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

reset($LANGUAGES);
while(list($k,$v) = each($LANGUAGES)){
	include $main_path."language/".$k."/messages.inc.php";
	include $main_path."language/".$k."/categories.inc.php";
	$result = mysql_query ( "SELECT distinct c.cat_id FROM " . $DBPrefix . "categories c WHERE c.parent_id='0' AND c.deleted=0 ORDER BY cat_name" );
	$output = '<select name="id">'."\n";
	$output.= "\t".'<option value="">'.$MSG['2__0038'].'</option>'."\n";
	$output.= "\t".'<option value=""></option>'."\n";

	if ($result)
		$num_rows = mysql_num_rows($result);
	else
		$num_rows = 0;

	$i = 0;
	while($i < $num_rows){
		$category_id = mysql_result($result,$i,"cat_id");
		$cat_name = $category_names[$category_id];
		$output .= "\t".'<option value="'.$category_id.'">'.$cat_name.'</option>'."\n";
		$i++;
	}

	$output.= "\t".'<option value=""></option>'."\n";
	$output.= "\t".'<option value="0">'.$MSG['277'].'</option>'."\n";
	$output.= '</select>'."\n";

	$handle = fopen ( "../language/".$k."/categories_select_box.inc.php" , "w" );
	fputs($handle, $output);
	fclose($handle);
}
?>