<?php
function isAdminLoggedIn() { //Function to check if the user accessing server side pages is logged in
	$CI = get_instance();
	$CI->load->library('session'); //Get current session

	if ($CI->session->userdata('aId')) { //Check if the ID exists
		return TRUE;
	} else {
		return FALSE;
	}
}
function redirectTo($url,$message,$htmlClass) //Function takes a message and html class -> Responds with redirection to URL with said response
{
	$CI = get_instance(); //Gets current instance, page info etc
	$CI->load->library('session'); //Get current session
	$CI->session->set_flashdata('class',$htmlClass); //Sets the class to respond with
	$CI->session->set_flashdata('message',$message); //Sets the message to respond with
	redirect($url); //Redirect to URL with the message
}
?>
