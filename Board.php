<!DOCTYPE html>
<?php
//include 'db.php';
include 'XLSXUpload.php';
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Import Excel To Mysql Database Using PHP </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Hemant Vishwakarma">
    <meta name="description" content="Import Excel File To MySql Database Using php">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript">

    </script>
</head>
<body>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>ID</th>
        <th>Function_ID</th>
        <th>Status</th>
        <th>Description</th>
        <th>Catalog_Group</th>
        <th>Part_Family</th>
        <th>Part_Type</th>
        <th>Number_Of_Contacts</th>
        <th>Gender</th>
        <th>Keying</th>
        <th>Interface</th>
        <th>Symbol</th>
        <th>System_Component</th>
        <th>12NC</th>
        <th>Mate</th>


    </tr>
    </thead>
    <?php
    $conn = mysqli_connect('localhost','root','','asmlcompare');
    $SQLSELECT = "SELECT qcg.*, mid.QCG, nc.`12NC` FROM qcg 
                  INNER JOIN `12ncqcg` AS mid ON qcg.Function_ID = mid.QCG 
                  INNER JOIN `12nc` AS nc ON mid.`12NC` = nc.`12NC`
                  WHERE qcg.Interface 
                  Like \"m%\" ORDER BY qcg.ID";


    //$result_set =  mysqli_query($SQLSELECT, $conn);
    $result = $conn->query($SQLSELECT);

    $row_cnt = $result->num_rows;

    printf("Result set has %d rows.\n", $row_cnt);

    //while($row = mysqli_fetch_array($result_set))
    while($row = $result->fetch_assoc())
    {
        ?>
        <tr>
            <td><?php echo $row['ID']; ?></td>
            <td><?php echo $row['Function_ID']; ?></td>
            <td><?php echo $row['Status']; ?></td>
            <td><?php echo $row['Description']; ?></td>
            <td><?php echo $row['Catalog_Group']; ?></td>
            <td><?php echo $row['Part_Family']; ?></td>
            <td><?php echo $row['Part_Type']; ?></td>
            <td><?php echo $row['Number_of_Contacts']; ?></td>
            <td><?php echo $row['Gender']; ?></td>
            <td><?php echo $row['Keying']; ?></td>
            <td><?php echo $row['Interface']; ?></td>
            <td><?php echo $row['Symbol']; ?></td>
            <td><?php echo $row['System_Component']; ?></td>
            <td><?php echo $row['12NC']; ?></td>
            <td><?php echo $row['Mate']; ?></td>

        </tr>

        <?php
    }
    ?>
</table>

</body>
</html>