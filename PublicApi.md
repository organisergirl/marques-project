As stated in the DevelopmentPhilosophy page the intent of the MARQues system is to support the development of websites that use maps as their core user interface component. Specifically a site built with the MARQues system should be able to provide:

  * A search interface
  * A browse interface
  * Ability to add / remove / view and manage markers on a map

The core of this functionality is represented in the public API.



# Search API #

The Search API is designed to support two different types of searches, a basic and an advanced search. The core of the Search API is contained in the [SearchesController](http://code.google.com/p/marques-project/source/browse/marques/app/controllers/SearchesController.php).

The intention of the search controller is to provide a public API for undertaking a search. The search can then use the dataset specific models to construct the search results and return them. Each search result must have a number of common fields.

## Basic Search ##

A basic search is undertaken by posting the search terms to the searches controller via the following URL

/marques/searches.json

The search terms need to be encoded in a variable labelled search.

## Advanced Search ##

An advanced search is undertaken by posting the search terms and search operators to the searches controller via the following URL

/marques/searches/advanced.json

The search terms need to be encoded in a variable labelled search.

## By ID ##

A search by  ID is undertaken by posting the id to the searches controller via the following URL

/marques/searches/byid.json

The search term must be encoded in a variable labelled id.

## Search Result Data ##

The data returned by the searches controller is encoded in JSON and is an array of search result objects. A search result object looks like this:

```

{
    "results": [
        {
            "cinema_type": "1", 
            "coords": "-34.933961,138.498957", 
            "icon": "http://marques.local/assets/markers/letter-h-orange.png", 
            "id": "100", 
            "locality_type": "2", 
            "result": "Ozone, Hillside, Ozone Theatres Ltd., Ozone Street, Henley Beach, SA", 
            "state": "SA", 
            "title": "Ozone, Hillside", 
            "type": "film_weekly_cinema"
        }, 
        {
            "cinema_type": "1", 
            "coords": "-37.828719,140.781004", 
            "icon": "http://marques.local/assets/markers/letter-h-green.png", 
            "id": "175", 
            "locality_type": "3", 
            "result": "Ozone, Ozone Theatres Ltd., 10 Commercial Street East, Mount Gambier, SA", 
            "state": "SA", 
            "title": "Ozone", 
            "type": "film_weekly_cinema"
        }
}

```

The required fields are as follows:

| **Field Name** | **Description** |
|:---------------|:----------------|
| coords           | the geographic coordinates of the marker on the map |
| icon               | the url of the icon used to represent the marker on the map |
| result             | the text of the search result used to populate the page |
| title                | the title of the marker |
| type               | the type of data represented by the search result |

# Browse API #

The intention of the browse API is to support the ability to browse the data using different categories.

## By State and Suburb ##

A request for browse data is undertaken by posting data to the following URL.

/marques/searches/bysuburb.json

The following variables must be part of the post:

  * state - a state identifier as outlined in the [australian\_states](DatabaseSchema#australian_states.md) table
  * suburb - the name of the suburb, which is stored in the dataset specific table

## By State ##

A request for browse data is undertaken by posting data to the following URL.

/marques/searches/bystate.json

The following variables must be part of the post:

  * state - a state identifier as outlined in the [australian\_states](DatabaseSchema#australian_states.md) table

## By Locality ##

A request for browse data is undertaken by posting data to the following URL.

/marques/searches/bylocality.json

The following variables must be part of the post:

  * state - a state identifier as outlined in the [australian\_states](DatabaseSchema#australian_states.md) table
  * locality - a locality identifier as outlined in the [locality\_types](DatabaseSchema#locality_types.md) table

## By Cinema Type ##

A request for browse data is undertaken by posting data to the following URL.

/marques/searches/bycinematype.json

The following variables must be part of the post:

  * state - a state identifier as outlined in the [australian\_states](DatabaseSchema#australian_states.md) table
  * type - a cinema type identifier as outlined in the [film\_weekly\_cinema\_types](DatabaseSchema#film_weekly_cinema_types.md) table


## Browse Result Data ##

The browse result data is required to be in the same format as that used by [searches](PublicApi#Search_Result_Data.md).

# InfoWindow API #

It was an original intention to develop a general purpose API similar to that used for searching and browsing. Unfortunately due to resource constraints this was not possible. It is left for future projects to undertake development of this feature. As an example the FilmWeeklyData specific API, as represented by the [FilmWeeklyWindowsController](http://code.google.com/p/marques-project/source/browse/marques/app/controllers/FilmWeeklyInfoWindowsController.php) is available.

To retrieve data that can be used to populate an info window a request is made to the following url

/marques/film\_weekly\_info\_windows/content/xxx

Replace xxx with the unique record identifier of the data item that will be used to populate the infoWindow. The data returned should be formatted HTML that will be used to populate an infoWindow as a result of a user clicking the marker on the map.