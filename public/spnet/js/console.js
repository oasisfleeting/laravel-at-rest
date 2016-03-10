(function ($) {

	var version = '0.0.4';

	/**
	 * @function : get_defaults
	 * @returns  : Object
	 * @desc     : Returns Global Defaults
	 * */
	var get_defaults = function () {

		return {
			// The standard url that should be used to make requests
			url: window.location.pathname,

			// The HTTP Method that must be used for Ajax Requests
			method: 'GET',

			// The GET/POST parameter that should be used to make requests
			param: 'cmd',

			// Class of the the primary terminal container
			tty_class: 'cmd_terminal',

			// ps : The Primary Prompt (it's better to edit this using css)
			ps: '',

			// The theme that is applied by default
			theme: 'fallout',

			// Explicitly set width and height of the terminal
			// container. This may also be done in tty_class
			width : '99.5%',
			height: '550px',

			// Message to be shown when the terminal is first
			welcome: 'Laravel At Rest',

			// The password placeholder symbol
			placeholder: '*',

			// When command is not found: "CMD" will be replaced
			not_found: '<div> CMD: Command Not Found </div>',

			// Prefix for error messages
			error_prefix: 'An Error Occured: ',

			// Is Autocomplete feature Enabled
			autocomplete: true,

			// Is Command History Enabled
			history: true,

			// Number of entries to be stored in history
			history_max: 800,

			// The forms accept-charset attribute value
			charset: 'UTF-8',

			// The forms enctype attribute value
			enctype: 'multipart/form-data',

			// Autofocus on input on load
			autofocus: true,
		};
	};


	/**
	 * @property : dispatch
	 * @accessor : $.register_command ( See Below )
	 * @private
	 * @desc     : Stores command name and action to be taken when user enters a command.
	 **/
	var dispatch = {};

	/**
	 * @property : callbacks
	 * @accessor : $.register_callback ( See Below )
	 * @private
	 * @desc     : Callbacks object that stores callback methods.
	 **/
	var callbacks = {};

	/**
	 * @property : callbefores
	 * @accessor : $.register_callbefore ( See Below )
	 * @private
	 * @desc     : Calls fucntion before running through Ptty.
	 **/
	var callbefores = {};

	/**
	 * @property : history
	 * @accessor : $.fn.Ptty
	 * @private
	 * @desc     : Mantains the record of called commands
	 **/
	var history = [];

	/**
	 * @property : cmd_opts
	 * @accessor : $.set_command_option ( See Below )
	 * @private
	 * @desc     : Options of current command.
	 **/
	var cmd_opts = {
		// If set, edits the subroutine name
		cmd_name : null,
		// Command class
		cmd_class: null,
		// The ps value
		cmd_ps   : null,
		// The command string
		cmd_in   : null,
		// The output of the command.
		cmd_out  : null,
		// Set to true when you don't want cmd_in to be recorded
		cmd_quiet: null,
		// Set to a unique sting for secure transactions
		cmd_token: null,
		// Acumulates a string for a subroutine to use
		cmd_query: null,
		// Clears the selected option
		cmd_clean: null,
	};

	// Merge defaults with options
	var settings = get_defaults();


	/**
	 * @method   : native_commands
	 * @accessor : $.flush_commands and $.fn.Ptty
	 * @private
	 * @desc     : Registers the native Ptty commands
	 **/
	var native_commands = function (options) {

		$.register_command(
			'clear',
			'Cleans the screen leaving a new command prompt ready.',
			'clear [no options]',
			function () {
				$('.' + settings.tty_class + '_content').html('');
				return {type: 'print', out: '', quiet: 'clear'};
			}
		);

		if (settings.history) {
			$.register_command(
				'history',
				'Shows list of typed in commands.',
				'history [clear]',
				function (args) {
					var hist_out = '';
					if ($.trim(args[1]) == 'clear') {
						history = []
					} else if (history.length > 0) {
						var i, tmp;
						for (i in history) {
							tmp = history[i];
							hist_out += '<li>' + tmp + '</li>';
						}
						hist_out = '<ul class="ve-li">' + hist_out + '</ul>';
					}
					return {type: 'print', out: hist_out};
				}
			);
		}

		$.register_command(
			'help',
			'Displays a list of useful information.',
			'help [ [-a | --all] | [command] ]',
			function (tokens) {
				var help_out = '';
				if (typeof tokens[1] === 'string' && tokens[1].length > 0) {
					var cmd_to_show = $.trim(tokens[1]);
					if (cmd_to_show == '-a' || cmd_to_show == '--all') {
						help_out = '<b>Available commands:</b></br></br><ul class="ve-li">'
						for (i in dispatch) {
							help_out += '<li><p><b>' + i + '</b> - ' + dispatch[i].desc + '</br>';
							help_out += 'Usage: ' + dispatch[i].usage + '</p></br></li>';
						}
						help_out += '</ul>' + "\n";
					} else if (typeof dispatch[cmd_to_show] !== 'undefined') {
						help_out = '<b>' + cmd_to_show + '</b> - ' + dispatch[cmd_to_show].desc + '</br>';
						help_out += 'Usage: ' + dispatch[cmd_to_show].usage + "\n";
					} else {
						help_out = 'help:</br>The "' + cmd_to_show + '" option does not exist.' + "\n";
					}
				} else {
					help_out = 'Use "help [comand name]" to display specific info about a command.</br>' + "\n";
					help_out += 'Available commands are:</br><ul class="sq-li">';
					for (i in dispatch) {
						help_out += '<li>' + i + '</li>';
					}
					help_out += '</ul>' + "\n";
				}
				return {type: 'print', out: help_out};
			}
		);
	};

	/**
	 * @method : Ptty
	 * @public
	 * @desc   : Sets up the terminal on the jQuery object that represents a group of HTML nodes
	 * @args   : object
	 **/
	$.fn.Ptty = function (options) {

		settings = $.extend(true, settings, options);

		// jQuery Plugin
		return this.each(function () {

			var element = $(this);
			var hcurrent = null;

			// Setup some markup in the element
			// required for terminal emulation
			element.addClass(settings.tty_class).addClass(settings.tty_class + '_theme_' + settings.theme);
			if (settings.width && settings.height) {
				element.css({width: settings.width, height: settings.height});
			}

			element.html('').append('<div class="' + settings.tty_class + '_loading"><span><span></span></span></div>'
				+ '<div class="' + settings.tty_class + '_content"><div>' + settings.welcome + '</div></div>'
				+ '<div class="' + settings.tty_class + '_prompt">'
				+ '<span class="' + settings.tty_class + '_ps">'
				+ '<span class="' + settings.tty_class + '_active">' + settings.ps + '</span>&nbsp;</span>'
				+ '<form accept-charset="' + settings.charset + '" enctype="' + settings.enctype + '">'
				+ '<input type="text" autocomplete="off" /><input type="password" />'
				+ '<span class="upl_container hide"><input type="file" /><a href="javascript:void(0)" '
				+ 'onclick="$(this).parent().addClass(\'hide\').siblings(\'input[type=text]\').show();">Cancel</a></span>'
				+ '</form><progress class="' + settings.tty_class + '_progress"></progress></div>');

			// Representing prompt, form, input and content section in the terminal
			var prompt = element.find('span.' + settings.tty_class + '_active');
			var input_form = element.find('div:last form');
			var txt_input = input_form.find('input[type=text]');
			var psw_input = input_form.find('input[type=password]');
			var upl_input = input_form.find('input[type=file]');
			var content = element.find('div.' + settings.tty_class + '_content');
			var loading = element.find('div.' + settings.tty_class + '_loading');
			var progress = element.find('progress.' + settings.tty_class + '_progress');

			// Custom Dispatcher
			var cdispatch = null;

			// Storage for autocomplete and history
			var saved = {ac_save: null, h_save: null};

			// Set cursor on the prompt
			if (settings.autofocus) {
				txt_input.focus();
			}
			element.bind('select focus click', function () {
				if (txt_input.is(':visible')) {
					txt_input.focus();
				} else if (psw_input.is(':visible')) {
					psw_input.focus();
				}
			});

			// Make sure prompt is enabled
			prompt.removeAttr('disabled');

			// Register commands
			native_commands(options);


			//function beginProgress(){
			//	$('cmd_terminal_loading').show();
			//	$('cmd_terminal_loading > span:first-child').animate({'width':'60%'},50,'easein').promise().always(function(){
			//		//$('cmd_terminal_loading > span:first-child').wrap('<span>').css('border-top')
			//		//1px solid black');
			//	})
			//}

			/**
			 * @method   : update_content
			 * @private  :
			 * @desc     : Updates the content section. Must be the last function called.
			 * @args     : p, command, output
			 **/
			var update_content = function (p, command, output) {
				//console.log(p);console.log(command);console.log(output);
				// Override command options if any.
				var command_class = cmd_opts.cmd_class;
				if (command_class === null) {
					command_class = (cdispatch) ? settings.tty_class + '_sub' : settings.tty_class + '_ps';
				}

				if (cmd_opts.cmd_in !== null) command = cmd_opts.cmd_in;
				if (cmd_opts.cmd_out !== null) output = cmd_opts.cmd_out;

				if (cmd_opts.cmd_quiet == 'clear') {
					content.html('');
					p = '';
				} else if (cmd_opts.cmd_quiet == 'password') {
					command = Array(command.length + 1).join(settings.placeholder);
					p = '<span class="' + command_class + '"><span>' + p + '</span>&nbsp;' + command + '</span>';
				} else if (cmd_opts.cmd_quiet == 'blank') {
					p = '<span class="' + command_class + '"><span>' + p + '</span>&nbsp;</span>';
				} else if (cmd_opts.cmd_quiet == 'output') {
					p = '';
				} else {
					p = '<span class="' + command_class + '"><span>' + p + '</span>&nbsp;' + command + '</span>';
				}

				content.append('<div class="contentappended">' + p + '<div class="contentappendedtwo">' + output + '</div></div>');

				// Empty form for next command
				input_form.find('input').each(function (index, el) {
					$(this).val('');
				});

				// Reset cmd_opts.
				for (opt in cmd_opts) {
					// Dont remove subruoutine cmd_opts.
					if (opt !== 'cmd_clean' && opt !== 'cmd_name' && opt !== 'cmd_ps'
						&& opt !== 'cmd_query' && opt !== 'cmd_token') {
						cmd_opts[opt] = null;
					}
				};

				// End loading.
				loading.fadeOut(300);
				prompt.removeAttr('disabled').show();
			};

			/**
			 * @method   : get_prompt
			 * @private  :
			 * @desc     : Get the current prompt
			 **/
			var get_prompt = function () {
				var ps = (cdispatch) ? cdispatch.ps : settings.ps;
				return (cmd_opts.cmd_ps !== null) ? cmd_opts.cmd_ps : ps;
			};

			/**
			 * @method   : set_prompt
			 * @private  :
			 * @desc     : Set the current prompt
			 **/
			var set_prompt = function (ps) {
				if (cmd_opts.cmd_class === null) {
					cmd_opts.cmd_class = ( cdispatch ) ? settings.tty_class + '_sub' : settings.tty_class + '_ps';
				}
				if (ps === null) ps = (cdispatch) ? cdispatch.ps : settings.ps;
				prompt.html(ps);
				return ps;
			};

			/**
			 * @method   : cmd_do_ajax
			 * @private  :
			 * @desc     : Do ajax request
			 * @args     : key, value, tokens, ajax_url
			 **/
			var cmd_do_ajax = function (key, value, ajax_url) {
				$('.cmd_terminal_loading > span:first-child').animate({width:'100%'},1500,'linear').promise().always(function(){
					$('.cmd_terminal_loading > span:first-child').animate({width:'0%'},1500,'linear');
				});
				// Prepare data
				var ajax_data = {cmd: value};
				// Check for options
				if (cmd_opts.cmd_query !== null) ajax_data['cmd_query'] = cmd_opts.cmd_query;
				if (cmd_opts.cmd_in !== null) ajax_data['cmd'] = cmd_opts.cmd_in;
				if (cmd_opts.cmd_token !== null) ajax_data['cmd_token'] = cmd_opts.cmd_token;

				// Callbefore data
				if (value !== cmd_opts.cmd_in) ajax_data['cbf'] = value; // CHECK THIS

				// Check URL
				if (ajax_url === false || ajax_url == '' || typeof ajax_url === 'undefined') {
					ajax_url = (dispatch[key].type_of) ? dispatch[key].type_of : settings.url;
				}


				// Send
				$.ajax({
					type: settings.method,
					url : ajax_url,
					data: ajax_data
				})
					.done(function (data) {
						// Add called URL to result
						data['ajax_url'] = ajax_url;
						data = data || '';
						cmd_callback(value, data);
					})
					.fail(function () {
						// Error
						update_content(
							get_prompt(),
							value,
							'<div>' + settings.error_prefix + ' Invalid server response. </div>'
						);
					});
			};

			/**
			 * @method   : cmd_execute
			 * @private  :
			 * @desc     : Called after submit(). Separates request types.
			 * @args     : key (command), value (command + options), tokens (options array)
			 **/
			var cmd_execute = function (key, value, tokens) {
				if (key == '') {
					// empty command
					update_content(get_prompt(), value, '');

				} else if (cdispatch !== null) {
					// Custom Dispatch
					cmd_custom_dispatch(key, value, tokens);

				} else if (typeof dispatch[key] === 'undefined') {
					// Command not found
					update_content(get_prompt(), value, settings.not_found.replace('CMD', tokens[0]));

				} else if (typeof dispatch[key].type_of === 'object') {
					// Start hook for custom dispatch. (AJAX to different URLs)
					cmd_custom_dispatch(key, value, tokens);

				} else if (typeof dispatch[key].type_of === 'string') {
					// use AJAX method
					cmd_do_ajax(key, value, false);

				} else if (typeof dispatch[key].type_of === 'function') {
					// use javascript
					cmd_dispatch_js(dispatch[key].type_of, tokens, value);

				} else {
					// typeof dispatch[key].type_of === 'boolean' || 'symbol' || 'number'
					cmd_do_ajax(key, value, settings.url);
				}
			};

			/**
			 * @method   : start_subroutine
			 * @private  :
			 * @desc     : Starts Sub-routine.
			 * @args     : key
			 **/
			var start_subroutine = function (key) {
				cdispatch = dispatch[key].type_of;
				prompt.html(cdispatch.ps);
				element.find('div:last span:first')
					.toggleClass(settings.tty_class + '_ps ' + settings.tty_class + '_sub');

				cmd_opts.cmd_name = key;
				cmd_opts.cmd_ps = settings.ps; // first call lacks sub-ps
				cmd_opts.cmd_class = settings.tty_class + '_ps';

				saved.ac_save = settings.autocomplete;
				settings.autocomplete = false;
				saved.h_save = history;
				history = [];
			};

			/**
			 * @method   : end_subroutine
			 * @private  :
			 * @desc     : Ends Sub-routines.
			 **/
			var exit_subroutine = function () {
				prompt.html(null);
				element.find('div:last span:first')
					.toggleClass(settings.tty_class + '_ps ' + settings.tty_class + '_sub');

				// cmd_opts reset will be done uppon next command.
				cmd_opts.cmd_ps = (cmd_opts.cmd_ps !== null) ? cmd_opts.cmd_ps : cdispatch.ps;
				cmd_opts.cmd_class = settings.tty_class + '_ps';
				cmd_opts.cmd_name = null;
				cmd_opts.cmd_token = null;
				cmd_opts.cmd_query = null;

				settings.autocomplete = ( saved.ac_save ) ? saved.ac_save : false;
				history = ( saved.h_save ) ? saved.h_save : [];
				cdispatch = null;
			};

			/**
			 * @method   : cmd_custom_dispatch
			 * @private  :
			 * @desc     : Handles Sub-routines.
			 * @args     : key, value, tokens
			 **/
			var cmd_custom_dispatch = function (key, value, tokens) {
				var hook = settings.url

				if (cdispatch == null) {
					// Do START and save settings
					start_subroutine(key);
					hook = cdispatch.start_hook;

				} else if (cdispatch) {

					if (key == 'quit' || key == 'exit') {
						// Do EXIT and recover settings
						hook = cdispatch.exit_hook;
						exit_subroutine();

					} else {
						// Do REGULAR call
						hook = cdispatch.dispatch_method;
					}
				}

				if (typeof hook === 'string') {
					// use AJAX
					cmd_do_ajax(key, value, hook);
				} else if (typeof hook === 'function') {
					// use javascript
					cmd_dispatch_js(hook, tokens, value);
				}
			};

			/**
			 * @method   : cmd_dispatch_js
			 * @private  :
			 * @desc     : Executes JS function
			 * @args     : key, value, tokens
			 **/
			var cmd_dispatch_js = function (js_func, tokens, value) {
				return cmd_callback(value, js_func(tokens));
			};

			/**
			 * @method   : cmd_callback
			 * @private  :
			 * @desc     : Does requested type action, or executes top level function.
			 * @args     : value, data
			 **/
			var cmd_callback = function (value, data) {
				data = data || '';
				var cbk = {ps: get_prompt(), output: ''};

				// Set type of prompt
				switch (data.type) {
					case 'prompt':
						// Ask for information (generate token)
						if (!cmd_opts.cmd_token) {
							var token1 = Math.random().toString(36).substr(2),
								token2 = Math.random().toString(36).substr(2),
								token3 = Math.random().toString(36).substr(2);
							cmd_opts.cmd_token = token1 + token2 + token3;
						}
						break;
					case 'password':
						// Change input type to password
						txt_input.hide();
						psw_input.show().focus();
						break;
					case 'upload':
						// Set settings
						if (typeof data.upload_multiple != 'undefined') upl_input.attr('multiple', 'multiple');
						if (typeof data.upload_accept != 'undefined') upl_input.attr('accept', data.upload_accept);

						// Show file selector
						txt_input.hide();
						upl_input.parent().removeClass('hide');

						// File input listener
						upl_input.bind('change', function () {
							upl_input.parent().addClass('hide');
							txt_input.show();

							if (upl_input.val() != '') {
								cmd_upload(this.files, data);
							}
							// Reset input
							upl_input.attr('accept', '');
							upl_input.attr('multiple', '');
							upl_input.val('');
						});

						break;
					default:
						data.type = 'print';
						break;
				}

				// For the last subroutine.
				if (value == 'exit' || value == 'quit') {
					cbk.ps = cmd_opts.cmd_ps;
					cmd_opts.cmd_ps = null;
				}

				// Check response for overrides
				cmd_opts.cmd_ps = ( typeof data.ps !== 'undefined' ) ? set_prompt(data.ps) : null;
				if (typeof data.class !== 'undefined') cmd_opts.cmd_class = data.class;
				if (typeof data.in !== 'undefined') cmd_opts.cmd_in = data.in;
				if (typeof data.out !== 'undefined') cbk.output = cmd_opts.cmd_out = data.out;
				if (typeof data.quiet !== 'undefined') cmd_opts.cmd_quiet = data.quiet;
				if (typeof data.token !== 'undefined') cmd_opts.cmd_token = data.token
				if (typeof data.query !== 'undefined') cmd_opts.cmd_query = data.query;
				if (typeof data.clean !== 'undefined') cmd_opts.cmd_clean = data.clean;

				// Update content accordingly
				update_content(cbk.ps, value, cbk.output);

				// Must go after update_content
				if (typeof data.exit !== 'undefined' && cdispatch) {
					exit_subroutine();
					cmd_opts.cmd_ps = null;
				}

				// Check if function exists in callbacks object
				if (typeof data.callback !== 'undefined' && data.type !== 'upload') {
					run_custom_callback(cbk, data);
				}
			};

			var run_custom_callback = function (cbk, data) {
				try {
					if (typeof callbacks[data.callback] === 'function') {
						cbk.output = callbacks[data.callback](data);
					} else {
						throw( settings.error_prefix + ' ' + data.callback + ' callback unknown.');
					}
				} catch (e) {
					// Debug
				}
			};

			/**
			 * @method   : scroll_to_bottom
			 * @private  :
			 * @desc     : This interval is necessary due to the dynamic content div.
			 **/
			var scroll_to_bottom = function () {
				var tries = 0, old_height = new_height = element.height();
				var intervalId = setInterval(function () {
					if (old_height != new_height) {
						// Env loaded
						clearInterval(intervalId);
						element.animate({scrollTop: new_height}, 'slow');
					} else if (tries >= 30) {
						// Give up (and scroll anyway)
						clearInterval(intervalId);
						element.animate({scrollTop: new_height}, 'slow');
					} else {
						new_height = content.height();
						tries++;
					}
				}, 50);
			};

			/* Adds a progress bar to any process */
			var progress_handler = function (e) {
				if (e.lengthComputable) {
					progress.attr({
						value: e.loaded,
						max  : e.total
					});
				}
			}

			/* Cleanup and scroll */
			var clean_and_scroll = function () {
				//	if(txt_input.is(':visible')) {
				//		txt_input.val('');
				//		txt_input.focus();
				//	}else if(psw_input.is(':visible')){
				//		psw_input.val('');
				//		psw_input.focus();
				//	}
				//	scroll_to_bottom();
			}

			/**
			 * @method   : cmd_upload
			 * @private  :
			 * @desc     : attempts to upload a file via ajax
			 **/
			var cmd_upload = function (files, data) {

				var files_selected = '';

				if (typeof data.upload_to !== 'undefined') {
					var ajax_url = data.upload_to;
				} else {
					var ajax_url = (cdispatch !== null) ? cdispatch.dispatch_method : settings.url;
				}

				// Add files
				var formData = new FormData();
				for (var i = 0; i < files.length; i++) {
					formData.append("file_" + i, files[i]);
					files_selected += ' ' + files[i].name;
				}
				;

				// Add data
				for (var key in data) {
					formData.append(key, data[key]);
				}
				;

				progress.show();

				$.ajax({
					url        : ajax_url,
					type       : 'POST',
					xhr        : function () {
						var myXhr = $.ajaxSettings.xhr();

						if (myXhr.upload) {
							myXhr.upload.addEventListener($('progress'), progress_handler, false);
						}
						return myXhr;
					},
					// Form data
					data       : formData,
					//Options to not process data or worry about content-type.
					cache      : false,
					contentType: false,
					processData: false
				})
					.done(function (response) {
						//console.log('Uploaded:'+files_selected+' to '+ajax_url);
						update_content(get_prompt(), files_selected, response.out);
					})
					.fail(function () {
						var error = (typeof response.out !== 'undefined') ? response.out : 'Error.'
						update_content(get_prompt(), files_selected, response.out);
					})
					.always(function () {
						progress.hide();
					});
			};

			/**
			 * @method   : Anonymous
			 * @private  :
			 * @event_handler
			 **/
			input_form.submit(function (e) {
				e.preventDefault();
				e.stopPropagation();

				var value, save_to_history;
				if (psw_input.val().length) {
					// Password input
					value = psw_input.val();
					psw_input.val('');
				} else if (upl_input.val().length) {
					// Upload input
					value = upl_input.val();
					upl_input.val('');
				} else {
					// Text input
					// Encode value by putting it in a fake container and fishing it out.
					value = $.trim($('<div/>').text(txt_input.val()).html());
					// If first character is whitespace don't save.
					var save_to_history = (value.charAt(0) == ' ') ? false : true;
				}

				// Cache input (without query)
				cmd_opts.cmd_in = value;

				// Concatenate if query is still set
				if (cmd_opts.cmd_query !== null) value = cmd_opts.cmd_query + value;

				// Reset name, ps, or query on demand
				if (cmd_opts.cmd_clean !== null) {
					if (typeof cmd_opts.cmd_clean == 'object') {
						for (var i = 0; i < cmd_opts.cmd_clean.length; i++) {
							var to_clean = 'cmd_' + cmd_opts.cmd_clean[i];
							if (cmd_opts.hasOwnProperty(to_clean)) {
								cmd_opts[to_clean] = null;
							}
						}
						;
					} else if (typeof cmd_opts.cmd_clean == 'string' && cmd_opts.hasOwnProperty('cmd_' + cmd_opts.cmd_clean)) {
						cmd_opts['cmd_' + cmd_opts.cmd_clean] = null;
					}
					// Reset the clean option and prompt
					set_prompt(cmd_opts.cmd_ps);
					cmd_opts.cmd_clean = null;
				}

				var tokens = value.split(/\s+/);
				var key = tokens[0];

				// Add to history
				if (settings.history && (typeof dispatch[key] !== 'undefined' || cdispatch)
					&& save_to_history && value.length && cmd_opts.cmd_quiet === null) {

					if (history.length > settings.history_entries) {
						history.shift();
					}
					// HTML Decode before inserting
					history.push($.trim($('<div/>').html(value).text()));
				}
				// Reset history
				hcurrent = 0;

				// Activate loading
				loading.show();
				prompt.attr('disabled', 'disabled').hide();

				// Run Callbefores
				if (key in callbefores && typeof callbefores[key] == 'function') {
					var cbf_result = callbefores[key](value);
					if (cbf_result === false) {
						clean_and_scroll();
						// End here.
						return update_content(get_prompt(), value, '');
					} else if (typeof cbf_result == 'string') {
						value = cbf_result;
						tokens = value.split(/\s+/);
						key = tokens[0];
					}
				}

				// Play ball...
				cmd_execute(key, value, tokens);

				// Cleanup and Scroll
				clean_and_scroll();
			});

			/**
			 * @method   : Anonymous
			 * @private  :
			 * @desc     : Add event handlers to the txt_input field
			 * @event_handler
			 **/
			txt_input.keydown(function (e) {
				var keycode = e.keyCode;
				switch (keycode) {
					// Command Completion Tab
					case 9:
						e.preventDefault();
						if (settings.autocomplete) {
							var commands = [];
							var current_value = $.trim(txt_input.val());
							if (current_value.match(/^[^\s]{0,}$/)) {
								for (i in dispatch) {
									if (current_value == '') {
										commands.push(i);
									} else if (i.indexOf(current_value) == 0) {
										commands.push(i);
									}
								}

								if (commands.length > 1) {
									update_content(
										get_prompt(),
										current_value,
										'<ul class="sq-li"><li>' + commands.join('</li><li>') + '</li></ul>'
									);
								} else if (commands.length == 1) {
									txt_input.val(commands.pop() + ' ');
								}
							}
						}
						scroll_to_bottom();
						break;

					// History Up
					case 38:
						e.preventDefault();
						if (settings.history) {
							hcurrent = ( hcurrent === null || hcurrent == 0 ) ? history.length - 1 : hcurrent - 1;
							txt_input.val(history[hcurrent]);
						}
						break;

					// History Down
					case 40:
						e.preventDefault();
						if (settings.history) {
							if (hcurrent === null || hcurrent == (history.length - 1 )) {
								txt_input.val('');
								break;
							}
							hcurrent++;
							txt_input.val(history[hcurrent]);
						}
						break;

					// Scroll down on Enter
					case 13:
						e.preventDefault();
						input_form.submit(); // important!
						scroll_to_bottom();
						txt_input.focus();
						break;
				}
			});

			/**
			 * @method   : Anonymous
			 * @private  :
			 * @desc     : Add event handlers to the password field
			 * @event_handler
			 **/
			psw_input.keydown(function (e) {
				if (psw_input.is(':visible')) {
					var keycode = e.keyCode;
					switch (keycode) {
						//  Enter: Empty and hide password input
						case 13:
							e.preventDefault();
							input_form.submit();
							psw_input.hide();
							txt_input.show();
							scroll_to_bottom();
							txt_input.focus();
							break;
					}
				}

			});

			/**
			 * @method   : Anonymous
			 * @private  :
			 * @desc     : Add event handlers to the document
			 * @event_handler
			 **/
			$(document).keydown(function (e) {
				var keycode = e.keyCode;
				switch (keycode) {
					// Escape: Focus back to input
					case 27:
						if (txt_input.is(':visible')) {
							txt_input.focus();
						} else if (psw_input.is(':visible')) {
							psw_input.focus();
						} else if (upl_input.is(':visible')) {
							upl_input.parent().addClass('hide')
								.siblings('input[type=text]').show().focus();
						}
						break;
				}
			});
		});
	};

	/**
	 * @method : register_command
	 * @public
	 * @desc   : Accepts a str as command name and a function, object or string as dispatch method.
	 **/
	$.register_command = function (command, cmd_desc, cmd_usage, dispatch_method) {
		var ret = false;
		if (typeof dispatch_method === 'string' || typeof dispatch_method === 'object' || typeof dispatch_method === 'function') {
			dispatch[command] = {desc: cmd_desc, usage: cmd_usage, type_of: dispatch_method};
			ret = true;
		}
		return ret;
	};

	/**
	 * @method : register_callback
	 * @public
	 * @desc   : Adds the name of the callback (to invoke) and the method (to execute)
	 **/
	$.register_callback = function (cbk_name, cbk_method) {
		var ret = false;
		if (typeof cbk_method === 'string' || typeof cbk_method === 'object' || typeof cbk_method === 'function') {
			callbacks[cbk_name] = cbk_method;
			ret = true;
		}
		return ret;
	};

	/**
	 * @method : register_callbefore
	 * @public
	 * @desc   : Adds the name of the registered command and the method (to execute)
	 **/
	$.register_callbefore = function (cbf_name, cbf_method) {
		var ret = false;
		if (typeof cbf_method === 'function') {
			callbefores[cbf_name] = cbf_method;
			ret = true;
		}
		return ret;
	};

	/**
	 * @method : flush_commands
	 * @public
	 * @desc   : Empties the dispatch property
	 **/
	$.flush_commands = function (options) {
		dispatch = {};
		$.set_command_option(options);
		// Register native commands again.
		native_commands(options);
	};

	/**
	 * @method : set_command_option
	 * @public
	 * @desc   : Edits the cmd_opts property.
	 * @option_obj : An object containing any of the cmd_opts attributes.
	 **/
	$.set_command_option = function (option_obj) {
		return $.extend(true, cmd_opts, option_obj);
	};

	/**
	 * @method : get_command_option
	 * @public
	 * @desc   : Returns the cmd_opts value for the property requested.
	 * @options   : The name of the property
	 **/
	$.get_command_option = function (options) {
		var out = {};
		if (typeof options == 'string') {
			if (typeof cmd_opts[options] !== 'undefined') {
				out[options] = cmd_opts[options];
			}
		} else {
			for (opt in options) {
				if (typeof cmd_opts[opt] !== 'undefined') {
					out[opt] = cmd_opts[opt];
				}
			}
		}
		return out;
	};

	/**
	 * @method : tokenize
	 * @public
	 * @desc   : Will attempt to return an array where text has been tokenized in a command line fashion.
	 * @str   : A string, for example: first -s second "argument.sh -xyz" --foo="bar \'baz\' 123" -abc
	 * @arr   : An array with the options to look for eg ['--option','-x','-y','-z']
	 **/
	$.tokenize = function (command_str, options_arr) {
		var out = {};
		var option = value = quote_type = quote_open = false;
		var cmd = command_str.split(/\s+/);
		cmd.shift();

		for (var i = 0; i < cmd.length; i++) {
			if ($.inArray(cmd[i], options_arr) >= 0) {
				// Get option
				option = cmd[i];
				value = false;
			} else if (cmd[i].charAt(0) == '"' && quote_open === false) {
				quote_type = '"';
				quote_open = true;
				value = cmd[i];
			} else if (cmd[i].charAt(0) == "'" && quote_open === false) {
				quote_type = "'";
				quote_open = true;
				value = cmd[i];
			} else if (cmd[i].slice(-1) == quote_type && quote_open === true) {
				quote_open = false;
				value += ' ' + cmd[i];
				// Trim & Strip slashes
				value = $.trim(value.substring(1).slice(0, -1).replace(/\\(.)/mg, "$1"));
			} else if (quote_open === true) {
				value += ' ' + cmd[i];
			} else {
				value = cmd[i];
			}
			// Add to output
			if (option && quote_open === false) {
				out[option] = value;
			}
		}
		return out;
	}

})(jQuery);