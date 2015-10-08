The intention of the MARQues map helper JavaScript library is to make it easier to undertake common tasks related to the management of a map and manipulation of user interface elements.

The helper is stored in the [marques-map-helper.js](http://code.google.com/p/marques-project/source/browse/marques/app/webroot/js/marques-map-helper.js) file.



# Core Object #

The core of of the marques map helper is exposed via the `marques` javascript object which is an instantiation of the `marquesHelper` class.

# Functions #

The functions exposed by the `marques` object are as follows

## getAustralianCoords ##

This function returns an array of objects that represent coordinates and zoom levels for each Australian state and capital city. It also includes an entry for Australia itself.

## countryJumpList ##

This function returns data that can be used to populate a drop down list to suport panning and zooming to a specific country. At the moment the only entry is for Australia.

## stateJumpList ##

This function returns data that can be used to populate a drop down list to support  panning and zooming to a specific Australian state

## cityJumpList ##

This function returns data that can be used to populate a drop down list to support panning and zooming to a specific Australian capital city.

## panAndZoom(map, value) ##

The function takes a reference to the map, as the `map` parameter, and a coordinate and zoom value, as the `value` parameter and pans and zooms the map.

The `value` must be a comma delimited list containing the three values latitude,longitude,zoom

## deleteMarker(map, marker) ##

This function takes a reference to the map, as the `map` parameter, and a marker, as the `marker` parameter and removes the marker from the map. The `marker` parameter can also contain an array of markers if more than one marker needs to be removed from the map

## computeLatLngHash(latitude, longitude) ##

This function strips all punctuation from a latitude and longitude pair and returning the resulting string

## fillSelectBox(id, url, ignoreFirst, addDefault) ##

This function makes an AJAX request for data that can be used to populate a select box. The parameters are:

  * `id` - the id of the select element
  * `url` - the url used to request the data
  * `ignoreFirst` - if set to true the first element in the returned data will be ignored
  * `addDefault` - if set this value will be used as the first element and will be selected