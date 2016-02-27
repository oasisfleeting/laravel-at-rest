<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListingsPhotosTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'listings_photos', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->enum( 'Public',array(1,0) );
			$table->timestamp('MediaModificationTimestamp' );
			$table->string( 'MediaURL' );
			$table->integer( 'listingId' );
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop( 'listings_photos' );
	}
}
