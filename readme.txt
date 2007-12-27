=== Weasel's Login Redirect ===
Contributors: weasello
Donate link: 
Tags: author, tools, login, redirect, hide
Requires at least: 2.0.2
Tested up to: 2.3.1
Stable tag: 2.0

Redirects user login attempts from going to your dashboard! Great for keeping the 'back end' private. Also allows alteration of the login/logout link text.

== Description ==

Redirects user login attempts from going to your dashboard! Great for keeping the 'back end' private. Also allows alteration of the login/logout link text.

TECHNICAL BITS:

Redirects user login from the `wp_loginout();` function to a page of your choice. Also allows changing the text of the `wp_register();` button.

I strongly recommend you install the <a href="http://www.im-web-gefunden.de/wordpress-plugins/role-manager/">Role Manager plugin</a> for access control - many plugins use it and you get enhanced functionality out of this plugin if you do. As of this writing we are using v2.2.1.

COMMON ISSUE:

If your template does not use `wp_loginout();` or `wp_register();` you may want to adjust it so that it does.

== Installation ==

1. Upload `wz_loginredirect.php` or it's containing directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. View the plugin options on the admin menu under the "Options" tab, subheading "Login Redirect". If you don't see this menu, try increasing your user access level. If you still don't see it, install the <a href="http://www.im-web-gefunden.de/wordpress-plugins/role-manager/">Role Manager plugin</a> and grant yourself access rights!

== Frequently Asked Questions ==

= What is the difference between version 1.2 and 2.0? =

Better documentation!

== Screenshots ==

1. This is a screenshot of the control panel interface for the plugin.