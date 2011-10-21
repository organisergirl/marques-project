/**
 * Mapping the Movies
 *
 * @copyright     Copyright 2011, Flinders Institute for Research in the Humanities - Flinders University (http://www.flinders.edu.au)
 * @license       All Rights Reserved
 */
 
// global variables
var map = null;

var mapData = {
	hashes:  [], 
	data:    [],
	markers: []
};

//populate the page
$(document).ready(function() {
		
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
	
	//resize the map
	resizeMap();

});

// initialisation functions
function initUI() {

	// initalise the ui elements
	$('.fw-button').button();

	// initialise the buttons
	$('#btn_search').click(function() {
		$('#search_dialog').dialog('open');
	});
	
	$('#btn_adv_search').click(function() {
		$('#adv_search_dialog').dialog('open');
	});
	
	$('#btn_browse').click(function() {
		$('#browse_dialog').dialog('open');
	});
	
	$('#btn_controls').click(function(){
		$('#controls_dialog').dialog('open');
	});
	
	// initialise the add to map links
	$('.add-to-map').live('click', function() {
		addToMap(this);
	});
	
	// initialise the filters
	$('.fw-state-filter').click(function(event) {
		filterSearchResults('fw-state', event);
	});
	
	// fill in the advanced search select boxes
	marques.fillSelectBox('#adv_filter_state', '/marques/australian_states/items.json');
	marques.fillSelectBox('#adv_filter_locality', '/marques/locality_types/items.json');
	marques.fillSelectBox('#adv_filter_cinema', '/marques/film_weekly_cinema_types/items.json');
	
	marques.fillSelectBox('#browse_state', '/marques/australian_states/itemsbyid.json', true, 'Select a state');
	marques.fillSelectBox('#browse_filter_cinema', '/marques/film_weekly_cinema_types/items.json');
	
	// allow user to swap from advanced to basic search
	$('#search_swap').click(function(event) {
		$('#adv_search_dialog').dialog('close');
		$('#search_dialog').dialog('open');
	});
	
	// filter the advanced search results
	$('#adv_filter_state').change(function (event) {
		filterAdvSearchResults();
	});
	
	$('#adv_filter_locality').change(function (event) {
		filterAdvSearchResults();
	});
	
	$('#adv_filter_cinema').change(function (event) {
		filterAdvSearchResults();
	});
	
	// initialise the browse select boxes
	$('#browse_state').change(function (event) {
	
		$('#browse_filter_cinema option:selected').attr('selected', false);
		$('#browse_filter_cinema option:first').attr('selected', 'selected');
		
		$('#browse_search_results').empty();
		$('#browse_result_count').empty();
		$('#browse_result_hidden').empty();
		
		$('.browse-suburb').each(function(index, element) {
			$(element).empty();
		});
			
		var state = $('#browse_state option:selected').val();
		
		if(state != 'default') {
			var url = '/marques/browse/suburbs/' + state + '.json';
			var optionA = '<option value="default">Select a Suburb</option>';
			var optionF = '<option value="default">Select a Suburb</option>';
			var optionK = '<option value="default">Select a Suburb</option>';
			var optionP = '<option value="default">Select a Suburb</option>';
			var optionU = '<option value="default">Select a Suburb</option>';
			
			var tmp
			
			$.get(url, function(data) {
				$.each(data.items, function(index, value) {
				
					tmp = value.description.toLowerCase();
					tmp = tmp.substr(0,1);
					
					if(tmp == 'a' || tmp == 'b' || tmp == 'c' || tmp == 'd' || tmp == 'e') {
						optionA += '<option value="' + value.id + '">' + value.description + '</option>';
					} else if (tmp == 'f' || tmp == 'g' || tmp == 'h' || tmp == 'i' || tmp == 'j') {
						optionF += '<option value="' + value.id + '">' + value.description + '</option>';
					} else if (tmp == 'k' || tmp == 'l' || tmp == 'm' || tmp == 'n' || tmp == 'o') {
						optionK += '<option value="' + value.id + '">' + value.description + '</option>';
					} else if (tmp == 'p' || tmp == 'q' || tmp == 'r' || tmp == 's' || tmp == 't') {
						optionP += '<option value="' + value.id + '">' + value.description + '</option>';
					} else {
						optionU += '<option value="' + value.id + '">' + value.description + '</option>';
					}
				
				});
				
				$('#browse_suburb_a').append(optionA);
				$('#browse_suburb_f').append(optionF);
				$('#browse_suburb_k').append(optionK);
				$('#browse_suburb_p').append(optionP);
				$('#browse_suburb_u').append(optionU);
			});
		}
	});
	
	$('.browse-suburb').change(function (event) {
	
		$('#browse_filter_cinema option:selected').attr('selected', false);
		$('#browse_filter_cinema option:first').attr('selected', 'selected');
		
		var target = $(this);
		var targetid = target.attr('id');
		
		$('.browse-suburb').each(function(index, value){
		
			var otherid = $(value).attr('id');
		
			if(otherid != targetid) {
				$('#' + otherid + ' option:selected').attr('selected', false);
				$('#' + otherid + ' option:first').attr('selected', 'selected');
			}
		
		});
	
		var suburb = target.val();
		var state  = $('#browse_state').val();
		
		$.post(
			'/marques/searches/bysuburb.json',
			{
				suburb: suburb,
				state:  state
			},
			function(data, textStatus, jqXHR) {
				doSearchResults(data, '#browse_search_results');
				
				$('#browse_result_count').empty().append(data.results.length);
				$('#browse_result_hidden').empty().append('0');
			},
			'json'
		);
	});
	
	$('#browse_filter_cinema').change(function (event) {
	
		$('.fw-search-result').show();
	
		var criteria = $('#browse_filter_cinema').val();
		var count = 0;
		
		if(criteria != 'all') {
			$('.fw-search-result').filter(':visible').each(function(index, element) {
						
				var data = $(this).data('result');
				
				if(data.cinema_type != criteria) {
					$(this).hide();
					count++;
				}
			});
		}
		
		$('#browse_result_hidden').empty().append(count);	
	});
	
	$('.jump-list').change(function (event){
	
		if($(this).val() != 'default') {
			marques.panAndZoom(map, $(this).val());
			map.panBy(-400, 0);
		}

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
		height: 450,
		width: 700,
		modal: true,
		position: 'left',
		buttons: [
			{
				text: 'Add All',
				click: function() {
					$('.fw-add-to-map').filter(':visible').each(function(index, element) {
						$(this).click();
					});
				}
			},			
			{
				text: 'Close',
				click: function() {
					$(this).dialog('close');
				}
			}
		],
		open: function() {
			$("#search_message_box").hide();
			initSearchForms();
			map.panBy(-350, 0);
		},
		close: function() {
			//tidy up the dialog when we close
			var form = $('#search_form').validate();
			form.resetForm();
			map.panBy(350, 0);
		}
	});
	
	$('#adv_search_dialog').dialog({
		autoOpen: false,
		height: 500,
		width: 800,
		modal: true,
		position: 'left',
		buttons: [
			{
				text: 'Add All',
				click: function() {
					$('.fw-add-to-map').filter(':visible').each(function(index, element) {
						$(this).click();
					});
				}
			},			
			{
				text: 'Close',
				click: function() {
					$(this).dialog('close');
				}
			}
		],
		open: function() {
			$("#adv_search_message_box").hide();
			initSearchForms();
			map.panBy(-400, 0);
		},
		close: function() {
			//tidy up the dialog when we close
			var form = $('#adv_search_form').validate();
			form.resetForm();
			map.panBy(400, 0);
		}
	});
	
	$('#browse_dialog').dialog({
		autoOpen: false,
		height: 500,
		width: 800,
		modal: true,
		position: 'left',
		buttons: [
			{
				text: 'Add All',
				click: function() {
					$('.fw-add-to-map').filter(':visible').each(function(index, element) {
						$(this).click();
					});
				}
			},			
			{
				text: 'Close',
				click: function() {
					$(this).dialog('close');
				}
			}
		],
		open: function() {
			// do this when the dialog opens
			map.panBy(-400, 0);
		},
		close: function() {
			// do this when the dialog closes
			map.panBy(400, 0);
		}
	});
	
	$('#controls_dialog').dialog({
		autoOpen: false,
		height: 500,
		width: 800,
		modal: true,
		position: 'left',
		buttons: [			
			{
				text: 'Close',
				click: function() {
					$(this).dialog('close');
				}
			}
		],
		open: function() {
			// do this when the dialog opens
			map.panBy(-400, 0);
			prepareMapControls();
		},
		close: function() {
			// do this when the dialog closes
			map.panBy(400, 0);
		}
	});
}

function prepareMapControls() {

	$('.jump-list').each(function(index, element){
		$(element).empty();
	});
	
	var list = '<option value="default">Select a State</option>';
	
	$(marques.stateJumpList()).each(function(index, value) {
		list += '<option value="' + value.value + '">' + value.id + '</option>';
	});
	
	$('#jump_state').append(list);
	
	list = '<option value="default">Select a City</option>';
	
	$(marques.cityJumpList()).each(function(index, value) {
		list += '<option value="' + value.value + '">' + value.id + '</option>';
	});
	
	$('#jump_city').append(list);
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
				beforeSubmit: function() {
					$('#search_results_box').empty().append('<p class="search-progress"><img src="/assets/images/search-progress.gif" height="19" width="220" alt="Search Underway"/></p>');
				},
				success: doBasicSearch,
				error: function (jqXHR, textStatus, errorThrown) {
					$('#search_results_box').empty().append('<div class="ui-state-error ui-corner-all search-message-box"><p><span class="ui-icon ui-icon-alert status-icon"></span>An error occurred during the search, please try again later</p></div>');

				}
			});
		}
	});
	
	$('#adv_search_form').validate({
		rules: {
			search: 'required'
		},
		messages: {
			search: 'Search terms are required'
		},
		errorContainer: '#adv_search_message_box',
		errorLabelContainer: '#adv_search_message',
		submitHandler: function(form) {
			$(form).ajaxSubmit({
				dataType:  'json',
				beforeSubmit: function() {
					$('#adv_search_results_box').empty().append('<p class="search-progress"><img src="/assets/images/search-progress.gif" height="19" width="220" alt="Search Underway"/></p>');
					resetAdvFilters();
				},
				success: doAdvancedSearch,
				error: function (jqXHR, textStatus, errorThrown) {
					$('#adv_search_results_box').empty().append('<div class="ui-state-error ui-corner-all search-message-box"><p><span class="ui-icon ui-icon-alert status-icon"></span>An error occurred during the search, please try again later</p></div>');

				}
			});
		}
	});

}

function doBasicSearch(data) {
	doSearchResults(data, '#search_results_box');
	
	$('#search_result_count').empty().append(data.results.length);
	$('#search_result_hidden').empty();
}

function doAdvancedSearch(data) {
	doSearchResults(data, '#adv_search_results_box'); 
	
	$('#adv_result_count').empty().append(data.results.length);
	$('#adv_result_hidden').empty();
}

// function to undertake a search
function doSearchResults(data, elem) {
	
	// store a reference to the search results node so we
	// don't keep looking it up
	var results = $(elem);
	
	// variables to store the data
	var id;
	var cinema;
	var exhibitor;
	var address;
	var entry = '';
	var para;

	// empty any existing search results
	results.empty();
	
	if(data.results.length > 0) {
	
		// loop through all of the items
		$.each(data.results, function(index, value) {
		
			entry = '<p class="fw-search-result fw-search-result-' + value.state + '">' + value.result + ' </p>';
		
			para = $(entry);
			
			if($.inArray(marques.computeLatLngHash(value.coords), mapData.hashes) > -1) {
				entry = '<span class="fw-add-to-map">Added</span>';
			} else {
				entry = '<span id="' + value.type + "-" + value.id + '" class="fw-add-to-map add-to-map fw-clickable">Add to Map</span>';
			}
			
			entry = $(entry);
			
			entry.data('result', value);
			para.data('result', value);
			
			para.append(entry);
			
			results.append(para);
		
		});
			
	} else {
		results.append('<p class="no-search-results">No Search Results Found</p>');
	}

}

// function to filter the search results
function filterSearchResults(type, event) {

	// determine what type of filter to carry out
	if(type == 'fw-state') {
		// filter the search results by state
		
		// get the state
		var state = event.target.innerHTML;
		
		var count = 0;
		
		if(state != 'All') {
			// fade out the selected search results
			$('.fw-search-result-' + state).show();
			$('.fw-search-result').not('.fw-search-result-' + state).each(function(index, element) {
				$(element).hide();
				count++;
			});
			
		} else {
			// show all of the search results
			$('.fw-search-result').show();
		}
		
		$('#search_result_hidden').empty().append(count);
	}
}

// function to reset the advance filter select boxes
function resetAdvFilters() {

	$('#adv_filter_state option:selected').attr('selected', false);
	$('#adv_filter_state option:first').attr('selected', 'selected');
	
	$('#adv_filter_locality option:selected').attr('selected', false);
	$('#adv_filter_locality option:first').attr('selected', 'selected');
	
	$('#adv_filter_cinema option:selected').attr('selected', false);
	$('#adv_filter_cinema option:first').attr('selected', 'selected');
	
	$('#adv_result_count').empty();
	$('#adv_result_hidden').empty();

}

// function to filter the advanced search results
function filterAdvSearchResults() {

	var count = 0;

	// show all of the search results
	$('.fw-search-result').show();
	
	// filter by state
	var criteria = $('#adv_filter_state').val();
	
	// filter the search results by state
	if(criteria != 'All') {
		// fade out the selected search results
		$('.fw-search-result-' + criteria).show();
		$('.fw-search-result').not('.fw-search-result-' + criteria).each(function(index, element) {
			count++;
			$(this).hide();
		});
		
	}

	// filter by locality type
	// work on those that aren't already hidden
	criteria = $('#adv_filter_locality').val();
	
	if(criteria != 'all') {
	
		$('.fw-search-result').filter(':visible').each(function(index, element) {
			
			var data = $(this).data('result');
			
			if(data.locality_type != criteria) {
				count++;
				$(this).hide();
			}
		});
	}
		
	// filter by cinema type
	// get all of those that aren't already hidden
	criteria = $('#adv_filter_cinema').val();
	if(criteria != 'all') {
		$('.fw-search-result').filter(':visible').each(function(index, element) {
					
			var data = $(this).data('result');
			
			if(data.cinema_type != criteria) {
				count++;
				$(this).hide();
			}
		});
	}
	
	$('#adv_result_hidden').empty().append(count);
}

// function to add an item to the map
function addToMap(item) {

	var data = $(item).data('result');
	
	var coords = data.coords.split(',');
	
	var latlng = new google.maps.LatLng(coords[0], coords[1]);
	var marker = new google.maps.Marker({
		position: latlng,
		map: map,
		title: data.title,
		icon: data.icon
	});

	// add to the list of what is on the map
	mapData.hashes.push(marques.computeLatLngHash(data.coords));
	mapData.data.push(data);
	mapData.markers.push(marker);
	
	$(item).empty().append('Added');
	$(item).removeClass('fw-clickable add-to-map');

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