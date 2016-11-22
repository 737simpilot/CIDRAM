<?php
/**
 * This file is a part of the CIDRAM package, and can be downloaded for free
 * from {@link https://github.com/Maikuolan/CIDRAM/ GitHub}.
 *
 * CIDRAM COPYRIGHT 2016 and beyond by Caleb Mazalevskis (Maikuolan).
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * This file: Korean language data for the front-end (last modified: 2016.11.22).
 *
 * @todo (This is incomplete).
 */

/** Prevents execution from outside of CIDRAM. */
if (!defined('CIDRAM')) {
    die('[CIDRAM] This should not be accessed directly.');
}

$CIDRAM['lang']['bNav_home_logout'] = '<a href="?">Home</a> | <a href="?cidram-page=logout">Log Out</a>';
$CIDRAM['lang']['bNav_logout'] = '<a href="?cidram-page=logout">Log Out</a>';
$CIDRAM['lang']['config_general_disable_cli'] = 'Disable CLI mode?';
$CIDRAM['lang']['config_general_disable_frontend'] = 'Disable front-end access?';
$CIDRAM['lang']['config_general_emailaddr'] = 'Email address for support.';
$CIDRAM['lang']['config_general_forbid_on_block'] = 'Which headers should CIDRAM respond with when blocking requests?';
$CIDRAM['lang']['config_general_ipaddr'] = 'Where to find the IP address of connecting requests?';
$CIDRAM['lang']['config_general_lang'] = 'Specify the default language for CIDRAM.';
$CIDRAM['lang']['config_general_logfile'] = 'Human readable file for logging all blocked access attempts. Specify a filename, or leave blank to disable.';
$CIDRAM['lang']['config_general_logfileApache'] = 'Apache-style file for logging all blocked access attempts. Specify a filename, or leave blank to disable.';
$CIDRAM['lang']['config_general_logfileSerialized'] = 'Serialised file for logging all blocked access attempts. Specify a filename, or leave blank to disable.';
$CIDRAM['lang']['config_general_silent_mode'] = 'Should CIDRAM silently redirect blocked access attempts instead of displaying the "Access Denied" page? If yes, specify the location to redirect blocked access attempts to. If no, leave this variable blank.';
$CIDRAM['lang']['config_general_timeOffset'] = 'Timezone offset in minutes.';
$CIDRAM['lang']['config_recaptcha_expiry'] = 'Number of hours to remember reCAPTCHA instances.';
$CIDRAM['lang']['config_recaptcha_lockip'] = 'Lock reCAPTCHA to IPs?';
$CIDRAM['lang']['config_recaptcha_lockuser'] = 'Lock reCAPTCHA to users?';
$CIDRAM['lang']['config_recaptcha_logfile'] = 'Log all reCAPTCHA attempts? If yes, specify the name to use for the logfile. If no, leave this variable blank.';
$CIDRAM['lang']['config_recaptcha_secret'] = 'This value should correspond to the "secret key" for your reCAPTCHA, which can be found within the reCAPTCHA dashboard.';
$CIDRAM['lang']['config_recaptcha_sitekey'] = 'This value should correspond to the "site key" for your reCAPTCHA, which can be found within the reCAPTCHA dashboard.';
$CIDRAM['lang']['config_recaptcha_usemode'] = 'Defines how CIDRAM should use reCAPTCHA (see documentation).';
$CIDRAM['lang']['config_signatures_block_bogons'] = 'Block bogon/martian CIDRs? If you expect connections to your website from within your local network, from localhost, or from your LAN, this directive should be set to false. If you don\'t expect these such connections, this directive should be set to true.';
$CIDRAM['lang']['config_signatures_block_cloud'] = 'Block CIDRs identified as belonging to webhosting/cloud services? If you operate an API service from your website or if you expect other websites to connect to your website, this should be set to false. If you don\'t, then, this directive should be set to true.';
$CIDRAM['lang']['config_signatures_block_generic'] = 'Block CIDRs generally recommended for blacklisting? This covers any signatures that aren\'t marked as being part of any of the other more specific signature categories.';
$CIDRAM['lang']['config_signatures_block_proxies'] = 'Block CIDRs identified as belonging to proxy services? If you require that users be able to access your website from anonymous proxy services, this should be set to false. Otherwise, if you don\'t require anonymous proxies, this directive should be set to true as a means of improving security.';
$CIDRAM['lang']['config_signatures_block_spam'] = 'Block CIDRs identified as being high-risk for spam? Unless you experience problems when doing so, generally, this should always be set to true.';
$CIDRAM['lang']['config_signatures_ipv4'] = 'A list of the IPv4 signature files that CIDRAM should attempt to parse, delimited by commas.';
$CIDRAM['lang']['config_signatures_ipv6'] = 'A list of the IPv6 signature files that CIDRAM should attempt to parse, delimited by commas.';
$CIDRAM['lang']['config_template_data_css_url'] = 'CSS file URL for custom themes.';
$CIDRAM['lang']['field_blocked'] = 'Blocked';
$CIDRAM['lang']['field_component'] = 'Component';
$CIDRAM['lang']['field_create_new_account'] = 'Create New Account';
$CIDRAM['lang']['field_delete_account'] = 'Delete Account';
$CIDRAM['lang']['field_filename'] = 'Filename: ';
$CIDRAM['lang']['field_install'] = 'Install';
$CIDRAM['lang']['field_ip_address'] = 'IP Address';
$CIDRAM['lang']['field_latest_version'] = 'Latest Version';
$CIDRAM['lang']['field_log_in'] = 'Log In';
$CIDRAM['lang']['field_ok'] = 'OK';
$CIDRAM['lang']['field_options'] = 'Options';
$CIDRAM['lang']['field_password'] = 'Password';
$CIDRAM['lang']['field_permissions'] = 'Permissions';
$CIDRAM['lang']['field_set_new_password'] = 'Set New Password';
$CIDRAM['lang']['field_size'] = 'Total Size: ';
$CIDRAM['lang']['field_size_bytes'] = 'bytes';
$CIDRAM['lang']['field_size_GB'] = 'GB';
$CIDRAM['lang']['field_size_KB'] = 'KB';
$CIDRAM['lang']['field_size_MB'] = 'MB';
$CIDRAM['lang']['field_size_TB'] = 'TB';
$CIDRAM['lang']['field_status'] = 'Status';
$CIDRAM['lang']['field_uninstall'] = 'Uninstall';
$CIDRAM['lang']['field_update'] = 'Update';
$CIDRAM['lang']['field_username'] = 'Username';
$CIDRAM['lang']['field_your_version'] = 'Your Version';
$CIDRAM['lang']['header_login'] = 'Please log in to continue.';
$CIDRAM['lang']['link_accounts'] = 'Accounts';
$CIDRAM['lang']['link_config'] = 'Configuration';
$CIDRAM['lang']['link_documentation'] = 'Documentation';
$CIDRAM['lang']['link_home'] = 'Home';
$CIDRAM['lang']['link_ip_test'] = 'IP Test';
$CIDRAM['lang']['link_logs'] = 'Logs';
$CIDRAM['lang']['link_updates'] = 'Updates';
$CIDRAM['lang']['logs_logfile_doesnt_exist'] = 'Selected logfile doesn\'t exist!';
$CIDRAM['lang']['logs_no_logfiles_available'] = 'No logfiles available.';
$CIDRAM['lang']['logs_no_logfile_selected'] = 'No logfile selected.';
$CIDRAM['lang']['response_accounts_already_exists'] = 'An account with that username already exists!';
$CIDRAM['lang']['response_accounts_created'] = 'Account successfully created!';
$CIDRAM['lang']['response_accounts_deleted'] = 'Account successfully deleted!';
$CIDRAM['lang']['response_accounts_doesnt_exist'] = 'That account doesn\'t exist.';
$CIDRAM['lang']['response_accounts_password_updated'] = 'Password successfully updated!';
$CIDRAM['lang']['response_component_successfully_installed'] = 'Component successfully installed.';
$CIDRAM['lang']['response_component_successfully_uninstalled'] = 'Component successfully uninstalled.';
$CIDRAM['lang']['response_component_successfully_updated'] = 'Component successfully updated.';
$CIDRAM['lang']['response_component_uninstall_error'] = 'An error occurred while attempting to uninstall the component.';
$CIDRAM['lang']['response_component_update_error'] = 'An error occurred while attempting to update the component.';
$CIDRAM['lang']['response_configuration_updated'] = 'Configuration successfully updated.';
$CIDRAM['lang']['response_error'] = 'Error';
$CIDRAM['lang']['response_login_invalid_password'] = 'Login failure! Invalid password!';
$CIDRAM['lang']['response_login_invalid_username'] = 'Login failure! Username doesn\'t exist!';
$CIDRAM['lang']['response_login_password_field_empty'] = 'Password field empty!';
$CIDRAM['lang']['response_login_username_field_empty'] = 'Username field empty!';
$CIDRAM['lang']['response_no'] = 'No';
$CIDRAM['lang']['response_updates_already_up_to_date'] = 'Already up-to-date.';
$CIDRAM['lang']['response_updates_not_installed'] = 'Component not installed!';
$CIDRAM['lang']['response_updates_outdated'] = 'Outdated!';
$CIDRAM['lang']['response_updates_outdated_manually'] = 'Outdated (please update manually)!';
$CIDRAM['lang']['response_updates_unable_to_determine'] = 'Unable to determine.';
$CIDRAM['lang']['response_yes'] = 'Yes';
$CIDRAM['lang']['state_complete_access'] = 'Complete access';
$CIDRAM['lang']['state_component_is_active'] = 'Component is active.';
$CIDRAM['lang']['state_component_is_inactive'] = 'Component is inactive.';
$CIDRAM['lang']['state_component_is_provisional'] = 'Component is provisional.';
$CIDRAM['lang']['state_default_password'] = 'Warning: Using default password!';
$CIDRAM['lang']['state_logged_in'] = 'Logged in';
$CIDRAM['lang']['state_logs_access_only'] = 'Logs access only';
$CIDRAM['lang']['state_password_not_valid'] = 'Warning: This account is not using a valid password!';
$CIDRAM['lang']['switch-hide-non-outdated-set-false'] = 'Don\'t hide non-outdated';
$CIDRAM['lang']['switch-hide-non-outdated-set-true'] = 'Hide non-outdated';
$CIDRAM['lang']['switch-hide-unused-set-false'] = 'Don\'t hide unused';
$CIDRAM['lang']['switch-hide-unused-set-true'] = 'Hide unused';
$CIDRAM['lang']['tip_accounts'] = 'Hello, {username}.<br />The accounts page allows you to control who can access the CIDRAM front-end.';
$CIDRAM['lang']['tip_config'] = 'Hello, {username}.<br />The configuration page allows you to modify the configuration for CIDRAM from the front-end.';
$CIDRAM['lang']['tip_donate'] = 'CIDRAM is offered free of charge, but if you want donate to the project, you can do so by clicking the donate button.';
$CIDRAM['lang']['tip_enter_ips_here'] = 'Enter IPs here.';
$CIDRAM['lang']['tip_home'] = 'Hello, {username}.<br />This is the homepage for the CIDRAM front-end. Select a link from the navigation menu on the left to continue.';
$CIDRAM['lang']['tip_ip_test'] = 'Hello, {username}.<br />The IP test page allows you to test whether IP addresses are blocked by the currently installed signatures.';
$CIDRAM['lang']['tip_login'] = 'Default username: <span class="txtRd">admin</span> – Default password: <span class="txtRd">password</span>';
$CIDRAM['lang']['tip_logs'] = 'Hello, {username}.<br />Select a logfile from the list below to view the contents of that logfile.';
$CIDRAM['lang']['tip_see_the_documentation'] = 'See the <a href="https://maikuolan.github.io/CIDRAM/#documentation">documentation</a> for information about the various configuration directives and their purposes.';
$CIDRAM['lang']['tip_updates'] = 'Hello, {username}.<br />The updates page allows you to install, uninstall, and update the various components of CIDRAM (the core package, signatures, L10N files, etc).';
$CIDRAM['lang']['title_accounts'] = 'CIDRAM – Accounts';
$CIDRAM['lang']['title_config'] = 'CIDRAM – Configuration';
$CIDRAM['lang']['title_home'] = 'CIDRAM – Home';
$CIDRAM['lang']['title_ip_test'] = 'CIDRAM – IP Test';
$CIDRAM['lang']['title_login'] = 'CIDRAM – Login';
$CIDRAM['lang']['title_logs'] = 'CIDRAM – Logs';
$CIDRAM['lang']['title_updates'] = 'CIDRAM – Updates';

$CIDRAM['lang']['info_some_useful_links'] = 'Some useful links:<ul>
            <li><a href="https://github.com/Maikuolan/CIDRAM/issues">CIDRAM Issues @ GitHub</a> – Issues page for CIDRAM (support, assistance, etc).</li>
            <li><a href="http://www.spambotsecurity.com/forum/viewforum.php?f=61">CIDRAM @ Spambot Security</a> – Discussion forum for CIDRAM (support, assistance, etc).</li>
            <li><a href="https://wordpress.org/plugins/cidram/">CIDRAM @ Wordpress.org</a> – Wordpress plugin for CIDRAM.</li>
            <li><a href="https://websectools.com/">WebSecTools.com</a> – A collection of simple webmaster tools to secure websites.</li>
            <li><a href="https://macmathan.info/zbblock-range-blocks">MacMathan.info</a> – Contains optional range blocks that can be added to CIDRAM to block any unwanted countries from accessing your website.</li>
            <li><a href="https://www.facebook.com/groups/2204685680/">International PHP Group @ Facebook</a> – PHP learning resources and discussion.</li>
            <li><a href="https://wwphp-fb.github.io/">International PHP Group @ GitHub</a> – PHP learning resources and discussion.</li>
        </ul>';
