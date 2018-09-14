<?
function chck_filters() {
			 		// CHECK IF TABLE EXISTS 
					// SOURCE :: http://www.daniweb.com/web-development/php/threads/99756/check-if-mysql-table-exists
					$sql="SELECT * FROM filters";
					$result=mysql_query($sql);
					if (!$result)
					{
					//echo "No table exists";
				 //Creating tables to selected database
				// Notice : you must select the database and the conection befor creating tables
				// all done by mysql-query
				// NOTICE : " int NOT NULL AUTO_INCREMENT "  is setting the 1st column as an id 
				// NOTICE : " PRIMARY KEY(personID), "  setting the 1st column as a primary key 
			
			// Create table
			/*mysql_select_db("wp");*/
			$sql = "CREATE TABLE filters
			(
			ID int NOT NULL AUTO_INCREMENT, 
			PRIMARY KEY(ID),
			name text COLLATE 'utf8_general_ci',
			content text COLLATE 'utf8_general_ci'
			)"; // IMP :: last record set must be without " , " at the end of creating table :)
			// Execute query
			$table_creation = mysql_query($sql);
			
			if ( isset($table_creation) && isset($result)) { 
			
			mysql_query("INSERT INTO filters (name,content) VALUES ('1st run','1st run') ");
			mysql_query("INSERT INTO filters (name,content) VALUES ('1st run','1st run') ");
			
			echo "Creating tables done successfully " ;
			
			} else { 
			
			echo " Creating tables failed " ;
	
							}
			
					}
	
			}
?>