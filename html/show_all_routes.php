<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="basic.css">
</head>
<body>
    <h1>Showing All Routes in the Database</h1>
    <h3>By converting a MySQLi result object to an HTML table.</h3>
<?php 
    
    $host = "localhost";
    $user = "william.bailey";
    $pass = "charmander";
    $dbse = "red_river_climbs";
    
    $conn = new mysqli($host, $user, $pass, $dbse);
    echo $_GET['crag_name'];
    if ($_GET['crag_name']) {
        $query = "SELECT * FROM climbs WHERE crag_name = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $_GET['crag_name']);
    } else {
        $query = "SELECT * FROM climbs";
        $stmt = $conn->prepare($query);
        $stmt->bind_param();
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $conn->close();

    result_to_table($result);
    
?>
</body>
</html>
<?php

function result_to_table($res) {
    $nrows = $res->num_rows;
    $ncols = $res->field_count;
    $resar = $res->fetch_all();

    ?> 
    <p>
    <?php echo $ncols; ?> columns, <?php echo $nrows; ?> rows.
    </p>
        <table>
        <thead>
        <tr>
    <?php
    while ($fld = $res->fetch_field()) {
    ?>
        <th><?php echo $fld->name; ?></th>
    <?php
    }
    ?>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0;$i<$nrows; $i++) {
    ?>
    <tr>
    <?php
        for ( $j = 0; $j < $ncols; $j++ ) {
    ?>
            <td><?php echo $resar[$i][$j]; ?></td>
    <?php
        }
    ?>        
        </tr>
    <?php
    }
?>
    </tbody>
    </table>
<?php
}
?>
