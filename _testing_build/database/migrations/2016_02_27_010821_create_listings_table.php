<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateListingsTable
 */
class CreateListingsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	/*id                    INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	FullStreetAddress     VARCHAR (255) NOT NULL,
	City                  VARCHAR (255) NOT NULL,
	StateOrProvince       VARCHAR (255) NOT NULL,
	PostalCode            INT NOT NULL,
	Country               VARCHAR (255) NOT NULL,
	DiscloseAddress       CHAR(2) DEFAULT '1' NOT NULL,
	ListPrice             DECIMAL(10,2) NOT NULL,
	ListPricePublic       CHAR(2) DEFAULT '1' NOT NULL,
	ListingURL            VARCHAR (255) NOT NULL,
	Bedrooms              TINY INT NOT NULL,
	Bathrooms             TINY INT NOT NULL,
	PropertyType          VARCHAR (255) NOT NULL,
	ListingKey            VARCHAR (255) NOT NULL,
	ListingCategory       VARCHAR (255) NOT NULL,
	ListingStatus         VARCHAR (255) NOT NULL,
	ListingDescription    VARCHAR (255) NOT NULL,
	MlsId                 VARCHAR (255) NOT NULL,
	MlsName               VARCHAR (255) NOT NULL,
	MlsNumber             INT NOT NULL*/
	public function up()
	{
		Schema::create('listings', function (Blueprint $table)
		{
			$table->increments('id');//INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
			$table->string('FullStreetAddress');//VARCHAR (255) NOT NULL,
			$table->string('City');//VARCHAR (255) NOT NULL,
			$table->string('StateOrProvince');//VARCHAR (255) NOT NULL,
			$table->integer('PostalCode');//INT NOT NULL,
			$table->string('Country');//VARCHAR (255) NOT NULL,
			$table->char('DiscloseAddress');//CHAR(2) DEFAULT '1' NOT NULL,
			$table->decimal('ListPrice', 10, 2);//DECIMAL(10,2) NOT NULL,
			$table->enum('ListPricePublic', array(1, 0));//CHAR(2) DEFAULT '1' NOT NULL,
			$table->string('ListingURL');//VARCHAR (255) NOT NULL,
			$table->tinyInteger('Bedrooms');//TINY INT NOT NULL,
			$table->tinyInteger('Bathrooms');//TINY INT NOT NULL,
			$table->string('PropertyType');//VARCHAR (255) NOT NULL,
			$table->string('ListingKey');//VARCHAR (255) NOT NULL,
			$table->string('ListingCategory');//VARCHAR (255) NOT NULL,
			$table->string('ListingStatus');//VARCHAR (255) NOT NULL,
			$table->string('ListingDescription');//VARCHAR (255) NOT NULL,
			$table->string('MlsId');//VARCHAR (255) NOT NULL,
			$table->string('MlsName');//VARCHAR (255) NOT NULL,
			$table->integer('MlsNumber');//INT NOT NULL
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('listings');
	}
}
