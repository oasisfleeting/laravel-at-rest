<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;


class ParseListings extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'parselistings';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Parses xml from sntmedia xml';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		$this->parse();
	}

	/**
	 * parse xml and store it in the database
	 */
	public function parse() {
		//parse listings from sntmedia
		//$url = 'https://sntmedia.atlassian.net/wiki/download/attachments/4358316/listings.xml?version=1&modificationDate=1455562119802&api=v2';
		$url                 = '../resources/xml/listings.xml';
		$url                 = file_get_contents( $url );
		$listings            = simplexml_load_string( $url );
		$this->xmlNamespaces = $listings->getDocNamespaces( true );
		$xmlns               = array_shift( $this->xmlNamespaces );
		$attributes          = array();
		$attributes['table'] = 'listings';
		$spListing           = new \App\Models\Listing();
		$spListingPhoto      = new \App\Models\Listingsphotos();
		$list                = array();
		$i                   = 0;
		foreach ( $listings as $listing ) {
			$list[ $i ]['Address'] = (array) $listing->Address[0]->children( $xmlns );
			foreach ( $list[ $i ]['Address'] as $key => $val ) {
				$list[ $i ][ $key ] = $val;
			}
			unset( $list[ $i ]['Address'] );

			$list[ $i ]['ListPrice']       = $this->xml_value( $listing->ListPrice );
			$list[ $i ]['ListPricePublic'] = $this->xml_value( $listing->ListPrice->attributes( $xmlns )['isgSecurityClass'] ) === 'Public' ? 1 : 0;

			$list[ $i ]['PropertyType'] = $this->proptype( $listing->PropertyType );

			$list[ $i ]['DiscloseAddress']    = $this->xml_value( $listing->DiscloseAddress ) == true ? 1 : 0;
			$list[ $i ]['ListingURL']         = $this->xml_value( $listing->ListingURL );
			$list[ $i ]['Bedrooms']           = $this->xml_value( $listing->Bedrooms );
			$list[ $i ]['Bathrooms']          = $this->xml_value( $listing->Bathrooms );
			$list[ $i ]['ListingKey']         = $this->xml_value( $listing->ListingKey );
			$list[ $i ]['ListingCategory']    = $this->xml_value( $listing->ListingCategory );
			$list[ $i ]['ListingStatus']      = $this->xml_value( $listing->ListingStatus );
			$list[ $i ]['ListingDescription'] = $this->xml_value( $listing->ListingDescription );
			$list[ $i ]['MlsId']              = $this->xml_value( $listing->MlsId );
			$list[ $i ]['MlsName']            = $this->xml_value( $listing->MlsName );
			$list[ $i ]['MlsNumber']          = $this->xml_value( $listing->MlsNumber );


			//$list[ $i ]['createdOn'] = date( 'Y-m-d G:i:s', time() );
			$list[ $i ]['listingId'] = $spListing->insertRow( $list[ $i ], 0 );
			$list[ $i ]['Photos']    = $this->xml_values( $listing->Photos->children(), $xmlns );

			$photos = array();
			//this is unneccessary for the xml given, but I assume eventually there will be non public photos?
			foreach ( $list[ $i ]['Photos'] as $accessKey => $val ) {
				for ( $j = 0; $j < count( $val ); $j ++ ) {
					//public
					$photos              = $val[ $j ];
					$photos['listingId'] = $list[ $i ]['listingId'];
					$photos['Public']    = $accessKey === 'Public' ? 1 : 0;
					$photoId = $spListingPhoto->insertRow($photos,0);
				}
			}
			$i ++;
		}


		$this->comment( print_r( $list[0] ) );
	}

	public function proptype( $object ) {
		$key       = (array) $object;
		$otherDesc = $this->xml_value( $object );
		$otherDesc = array_shift( $otherDesc );
		if ( $key[0] !== $otherDesc ) {
			return $key[0] . ' (' . $otherDesc . ')';
		} else {
			return $key[0];
		}
	}

	public function xml_value( $xmlobject ) {
		$array = (array) $xmlobject;

		return array_shift( $array );
	}

	public function xml_values( $array, $namespace ) {
		$ret = array();
		if ( $array->count() > 0 ) {
			$array = $this->xml_value( $array );
			if ( ! is_array( $array ) ) {
				$array = array( $array );
			}
			for ( $i = 0; $i < count( $array ); $i ++ ) {
				$key           = (string) $array[ $i ]->children()->attributes( $namespace )['isgSecurityClass'];
				$array[ $i ]   = (array) $array[ $i ];
				$keys          = array_keys( $array[ $i ] );
				$vals          = array_values( $array[ $i ] );
				$vals[0]       = date( 'Y-m-d G:i:s', strtotime( $vals[0] ) );
				$ret[ $key ][] = array_combine( $keys, $vals );
			}
		}

		return $ret;
	}
}
