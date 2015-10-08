<h1> Introduction </h1>

There are three categories of tables in the MARQues database.



A [database diagram](http://marques-project.googlecode.com/git/assets/database/database-schema.png) is available and is derived from the [database-schema.sql](http://marques-project.googlecode.com/git/assets/database/database-schema.sql) file.

## MARQues System Tables ##

The MARQues system tables are as follows:

### users ###

The users table defines information about authorised users of the system. Of particular note is the password field. This password contains a hash of the actual password as produced by [Lithium](http://lithify.me/docs/manual/auth/simple-authentication.wiki).

### activity\_logs ###

Used to store details about activities that are of interest, data could be used for system analytics but no visualisation component is available at present. More information is available on the ActivityLogs page

## Generic Dataset Tables ##

Tables that can be used by more than one dataset are as follows:

### australian\_states ###

The australian\_states table has a list of australian states including abbreviation and long name

### locality\_types ###

The locality\_types table has a list of different locality types, such as suburban, rural etc.

### resources ###

This table is used to store links to resources that may be associated with one or more data records.

## Specific Dataset Tables ##

These tables are specific to the FilmWeeklyData and are as follows:

### film\_weekly\_cinemas ###

The film\_weekly\_cinemas table contains the main record for each cinema in the FilmWeeklyData

### film\_weekly\_cinema\_types ###

The film\_weekly\_cinema\_types table contains a list of the different cinema types defined in the dataset

### film\_weekly\_categories ###

The film\_weekly\_categories table contains a list of the different categories. This is the way the system manages the different years in the dataset by treating them as a sequentially numbered list of categories as opposed to discreet time intervals

### film\_weekly\_category\_maps ###

The film\_weekly\_category\_maps table provides the link between a film\_weekly\_cinema record and the film\_weekly\_categories records to which it belongs

### film\_weekly\_archaeologies ###

The film\_weekly\_archaeologies table contains the archaeology records for each theatre, linking the changes to the main record in the film\_weekly\_cinemas table and the year in which the change occurred by linking the record to the film\_weekly\_categories table.

### film\_weekly\_markers ###

The film\_weekly\_markers table contains records that define a matrix that matches the combination of film\_weekly\_cinema\_type and locality\_type to the URL of the required marker

### film\_weekly\_searches ###

This table provides a full text index of the following fields:

  * film\_weekly\_cinemas.street
  * film\_weekly\_cinemas.suburb
  * film\_weekly\_cinemas.cinema\_name
  * film\_weekly\_cinemas.exhibitor\_name
  * film\_weekly\_archaeologies.cinema\_name
  * film\_weekly\_archaeologies.exhibitor\_name

In this way a full text search can find a record based on either the main or archaeology record. It is proposed that the default search will use natural language searching whilst the advanced search will use boolean operators. More information on the full text indexes is [available here](http://dev.mysql.com/doc/refman/5.1/en/fulltext-search.html).

Please note that other ways of finding records will be via the browse interface. Specialised searches can also be implemented if required.

### film\_weekly\_resource\_maps ###

This table provides a link between the resources table and the film\_weekly\_cinemas table.