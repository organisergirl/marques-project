# Introduction #

The activity log functionality is intended to store data that can provide further insight into how the system is being used. At the moment data is logged and there is no visualisation.

The intention of the activity log is that it is easy to use, and does not store personally identifiable information.

# Storing a log entry #

The easiest way to create an activity log is to use the `app\models\ActivityLogs` class and create and store a log entry using code like this:

```

// save an activity log entry

// create the data
$log = array(
  'type'  => 'search',
  'notes' => $this->request->data['search'],
  'timestamp' => date('Y-m-d H:i:s')
);

// use the data to create an instance of the model
$activity = ActivityLogs::create($log);

// save the model
$activity->save();

```

Please note that due to an [known issue](https://github.com/UnionOfRAD/lithium/issues/28) with the Lithium framewor it is necessary to explicitly initialise the timestamp field.

# Database table #

Activity log entries are stored in the ActivityLogs table as outlined by the DatabaseSchema page. The table contains the following fields

| **Field Name** | **Description** |
|:---------------|:----------------|
| id             | a unique identifier for the row |
| type           | a brief (20 char) identifier for the type of activity log entry |
| notes          | any additional information that needs to be logged |
| timestamp      | the date and time that the activity occurred |

# Activity Types #

The activities that are currently in use are

| **Type** | **Description** |
|:---------|:----------------|
| search   | a basic search - the notes field contains the search keywords used |
| adv-search | an advanced search - the notes field contains the search keywords used |
| browse-by-suburb | the suburb and state used to request data to populate the browse interface |