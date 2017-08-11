<?php
/*
Plugin Name: Force User Field Registration
Plugin URI: http://www.andrewferguson.net/wordpress-plugins/force-user-field-registration/
Plugin Description: Forces new users to register additional fields
Version: 0.11
Author: Andrew Ferguson
Author URI: http://www.andrewferguson.net/

Force User Field Registration - Forces new users to register additional fields
Copyright (c) 2007 Andrew Ferguson
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
*/


add_action('register_form', 'fergcorp_forceRegistrationField_addFields');
add_action('register_post', 'fergcorp_forceRegistrationField_checkFields');
add_action('fergcorp_forceRegistrationField_hook', 'fergcorp_forceRegistrationField_updateFields');

$fergcorp_forceRegistrationField_knownFields = array(
														"first_name"	=> "First Name",
														"last_name"		=> "Last Name",
														"nickname"		=>	"Nickname",
														"url"			=> "Website",
														"aim"			=> "AIM",
														"yim"			=> "Yahoo IM",
														"jabber"		=>	"Jabber / Google Talk"
													);


function fergcorp_forceRegistrationField_addFields(){

	global $fergcorp_forceRegistrationField_knownFields;

	$optionsValue = array("first_name", "last_name");

	foreach($optionsValue as $thisValue){
	?>
	<p>
		<label><?php _e($fergcorp_forceRegistrationField_knownFields[$thisValue]) ?><br />
		<input type="text" name="<?php echo $thisValue; ?>" id="<?php echo $thisValue; ?>" value="<?php echo attribute_escape(stripslashes($_POST[$thisValue])); ?>" class="input" value="" size="20" tabindex="10" /></label>
	</p>
	<?
	}

}

function fergcorp_forceRegistrationField_checkFields(){

	global $fergcorp_forceRegistrationField_knownFields, $errors;

	$optionsValue = array("first_name", "last_name");
	foreach($optionsValue as $thisValue){
		if ($_POST[$thisValue] == '') {
			$errors[$thisValue] = __('<strong>ERROR</strong>: Please type your '.$fergcorp_forceRegistrationField_knownFields[$thisValue].'.');
		}
	}
}

function fergcorp_forceRegistrationField_updateFields(){

	global $user_login, $wpdb, $current_user, $fergcorp_addField;

	$optionsValue = array("first_name", "last_name");

	$user_id = $wpdb->get_var("SELECT ID FROM $wpdb->users WHERE user_login = '$user_login' LIMIT 1");

	foreach($optionsValue as $thisValue){
		$wpdb->query("INSERT INTO $wpdb->usermeta ( `umeta_id` , `user_id` , `meta_key` , `meta_value` )
	VALUES (NULL , '$user_id', '".$thisValue."', '".$_POST[$thisValue]."')");
	}

}
?>