The majority of content in the MARQues system is created using data sourced from the database and are not designed to be edited directly. The two exceptions to this are the Welcome and Help dialogs.

It is recommended that you read the information in the [Common Information](EditingPages#Common_Information.md) section before continuing.



Information on how to [Add Resources to Cinema Records](AddingResources.md) is provided on a separate Wiki page.

# Welcome Message #

The welcome dialog is intended to provide information to new users of the map. In the [Australian Cinema Map](http://auscinemas.flinders.edu.au/) website, developed using the FilmWeeklyData, the information is displayed in a dialog that opens when the website initially loads.

It is intended that the user read the information in the welcome dialog before continuing to use the website. If the user chooses they can tick a box which indicates when they return to the site the welcome dialog should not be displayed.

To edit the content of the Welcome Message:

  1. Login to the production server via FTP
  1. Navigate to the following directory <br> <code>~/auscinemas.flinders/marques/app/views/pages</code>
<ol><li>Download the <code>welcome.html.php</code> file to your computer<br>
</li><li>Save your changes<br>
</li><li>Upload the changed file to the path specified in step 2, overwriting the file that is already there<br>
</li><li>Logoff from the production server</li></ol>

In the case of the Australian Cinema Map website the content is loaded into the dialog enclosed in a <code>div</code> tag with the <code>fw-welcome-message</code> class. This can be used to style the content if necessary.<br>
<br>
<h1>Help Text</h1>

The help text is intended to provide helpful information to users of the map.  In the <a href='http://auscinemas.flinders.edu.au/'>Australian Cinema Map</a> website, developed using the FilmWeeklyData, the information is displayed in a dialog that opens when the user clicks the help button<br>
<br>
To edit the content of the Welcome Message:<br>
<br>
<ol><li>Login to the production server via FTP<br>
</li><li>Navigate to the following directory <br> <code>~/auscinemas.flinders/marques/app/views/pages</code>
</li><li>Download the <code>help.html.php</code> file to your computer<br>
</li><li>Save your changes<br>
</li><li>Upload the changed file to the path specified in step 2, overwriting the file that is already there<br>
</li><li>Logoff from the production server</li></ol>

In the case of the Australian Cinema Map website the content is loaded into the dialog enclosed in a <code>div</code> tag with the <code>fw-help-text</code> class. This can be used to style the content if necessary.<br>
<br>
Note: Ensure that the headings defined in the file retain their id attribute as this is used to link the help buttons used with other dialogs to the appropriate help text.<br>
<br>
<h1>Film Weekly Text</h1>

The help text is intended to provide helpful information to users of the map.  In the <a href='http://auscinemas.flinders.edu.au/'>Australian Cinema Map</a> website, developed using the FilmWeeklyData, the information is displayed in a dialog that opens when the user clicks the help button<br>
<br>
To edit the content of the Welcome Message:<br>
<br>
<ol><li>Login to the production server via FTP<br>
</li><li>Navigate to the following directory <br> <code>~/auscinemas.flinders/marques/app/views/pages</code>
</li><li>Download the <code>filmweekly.html.php</code> file to your computer<br>
</li><li>Save your changes<br>
</li><li>Upload the changed file to the path specified in step 2, overwriting the file that is already there<br>
</li><li>Logoff from the production server</li></ol>

In the case of the Australian Cinema Map website the content is loaded into the dialog enclosed in a <code>div</code> tag with the <code>fw-film-weekly-text</code> class. This can be used to style the content if necessary.<br>
<br>
<h1>Legend Text</h1>

The legend text is intended to provide helpful information to users of the map about the iconography used in the display of cinema information.  In the <a href='http://auscinemas.flinders.edu.au/'>Australian Cinema Map</a> website, developed using the FilmWeeklyData, the information is displayed in a dialog that opens when the user clicks the legend button<br>
<br>
To edit the content of the Legend Text:<br>
<br>
<ol><li>Login to the production server via FTP<br>
</li><li>Navigate to the following directory <br> <code>~/auscinemas.flinders/marques/app/views/pages</code>
</li><li>Download the <code>legend.html.php</code> file to your computer<br>
</li><li>Save your changes<br>
</li><li>Upload the changed file to the path specified in step 2, overwriting the file that is already there<br>
</li><li>Logoff from the production server</li></ol>

Please note that for the automatic generation of the table that provides an overview of the marker icons to occur the HTML in the <code>&lt;!-- do not edit --&gt;</code> cannot be edited.<br>
<br>
In the case of the Australian Cinema Map website the content is loaded into the dialog enclosed in a <code>div</code> tag with the <code>fw-film-legend-text</code> class. This can be used to style the content if necessary.<br>
<br>
<h1>About Text</h1>

The about text is intended to provide an overview of the website. In the <a href='http://auscinemas.flinders.edu.au/'>Australian Cinema Map</a> website, developed using the FilmWeeklyData, the information is displayed in a dialog that opens when the user clicks the about button.<br>
<br>
To edit the content of the About Text:<br>
<br>
<ol><li>Login to the production server via FTP<br>
</li><li>Navigate to the following directory <br> <code>~/auscinemas.flinders/marques/app/views/pages</code>
</li><li>Download the <code>about.html.php</code> file to your computer<br>
</li><li>Save your changes<br>
</li><li>Upload the changed file to the path specified in step 2, overwriting the file that is already there<br>
</li><li>Logoff from the production server</li></ol>

n the case of the Australian Cinema Map website the content is loaded into the dialog enclosed in a <code>div</code> tag with the <code>fw-about-text</code> class. This can be used to style the content if necessary.<br>
<br>
<h1>Contribute Text</h1>

The contribute text is intended to provide an overview of how users can contribute information and resources to the website.  In the <a href='http://auscinemas.flinders.edu.au/'>Australian Cinema Map</a> website, developed using the FilmWeeklyData, the information is displayed in a dialog that opens when the user clicks the contribute button, or clicks the contribute link in the infowindow.<br>
<br>
To edit the content of the About Text:<br>
<br>
<ol><li>Login to the production server via FTP<br>
</li><li>Navigate to the following directory <br> <code>~/auscinemas.flinders/marques/app/views/pages</code>
</li><li>Download the <code>contribute.html.php</code> file to your computer<br>
</li><li>Save your changes<br>
</li><li>Upload the changed file to the path specified in step 2, overwriting the file that is already there<br>
</li><li>Logoff from the production server</li></ol>

n the case of the Australian Cinema Map website the content is loaded into the dialog enclosed in a <code>div</code> tag with the <code>fw-contribute-text</code> class. This can be used to style the content if necessary.<br>
<br>
<h1>Common Information</h1>

It is important to remember that:<br>
<br>
<ol><li>These pages should only contain a HTML snippet, not a full HTML document<br>
</li><li>Any HTML will be embedded in the page as is, including image tags etc.<br>
</li><li>Styling of the content should be undertaken via CSS rules in a separate file such<br>
</li><li>Changes to these files, once uploaded to the server, take effect immediately</li></ol>

<h2>Including Images</h2>

Images can be included in the text that displayed in these dialog boxes.<br>
<br>
To upload an image:<br>
<br>
<ol><li>Login to the production server via FTP<br>
</li><li>Navigate to the following directory <br> <code>~/auscinemas.flinders/assets/dialog-images</code>
</li><li>Upload the required image<br>
</li><li>Logoff from the production server</li></ol>

Please ensure that:<br>
<br>
<ol><li>image file names are all in lower case<br>
</li><li>image file names do not contain spaces, replace any spaces with a -</li></ol>

To reference the image using the <code>src</code> attribute of the <code>img</code> tag the URL will be as follows<br>
<br>
<code>/assets/dialog-images/{image-name}</code>

Replace <code>{image-name}</code> with the name of the uploaded image