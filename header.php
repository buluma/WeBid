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
 
if(!defined('InWeBid')) exit();

include $include_path . "maintenance.php";
include $include_path . "banners.inc.php";
if (basename($_SERVER['PHP_SELF']) !== "error.php")
    include $include_path . "stats.inc.php";

$jsfiles = (basename($_SERVER['PHP_SELF']) == 'sell.php') ? '<script type="text/javascript" src="includes/calendar.js"></script>
<script type="text/javascript" src="fck/fckeditor.js"></script>' : '';
// -- Get users and auctions counters
$query = "SELECT * FROM " . $DBPrefix . "counterstoshow";
$res = mysql_query($query);
$system->check_mysql($res, $query, __LINE__, __FILE__);
$COUNTERSTOSHOW = mysql_fetch_array($res);
$query = "select * from " . $DBPrefix . "counters";
$result_counters = mysql_query($query);
$counters = "";
if ($result_counters) {
    if ($COUNTERSTOSHOW['auctions'] == 'y') $counters .= "<b>" . mysql_result($result_counters, 0, "auctions") . "</b>&nbsp;" . strtoupper($MSG['232']);
    if ($COUNTERSTOSHOW['users'] == 'y') $counters .= "|&nbsp;<b>" . mysql_result($result_counters, 0, "users") . "</b>&nbsp;" . strtoupper($MSG['231']);
    if ($COUNTERSTOSHOW['online'] == 'y') {
        $s = session_id();
        $uxtime = time();
        $sqluni = "SELECT * FROM " . $DBPrefix . "online WHERE SESSION = '$s'";
        $res = mysql_query($sqluni);
        $system->check_mysql($res, $sqluni, __LINE__, __FILE__);

        if (mysql_num_rows($res) == 0) {
            $insess = "INSERT INTO " . $DBPrefix . "online (SESSION, time) values('$s','$uxtime')";
            $system->check_mysql(mysql_query($insess), $insess, __LINE__, __FILE__);
        } else {
            $oID = mysql_result($res, 0, 'ID');
            $updtime = "UPDATE " . $DBPrefix . "online set time='$uxtime' WHERE ID = '$oID'";
            $system->check_mysql(mysql_query($updtime), $updtime, __LINE__, __FILE__);
        }
        $deltime = $uxtime - 900;
        $removeold = "DELETE from " . $DBPrefix . "online WHERE time < '$deltime'";
        $system->check_mysql(mysql_query($removeold), $removeold, __LINE__, __FILE__);
        $sql = "SELECT * FROM " . $DBPrefix . "online";
        $res = mysql_query($sql);
        $system->check_mysql($res, $sql, __LINE__, __FILE__);

        $count15min = mysql_num_rows($res);

        $counters .= "&nbsp;|&nbsp;<B>" . $count15min . "</B>&nbsp;" . $MGS_2__0064 . "&nbsp;";
    }
}
// -- Display current Date/Time
$mth = "MON_0" . gmdate('m', $system->ctime);
$date = $MSG[$mth] . gmdate(' j, Y', $system->ctime);
$counters .= '|&nbsp;' . $date . ' <span id="servertime"></span>';

include($include_path . "styles.inc.php");
$page_title = (isset($page_title)) ? ' ' . $page_title : '';

$template->assign_vars(array(
        'DOCDIR' => $DOCDIR, // Set document direction (set in includes/messages.XX.inc.php) ltr/rtl
        'PAGE_TITLE' => $system->SETTINGS['sitename'] . $page_title,
        'CHARSET' => $CHARSET,
        'STYLES' => $thisstyle,
        'DESCRIPTION' => stripslashes($system->SETTINGS['descriptiontag']),
        'KEYWORDS' => stripslashes($system->SETTINGS['keywordstag']),
        'EXTRAINC' => $jsfiles,
        'ACTUALDATE' => ActualDate(),
        'PAGEALIGN' => $system->SETTINGS['alignment'],
        'PAGEWIDTH' => $system->SETTINGS['pagewidth'] . (($system->SETTINGS['pagewidthtype'] == 'perc') ? "%" : ''),
        'LOGO' => ($system->SETTINGS['logo']) ? '<a href="' . $system->SETTINGS['siteurl'] . 'index.php?"><img src="' . $system->SETTINGS['siteurl'] . 'themes/' . $system->SETTINGS['theme'] . '/' . $system->SETTINGS['logo'] . '" border="0" alt="' . $system->SETTINGS['sitename'] . '"></a>' : "&nbsp;",
        'BANNER' => ($system->SETTINGS['banners'] == 1) ? view() : '',
        'HEADERCOUNTER' => $counters,
        'SITEURL' => $system->SETTINGS['siteurl'],
		'SSLURL' => ($system->SETTINGS['https'] == 'y') ? str_replace('http://', 'https://', $system->SETTINGS['siteurl']) : $system->SETTINGS['siteurl'],
		'ASSLURL' => ($system->SETTINGS['https'] == 'y' && $system->SETTINGS['usersauth'] == 'y') ? str_replace('http://', 'https://', $system->SETTINGS['siteurl']) : $system->SETTINGS['siteurl'],
        'Q' => (isset($q)) ? $q : '',
        'SELECTION_BOX' => file_get_contents($main_path . "language/" . $language . "/categories_select_box.inc.php"),
		'USERNAME' => (isset($_SESSION['WEBID_LOGGED_IN_USERNAME'])) ? $_SESSION['WEBID_LOGGED_IN_USERNAME'] : '',

        'B_CAN_SELL' => (($system->SETTINGS['uniqueseller'] > 0 && $_SESSION['WEBID_LOGGED_IN'] == $system->SETTINGS['uniqueseller']) || $system->SETTINGS['uniqueseller'] == 0),
        'B_LOGGED_IN' => (isset($_SESSION['WEBID_LOGGED_IN'])),
        'B_BOARDS' => ($system->SETTINGS['boards'] == 'y' && $system->SETTINGS['boardslink'] == 'y')
        ));

$template->set_filenames(array(
        'header' => 'global_header.html'
        ));
$template->display('header');
?>