<?php

// Disallow direct access to this file for security reasons
if(!defined("IN_MYBB"))
{
	die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}

$page->add_breadcrumb_item("Search Log", "index.php?module=tools-searchlog");

$sub_tabs['searchlogs'] = array(
	'title' => "Search Log",
	'link' => "index.php?module=tools-searchlog",
	'description' => "Here you can view all keywords of users searchs made on the forum."
);

if(!$mybb->input['action'])
{
	$page->output_header("Search Log");
	$page->output_nav_tabs($sub_tabs, 'searchlogs');

	$table = new Table;
	$table->construct_header("UID", array('width' => '5%'));
	$table->construct_header("Date", array("class" => "align_center", 'width' => '10%'));
	$table->construct_header("Keywords", array("class" => "align_center", 'width' => '15%'));
	$table->construct_header("Type", array("class" => "align_center", 'width' => '10%'));
	$table->construct_header("IP Address", array("class" => "align_center", 'width' => '10%'));

	$query = $db->query("SELECT * FROM " .TABLE_PREFIX."searchlog");

	while($logitem = $db->fetch_array($query))
	{
		$trow = alt_trow();
		$date = my_date($mybb->settings['dateformat'], $logitem['dateline']);
		$time = my_date($mybb->settings['timeformat'], $logitem['dateline']);
		$logitem['formatted_time'] = $date . " " . $time;

		$table->construct_cell($logitem['uid']);
		$table->construct_cell($logitem['formatted_time'], array("class" => "align_center"));
		$table->construct_cell($logitem['keywords'], array("class" => "align_center"));
		$table->construct_cell($logitem['resulttype'], array("class" => "align_center"));
		$table->construct_cell(my_inet_ntop($db->unescape_binary($logitem['ipaddress'])),array("class" => "align_center") );
		$table->construct_row();
	}

	// Show messages if no log entries are found.
	if($table->num_rows() == 0)
	{
		$table->construct_cell("There are no log entries at this time.", array("colspan" => "4"));
		$table->construct_row();
	}

	$table->output("Search Log");
	$page->output_footer();
}
