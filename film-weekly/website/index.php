<!DOCTYPE html>
<!-- 
/**
 * Mapping the Movies
 *
 * @copyright     Copyright 2011, Flinders Institute for Research in the Humanities - Flinders University (http://www.flinders.edu.au)
 * @license       All Rights Reserved
 */ 
-->
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>Mapping the Movies</title>
	<link rel="stylesheet" type="text/css" href="assets/main-style.css"/>
	<link rel="stylesheet" type="text/css" href="assets/jquery-ui.css"/>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="assets/javascript/libraries/jquery-1.6.4.min.js"></script>
	<script type="text/javascript" src="assets/javascript/libraries/jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="assets/javascript/libraries/jquery-validate-1.8.1.min.js"></script>
	<script type="text/javascript" src="assets/javascript/libraries/jquery-form-2.85.js"></script>
	<script type="text/javascript" src="assets/javascript/main.js"></script>
	<!-- use some of the MARQues scripts -->
	<script type="text/javascript" src="/marques/js/marques-map-helper.js"></script>
	
</head>
<body>
	<header>
		<hgroup>
			<h1>Mapping the Movies</h1>
			<h2>A map of Film Weekly Motion Picture Directory Cinema Data, 1948 - 1971</h2>
		</hgroup>
	</header>
	<nav>
		<p>
			<button id="btn_search" class="fw-button ui-state-default ui-corner-all">Search</button><button id="btn_browse" class="fw-button ui-state-default ui-corner-all">Browse</button><button id="btn_controls" class="fw-button ui-state-default ui-corner-all">Controls</button><button id="btn_help" class="fw-button ui-state-default ui-corner-all">Help</button>
		</p>
	</nav>
	<div id="map_container">
		<div id="map">
		</div>
	</div>
	<footer id="footer">
		<p class="left"> &#169; 2011 Flinders Institute for Research in the Humanities</p>
		<p class="right">Powered by <a href="http://code.google.com/p/marques-project/" title="More information about MARQues">MARQues</a></p>
	</footer>
	<!-- dialogs go here -->
	<div id="search_dialog" class="fw-dialog js" title="Search Film Weekly Data">
		<form id="search_form" method="post" action="marques/searches.json">
			<input name="search" size="50" type="search">
			<input type="submit" value="Search" class="fw-button ui-state-default ui-corner-all">
		</form>
		<div id="search_message_box" class="ui-state-error ui-corner-all">
			<p>
				<span class="ui-icon ui-icon-alert"></span><span id="search_message"></span>
			</p>
		</div>
		<h1>Search Results</h1>
		<div class="dialog-menu">
			<ul><li>Filter by State:</li><li class="clickable fw-state-filter">All</li><li class="clickable fw-state-filter">QLD</li><li class="clickable fw-state-filter">NSW</li><li class="clickable fw-state-filter">ACT</li><li class="clickable fw-state-filter">VIC</li><li class="clickable fw-state-filter">TAS</li><li class="clickable fw-state-filter">NT</li><li class="clickable fw-state-filter">SA</li><li class="clickable fw-state-filter">WA</li></ul>
		</div>
		<div class="clear"></div>
		<div id="search_results_box">
		</div>
	</div>
</body>
</html>