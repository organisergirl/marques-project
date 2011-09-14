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

import java.io.BufferedReader;
import java.io.IOException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.HashMap;

import org.apache.log4j.Logger;

import au.com.bytecode.opencsv.CSVReader;

import com.techxplorer.java.utils.FileUtils;
import com.techxplorer.java.utils.InputUtils;

/**
 * Main driving class for the import data task
 */
public class DataImporter {
	
	// declare private class level variables
	private static Logger logger    = Logger.getLogger(DataImporter.class.getName());
	
	private Connection    database  = null;
	private String        inputPath = null;
	
	private BufferedReader inputFile = null;
	
	/**
	 * construct a new Data Importer object
	 * 
	 * @param database a valid database connection to use as the destination
	 * @param inputPath the path to the input file
	 * 
	 * @throws IllegalArgumentException if the parameters do not pass validation
	 */
	public DataImporter(Connection database, String inputPath) {
		
		// validate the parameters
		if(InputUtils.isEmpty(inputPath) == true) {
			throw new IllegalArgumentException("the inputPath parameter is required");
		}
		
		if(FileUtils.isAccessible(inputPath) == false) {
			throw new IllegalArgumentException("the input path is not accessible");
		}
		
		if(database == null) {
			throw new IllegalArgumentException("the database connection parameter cannot be null");
		}
		
		try {
			if(database.isValid(0) == false) {
				throw new IllegalArgumentException("the database connection parameter is not valid");
			}
		} catch (SQLException e) {
			throw new IllegalArgumentException("the database connection parameter is not valid");
		}
		
		this.database = database;
		this.inputPath = inputPath;
		
		logger.debug("DataImporter class successfully instantiated");
	}
	
	/**
	 * opens the input file for reading and the output file for writing
	 * 
	 * @throws IOException if either operation fails
	 */
	public void openFiles() throws IOException {
		
		logger.debug("opening input file for reading");
		
		try{
			inputFile = FileUtils.openFileForReading(inputPath);
		} catch (IOException e) {
			logger.error("Unable to open the input file", e);
			throw new IOException("Unable to open the input file", e);
		}
	}
	
	/**
	 * import the data into the database
	 * 
	 * @throws ImportException if the import fails
	 */
	public void doTask() throws ImportException {
		
		logger.debug("undertaking the task");
		
		// create the CSVReader objects
		CSVReader reader = new CSVReader(inputFile, ',', '"', 1);
		
		//declare other helper variables
		String[] dataElems;
		String coordinate;
		
		HashMap<String, Integer> recordMap = new HashMap<String, Integer>();
		
		// build helper lists
		HashMap<String, String> australianStates = getAustralianStateMap();
		HashMap<String, String> localityTypes    = getLocalityTypesMap();
		HashMap<String, String> cinemaTypes      = getCinemaTypesMap();
		
		String state      = null;
		String locality   = null;
		String cinemaType = null;
		String capacity   = null;
		int    id;
		
		PreparedStatement cinemaStmt   = null;
		PreparedStatement categoryStmt = null;
		ResultSet         resultSet    = null;
		
		int lineCount = 1;
		
		final int CATEGORY_START  = 11;
		final int CATEGORY_END    = 32;
		final int CATEGORY_OFFSET = 10;
		
		try {
			cinemaStmt = database.prepareStatement("INSERT INTO film_weekly_cinemas " +
					"(latitude, longitude, australian_states_id, locality_types_id, film_weekly_cinema_types_id, street, suburb, postcode, cinema_name, exhibitor_name, capacity) " +
					"VALUES (?,?,?,?,?,?,?,?,?,?,?)", PreparedStatement.RETURN_GENERATED_KEYS);
		} catch (SQLException e) {
			logger.error("Unable to prepare the cinema sql insert statement", e);
			throw new ImportException("Unable to prepare the cinema sql insert statement", e);
		}
		
		try {
			categoryStmt = database.prepareStatement("INSERT INTO film_weekly_category_maps " +
					"(film_weekly_cinemas_id, film_weekly_categories_id) " + 
					"VALUES (?,?)");
		} catch (SQLException e) {
			logger.error("Unable to prepare the category map sql insert statement", e);
			throw new ImportException("Unable to prepare the category map sql insert statement", e);
		}
		
		// loop through the file processing each line
		try {
			
			while((dataElems = reader.readNext()) != null) {
				
				lineCount++;
				
				coordinate = dataElems[3] + "," + dataElems[4];
				
				if(recordMap.containsKey(coordinate) == false) {
					// new record
					
					state = australianStates.get(dataElems[0].trim());
					
					if(state == null) {
						logger.error("Unknown state detected: " + dataElems[0].trim() + "on line: " + lineCount);
						throw new ImportException("Unknown state detected: " + dataElems[0].trim() + "on line: " + lineCount);
					}
					
					locality = localityTypes.get(dataElems[1].trim());
					
					if(locality == null) {
						logger.error("Unknown locality detected: " + dataElems[1].trim() + "on line: " + lineCount);
						throw new ImportException("Unknown locality detected: " + dataElems[1].trim() + "on line: " + lineCount);
					}
					
					cinemaType = cinemaTypes.get(dataElems[2].trim());
					
					if(cinemaType == null) {
						logger.error("Unknown cinemaType detected: " + dataElems[2].trim() + "on line: " + lineCount);
						throw new ImportException("Unknown cinemaType detected: " + dataElems[2].trim() + "on line: " + lineCount);
					}
					
					// add the values to the statement
					try {
						cinemaStmt.setString(1, dataElems[3]); // latitude
						cinemaStmt.setString(2, dataElems[4]); // longitude
						cinemaStmt.setString(3, state); // australian_states_id
						cinemaStmt.setString(4, locality); // locality_types_id
						cinemaStmt.setString(5, cinemaType); // film_weekly_cinema_types_id
						cinemaStmt.setString(6, dataElems[5]); // street
						cinemaStmt.setString(7, dataElems[7]); // suburb
						cinemaStmt.setString(8, dataElems[6]); // postcode
						cinemaStmt.setString(9, tidyString(dataElems[8])); // cinema_name
						cinemaStmt.setString(10, tidyString(dataElems[9])); // exhibitor_name
						
						try {
							Integer.parseInt(dataElems[10]);
							capacity = dataElems[10];
						} catch (NumberFormatException e) {
							capacity = null;
						}
						
						logger.info("adding record for: " + coordinate);

						cinemaStmt.setString(11, capacity); // capacity
						
					} catch (SQLException e) {
						logger.error("error preparing sql statement", e);
						throw new ImportException("error preparing sql statement", e);
					}
					
					// execute the statement
					try {
						cinemaStmt.executeUpdate();
						
						resultSet = cinemaStmt.getGeneratedKeys();
						
						if(resultSet.next()){
							id = resultSet.getInt(1);
							recordMap.put(coordinate,id);
							logger.debug(id);
						} else {
							logger.error("error retrieving record id");
							throw new ImportException("error retrieving record id");
						}
						
					} catch (SQLException e) {
						logger.error("error executing sql statement", e);
						throw new ImportException("error executing sql statement", e);
					}
					
					// add the categories
					try {
						for(int i = CATEGORY_START; i < CATEGORY_END ; i++) {
							if(dataElems[i].equals("") == false) {
								categoryStmt.setString(1, Integer.toString(id));
								categoryStmt.setString(2, Integer.toString(i - CATEGORY_OFFSET));
								
								logger.debug("" + Integer.toString(id) + " " + Integer.toString(i - 10));
								
								try {
									categoryStmt.executeUpdate();
								} catch (SQLException e) {
									logger.error("error executing category insert statement", e);
									throw new ImportException("error executing category insert statement", e);
								}
							}
						}
					} catch (SQLException e) {
						logger.error("error preparing category insert statement", e);
						throw new ImportException("error preparing category insert statement", e);
					}
				}
				
			}
		} catch (IOException e) {
			logger.error("Unable to read from the input file", e);
			throw new ImportException("Unable to read from the input file", e);
		}
		
	}
	
	// a private method to build the Australian States map
	private HashMap<String, String> getAustralianStateMap() {
	
		HashMap<String, String> states = new HashMap<String, String>();
		
		states.put("WA", "1");
		states.put("NT", "2");
		states.put("SA", "3");
		states.put("QLD", "4");
		states.put("NSW", "5");
		states.put("ACT", "6");
		states.put("VIC", "7");
		states.put("TAS", "8");
		
		return states;
	}
	
	// private method to build the Localities map
	private HashMap<String, String> getLocalityTypesMap() {
		
		HashMap<String, String> localities = new HashMap<String, String>();
		
		localities.put("Central Business District","1");
		localities.put("Suburban","2");
		localities.put("Country/Rural","3");
		
		return localities;
	}
	
	// private method to build the cinema types map
	private HashMap<String, String> getCinemaTypesMap() {
		
		HashMap<String, String> cinemas = new HashMap<String, String>();
		
		cinemas.put("Cinema", "1");
		cinemas.put("Drive-in", "2");
		cinemas.put("Touring Circuit", "3");
		cinemas.put("Open Air", "4");
		
		return cinemas;
	}
	
	//private method to brute force tidy a string
	private String tidyString(String value) {
		
		String newValue = value.replaceAll("[^\\p{ASCII}]", "");
		
		newValue = newValue.trim();
		
		if(newValue.length() == 0) {
			return null;
		} else {
			return newValue;
		}
	}

}
