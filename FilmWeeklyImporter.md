<h1>Introduction </h1>

The Film Weekly Importer app is a [Java based application](http://en.wikipedia.org/wiki/Java_(programming_language)) that can be used to import the FilmWeeklyData contained in the geo-coded spreadsheets into the MARQues database.

A ready to use version of the application is [available for download](http://code.google.com/p/marques-project/downloads/detail?name=FwImporter-1.0.3.zip) and the [source code is also available](http://code.google.com/p/marques-project/source/browse/#git%2Ffilm-weekly%2Fimporter).



# About the App #

The Film Weekly Importer App requires the following libraries:

  * [Apache Commons CLI](http://commons.apache.org/cli/) - version 1.2
  * [Apache Commons Collections](http://commons.apache.org/collections/) - version 3.2.1
  * [Apache Commons Configuration](http://commons.apache.org/configuration/) - version 1.7
  * [Apache Commons Lang](http://commons.apache.org/lang/) - version 2.6
  * [Apache Commons Logging](http://commons.apache.org/logging/) - version 1.1.1
  * [Apache log4j](http://logging.apache.org/log4j) - version 1.2.16
  * [Google Gson](http://code.google.com/p/google-gson/) - version 1.7.1
  * [MySQL Connector/J](http://dev.mysql.com/downloads/connector/j/) - version 5.1.17
  * [opencsv](http://opencsv.sourceforge.net/) - version 2.3
  * [Techxplorer's Java Utils Library](http://techxplorer.com/projects/java-utils-lib/)

# Using the App #

To use the app either download and compile the source code or download the pre compiled app use the links above. The app requires two configuration files, a properties file and a log4j configuration file. A small number of command line options are also required.

## Properties File ##

The properties file defines the following four properties:

| **Property** | **Description** |
|:-------------|:----------------|
| db-host      | host name of the MySQL database server |
| db-user      | MySQL user name used to connect to the database server |
| db-password  | Password for the above user name |
| db-name      | Name of the database inside the MySQL server |

An example properties file is below. Any lines beginning with a # are treated as comments and are ignored.

```
# properties for the importer program
# mysql database host name
db-host = localhost
# mysql database user name
db-user = marques
# mysql database password
db-password = marques
# mysql database name
db-name = marques
```

## Apache log4J properties ##

The log4j properties file specifies how messages from the app are logged. You're encouraged to check out the log4j documentation available at the URL above. A sample configuration that outputs all log messages to the console is below. Any lines beginning with a # are treated as comments and are ignored.

```
# Set root logger level to DEBUG and its only appender to A1.
log4j.rootLogger=ALL, A1

# A1 is set to be a ConsoleAppender.
log4j.appender.A1=org.apache.log4j.ConsoleAppender

# A1 uses PatternLayout.
log4j.appender.A1.layout=org.apache.log4j.PatternLayout
log4j.appender.A1.layout.ConversionPattern=%-4r [%t] %-5p %c %x - %m%n

# Filter out the Apache Commons Configuration Messages
log4j.logger.org.apache.commons.configuration=WARN
```

## Command Line options ##

The following command line options are used to configure the application

| **Option** | **Description** | **Required** |
|:-----------|:----------------|:-------------|
| -input     | full path to the input file | Yes          |
| -log4j     | full path to the [log4j properties file](FilmWeeklyImporter#Apache_log4J_properties.md) | Yes          |
| -properties | full path to the [properties file](FilmWeeklyImporter#Properties_File.md) | Yes          |
| -debug\_coord\_list | path to a file that will contain a unique list of coordinates | No           |
| -debug\_json\_list | path to a file that will contain a basic set of coordinates in JSON format | No           |

**Note** The options starting with -debug are not typically used in normal operation

## Starting the Application ##

Starting the application without any command line options, or with the incorrect options, results in a helpful error message.

Typically starting the application would require a command such as this

<pre>
java -jar FwImporter.jar -properties path/to/default.properties -input path/to/input.csv -log4j /path/to/log4j.properties<br>
</pre>