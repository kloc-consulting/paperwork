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
		<title>Note</title>
	</head>
	
	<body>

<?php

	$db = pwork_connect($config);
    $uid = 1;
  
    if (isset($_GET['uid'])) {
		$uid = $_GET['uid'];
    }
    if (is_array($_POST)) {
    	if (array_key_exists("noteId", $_POST)) {
			$uid = ($_POST['noteId']);
    	}
    	if (array_key_exists("btnNoteCreate", $_POST)) {
    		$sql = "INSERT INTO notes (note_title, note_created, note_modified) VALUES ('New Note', now(), now()); "
    			. "SELECT Currval('notes_note_id_seq') LIMIT 1";
			$qry = pg_query($sql) or die('Query failed: ' . pg_last_error());
			$fch = pg_fetch_row($qry);
			$uid = $fch[0];
    	} else if (array_key_exists("form", $_POST)) {
   		 	$formdata = $_POST['form'];
   		 	if (array_key_exists("acnSave", $_POST)) {
   		 		if (array_key_exists("title", $formdata)) {
   		 			$title = $formdata['title'];
   		 			$title = pg_escape_string($title);
   		 			$result = pg_query("UPDATE notes SET note_title='$title', note_modified=now() WHERE note_id=$uid"); 
				}
   		 		if (array_key_exists("text", $formdata)) {
   		 			$text = $formdata['text'];
   		 			$text = pg_escape_string($text);
   		 			$result = pg_query("UPDATE notes SET note_text='$text' WHERE note_id=$uid"); 
				}   		 	
			} 
   		}
    }
    
	$query = 'SELECT * FROM notes WHERE note_id=' . $uid;
	$result = pg_query($query) or die('Abfrage fehlgeschlagen: ' . pg_last_error());

	while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {


		pwork_toolbar_begin();
		pwork_toolbar_item_note_new();
		pwork_toolbar_item_sep();
		pwork_toolbar_item_note_find();
		pwork_toolbar_item_sep();
		pwork_toolbar_item_note_delete($uid);
		pwork_toolbar_end();

		 
		printf("<h1>%s</h1>\n", $row["note_title"]); 
		
		echo "<table>"; 
		echo "<form method='post' name='saveNote' action='pwork_note.php'>"; 

		echo "<tr><td>"; 
		$title = htmlspecialchars($row["note_title"]);
		echo("<input type='hidden' name='acnSave' value='Save'>\n"); 
		echo("<input type='hidden' name='noteId' value='$uid'>\n"); 
		echo("<input class='title' type='text' id='noteTitle' size='80' name='form[title]' value='$title'>");
		echo("</td></tr>\n"); 
		$text = htmlspecialchars($row["note_text"]);
		printf("<tr><td><textarea class='notes' rows='24' cols='78' name='form[text]'>%s</textarea></td></tr>\n", $text); 
		
		echo "<tr>";
	}
?>

<script type='text/javascript'>
	function onSaveNote(){
		document.saveNote.submit();
	}
	function onDeleteNote(){
		var r = confirm("Do you really want to delete this note?");
		if (r == true) {
			document.deleteNote.submit();
		} else {
		}
	}


</script>

</body>
</html>
