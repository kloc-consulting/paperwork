<?php

	// ------- //
	// Toolbar //
	// ------- //

	// Start the toolbar
	function pwork_toolbar_begin() {
		echo "<table class='toolbar'><tr class='toolbar'>";
	}

	// End the toolbar
	function pwork_toolbar_end() {
		echo "</tr></table>";
	}

	// A toolbar item
	function pwork_toolbar_item($title, $link) {
		echo ("<td class='toolbaritem'><a href='pwork_" 
				. $link . ".php'>"
				. $title . "</a></td>");
	}

	// A toolbar item with an uid
	function pwork_toolbar_item2($title, $link, $uid) {
		echo ("<td class='toolbaritem'><a href='pwork_" 
				. $link . ".php?uid=" . $uid ."'>"
				. $title . "</a></td>");
	}

	// Separator for toolbar items
	function pwork_toolbar_item_sep () {
		echo "<td class='toolbarsep'>&middot;</td>";
	}


	// ----- //
	// Boxes //
	// ----- //

	// Begin the box
	function pwork_box_begin($title) {
		echo ("<table class='box'><tr><td class='hdr_box'>" . $title . "</td></tr>\n");
	}

	// Begin the box content
	function pwork_box_content_begin() {
		echo "<tr><td class='box'>";
	}

	// End the box content
	function pwork_box_content_end() {
		echo "</td></tr>";
	}


	// End the box
	function pwork_box_end() {
		echo "</table>\n";
	}


	// -------- //
	// Projects //
	// -------- //


     // Return a link to the organizer main view
    function pm_proj_list($title) {
    	return "<a href='pm_overview.php'>" . $title . "</a>"; 
    }    
    
     // Return a link to the address book main view
    function pm_addr_list($title) {
    	return "<a href='pm_addrbook.php'>" . $title . "</a>"; 
    }    
	// Return a link to a contact
    function pm_addr_link($uid, $title) {
    	return "<a href='pm_contact.php?uid=". $uid . "'>" . $title . "</a>"; 
    }    


     // Sign on 
    function pm_login() {
    	return "<a href='pm_login.php'>Login</a>"; 
    }
        
    function pm_logout() {
    	return "<a href='pm_logout.php'>Logout</a>"; 
    }    

	// --------
	// PROJECTS
	// --------

    // Return a link to a project
    function pm_proj_link($uid, $title) {
    	return "<a href='pm_project.php?uid=". $uid . "'>" . $title . "</a>"; 
    }    

	// Outputs a project delete button for $projId
	function pm_proj_delete($projId) {
		echo "<form method='post' action='pm_overview.php'>";
		echo "<input type='hidden' name='projId' value='$projId'>\n"; 
		echo "<input class='note'  type='submit' value='Delete' name='btnProjDelete'/>"; 
	    echo "</form>";
	}


	// Creates a new $element
	function pwork_toolbar_item_new($element) {
		$uc = ucfirst($element);
		echo "<td class='toolbaritem'>";
		echo "<form name='create$uc' method='post' action='pwork_$element" . "_edit.php'>";
		echo("<input type='hidden' name='create$uc' value='DC'>\n"); 
		echo("<a href='javascript: onCreate$uc()'>New $uc</a></form>");
		echo "</td>";
		echo "<script type='text/javascript'>function onCreate$uc(){document.create$uc.submit();}</script>";

	}

	function pwork_toolbar_item_find($element) {
		$uc = ucfirst($element);
	    echo "\n<td class='toolbaritem'><form name='search$uc' method='post' action='pwork_" 
	    		. $element ."s.php'>\n";
		echo("<a href='javascript: onSearch" .$uc . "s()'>Find</a></form>");
		echo "</td>";
		echo "<script type='text/javascript'>function onSearch" . $uc . "s(){document.search"
			. $uc . ".submit();}</script>";
	}

	function pwork_toolbar_item_edit($element, $uid) {
	    echo "\n<td class='toolbaritem'>\n";
    	echo "<a href='pwork_" . $element . "_edit.php?uid=". $uid . "'>Edit</a>"; 
		echo "</td>";
	}

	//
	// PAGES
	//
    
    function pwork_page_link($uid, $title) {
    	return "<a href='pwork_page.php?uid=". $uid . "'>" . $title . "</a>"; 
    } 

    function pwork_page_edit($uid, $title) {
    	return "<a href='pwork_page_edit.php?uid=". $uid . "'>" . $title . "</a>"; 
    } 

	function pwork_toolbar_item_page_delete($uid) {
	    echo("<td class='toolbaritem'><form name='deletePage' method='post' action='pwork_pages.php'>");
		echo("<input type='hidden' name='pageId' value='$uid'>\n"); 
		echo("<input type='hidden' name='btnPageDelete' value='Delete'>\n"); 
		echo("<a href='javascript: onDeletePage()'>Delete</a></form>");
		echo("</td>");
	}

	//
	// NOTES 
	//

    // Return a link to a note
    function pwork_note_link($uid, $title) {
    	return "<a href='pwork_note.php?uid=". $uid . "'>" . $title . "</a>"; 
    } 

	function pwork_toolbar_item_note_new() {
		echo "<td class='toolbaritem'><form name='createNote' method='post' action='pwork_note.php'>";
		echo("<input type='hidden' name='btnNoteCreate' value='DC'>\n"); 
		echo("<a href='javascript: onCreateNote()'>New Note</a></form>");
		echo "</td>";
		echo "<script type='text/javascript'>function onCreateNote(){document.createNote.submit();}</script>";

	}

	function pwork_toolbar_item_note_find() {
	    echo "<td class='toolbaritem'><form name='searchNotes' method='post' action='pwork_notes.php'>";
		echo("<a href='javascript: onSearchNotes()'>Find</a></form>");
		echo "</td>";
		echo "<script type='text/javascript'>function onSearchNotes(){document.searchNotes.submit();}</script>";
	}

	function pwork_toolbar_item_note_delete($uid) {
	    echo("<td class='toolbaritem'><form name='deleteNote' method='post' action='pwork_notes.php'>");
		echo("<input type='hidden' name='noteId' value='$uid'>\n"); 
		echo("<input type='hidden' name='btnNoteDelete' value='Delete'>\n"); 
		echo("<a href='javascript: onDeleteNote()'>Delete</a></form>");
		echo("</td>");
	}
	


?>