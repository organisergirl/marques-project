The [Australian Cinema Map](http://auscinemas.flinders.edu.au/) website, developed using the FilmWeeklyData, uses iconography to differentiate between different types of cinemas in different localities.

Changing the iconography is a two stage process:

# Stage 1 - Upload the new iconography #

The icons used for markers on the map are image files in the PNG format.

To replace any of the existing icons:

  1. Login to the production server via FTP
  1. Navigate to the following directory <br> <code>~/auscinemas.flinders/assets/markers</code>
<ol><li>Delete any of the existing icons that are not required<br>
</li><li>Upload the new icons<br>
</li><li>Logoff from the production server</li></ol>

<b>Note:</b> Ensure that the file names for the markers are all in lowercase, have any spaces converted to a '-' and that the file name doesn't contain any other punctuation<br>
<br>
<h1>Stage 2 - Update the Marker records</h1>

The second stage in updating the iconography is to update the Marker records.<br>
<br>
To update the Marker records:<br>
<br>
<ol><li>Login to the MARQues control panel<br>
</li><li>Click on the <code>Manage Marker Records</code> link<br>
</li><li>Click the <code>Delete</code> link next to the record that is no longer required<br>
</li><li>Click the <code>Add New Record</code> link at the bottom of the page<br>
</li><li>Select the required <code>Cinema Type</code>
</li><li>Select the required <code>Locality Type</code>
</li><li>Enter the full URL to the new icon into the <code>Marker URL</code> field<br>
</li><li>Click the <code>Create New Record</code> button