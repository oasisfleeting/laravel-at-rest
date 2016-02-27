<?php

use Illuminate\Database\Migrations\Migration;

class CreateListingsPhotosTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'listings_photos', function ( Blueprint $table ) {
			$table->string( 'id' );
			$table->string( 'Public' );
			$table->string( 'MediaModificationTimestamp' );
			$table->string( 'MediaURL' );
			$table->string( 'listingId' );
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
