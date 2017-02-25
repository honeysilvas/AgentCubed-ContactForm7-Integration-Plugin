<?php 

// Configuration Details.

if ( ! defined( "ABSPATH" ) ) exit; // Exit if accessed directly

function agentcubed_get_config(){

	// Enter your login details here:
	$credential = array(
			"username" => "username",
			"password" => "password",
			"group_weblead_id" => "000000",
			"notification_email" => "silverhoneymedia@gmail.com",
			"lead_source_key" => "00000000-0000-0000-0000-000000000000",
			"url" => "https://dataexchange.agentcubed.com/PortalService/PortalService.asmx",
			"wsdl" => "https://dataexchange.agentcubed.com/PortalService/PortalService.asmx?wsdl",
		);
	
	// Test URLs
//	$credential[ "url" ] = "https://test.agentcubed.com/DataExchangeV2/PortalService/PortalService.asmx";	// dev
//	$credential[ "wsdl" ] = "https://test.agentcubed.com/DataExchangeV2/PortalService/PortalService.asmx?wsdl";	// dev

	return $credential;
}