# AgentCubed ContactForm7 Integration Plugin

This is a WordPress plugin that submits form submissions from ContactForm7 to AgentCubed using the AgentCubed API.


# Details

Contributors: honeysilvas

Website: http://silverhoneymedia.com

Tags: ContactForm7, AgentCubed, API, integration, WordPress plugin


# Installation
=================================

- Download AgentCubed-ContactForm7 Integration Plugin

https://github.com/honeysilvas/AgentCubed-ContactForm7-Integration-Plugin

- Open the "asset\config\config.php" file with a text editor (like Notepad) and add in your login information.

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

- Add additional fields in the XML file.

	If you need to add additional fields, you can add them in the asset/xml/xml.php file.

	You can see examples of the XML file in the AgentCubed Documentation https://portal.agentcubed.com/webshares/_media/api%20documentation/AgentCubed%20DataExchange%20V2%20Sample.zip 
	in the AgentCubed DataExchange V2 Sample\App_Data directory.  The easiest to understand example is the Sample Agency minimum requirements.xml file since it only shows the minimum required fields you need to submit.

	The schema is defined in the asset/xml/cubed.xsd.  (This XSD code is from AgentCubed so no need to modify this code).

	On the asset/function/include.php file, add the name of the fields to the $field array.  This sets them to "" (blank) if the variable is not set to avoid variable not set errors.

	// Set empty values for unset fields.
	
    $field = array( "plan", "your_name", "your_last", "your_email", "your_phone", "your_zipcode", "your_dfb", "your_state", "your_city" );	
	
- Install the Plugin
Upload the entire folder to the '/wp-content/plugins/' directory of your WordPress installation.
https://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation 

- Activate the plugin through the 'Plugins' menu in the WordPress Admin Dashboard.

- Make sure you have ContactForm7 plugin installed and activated.

- That's it!






# How it Works

The plugin uses the wpcf7_before_send_mail hook that is triggered when a user submits a form.
 
The plugin gets the form data and formats it to an XML format.
 
The plugin submits the data to the AgentCubed API url using the login credentials in the asset/config/config.php file.
 
In case of error, the form data gets emailed to the email specified in the notification email variable (also set in asset/config/config.php) and would just then need to be manually entered into the AgentCubed system.



# References: 

AgentCubed Documentation
https://portal.agentcubed.com/webshares/_media/api%20documentation/AgentCubed%20DataExchange%20V2%20Sample.zip

Contact Form 7 Documentation
http://contactform7.com/docs/
 
Contact Form 7 List of Hooks
https://github.com/jgrossi/contact-form-7-hooks

Unofficial Documentation for Contact Form 7
http://xaviesteve.com/3298/wordpress-contact-form-7-hook-unofficial-developer-documentation-and-examples/

