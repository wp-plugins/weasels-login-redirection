=== Weasel's Login Redirect ===
Contributors: weasello
Donate link: 
Tags: author, tools, login, redirect, hide
Requires at least: 2.0.2
Tested up to: 2.3.1
Stable tag: trunk

Redirects user login attempts from going to your dashboard! Great for keeping the 'back end' private. Also allows alteration of the login/logout link text.

== Description ==

Redirects user login attempts from going to your dashboard! Great for keeping the 'back end' private. Also allows alteration of the login/logout link text.

Technical bits:
Redirects user login from the wp_loginout function to a page of your choice. Also allows changing the text of the wp_register button. Requires <a href="http://redalt.com/wiki/Role+Manager">Red Alt's Role Manager</a> for access control.

If your template does not use wp_loginout or wp_register you may want to adjust it so that it does.

== Installation ==

1. Upload `wz_loginredirect.php` or it's containing directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. View the plugin options on the admin menu under the "Options" tab, subheading "Login Redirect"

== Frequently Asked Questions ==

= What is the difference between version 1.2 and 2.0? =

Better documentation!

== Screenshots ==

1. This is a screenshot of the control panel interface for the plugin.