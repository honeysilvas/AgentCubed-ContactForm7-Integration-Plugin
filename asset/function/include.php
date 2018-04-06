<?php

if ( ! defined( "ABSPATH" ) ) exit; // Exit if accessed directly

// Code based on example from AgentCubed API documentation at https://portal.agentcubed.com/webshares/_media/api%20documentation/AgentCubed%20DataExchange%20V2%20Sample.zip
function agentcubed_submit_data( $data ){
	$client = new SoapClient( $data[ "credential" ][ "wsdl" ], array( 'trace' => true ) );	// Entity not defined error

	$xml = agentcubed_get_xml( $data );

	$xdoc = new DomDocument;
	$xmlschema = plugin_dir_path( __FILE__ ) . "../../asset/xml/cubed.xsd";
	$xdoc->LoadXML($xml);

	if ( $xdoc->schemaValidate($xmlschema) ) {		
		$response = $client->AddLeadsUsingXMLString( array('xmlstring' => $xml) );
		
		// If not succesful in pushing through API, send email instead so that lead can be manually added.
		if ( $response->AddLeadsUsingXMLStringResult->PortalServiceReturnDataList->StatusCode != 0 ){
			$message = "";
			foreach ( $data as $key => $value ){
				$message .= $key . ": " . $value . "<br />"; 
			}

			wp_mail( $data[ "credential" ][ "notification_email" ], "New Lead, not added successfully to AgentCubed", "This new lead was not added successfully to AgentCubed.  Please add this lead to AgentCubed manually.<br />" . $message );
		}
	}
}

function agentcubed_format_data( $data ){
	
	// Set default values for fields so submission to API doesn't fail because of wrong format of data.
	
	// Set empty values for unset fields.
	$field = array( "plan", "your_name", "your_last", "your_email", "your_phone", "your_zipcode", "your_dfb" );
	
	foreach ( $field as $key ){
		if ( !isset( $data[ $key ] ) ){
			$data[ $key ] = "";
		}
	}
	
	// Get current date and time
	$data[ "current_time" ] = date( "Y-m-d" ) . "T" . date( "H:i:s" );	// Format "2011-02-01T01:01:01";
	
	// Format zipcode into 5 digits
	while ( strlen( $data[ "your_zipcode" ] ) < 5 ){
		$data[ "your_zipcode" ] = $data[ "your_zipcode" ] . "0";		
	}
	
	// Format phone number into 10 digits
	while ( strlen( $data[ "your_phone" ] ) < 10 ){
		$data[ "your_phone" ] = $data[ "your_phone" ] . "0";
	}
	
	// Default date of birth if empty
	if ( empty ( $data[ "your_dfb" ] ) ){
		$data[ "your_dfb" ] = "1970-01-01";
	}
	
		// Default email if empty
	if ( empty ( $data[ "your_email" ] ) ){
		$data[ "your_dfb" ] = $data[ "credential" ][ "notification_email" ];
	}
	
	return $data;
}