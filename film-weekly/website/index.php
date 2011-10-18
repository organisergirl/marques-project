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
	<title>Australian Cinemas Map</title>
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
			<h1>Australian Cinemas Map</h1>
			<h2>A map of Film Weekly Motion Picture Directory cinema data, 1948 - 1971</h2>
		</hgroup>
	</header>
	<nav>
		<p>
			<button id="btn_search" class="fw-button ui-state-default ui-corner-all">Search</button><button id="btn_adv_search" class="fw-button ui-state-default ui-corner-all">Adv. Search</button><button id="btn_browse" class="fw-button ui-state-default ui-corner-all">Browse</button><button id="btn_controls" class="fw-button ui-state-default ui-corner-all">Controls</button><button id="btn_help" class="fw-button ui-state-default ui-corner-all">Help</button>
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
		<p class="dialog-help">
			Enter address, cinema name or exhibitor name below.
		</p>
		<form id="search_form" method="post" action="marques/searches.json">
			<input name="search" size="50" type="search">
			<input type="submit" value="Search" class="fw-button ui-state-default ui-corner-all">
		</form>
		<div id="search_message_box" class="ui-state-error ui-corner-all search-message-box">
			<p>
				<span class="ui-icon ui-icon-alert status-icon"></span><span id="search_message" class="search-message"></span>
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
	<div id="adv_search_dialog" class="fw-dialog js" title="Advanced Search Film Weekly Data">
		<div style="float: left">
			<p class="dialog-help">
				Enter address, cinema name or exhibitor name below.
			</p>
			<form id="adv_search_form" method="post" action="marques/searches/advanced.json">
				<input name="search" size="50" type="search">
				<input type="submit" value="Search" class="fw-button ui-state-default ui-corner-all">
			</form>
			<div id="adv_search_message_box" class="ui-state-error ui-corner-all search-message-box">
				<p>
					<span class="ui-icon ui-icon-alert status-icon"></span><span id="adv_search_message" class="search-message"></span>
				</p>
			</div>
			<p class="dialog-help-2">
				You can use <a href="http://dev.mysql.com/doc/refman/5.1/en/fulltext-boolean.html" title="MySQL Documentation on available operators" class="external" target="_blank">boolean and other search operators</a>. <br/>If you do not need this level of functionality use the <span id="search_swap" class="clickable">standard search form</span>. 
			</p>
		</div>
		<div style="float: right">
			<table class="adv-filter-menu">
				<tr>
					<td colspan="2">
						Filter results by:
					</td>
				</tr>
				<tr>
					<td>
						<label for="adv_filter_state">State: </label>
					</td>
					<td>
						<select id="adv_filter_state" style="width: 100%">
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label for="adv_filter_locality">Locality Type: </label>
					</td>
					<td>
						<select id="adv_filter_locality">
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label for="adv_filter_cinema">Cinema Type: </label>
					</td>
					<td>
						<select id="adv_filter_cinema">
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						Search Results: <span id="adv_result_count"></span> Hidden: <span id="adv_result_hidden"></span>
					</td>
				</tr>
			</table>
		</div>
		<div class="clear"></div>
		<h1>Search Results</h1>
		<div id="adv_search_results_box">
		</div>
	</div>
	<div id="browse_dialog" class="fw-dialog js" title="Browse Film Weekly Data">
		<h1>Select a State</h1>
		<select id="browse_state"></select>
		<h1>Select a Suburb</h1>
		<select id="browse_suburb"></select>
		<h1>Select a Cinema Type</h1>
		<select id="browse_filter_cinema"></select>
		<h1>Record List</h1>
		<div id="browse_search_results">
		</div>
	</div>
</body>
</html>