=== Force User Field Registration ===
Contributors: fergbrain
Donate link: http://www.andrewferguson.net/2007/03/08/general-note/
Tags: user, registration, force, field, register
Requires at least: 2.1
Tested up to: 2.3 Beta 3
Stable tag: 0.11

Forces new users to register additional fields (such as first name and last name).

== Description ==

See http://www.andrewferguson.net/wordpress-plugins/force-user-field-registration/ for all the latest updates.

== Installation ==

Download the file and put it in your plugins directory.

You will then need to modify your wp-login.php file by adding `do_action('fergcorp_forceRegistrationField_hook');` right after line 245:

`else {
	do_action('fergcorp_forceRegistrationField_hook');
	wp_new_user_notification($user_id, $user_pass);
	wp_redirect('wp-login.php?checkemail=registered');
	exit();
}`

 Activate it.

The current version is configured to ask for first and last name. However, it also supports nickname, website, AIM, Yahoo! IM, and Jabber/GTalk. For the time being, to add/remove required fields you'll need to edit the $optionsValue arrays (there's a few of them, you'll need to change them all) to list the name the field you want (e.g. jabber).

== Frequently Asked Questions ==

= I'm messing around with the code trying to get First Name / Last Name / whatever fields I include to show up above Username / Email Address but not getting very far. Any clue how I might go about this? =

The additional fields are added using a WordPress hook. This hook occurs after the username and email address fields.

In order to put fields in front of the username/email fields, you'll have to physically modify the wp-login.php page. These modifications are outside the scope of this plugin, but shouldn't be too hard to figure out.

== Screenshots ==
1. Example of the added fields