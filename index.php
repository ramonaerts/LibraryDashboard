<!DOCTYPE html>
<?php
//include 'db.php';
include 'XLSXUpload.php';
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Library dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Hemant Vishwakarma">
    <meta name="description" content="Import Excel File To MySql Database Using php">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="theme.css">
    <style>

    </style>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>
<div>

<div class="container" style="margin:0 auto;">
    <div class="row" >
        <div class="col-md-12 text-center"><h1>Library dashboard</h1></div>
        <br>
        <div class="col-md-3 hidden-phone"></div>
        <div class="col-md-6" id="form-login">
            <form class="well" method="post" name="upload_excel" enctype="multipart/form-data">
                <fieldset>
                    <legend>Import Excel file</legend>
                    <div class="control-group">

                        <div class="control-label">
                            <label>tbi_xDM to EEE upload:</label>
                        </div>

                        <div class="controls form-group">
                            <input type="file" name="file" id="file" class="btn-file btn-md">
                        </div>
                        <div class="control-label">
                            <label>xDM_export upload:</label>
                        </div>
                        <div class="controls form-group">
                            <input type="file" name="file2" id="file2" class="btn-file btn-md">
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="d-flex justify-content-between">

                            <button type="submit" id="submit" name="deleteall" class="btn btn-primary btn-lg ">Delete</button>
                            <button type="submit" id="submit" name="importSubmit" class="btn btn-primary btn-lg ">Upload</button>
                            <button type="submit" id="submit" name="deletetest" class="btn btn-primary btn-lg ">Delete dups</button>

                        </div>
                    </div>
                </fieldset>
            </form>


        </div>

        <div class="col-md-3" id="form-login" >
            <form class="well" method="post" name="select_query" enctype="multipart/form-data">
                <fieldset>
                    <legend>Select:</legend>
                    <div class="control-group">
                        <input type="radio" name="choices" id="rad1" value="1" />
                        <label for="rad1">Boards</label></br>
                        <input type="radio" name="choices" id="rad2" value="2" />
                        <label for="rad2">Cables</label></br></br>
                        <button type="submit" id="submit" name="SelectQuery" class="btn btn-primary btn-flat btn-lg pull-left button-loading" data-loading-text="Loading...">Select</button>

                    </div>
                </fieldset>
            </form>

        </div>
    </div>
</div>
<div id="wrapper">
    <div id="piechart" ></div>
    <div id="piechart2"></div>
</div>
<div id="ColChart1"></div>

        <div class="col-md-3 hidden-phone"></div>
    </div>
<?php


?>
    <table width="100%" class="table table-bordered" >
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

        if(isset($_POST['importSubmit'])) {
            UploadFunction();
            UploadFunction2();
            UploadFunction3();
        }

        if(isset($_POST['deletetest'])) {
            DeleteFunction();
        }

        if (isset($_POST['deleteall']))
        {
            TrucFunc();
        }


        if(isset($_POST['SelectQuery'])) {
            SelectConnector();
        }
        ?>
    </table>
</div>

<?php
SelectBoards();
SelectCables();
SelectDups();


/*$conn = mysqli_connect('localhost', 'root', '', 'asmlcompare');

//------------------------------------------------------------------------------------------------------------

$SQLSELECTBoards = "SELECT qcg.*, mid.QCG, nc.`12NC` FROM qcg 
                              INNER JOIN `12ncqcg` AS mid ON qcg.Function_ID = mid.QCG 
                              INNER JOIN `12nc` AS nc ON mid.`12NC` = nc.`12NC`
                              WHERE qcg.Catalog_Group 
                              Like \"B%\" ORDER BY qcg.ID";
$resulter = $conn->query($SQLSELECTBoards);
$row_cnt = $resulter->num_rows;
//echo $row_cnt;

$SQLResultBoards = "SELECT * FROM qcg WHERE qcg.Catalog_Group Like \"B%\"";
$result = $conn->query($SQLResultBoards);
$row_cntr = $result->num_rows;
//echo $row_cntr;

$thingy = $row_cntr - $row_cnt;


echo $row_cntr;
echo "<br/>";
echo $row_cnt;
echo "<br/>";
echo $thingy;
echo "<br/>";
//------------------------------------------------------------------------------------------------------------

$SQLSELECTCables = "SELECT qcg.*, mid.QCG FROM qcg 
                              INNER JOIN `12ncqcg` AS mid ON mid.QCG = qcg.Function_ID
                              WHERE qcg.Catalog_Group 
                              Like \"C%\" ORDER BY qcg.ID";
$resulter2 = $conn->query($SQLSELECTCables);
$row_cnt2 = $resulter2->num_rows;
//echo $row_cnt;

$SQLResultCables = "SELECT * FROM qcg WHERE qcg.Catalog_Group Like \"C%\"";
$result2 = $conn->query($SQLResultCables);
$row_cntr2 = $result2->num_rows;
//echo $row_cntr;

$thingy2 = $row_cntr2 - $row_cnt2;


echo $row_cntr2;
echo "<br/>";
echo $row_cnt2;
echo "<br/>";
echo $thingy2;
echo "<br/>";
echo "<br/>";

//------------------------------------------------------------------------------------------------------------

//$Dups1 = "SELECT COUNT(*) FROM 12ncqcg, t1 INNER JOIN 12nc, t2 WHERE t1.`12NC` = t2.`12NC`;";
$AllNC1 = "SELECT * FROM 12nc";
$resultall1 = $conn->query($AllNC1);
$row_all1 = $resultall1->num_rows;
$Dups1 = "SELECT DISTINCT `12NC` FROM `12nc`";
$resultdup1 = $conn->query($Dups1);
$row_dup1 = $resultdup1->num_rows;

$ADups1 = $row_all1 - $row_dup1;


$AllNC2 = "SELECT * FROM 12ncqcg";
$resultall2 = $conn->query($AllNC2);
$row_all2 = $resultall2->num_rows;
$Dups2 = "SELECT DISTINCT `QCG` FROM `12ncqcg`";
$resultdup2 = $conn->query($Dups2);
$row_dup2 = $resultdup2->num_rows;

$ADups2 = $row_all2 - $row_dup2;


$AllNC3 = "SELECT * FROM qcg";
$resultall3 = $conn->query($AllNC3);
$row_all3 = $resultall3->num_rows;
$Dups3 = "SELECT DISTINCT `Function_ID` FROM `qcg`";
$resultdup3 = $conn->query($Dups3);
$row_dup3 = $resultdup3->num_rows;

$ADups3 = $row_all3 - $row_dup3;


echo $ADups1;
echo "<br/>";
echo $ADups2;
echo "<br/>";
echo $ADups3;
echo "<br/>";*/
?>

<script type="text/javascript">

</script>

</body>
</html>
