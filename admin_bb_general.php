<?php
/**
 *   copyright  		: (C) 2011 Philipp Heinze
 *   website		: http://phsoftware.de
 *
 */

/**
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 */

define('IN_PHPBB',1);
if(!empty($setmodules))
{
	$file = basename(__FILE__);
	$module['phBadBehave']['BB_General'] = "$file";
	return;
}

//
// Load default header
//
//TODO change to phpBB param requesting
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
$mode=htmlspecialchars($_REQUEST['mode']);
$id=intval($_REQUEST['id']);
$entry=$_REQUEST['entry'];
$limit=intval($_REQUEST['limit']);
if ($limit==0) $limit=30;

echo ('<script language="JavaScript">
<!--
function gCheckAll(chk)


         {
         for (var i=0;i < document.forms[1].elements.length;i++)


                 {
                         var e = document.forms[1].elements[i];
                         if (e.type == "checkbox")


                                 {
                                         e.checked = chk.checked
                                 }
                         }
                 }
//-->
</script>
<noscript></noscript>');
//toolbar
	echo ('<div id="selectbar" style="margin-bottom:10px;border: solid 1px #cccccc;">');
         echo ("<form action=\"".append_sid($_SERVER['PHP_SELF'])."\" method=\"post\">");
	echo ("SHOW ALL WHERE ");
         echo ('<select name="field" size="1">
         	<option value="id">ID</option>
              	<option value="ip">IP</option>
                 <option value="date">Date</option>
		<option value="request_method">Request method</option>
                 <option value="request_uri">Request URL</option>
                 <option value="server_protocol">Server Protocol</option>
                 <option value="user_agent">User agent</option>
                 <option value="http_headers">HTTP Headers</option>
		<option value="key">Key</option>
                </select>');
	echo ('<select name="where" size="1">
         	<option value="=">Is</option>
                 <option value="!=">Is not</option>
                 <option value="LIKE">Includes</option>
                </select>');
         echo ('<input type="Text" name="search" value="" size="10" maxlength="300">');
         echo ('Max Records:<input type="Text" name="limit" value="30" size="3" maxlength="3">');
         echo ('<input type="Submit" name="mode" value="sql">');
         echo("</form>");
	echo('</div>');
//end toolbar
switch($mode)
{
	case 'del':
         	$sql="DELETE FROM ".$table_prefix."bad_behavior WHERE `id`=$id LIMIT 1";
	        $result=$db->sql_query($sql);
                 if($db->sql_affectedrows()==1)
	        {
	                  echo ("<div align=\"center\">Record Successfully dropped</div><br />");
	        }else
                 {
                           echo ("<div align=\"center\">Could not drop record</div><br />");
                 }
	        $mode='';
         break;
         case 'delall':
         	$sql="TRUNCATE TABLE `".$table_prefix."bad_behavior`";
                 $db->sql_query($sql);
                 $result=$db->sql_query("SELECT `id` FROM `".$table_prefix."bad_behavior` WHERE 1 LIMIT 0,10");
                 if ($db->sql_numrows())
                 {
                           echo ("<div align=\"center\">Could not truncate Table</div><br />");
                 }else
                 {
		          echo ("<div align=\"center\">All Records Successfully dropped</div><br />");
                 }
              	$mode='';
         break;
         case 'delsel':
         	$sql="DELETE FROM `".$table_prefix."bad_behavior` WHERE `id` IN(".implode(",",$entry).")";
                 $result=$db->sql_query($sql);
		if ($db->sql_affectedrows()<count($entry))
                 {
		          echo ("<div align=\"center\">One Or more records couldn't be dropped</div><br />");
                 }else
                 {
		          echo ("<div align=\"center\">All selected Records Successfully dropped</div><br />");
                 }
                 $mode='';
	break;
}
switch ($mode)
{
	case 'all':

	        $sql="SELECT * FROM `".$table_prefix."bad_behavior` WHERE `id`=$id LIMIT 1";
	        if (!$result=$db->sql_query($sql))
	        {
	             message_die(GENERAL_ERROR, "Could not Load Entry", 'Error', __LINE__, __FILE__, $sql);
	        }
                 $row=$db->sql_fetchrow($result);
         //toolbar
                 echo ('<div id="toolbar" style="margin-bottom:10px;border: solid 1px #cccccc;">');
                 echo ("<a href=\"javascript:history.go(-1)\">Back</a>");
                 echo ("&emsp;|&emsp;<a href=\"".append_sid($_SERVER['PHP_SELF']."?mode=del&amp;id=$row[id]")."\">Delete Record</a>");
                 echo('</div>');
         //end toolbar
                 echo ("<div align=\"center\"><table>");
                 echo ("<tr><td class=\"catHead\" width=\"20px\"><center>ID</center></td><td class=\"catHead\" width=\"40px\"><center>IP</center></td><td class=\"catHead\" width=\"40px\"><center>Date</center></td><td class=\"catHead\" width=\"20px\"><center>Request Method</center></td><td class=\"catHead\" width=\"60px\"><center>Request URI</center></td><td class=\"catHead\" width=\"100px\"><center>HTTP Headers<center></td><td class=\"catHead\" width=\"100px\"><center>Request Entity</center></td><td class=\"catHead\" width=\"40px\"><center>User Agent</center></td><td class=\"catHead\" width=\"30px\"><center>Key</center></td><td class=\"catHead\" width=\"30px\"><center>Server Protocol</center></td></tr>");
                 echo ("<tr><td class=\"row1\">$row[id]</td><td class=\"row2\">$row[ip]</td><td class=\"row1\">$row[date]</td><td class=\"row2\">$row[request_method]</td><td class=\"row1\">$row[request_uri]</td><td class=\"row2\"><textarea name=\"request_uri\" cols=\"50\" rows=\"10\">$row[http_headers]</textarea></td><td class=\"row1\"><textarea name=\"request_uri\" cols=\"50\" rows=\"10\">$row[request_entity]</textarea></td><td class=\"row2\"><textarea name=\"request_uri\" cols=\"30\" rows=\"5\">$row[user_agent]</textarea></td><td class=\"row1\">$row[key]</td><td class=\"row2\">$row[server_protocol]</td></tr>");
                 echo ("</table></div>");
         break;
         case 'sql':
                 $field=htmlspecialchars($_REQUEST['field']);
                 $where=htmlspecialchars($_REQUEST['where']);
                 $search=htmlspecialchars($_REQUEST['search']);
                 if ($where=="LIKE") $search="%".$search."%";
                 if (!is_numeric($search)) $search="'".$search."'";
              	if ($field=="" OR $where=="" OR $search=="") $mode='';
                 $sql="SELECT * FROM `".$table_prefix."bad_behavior` WHERE `$field` $where $search ORDER BY `id` DESC LIMIT 0,$limit";

	default:
         	if (!$mode=="sql")
                 {
			$sql="SELECT `id`, `ip`, `date`, `key` FROM `".$table_prefix."bad_behavior` ORDER BY `id` DESC LIMIT 0,$limit";
                 }
                 echo ("<form action=\"".append_sid($_SERVER['PHP_SELF'])."\" method=\"post\">");
        	//toolbar
                 echo ('<div id="toolbar" style="margin-bottom:10px;border: solid 1px #cccccc;">');
                 echo ("<input type=\"Submit\" name=\"mode\" value=\"delall\">");
	        echo ("<input type=\"Submit\" name=\"mode\" value=\"delsel\">");
                 echo('</div>');
         //end toolbar

	         if(!$result = $db->sql_query($sql))
	         {
	              message_die(GENERAL_ERROR, "Could not query Entries", 'Error', __LINE__, __FILE__, $sql);
	         }

	         echo ("<div align=\"center\"><table>");
	         echo("<th colspan=\"7\">Latest logged entries</th>");
	         echo ("<tr><td class=\"catHead\"><input type=\"Checkbox\" name=\"checkall\" onclick=\"gCheckAll(checkall)\"></td><td width=\"50px\" class=\"catHead\">Show All</td><td class=\"catHead\" width=\"20px\">Drop</td><td class=\"catHead\" width=\"40px\">ID</td><td class=\"catHead\" width=\"40px\">IP</td><td class=\"catHead\" width=\"50px\">Date</td><td class=\"catHead\" width=\"30px\">Key</td></tr>");
                  if ($db->sql_numrows($result)>1)
                  {
	                  foreach($db->sql_fetchrowset($result)as $row)
	                  {
	                  	$k= fmod($k,2);
	                  	$k=$k+1;
	                  	echo ("<tr><td class=\"row$k\"><input type=\"Checkbox\" name=\"entry[".$row['id']."]\" value=\"$row[id]\"></td><td class=\"row$k\"><a href=\"".append_sid($_SERVER['PHP_SELF']."?mode=all&amp;id=$row[id]")."\">See All</a></td><td><a href=\"".append_sid($_SERVER['PHP_SELF']."?mode=del&amp;id=$row[id]")."\">Drop</a></td><td class=\"row$k\">$row[id]</td><td class=\"row$k\">$row[ip]</td><td class=\"row$k\">$row[date]</td><td class=\"row$k\">$row[key]</td></tr>");
		 	  }
	         }else
                  {
                  	  $row=$db->sql_fetchrow($result);
	                  echo("<tr><td class=\"row1\"><input type=\"Checkbox\" name=\"entry[".$row['id']."]\" value=\"$row[id]\"></td><td class=\"row1\"><a href=\"".append_sid($_SERVER['PHP_SELF']."?mode=all&amp;id=$row[id]")."\">See All</a></td><td><a href=\"".append_sid($_SERVER['PHP_SELF']."?mode=del&amp;id=$row[id]")."\">Drop</a></td><td class=\"row1\">$row[id]</td><td class=\"row1\">$row[ip]</td><td class=\"row1\">$row[date]</td><td class=\"row1\">$row[key]</td></tr>");
                  }
	         echo ("</table></div>");
                  echo ("</form>");
         break;


}


echo ("<div align=\"center\">PhBad Behave3 v.1 Beta using Bad Behavior XXXXX</div>");
include('./page_footer_admin.'.$phpEx);

?>
