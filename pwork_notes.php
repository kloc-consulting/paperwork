<?php
/*
    Copyright (C) 2016 Karsten Lueth
    This file is part of paperwork.

    Paperwork is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Paperwork is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Paperwork.  If not, see <http://www.gnu.org/licenses/>.
*/ 
    include_once "lib/pwork_db.php";
    include_once "lib/pwork_utils.php";
?>

<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>
<html>
	<head>
		<meta http-equiv='content-style-type' content='text/html; charset=iso-8859-1'>
		<link rel="stylesheet" href="css/pwork_style.css" type="text/css">
		<title>Search Notes</title>
	</head>
	<body>

<?php

	$db = pwork_connect($config);
	$search = "";

	// Process POST and GET parameter
    if (isset($_GET['search'])) {
		$search = $_GET['search'];
    }
    
    if (is_array($_POST)) {
    	if (array_key_exists("btnNoteDelete", $_POST)) {
    		$noteId = ($_POST['noteId']);
    		$sql = "DELETE FROM notes WHERE note_id=$noteId";
    		pg_query($sql);
    	}
    	if (array_key_exists("search", $_POST)) {
			$search = pg_escape_string($_POST['search']);
			echo "Here: $search"; 
    	}
	}

	// The 'toolbar'. Currently the only command is "New Note". 
	pwork_toolbar_begin();
	pwork_toolbar_item_note_new();
	pwork_toolbar_end();
?>
	<h1>Notes</h1> 
	
<?php
	printf('<form method="get" name="searchNotes" action="%s">', basename(__FILE__)); 
	$htmlsearch = htmlspecialchars($search);
	printf('<input class="search" size="86" name="search" value="%s">', $htmlsearch);
?>
	</form>
<?php

	// Prepare the SQL query. 
	$safe_search = pg_escape_string($search); 
	if ($search == '') {
		$where = ' ';    		
		$order = ' ORDER BY note_modified DESC';
	} else {
	   	$where = "WHERE note_title like '%" . $safe_search . "%' ";
		$order = ' ORDER BY note_title';
	}
	
	$limit = ' LIMIT 100'; 

	$query = 'SELECT * FROM notes ' . $where . $order . $limit;
	
	$result = pg_query($query) or die('SQL query failed: ' . pg_last_error());

?>
   	<table class='listing'>
	<tr>
		<td class='hdr_datetime'>Modified</td>
		<td class='hdr_title'>Title</td>
	</tr>
<?php

	$format = $config['formatting']; 
	$fmt_date = $format['fmt-date']; 


	while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
		echo '<tr class="listing">';
		
		$date = date_create($row['note_modified']);
		
		
		$formatted_date = date_format($date, $fmt_date);
		$id = $row["note_id"];
		printf('<td class="datetime">%s</td>', $formatted_date); 
		printf('<td class="title">%s</td>', pwork_note_link($id, $row['note_title'])); 
    	echo '</td></tr>';
	}
?>
	</table>
</body>
</html>
