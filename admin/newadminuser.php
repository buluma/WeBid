<?php
/***************************************************************************
 *   copyright				: (C) 2008 WeBid
 *   site					: http://www.webidsupport.com/
 ***************************************************************************/

/***************************************************************************
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version. Although none of the code may be
 *   sold. If you have been sold this script, get a refund.
 ***************************************************************************/

require('../includes/config.inc.php');
include "loggedin.inc.php";
include $include_path . 'status.inc.php';

unset($ERR);

if(isset($_POST['action']) && $_POST['action'] == "update") {
	if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['repeatpassword'])) {
		$ERR = $ERR_047;
	} elseif((!empty($_POST['password']) && empty($_POST['repeatpassword'])) || empty($_POST['password']) && !empty($_POST['repeatpassword'])) {
		$ERR = $ERR_054;
	} elseif($_POST['password'] != $_POST['repeatpassword']) {
		$ERR = $ERR_006;
	} else {
		// Check if "username" already exists in the database
		$query = "SELECT id FROM " . $DBPrefix . "adminusers WHERE username = '" . $_POST['username'] . "'";
		$r = mysql_query($query);
		$system->check_mysql($r, $query, __LINE__, __FILE__);
		if(mysql_num_rows($r) > 0) {
			$ERR = sprintf($ERR_055, $_POST['username']);
		} else {
			$TODAY = gmdate("Ymd");
			$PASS = md5($MD5_PREFIX.$_POST['password']);
			$query = "INSERT INTO " . $DBPrefix . "adminusers VALUES
			(NULL, '" . addslashes($_POST['username']) . "', '" . $PASS . "', '" . $TODAY . "', '0', " . intval($_POST['status']) . ")";
			$system->check_mysql(mysql_query($query), $query, __LINE__, __FILE__);
			header("Location: adminusers.php");
			exit;
		}
	}
}

loadblock($MSG['003'], '', 'text', 'username', $system->SETTINGS['username']);
loadblock($MSG['004'], '', 'password', 'password', $system->SETTINGS['password']);
loadblock($MSG['564'], '', 'password', 'repeatpassword', $system->SETTINGS['repeatpassword']);
loadblock($MSG['565'], '', 'batch', 'status', $system->SETTINGS['status'], $MSG['566'], $MSG['567']);

$template->assign_vars(array(
        'ERROR' => (isset($ERR)) ? $ERR : '',
        'SITEURL' => $system->SETTINGS['siteurl'],
		'TYPE' => 'use',
		'TYPENAME' => $MSG['25_0010'],
		'PAGENAME' => $MSG['367']
        ));

$template->set_filenames(array(
        'body' => 'adminpages.html'
        ));
$template->display('body');
?>