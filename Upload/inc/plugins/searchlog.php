<?php

// Make sure we can't access this file directly from the browser.
if(!defined("IN_MYBB"))
{
	die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}

$plugins->add_hook("admin_tools_menu_logs", "searchlog_admin_menu");
$plugins->add_hook("admin_tools_action_handler", "searchlog_admin_action_handler");
$plugins->add_hook("admin_tools_permissions", "searchlog_admin_permissions");

function searchlog_info()
{
	return array(
		"name"				=> "Search Log",
		"description"		=> "This plugin adds away to view keywords of what users have searched in the Admin CP. The log can be found alongside of the other board logs under the 'Tools & Maintenance' section.",
		"website"			=> "https://brianleek.me/",
		"author"			=> "Brian Leek",
		"authorsite"		=> "https://brianleek.me/",
		"version"			=> "1.0",
		"codename"			=> "searchlog",
		"compatibility"		=> "18*"
	);
}

function searchlog_admin_menu($sub_menu)
{
	$sub_menu['90'] = array('id' => 'searchlog', 'title' => "Search Log", 'link' => 'index.php?module=tools-searchlog');

	return $sub_menu;
}

function searchlog_admin_action_handler($actions)
{
	$actions['searchlog'] = array('active' => 'searchlog', 'file' => 'searchlog.php');

	return $actions;
}
