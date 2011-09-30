/**
 * Mapping the Movies
 *
 * @copyright     Copyright 2011, Flinders Institute for Research in the Humanities - Flinders University (http://www.flinders.edu.au)
 * @license       All Rights Reserved
 */
 
// global variables
var map = null;

//populate the page
$(document).ready(function() {

	// initalise the ui elements
	$('button').button();
	
	//resize the map
	resizeMap();
	
	// bind the resize map function to the resize event for the window
	$(window).resize(function() {
		resizeMap();
	});
	
	// initalise the map
	var coords = marques.getAustralianCoords().australia;
	
	var myOptions = {
		zoom: coords.zoom,
		center: coords.LatLng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	
	map = new google.maps.Map(document.getElementById('map'), myOptions);
	
	
	// initialise the UI elements
	initUI();
	
	// finalise the page by removing the js class
	$('.js').removeClass('js');

});

// initialisation functions
function initUI() {

	// initialise the buttons
	$('#btn_search').click(function() {
		$('#search_dialog').dialog('open');
	});
	
	// initialise the dialogs
	initDialogs();
	//initForms();

}

/**
 * initialise all of the dialogs
 */
function initDialogs() {

	// initalise all of the dialogs
	$('#search_dialog').dialog({
		autoOpen: false,
		height: 300,
		width: 600,
		modal: true,
		buttons: {
			Close: function() {
					$( this ).dialog( "close" );
			}
		},
		open: function() {
			$("#search_message_box").hide();
			initForms();
		},
		close: function() {
			//tidy up the dialog when we close
			$('#search_message_box').empty().hide();
		}
	});

}

function initForms() {

	$('#search_form').validate({
		rules: {
			search: 'required'
		},
		messages: {
			search: 'Search terms are required'
		},
		errorContainer: '#search_message_box',
		errorLabelContainer: '#search_message',
		submitHandler: function(form) {
			$(form).ajaxSubmit({
				dataType:  'xml', 
				success: doBasicSearch,
				error: function (jqXHR, textStatus, errorThrown) {
					console.log(jqXHR);
					console.log(textStatus);
					console.log(errorThrown);
					alert('error');
					
				}
			});
		}
	
	
	});

}

// function to undertake a search
function doBasicSearch(responseXML) {
	
	// store a reference to the search results node so we
	// don't keep looking it up
	var results = $('#search_results_box');
	
	// variables to store the data
	var id;
	var cinema;
	var exhibitor;
	var address;
	var entry = '';

	// empty any existing search results
	results.empty();

	//loop through all of the items
	$(responseXML).find("item").each(function () {
	
		id        = $(this).find('id').text();
		cinema    = $(this).find('cinema_name').text();
		exhibitor = $(this).find('exhibitor_name').text();
		address   = $(this).find('address').text();
		
		// build an entry
		entry += '<p>' + cinema + ', ' + exhibitor + ', ' + address + '</p>';
	});
	
	// append the new data
	results.append(entry);

}

//dynamically resize the map
function resizeMap() {

	// calculate new size and apply it
	var mid = document.getElementById('map_container');
	var foot = document.getElementById('footer');
	
	//mid.style.height = ((foot.offsetTop + foot.clientHeight - footerHeightAdjust) - (mid.offsetTop))+'px';
	mid.style.height = ((foot.offsetTop) - (mid.offsetTop))+'px';
	
	// trigger a resize event on the map so it reflects the new size
	if(map != null) {
		google.maps.event.trigger(map, 'resize');
	}
}