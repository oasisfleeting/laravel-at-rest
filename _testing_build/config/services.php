<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun'  => ['domain' => '', 'secret' => '',],

	'mandrill' => ['secret' => '',],

	'ses'      => ['key' => '', 'secret' => '', 'region' => 'us-east-1',],

	'stripe'   => ['model' => 'App\User', 'secret' => '',],

	'google'   => ['client_id'     => '', // 'client_id' => '1038196167526-euluve7af4mhfgde9vr79a8s1or4t8it',
	               'client_secret' => '', 'redirect' => '',],

	'twitter'  => ['client_id'     => '', //'client_id' => '',
	               'client_secret' => '', 'redirect' => '',],

	'facebook' => ['client_id'     => '', //'client_id' => '',
	               'client_secret' => '', 'redirect' => '',],

];
