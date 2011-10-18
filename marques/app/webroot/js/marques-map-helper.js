/**
 * MARQUes - Maps Answering Research Questions
 *
 * @copyright     Copyright 2011, Flinders University (http://www.flinders.edu.au)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

/*
 * use a namespace for all of the MARQues related JavaScript
 */
 
var marques = new marquesHelper();

function marquesHelper() {

}


/**
 * function to build an array of coordinates
 */
marquesHelper.prototype.getAustralianCoords = function() {

	var coordList = null;

	// check to see if the Google Maps API is loaded
	if(typeof google.maps.Map === 'function') {
		// yes
		coordList = {
			australia: {
				LatLng: new google.maps.LatLng(-25.947028, 133.209639),
				zoom: 4
			},
			states: {
				sa: {
					LatLng: new google.maps.LatLng(-32, 135.763333),
					zoom: 6
				},
				wa: {
					LatLng: new google.maps.LatLng(-25.328055, 122.298333),
					zoom: 5
				},
				nsw: {
					LatLng: new google.maps.LatLng(-32.163333, 147.016666),
					zoom: 6
				},
				qld: {
					LatLng: new google.maps.LatLng(-22.486944, 144.431666),
					zoom: 5
				},
				tas: {
					LatLng: new google.maps.LatLng(-42.021388, 146.593333),
					zoom: 7
				},
				vic: {
					LatLng: new google.maps.LatLng(-36.854166, 144.281111),
					zoom: 6
				},
				act: {
					LatLng: new google.maps.LatLng(-35.49, 149.001388),
					zoom: 9
				},
				nt: {
					LatLng: new google.maps.LatLng(-19.383333, 133.357777),
					zoom: 6
				}
			},
			capitals: {
				adelaide: {
					LatLng: new google.maps.LatLng(-34.93, 138.60),
					zoom: 14
				},
				perth: {
					LatLng: new google.maps.LatLng(-31.95, 115.85),
					zoom: 14
				},
				sydney: {
					LatLng: new google.maps.LatLng(-33.87, 151.20),
					zoom: 14
				},
				brisbane: {
					LatLng: new google.maps.LatLng(-27.47, 153.02),
					zoom: 14
				},
				hobart: {
					LatLng: new google.maps.LatLng(-42.88, 147.32),
					zoom: 14
				},
				melbourne: {
					LatLng: new google.maps.LatLng(-38.82, 144.97),
					zoom: 14
				},
				canberra: {
					LatLng: new google.maps.LatLng(-35.30, 149.13),
					zoom: 14
				},
				darwin: {
					LatLng: new google.maps.LatLng(-12.45, 130.83),
					zoom: 14
				}
			}
		};
	} else {
		//no
		coordList = {
			australia: {
				Lat: -25.947028,
				Lng: 133.209639,
				zoom: 2
			},
			states: {
				sa: {
					Lat: -32,
					Lng: 135.763333,
					zoom: 6
				},
				wa: {
					Lat: -25.328055,
					Lng: 122.298333,
					zoom: 5
				},
				nsw: {
					Lat: -32.163333,
					Lng: 147.016666,
					zoom: 6
				},
				qld: {
					Lat: -22.486944,
					Lng: 144.431666,
					zoom: 5
				},
				tas: {
					Lat: -42.021388,
					Lng: 146.593333,
					zoom: 7
				},
				vic: {
					Lat: -36.854166,
					Lng: 144.281111,
					zoom: 6
				},
				act: {
					Lat: -35.49,
					Lng: 149.001388,
					zoom: 9
				},
				nt: {
					Lat: -19.383333,
					Lng: 133.357777,
					zoom: 6
				}
			},
			capitals: {
				adelaide: {
					Lat: -34.93,
					Lng: 138.60,
					zoom: 14
				},
				perth: {
					Lat: -31.95,
					Lng: 115.85,
					zoom: 14
				},
				sydney: {
					Lat: -33.87,
					Lng: 151.20,
					zoom: 14
				},
				brisbane: {
					Lat: -27.47,
					Lng: 153.02,
					zoom: 14
				},
				hobart: {
					Lat: -42.88,
					Lng: 147.32,
					zoom: 14
				},
				melbourne: {
					Lat: -38.82,
					Lng: 144.97,
					zoom: 14
				},
				canberra: {
					Lat: -35.30,
					Lng: 149.13,
					zoom: 14
				},
				darwin: {
					Lat: -12.45,
					Lng: 130.83,
					zoom: 14
				}
			}
		};
	}

	return coordList;
}

/**
 * compute a hash of the lat lngs for indexing collections of objects
 * 
 * TODO: delevelop a more robust hash algorithm
 */
marquesHelper.prototype.computeLatLngHash = function(latitude, longitude) {

	if(longitude == null) {
		
		var coords = latitude.split(',');
		
		latitude  = coords[0];
		longitude = coords[1];
	
	}

    var lat = parseFloat(latitude);
    var lng = parseFloat(longitude);
    
    var latlngHash = (lat.toFixed(6) + "" + lng.toFixed(6));
    
    latlngHash     = latlngHash.replace(".","").replace(",", "").replace("-", "");
    latlngHash     = latlngHash.replace(".","").replace(",", "").replace("-", "");
    
    return latlngHash;
}

/**
 * fill a select box with items retrieved via ajax
 */
marquesHelper.prototype.fillSelectBox = function(id, url, ignoreFirst, addDefault) {

	// get a jQuery object for the id
	var selectBox = $(id);
	
	// get the data and populate the select box
	$.get(url, function(data) {
	
		selectBox.empty();
		
		var items = '';
		var list = data.items;
		
		// add a default value of required
		if(addDefault != null) {
			items += '<option value="default">' + addDefault + '</option>';
		}
		
		if(ignoreFirst == true) {
			$.each(data.items, function(index, value) {
				if(index != 0) {
					items += '<option value="' + value.id + '">' + value.description + '</option>';
				}
			});		
		} else {
			$.each(data.items, function(index, value) {
				items += '<option value="' + value.id + '">' + value.description + '</option>';
			});	
		}
		
		selectBox.append(items);
		
	});
}