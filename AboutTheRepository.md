<h1>Introduction</h1>

The source code for the project is housed here in the [Google Project Hosting](http://code.google.com/projecthosting/) service using the [Git](http://en.wikipedia.org/wiki/Git_(software)) distributed version control system.

You can [browse](http://code.google.com/p/marques-project/source/browse/) the repository as well as checkout your own copy using Git if you wish.

The directory structure is as follows



## assets ##

This top level directory contains files that are project assets. This includes images, documentation and mind maps.

### database ###

This sub-directory contains a sql script that can be used to construct the required [MySQL](http://en.wikipedia.org/wiki/Mysql) DatabaseSchema.

### marques-logo ###

This sub-directory contains the logo files including the source files used to construct the log.

### mind-maps ###

This sub-directory contains mind maps used to document various aspects of the system. More information about the mind maps is available on the ProjectMindMaps page.

## film-weekly ##

This top level directory contains files that are related to the management of the FilmWeeklyData.

### importer ###

The top level directory for the source code of the FilmWeeklyImporter app.

### map-mockup ###

The top level directory for an early [mockup of a map](http://marques-project.googlecode.com/git/film-weekly/map-mockup/index.html).

### website ###

The development version of the [Australian Cinemas Map](http://auscinemas.flinders.edu.au/). It uses the MARQues system to build a map using the FIlmWeeklyData. Development of this website provided the impetus to develop the MARQues system.

## marques ##

This top level directory contains the source code for the marques system. The system is built around the  [Lithium](http://lithify.me/) framework using the [PHP](http://en.wikipedia.org/wiki/PHP) scripting language.

### app ###

This sub-directory contains all of the files that make up the MARQues project application. For details of each file please consult the comments in the source code as well as the system documentation here in the wiki.

### libraries ###

This sub-directory contains a copy of the Lithium source code that is housed [in a repository](https://github.com/UnionOfRAD/lithium) in the [GitHub](https://github.com/) service. It is included in our repository as a [submodule](http://book.git-scm.com/5_submodules.html).

Additional lithium libraries are also stored in this directory.