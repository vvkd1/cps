<?php
	// ==================================================================
	// Constants
	define("OBJECT","OBJECT",true);
	define("ARRAY_A","ARRAY_A",true);
	define("ARRAY_N","ARRAY_N",true);
	// ==================================================================
	//	The Main Class
	class db {
		var $get_colCount = 0;
		// ==================================================================
		//	DB Constructor - connects to the server and selects a database
		function db($dbuser, $dbpassword, $dbname, $dbhost) {
			$this->dbh = @mysql_connect($dbhost,$dbuser,$dbpassword);
			if ( ! $this->dbh ) {
				$this->print_error("<ol><b>Error establishing a database connection!</b><li>Are you sure you have the correct user/password?<li>Are you sure that you have typed the correct hostname?<li>Are you sure that the database server is running?</ol>");
			}
			$this->select($dbname);
		}
		// ==================================================================
		//	Select a DB (if another one needs to be selected)
		function select($db) {
			if ( !@mysql_select_db($db,$this->dbh)) {
				$this->print_error("<ol><b>Error selecting database <u>$db</u>!</b><li>Are you sure it exists?<li>Are you sure there is a valid database connection?</ol>");
			}
		}
		// ==================================================================
		//	Select a DB (if another one needs to be selected)
		function closeDb () {
			if (!@mysql_close($this->dbh)) {
				$this->print_error("<ol><b>Error Closing database <u>$db</u>!</b></ol>");
			}
		}
		// ==================================================================
		//	Print SQL/DB error.
		function print_error($str = "") {
			if ( !$str ) $str = mysql_error();
			// If there is an error then take note of it
			print "<blockquote>";
			print "<b>SQL/DB Error --</b> ";
			print "[<font color=\"000077\">$str</font>]";
			print "</blockquote>";
		}
		// ==================================================================
		//	Basic Query
		function query($query, $output = OBJECT, $insID = false)  {
			// Log how the function was called
			$this->func_call = "\$db->query(\"$query\", $output)";
			// Kill this
			$this->last_result = null;
			$this->col_info = null;
			// Keep track of the last query for debug..
			$this->last_query = $query;
			// Perform the query via std mysql_query function..
			$this->result = mysql_query($query,$this->dbh);
			if ( mysql_error() ) {
				// If there is an error then take note of it..
				$this->print_error();
			}
			else {
				// In other words if this was a select statement..
				if ( $this->result ) {
					// =======================================================
					// Take note of column info
					$i=0;
					$this->get_colCount = @mysql_num_fields($this->result);
					while ($i < $this->get_colCount) {
						$this->col_info[$i] = @mysql_fetch_field($this->result);
						$i++;
					}
					// =======================================================				
					// Store Query Results
					$i=0;
					while ( $row = @mysql_fetch_object($this->result) ) {
						// Store relults as an objects within main array
						$this->last_result[$i] = $row;
						$i++;
					}
					@mysql_free_result($this->result);
					// If there were results then return true for $db->query
					if ($insID) {
						return mysql_insert_id($this->dbh);
					}
					else if ( $i ) {
						return true;
					}
					else {
						return false;
					}
				}
			}
		}
		// ==================================================================
		//	Get one variable from the DB - see docs for more detail
		function get_var($query=null,$x=0,$y=0) {
			// Log how the function was called
			$this->func_call = "\$db->get_var(\"$query\",$x,$y)";
			// If there is a query then perform it if not then use cached results..
			if ( $query ) {
				$this->query($query);
			}
			// Extract var out of cached results based x,y vals
			if ( $this->last_result[$y] ) {
				$values = array_values(get_object_vars($this->last_result[$y]));
			}
			// If there is a value return it else return null
			return $values[$x]?$values[$x]:null;
		}
		// ==================================================================
		//	Get enum values
		function get_enumvalues ($table, $column) {
			// Log how the function was called
			$this->func_call = "\$db->get_enumvalues(\"$table\",\"$column\")";
			$query = "SHOW COLUMNS FROM `".$table."` LIKE '".$column."'";
			$this->query($query);
			
			$enum = $this->last_result[0]->Type;
			$off  = strpos($enum,"(");
			$enum = substr($enum, $off+1, strlen($enum)-$off-2);
			$values = explode(",",$enum);
			
			// For each value in the array, remove the leading and trailing
			// single quotes, convert two single quotes to one. Put the result
			// back in the array in the same form as CodeCharge needs.
			for( $n = 0; $n < count($values); $n++) {
				$val = substr( $values[$n], 1,strlen($values[$n])-2);
				$val = str_replace("''","'",$val);
				$values[$n] = stripslashes($val);//array( $val, $val );
			}
			return $values;
			//$values;
			//preg_match_all("/'([\w]*)'/", $this->last_result[0]->Type, $values);
			//return $values[1];
		}
		// ==================================================================
		//	Get one row from the DB - see docs for more detail
		function get_row($query=null,$y=0,$output=OBJECT)
		{
			// Log how the function was called
			$this->func_call = "\$db->get_row(\"$query\",$y,$output)";
			// If there is a query then perform it if not then use cached results..
			if ( $query ) {
				$this->query($query);
			}
			// If the output is an object then return object using the row offset..
			if ( $output == OBJECT ) {
				return $this->last_result[$y]?$this->last_result[$y]:null;
			}
			// If the output is an associative array then return row as such..
			elseif ( $output == ARRAY_A ) {
				return $this->last_result[$y]?stripslashes(get_object_vars($this->last_result[$y])):null;	
			}
			// If the output is an numerical array then return row as such..
			elseif ( $output == ARRAY_N ) {
				return $this->last_result[$y]?stripslashes(array_values(get_object_vars($this->last_result[$y]))):null;
			}
			// If invalid output type was specified..
			else {
				$this->print_error(" \$db->get_row(string query,int offset,output type) -- Output type must be one of: OBJECT, ARRAY_A, ARRAY_N ");	
			}
		}
		// ==================================================================
		//	Function to get 1 column from the cached result set based in X index
		// se docs for usage and info
		function get_col($query=null,$x=0) {
			// If there is a query then perform it if not then use cached results..
			if ( $query ) {
				$this->query($query);
			}
			// Extract the column values
			for ( $i=0; $i < count($this->last_result); $i++ ) {
				$new_array[$i] = stripslashes($this->get_var(null,$x,$i));
			}
			return $new_array;
		}
		// ==================================================================
		// Return the the query as a result set - see docs for more details
		function get_results($query=null, $output = OBJECT) {
			// Log how the function was called
			$this->func_call = "\$db->get_results(\"$query\", $output)";
			// If there is a query then perform it if not then use cached results..
			if ( $query ) {
				$this->query($query);
			}
			// Send back array of objects. Each row is an object		
			if ( $output == OBJECT ) {
				return $this->last_result; 
			}
			elseif ( $output == ARRAY_A || $output == ARRAY_N ) {
				if ( $this->last_result ) {
					$i=0;
					foreach( $this->last_result as $row ) {
						$new_array[$i] = stripslashes(get_object_vars($row));
						if ( $output == ARRAY_N ) {
							$new_array[$i] = stripslashes(array_values($new_array[$i]));
						}
						$i++;
					}
					return $new_array;
				}
				else
				{
					return null;	
				}
			}
		}
		// ==================================================================
		// Function to get column meta data info pertaining to the last query
		// see docs for more info and usage
		function get_col_info($info_type="name",$col_offset=-1) {
			if ( $this->col_info ) {
				if ( $col_offset == -1 ) {
					$i=0;
					foreach($this->col_info as $col ) {
						$new_array[$i] = $col->{$info_type};
						$i++;
					}
					return $new_array;
				}
				else {
					return $this->col_info[$col_offset]->{$info_type};
				}
			}
		}
		// ==================================================================
		// Dumps the contents of any input variable to screen in a nicely
		// formatted and easy to understand way - any type: Object, Var or Array
		function vardump($mixed) {
			echo "<blockquote>";
			echo "<pre>";
			if ( ! $this->vardump_called ) {
				echo "<font color=\"800080\"><b>Variable Dump..</b></font>\n\n";
			}
			print_r($mixed);	
			echo "\n\n<b>Last Query:</b> ".($this->last_query?$this->last_query:"NULL")."\n";
			echo "<b>Last Function Call:</b> " . ($this->func_call?$this->func_call:"None")."\n";
			echo "<b>Last Rows Returned:</b> ".count($this->last_result)."\n";
			echo "</pre></blockquote>";
			echo "\n<hr />";
			$this->vardump_called = true;
		}
		// Alias for the above function	
		function dumpvars($mixed) {
			$this->vardump($mixed);	
		}
		// ==================================================================
		// Displays the last query string that was sent to the database & a 
		// table listing results (if there were any). 
		// (abstracted into a seperate file to save server overhead).
		/*function debug() {
			echo "<blockquote>";
			echo "<b>Query --</b><br />\n";
			echo "[<b>$this->last_query</b><br />\n";
			echo "<b>Query Result..</b><br />\n";
			echo "<blockquote>";
			if ( $this->col_info ) {
				// =====================================================
				// Results top rows
				echo "<table cellpadding=\"5\" cellspacing=\"1\" bgcolor=\"555555\">";
				echo "<tr bgcolor=\"eeeeee\"><td valign=\"bottom\"><b>(row)</b></td>";
				for ( $i=0; $i < count($this->col_info); $i++ ) {
					echo "<td align=\"left\" valign=\"top\">{$this->col_info[$i]->type} {$this->col_info[$i]->max_length <b>{$this->col_info[$i]->name}</b></td>";
				}
				echo "</tr>";
				// ======================================================
				// print main results
				if ( $this->last_result ) {
					$i=0;
					foreach ( $this->get_results(null,ARRAY_N) as $one_row ) {
						$i++;
						echo "<tr bgcolor=\"ffffff\"><td bgcolor=\"eeeeee\" align=\"middle\"> $i </td>";
						foreach ( $one_row as $item ) {
							echo "<td> $item </td>";	
						}
						echo "</tr>";
					}
				} // if last result
				else {
					echo "<tr bgcolor=\"ffffff\"><td colspan=\"".(count($this->col_info)+1)."\">No Results</td></tr>";			
				}
				echo "</table>";
			} // if col_info
			else {
				echo "No Results";
			}
			echo "</blockquote></blockquote><hr />";
			$this->debug_called = true;
		}*/
	}
?>