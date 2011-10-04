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
	
	//resize the map
	resizeMap();
		
	// initialise the UI elements
	initUI();
	
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
	
	// finalise the page by removing the js class
	$('.js').removeClass('js');

});

// initialisation functions
function initUI() {

	// initalise the ui elements
	$('button').button();

	// initialise the buttons
	$('#btn_search').click(function() {
		$('#search_dialog').dialog('open');
	});
	
	// initialise the dialogs
	initDialogs();

}

/**
 * initialise all of the dialogs
 */
function initDialogs() {

	// initalise all of the dialogs
	$('#search_dialog').dialog({
		autoOpen: false,
		height: 400,
		width: 700,
		modal: true,
		buttons: {
			Close: function() {
					$( this ).dialog( "close" );
			}
		},
		open: function() {
			$("#search_message_box").hide();
			initSearchForms();
		},
		close: function() {
			//tidy up the dialog when we close
			$('#search_message_box').empty().hide();
		}
	});

}

function initSearchForms() {

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
				dataType:  'json', 
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
function doBasicSearch(data) {
	
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
	
	if(data.results.length > 0) {
		// loop through all of the items
		$.each(data.results, function(index, value) {
		
			entry += '<p class="fw-search-result">' + value.result + ' (<span id="' + value.type + "-" + value.id + '" class="add-to-map fw-clickable">Add to Map</span>)</p>';
		
		});
			
	} else {
		entry = '<p>No Search Results Found</p>';
	}
	
	

	/*
//loop through all of the items
	$(responseXML).find("item").each(function () {
	
		// get the id and type
		id     = $(this).attr('id');
		type   = $(this).attr('type');
		result = $(this).find('result').text();
		
		// build an entry
		entry += '<p class="fw-search-result">' + result + ' (<span id="' + type + "-" + id + '" class="add-to-map fw-clickable">Add to Map</span>)</p>';
		//entry += '<p id="' + type + "-" + id + '" class="search-result">' + result + '</p>';
	});
*/
	
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