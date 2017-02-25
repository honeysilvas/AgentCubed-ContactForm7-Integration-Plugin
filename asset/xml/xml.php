<?php 

if ( ! defined( "ABSPATH" ) ) exit; // Exit if accessed directly

function agentcubed_get_xml( $data ){

	$xml = '<?xml version="1.0" encoding="utf-8"?>
		<AgentCubedAPI xmlns="http://dataexchange.agentcubed.com" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
			<LoginCredentials>
				<ErrorNotificationEmail>' . $data[ "credential" ][ "notification_email" ] . '</ErrorNotificationEmail>
				<Username>' . $data[ "credential" ][ "username" ] . '</Username>
				<Password>' . $data[ "credential" ][ "password" ] . '</Password>
				<Group_WebLead_ID>' . $data[ "credential" ][ "group_weblead_id" ] . '</Group_WebLead_ID>
				<LeadSourceKey>' . $data[ "credential" ][ "lead_source_key" ] . '</LeadSourceKey>
			</LoginCredentials>
			<Leads>
				<Lead>
		           <LeadInformation>
						<AdditionalContent03>' . $data[ "plan" ] . '</AdditionalContent03>
						<LeadGeneratedDateTime>' . $data[ "current_time" ] . '</LeadGeneratedDateTime>
					</LeadInformation>
					<LeadIndividuals>
						<Individual IndividualID="0">
							<DOB>' . $data[ "your_dfb" ] . '</DOB>
							<LastName>' . $data[ "your_last" ] . '</LastName>
							<FirstName>' . $data[ "your_name" ] . '</FirstName>
							<Email>' . $data[ "your_email" ] . '</Email>
							<RelationType>Applicant</RelationType>
						</Individual>
					</LeadIndividuals>
					<LeadOpportunities>
						<Opportunity>
							<InsuranceType>Health</InsuranceType>
						</Opportunity>
					</LeadOpportunities>					
					<LeadContactDetails>
						<PrimaryPhone>' . $data[ "your_phone" ] . '</PrimaryPhone>
						<Address>						
							<ZipCode>' . $data[ "your_zipcode" ] . '</ZipCode>
						</Address>
					</LeadContactDetails>
				</Lead>
			</Leads>
		</AgentCubedAPI>';
		
	return $xml;
}