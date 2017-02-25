<?php 

/*
	Plugin Name: AgentCubed ContactForm7 Integration
	Plugin URI: http://silverhoneymedia.com
	Description: AgentCubed ContactForm7 Integration
	Author: Honey Silvas
	Version: 0.0.1
	Author URI: http://silverhoneymedia.com
*/

// Gets submitted information from Contact Form 7.
function agentcubed_before_send_mail ( $submission ) {

	// Use WPCF7_Submission object's get_posted_data() method to get it. 
	$submission = WPCF7_Submission::get_instance();
	
	if ( $submission ) {
		$data = $submission->get_posted_data();
		
		if ( !empty ( $data[ "your_email" ] ) ){	// Check which form is submitted	
			// Include files.
			include( plugin_dir_path( __FILE__ ) . "asset/config/config.php" );
			include( plugin_dir_path( __FILE__ ) . "asset/function/include.php" );
			include( plugin_dir_path( __FILE__ ) . "asset/xml/xml.php" );

			// Format values.
			$data = agentcubed_format_data( $data );
			
			// Get login information for AgentCubed
			$data[ "credential" ] = agentcubed_get_config();
			agentcubed_submit_data( $data );
		}
	}
}

// Hook into Contact Form 7's before send mail action.
add_action( "wpcf7_before_send_mail", "agentcubed_before_send_mail" );