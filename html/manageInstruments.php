<!-- 
    Lab 7 
    Eli Gooch
    CSC 362
    10/25/2021
--> 
<?php session_start(); ?>
<html>
    <head>
        <title>manageInstruments.php</title>

        <style>
            table, th, td {
                border: 1px solid black;
            }
        </style>
    </head>


    <body>
        <h1>Delete Records</h1>
        <p>Lab 7 <br> Eli Gooch <br> CSC 362 </p>

    <form action="manageInstruments.php" method=POST >
    <input type="text" name="enter name" value="username" method=POST/>
    <input type="submit" name="deleteButton" value="Remember Me" method=POST/>  
    </form>

    
    <?php
        /* ----- CONNECTION SETUP ----- */
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $dbhost = 'localhost';
        $dbuser = 'jeligooch';
        $dbpass = 'charmander';
        $database = 'instrument_rentals'; 

        $conn = new mysqli($dbhost, $dbuser, $dbpass, $database);

        $needs_reload = false;

        if ($conn->connect_errno) {
            echo "Error: Failed to make a MySQL connection, 
                here is why: ". "<br>"; 
            echo "Errno: " . $conn->connect_errno . "\n"; 
            echo "Error: " . $conn->connect_error . "\n"; 
            exit; // Quit this PHP script if the connection fails. 
        } else { 
            echo "Connected Successfully!" . "<br>"; 
            echo "Congratulations!" . "<br>"; 
        }

        /* ----- INSERTION HANDLING ----- */
        // Add some data into the database, if requested.
        if(array_key_exists('add_records', $_POST)){
            $ins_qry = file_get_contents('add_instruments.sql');
            $reload = true;
            $conn->query($ins_qry);
        }
        
        /* ----- SELECTION ----- */

        /* ----- DELETION HANDLING ----- */
        $del_str = file_get_contents('delete_instruments.sql');
        $del_stmt = $conn->prepare($del_str);
        
        echo($del_stmt);
        if($del_stmt) {
            $del_stmt->bind_param('i', $id);
        }

        if (array_key_exists("delbtn", $_POST)){
            
        }
        /* ----- END DELETION HANDLING ----- */

        /* ----- REDIRECT CLIENT ----- */
        if($needs_reload){
            header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
                exit();
        }

    ?>



    <form action="manageInstruments.php" method=POST>

    <?php 
        $del_stmt = $conn->prepare("DELETE FROM instruments WHERE instrument_id=?;");
        $del_stmt->bind_param('i', $id);
        $del_stmt_all = $conn->prepare("DELETE FROM instruments");

        $select = "SELECT instrument_id, instrument_type FROM instruments;";
        $results = $conn->query($select);

        $resar = $results->fetch_all();


        for($i=0; $i<$results->num_rows; $i++){

            //echo $resar[$i][0];
            //echo $resar[$i][1];

            $id = $resar[$i][0];
            if (isset($_POST["checkbox$id"])){
                echo $conn->error;
                $del_stmt->execute();
            }
        }
        //Step 1
        $needs_reload = false;

        if(array_key_exists("insertButton", $_POST))
        {
            $ins_qry = file_get_contents('add_instruments.sql');
            $needs_reload = true;

            if(!$conn->query($ins_qry)){
                echo $conn->error;
                echo "Failed to insert records!\n";
            } else {
                header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
                exit();
            }
        }

        
 
    function result_to_table($res, $del_stmt_fun, $del_stmt_all, $conn) {
        $nrows = $res->num_rows;
        $ncols = $res->field_count;
        $resar = $res->fetch_all();
        if($resar){
            echo "GREAT SUCCESS";
        } else {
            echo "UNDEFINED OFFSET GOOCH";
        }
        ?> 
        <p>
        <?php echo $ncols; ?> columns, <?php echo $nrows; ?> rows.
        </p>
        <table>
            <thead>
                <tr>
                    <th>Delete?</th>

                    <?php
                        while ($fld = $res->fetch_field()) {
                    ?>
                    <th>
                        <?php echo $fld->name; ?>
                    </th>
                    <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>

            <?php

                

                $test = $res->fetch_array(); //This is showing us that fetch_array is not working on $res
                if($test) {
                    echo "WOAH\n";
                } else {
                    echo "NO\n";
                }

                while ($row = $res->fetch_array()){ 
                                            //Never gets in here
                    echo "check it\n";
                    echo $row;
                }

                for($i=0; $i<$res->num_rows; $i++){

                    $id = $resar[$i][0];
                    if (isset($_POST["checkbox$id"])){
                        echo $conn->error;
                        $del_stmt->execute();
                    }
                    if (isset($_POST["deleteAllButton"])){
                        echo $conn->error;
                        $del_stmt_all->execute();
                        header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
                        exit();
                    }
            ?>
            <tr>
                <td>
                    <input type="checkbox"
                    name="checkbox<?php echo $id; ?>"
                    value=<?php echo $id ?>
                    />
                </td>   
                    <?php
                        for ( $j = 0; $j < $ncols; $j++ ) {
                    ?>
                    <td>
                        <?php echo $resar[$i][$j]; ?>
                    </td>
                    <?php
                        }
                    ?>        
            </tr>
    <?php
                } // close first for loop
    ?>
        </tbody>
        <p>Delete All Records
            <input  type="checkbox"
                    name="deleteAllButton"
                    value=<?php //echo $id; ?>
            />
        </p>
        </table>
    <?php
    } // close function
    ?>



    <?php 
        $results = $conn->query($select); //adding this line fixed all our "undefined offset" errors
        result_to_table($results, $del_stmt, $del_stmt_all, $conn);
    ?>
    
    <input type="submit" name="deleteButton" value="Delete Selected Records" method=POST/>
    <br>
    <input type="submit" name="insertButton" value="Insert Rows" method=POST/>
    </form>



    </body>

</html>