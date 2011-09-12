/**
 * Film Weekly Data Importer for the MARQues System
 * 
 * This application imports the Film Weekly data stored in the various
 * Microsoft Excel workbooks directly into the MARQues database
 * 
 * The workbooks must be saved in the CSV format for processing
 *
 * @copyright     Copyright 2011, Flinders University (http://www.flinders.edu.au)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

package au.edu.flinders.ehl.filmweekly;

import org.apache.commons.cli.CommandLine;
import org.apache.commons.cli.CommandLineParser;
import org.apache.commons.cli.HelpFormatter;
import org.apache.commons.cli.OptionBuilder;
import org.apache.commons.cli.Options;
import org.apache.commons.cli.PosixParser;
import org.apache.commons.configuration.Configuration;
import org.apache.commons.configuration.PropertiesConfiguration;

import com.techxplorer.java.utils.FileUtils;

/**
 * Main driving class for the application
 */
public class FwImporter {
	
	// public class level constants
	/**
	 * name of the application
	 */
	public static final String APP_NAME      = "Film Weekly Data Importer";
	
	/**
	 * copyright statement
	 */
	public static final String APP_COPYRIGHT = "Copyright 2011, Flinders University";
	
	/**
	 * license URL
	 */
	public static final String APP_LICENSE   = "License: http://opensource.org/licenses/bsd-license.php";
	
	/**
	 * version information
	 */
	public static final String APP_VERSION   = "Version: 1.0.0";
	
	/**
	 * URL for more information
	 */
	public static final String APP_MORE_INFO = "More info: http://code.google.com/p/marques-project/wiki/FilmWeeklyImporter";
	
	// private class variables
	private static final String[] APP_HEADER = {APP_NAME + " - " + APP_VERSION, APP_COPYRIGHT, APP_LICENSE, APP_MORE_INFO};

	/**
	 * Main method for the class
	 * 
	 * @param args array of command line arguments
	 */
	public static void main(String[] args) {
		
		// before we do anything, output some useful information
		for(int i = 0; i < APP_HEADER.length; i++) {
			System.out.println(APP_HEADER[i]);
		}
		
		// parse the command line options
		CommandLineParser parser = new PosixParser();
		CommandLine cmd = null;
		
		try {
			cmd = parser.parse(createOptions(), args);
		}catch(org.apache.commons.cli.ParseException e) {
			// something bad happened so output help message
			printCliHelp("Error in parsing options:\n" + e.getMessage());
		}
		
		// get an check on the properties path option
		String propertiesPath = cmd.getOptionValue("properties");
		if(FileUtils.isAccessible(propertiesPath) == false) {
			printCliHelp("Unable to access the specified properties file");
		}
		
		// get and check on the input file path option
		String inputPath = cmd.getOptionValue("input");
		if(FileUtils.isAccessible(propertiesPath) == false) {
			printCliHelp("Unable to access the specified input file");
		}
		
		// open the properties file
		Configuration config = new PropertiesConfiguration(propertiesPath);
				 

	}
	
	/*
	 * private method to output the command line options help
	 */
	private static void printCliHelp(String message) {
		System.out.println(message);
		HelpFormatter formatter = new HelpFormatter();
		formatter.printHelp("java -jar FwImporter.jar", createOptions());
		System.exit(-1);
	}

	/*
	 * private method to create the command line options used by the app
	 */
	private static Options createOptions() {

		Options options = new Options();

		OptionBuilder.withArgName("path");
		OptionBuilder.hasArg(true);
		OptionBuilder.withDescription("path to the properties file");
		OptionBuilder.isRequired(true);
		options.addOption(OptionBuilder.create("properties"));
		
		OptionBuilder.withArgName("path");
		OptionBuilder.hasArg(true);
		OptionBuilder.withDescription("path to the input file");
		OptionBuilder.isRequired(true);
		options.addOption(OptionBuilder.create("input"));

		return options;
	}

}
