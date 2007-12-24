<?php
/*
Plugin Name: Weasel's Login Redirect
Plugin URI: http://www.thedailyblitz.org/weasels-login-redirect-text-replacement-plugin
Description: Redirects user login from the wp_loginout function to a page of your choice. Also allows changing the text of the wp_register button. Requires <a href="http://redalt.com/wiki/Role+Manager">Red Alt's Role Manager</a> for access control.
Author: Andy Moore
Version: 2.0
Author URI: http://www.thedailyblitz.org
*/

// ##### This plugin should be completely self contained and work totally on its own without source editing. It will add an admin 
// ##### panel named "Login Redirect / Regchange" underneath the OPTIONS tab, and will create a new user capability to Red Alt's User 
// ##### Roles plugin. Feel free to use, cut n paste, and all that jazz, or even offer suggestions or make enhancements. All I ask in
// ##### return is that you drop me a line at weasel@thedailyblitz.org to let me know.

// ##### ---------- NOTHING USER-CONFIGURABLE AFTER HERE ------------

add_option('wz_loginredirect','/','Redirect Value');
add_option('wz_loginredirect_current',1,'Redirect to Current?');
add_option('wz_loginredirect_login','Login','Default login text');
add_option('wz_loginredirect_logout','Logout','Default logout text');
add_option('wz_loginredirect_register','Register','Registration Prompt');
add_option('wz_loginredirect_siteadmin','Site Admin','Site Admin text');

function wz_loginredirect_admin() {

	if (isset($_POST['info_update'])) {
		update_option('wz_loginredirect',$_POST['wz_loginredirect']);
                update_option('wz_loginredirect_current',$_POST['wz_loginredirect_current']);
		update_option('wz_loginredirect_login',$_POST['wz_loginredirect_login']);
		update_option('wz_loginredirect_logout',$_POST['wz_loginredirect_logout']);
		update_option('wz_loginredirect_register',$_POST['wz_loginredirect_register']);
		update_option('wz_loginredirect_siteadmin',$_POST['wz_loginredirect_siteadmin']);
		echo '<div class="updated fade" id="message"><p>Options Updated!</p></div>';
	}
	
	$redirect_text = get_option('wz_loginredirect');
        $redirect_current = get_option('wz_loginredirect_current');
	$login = get_option('wz_loginredirect_login');
	$logout = get_option('wz_loginredirect_logout');
	$register = get_option('wz_loginredirect_register');
	$siteadmin = get_option('wz_loginredirect_siteadmin');

	echo '<div class="wrap" id="main_page"><h2>' . __('Login Redirection / Text Change', 'Login Redirection') . '</h2>';
	echo '<p>' . __('Login Redirection changes where users are sent after they login/logout by default. (WP default sends you to the admin dashboard)<BR /><BR />Example:<BR /> <code>/index.php</code><BR /><BR />The other values allow you to change the default text phrases used by wp_loginout(); and wp_register();', 'login-redirect') . '</p>';

?> <form method="post">
    <fieldset name="wz_loginredirect_current">
        <legend>Redirect to Current Page? <I>Default: True</i></legend>
        <input type="radio" value=1 name="wz_loginredirect_current" <?php if ($redirect_current == 1) echo 'checked';?>> True
        <input type="radio" value=0 name="wz_loginredirect_current" <?php if ($redirect_current == 0) echo 'checked';?>> False
    </fieldset>
    <fieldset name="wz_loginredirect">
	<legend>Redirect path (only available if the above is set to false and saved): <I>Default: [blank]</I></legend>
	<input type="text" value="<?php echo $redirect_text; ?>" name="wz_loginredirect" <?php if ($redirect_current == 1) echo 'disabled="disabled"'; ?>>
     </fieldset>
    <fieldset name="wz_loginredirect_login">
	<legend>Login Prompt: <I>Default: Login</I></legend>
	<input type="text" value="<?php echo $login; ?>" name="wz_loginredirect_login">
     </fieldset>
    <fieldset name="wz_loginredirect_logout">
	<legend>Logout Prompt: <I>Default: Logout</I></legend>
	<input type="text" value="<?php echo $logout; ?>" name="wz_loginredirect_logout">
     </fieldset>
    <fieldset name="wz_loginredirect_register">
	<legend>Registration Prompt: <I>Default: Register</I></legend>
	<input type="text" value="<?php echo $register; ?>" name="wz_loginredirect_register">
     </fieldset>
    <fieldset name="wz_loginredirect_siteadmin">
	<legend>Site Admin Link Text: <I>Default: Site Admin</I></legend>
	<input type="text" value="<?php echo $siteadmin; ?>" name="wz_loginredirect_siteadmin">
     </fieldset>
	<div class="submit">
	  <input type="submit" name="info_update" value="Update Options" /></div>
  </form>
<?php
	echo '</div>';

}

function wz_loginredirect_menu_hook() { // ### Simply adds the submenu to the USERS page
	if(current_user_can('Login Redirect'))
	add_options_page('Login Redirect','Login Redirect','Login Redirect','wz_loginredirect_admin','wz_loginredirect_admin');
}

add_action('admin_menu','wz_loginredirect_menu_hook'); // ### hooks the menu into the admin interface

function wz_loginredirect($link) { 
        if (get_option('wz_loginredirect_current') == 1) {
	if (substr_count($link,'?') > 0) { $link = str_replace('">','&redirect_to='.$_SERVER["REQUEST_URI"].'">',$link); }
	 else $link = str_replace('">','?redirect_to='.$_SERVER["REQUEST_URI"].'">',$link);
        } else {
	if (substr_count($link,'?') > 0) { $link = str_replace('">','&redirect_to='.get_option('wz_loginredirect').'">',$link); }
	 else $link = str_replace('">','?redirect_to='.get_option('wz_loginredirect').'">',$link); }

	$link = str_replace('">Login</a>','">'.get_option('wz_loginredirect_login').'</a>',$link);
	$link = str_replace('">Logout</a>','">'.get_option('wz_loginredirect_logout').'</a>',$link);
	return $link;
}

function wz_registertext($link) {
	$link = str_replace('">Register</a>','">'.get_option('wz_loginredirect_register').'</a>',$link);
	$link = str_replace('">Site Admin</a>','">'.get_option('wz_loginredirect_siteadmin').'</a>',$link);
	return $link;
}

add_filter('loginout','wz_loginredirect');
add_filter('register','wz_registertext');

add_filter('capabilities_list','wz_loginredirect_addcapability'); // ### Integrates a role with Red Alt's Role-Manager plugin
function wz_loginredirect_addcapability($cap) {
	$cap[] = 'Login Redirect';
	return $cap;
}
?>