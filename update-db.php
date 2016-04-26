<?php

    $db   = 'astaled_local';
    $user = 'root';
    $pass = 'root';

    // Setup the associative array for replacing the old string with new string
    $replace_array = array( 
        'http://www.astaled.sk' => 'localhost',
        'astaled.sk' => 'localhost',
//        'esystem.sk/clients/' => '',
        );

    $mysql_link = mysql_connect( 'localhost', $user, $pass  );
    if( ! $mysql_link) {
        die( 'Could not connect: ' . mysql_error() );
    }

    $mysql_db = mysql_select_db( $db, $mysql_link );
    if(! $mysql_db ) {
        die( 'Can\'t select database: ' . mysql_error() );
    }

    // Traverse all tables
    $tables_query = 'SHOW TABLES';
    $tables_result = mysql_query( $tables_query );
    while( $tables_rows = mysql_fetch_row( $tables_result ) ) {
        foreach( $tables_rows as $table ) {

            // Traverse all columns
            $columns_query = 'SHOW COLUMNS FROM ' . $table;
            $columns_result = mysql_query( $columns_query );
            while( $columns_row = mysql_fetch_assoc( $columns_result ) ) {

                $column = $columns_row['Field'];
                $type = $columns_row['Type'];

                // Process only text-based columns
                if( strpos( $type, 'char' ) !== false || strpos( $type, 'text' ) !== false ) {
                    // Process all replacements for the specific column                    
                    foreach( $replace_array as $old_string => $new_string ) {
                        $replace_query = 'UPDATE ' . $table . 
                            ' SET ' .  $column . ' = REPLACE(' . $column . 
                            ', \'' . $old_string . '\', \'' .$new_string . '\');';
                          echo $replace_query."<br/>";
                        mysql_query( $replace_query );
                    }
                }
            }
        }
    }

    mysql_free_result( $columns_result );
    mysql_free_result( $tables_result );
    mysql_close( $mysql_link );

    echo 'Done!';

?>