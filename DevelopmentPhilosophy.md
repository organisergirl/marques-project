# Introduction #

The philosophy behind the development of the MARques system is as follows:

To develop an open source system that provides three quarters of a system that can manage geospatial data for the purposes of exploring research questions.

The intention is to provide an environment that supports many of the standard activities that a mapping system must provide. These include:

  * A search interface
  * A browse interface
  * Adding / Removing / Viewing / Managing markers on a map

Custom code will need to be developed for each different dataset dependent on the complexity of the data.

# Core Data Model #

The MARQues system is developed using the [Lithium](http://lithify.me/) framework using the [PHP](http://en.wikipedia.org/wiki/PHP) scripting language.

The Lithium framework is developed using the [Model-View-Controller](http://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller) software architecture.

The intention of the MARQues system is develop the necessary controllers and views to support the standard activities and define some common models, views and controllers will be used.

The FilmWeeklyData is being used as an exemplar dataset during this first phase of development.