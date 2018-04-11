<?php
function UploadFunction()
{
    $conn = mysqli_connect('localhost', 'root', '', 'asmlcompare');

    include_once 'Classes/PHPExcel/IOFactory.php';

    if ($_FILES['file']['name']) {

        $inputfilename = strtolower($_FILES['file']['name']);
        $exceldata = array();

//  Read your Excel workbook
        try {
            $inputfiletype = PHPExcel_IOFactory::identify($inputfilename);
            $objReader = PHPExcel_IOFactory::createReader($inputfiletype);
            $objPHPExcel = $objReader->load($inputfilename);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputfilename, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

//  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

//  Loop through each row of the worksheet in turn
        for ($row = 1; $row <= $highestRow; $row++) {
//  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
//  Insert row data array into your database of choice here
            $sql = "INSERT INTO 12ncqcg (12NC, QCG) VALUES ('" . $rowData[0][5] . "', '" . $rowData[0][51] . "')";

            if (mysqli_query($conn, $sql)) {
                $exceldata[] = $rowData[0];
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }

    $sql3 = "DELETE FROM 12ncqcg WHERE 12NC='12NC'";

    if ($conn->query($sql3) === TRUE) {
        //echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $sql4 = "DELETE FROM 12ncqcg WHERE QCG='N/A'";

    if ($conn->query($sql4) === TRUE) {
        //echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    /*$sql2 = "DELETE FROM 12ncqcg WHERE 12NC NOT IN (SELECT MAX(12NC) FROM (SELECT * FROM 12ncqcg) AS something GROUP BY QCG);";
    if ($conn->query($sql2) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }*/
}

function UploadFunction2()
{
    $conn = mysqli_connect('localhost', 'root', '', 'asmlcompare');

    include_once 'Classes/PHPExcel/IOFactory.php';

    if ($_FILES['file2']['name']) {

        $inputfilename = strtolower($_FILES['file2']['name']);
        $exceldata = array();

//  Read your Excel workbook
        try {
            $inputfiletype = PHPExcel_IOFactory::identify($inputfilename);
            $objReader = PHPExcel_IOFactory::createReader($inputfiletype);
            $objPHPExcel = $objReader->load($inputfilename);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputfilename, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

//  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

//  Loop through each row of the worksheet in turn
        for ($row = 1; $row <= $highestRow; $row++) {
//  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
//  Insert row data array into your database of choice here
            $sql = "INSERT INTO qcg (`ID`, `Function_ID`, `Status`, `Description`, `Catalog_Group`, `Part_Family`, `Part_Type`, `Number_of_Contacts`, `Gender`, `Keying`, `Interface`, `Symbol`, `System_Component`, `12NC`, `Mate`)
                    VALUES ('" . $rowData[0][0] . "', '" . $rowData[0][1] . "','" . $rowData[0][2] . "',
                            '" . $rowData[0][3] . "', '" . $rowData[0][4] . "','" . $rowData[0][5] . "',
                            '" . $rowData[0][6] . "', '" . $rowData[0][7] . "','" . $rowData[0][8] . "',
                            '" . $rowData[0][9] . "', '" . $rowData[0][10] . "','" . $rowData[0][11] . "',
                            '" . $rowData[0][12] . "', '" . $rowData[0][13] . "','" . $rowData[0][14] . "')";

            if (mysqli_query($conn, $sql)) {
                $exceldata[] = $rowData[0];
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }

    $sql3 = "DELETE FROM qcg WHERE Status='Status'";

    if ($conn->query($sql3) === TRUE) {
        //echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

function UploadFunction3()
{
    $conn = mysqli_connect('localhost', 'root', '', 'asmlcompare');

    include_once 'Classes/PHPExcel/IOFactory.php';

    if ($_FILES['file2']['name']) {

        $inputfilename = strtolower($_FILES['file2']['name']);
        $exceldata = array();

//  Read your Excel workbook
        try {
            $inputfiletype = PHPExcel_IOFactory::identify($inputfilename);
            $objReader = PHPExcel_IOFactory::createReader($inputfiletype);
            $objPHPExcel = $objReader->load($inputfilename);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputfilename, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

//  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(1);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

//  Loop through each row of the  worksheet in turn
        for ($row = 1; $row <= $highestRow; $row++) {
//  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
//  Insert row data array into your database of choice here
            $sql = "INSERT INTO 12nc (`ID`, `Function_ID`, `Status`, `Description`, `Catalog_Group`, `Part_Family`, `Part_Type`, `Number_of_Contacts`, `Gender`, `Keying`, `Interface`, `Symbol`, `System_Component`, `12NC`, `Mate`)
                    VALUES ('" . $rowData[0][0] . "', '" . $rowData[0][1] . "','" . $rowData[0][2] . "',
                            '" . $rowData[0][3] . "', '" . $rowData[0][4] . "','" . $rowData[0][5] . "',
                            '" . $rowData[0][6] . "', '" . $rowData[0][7] . "','" . $rowData[0][8] . "',
                            '" . $rowData[0][9] . "', '" . $rowData[0][10] . "','" . $rowData[0][11] . "',
                            '" . $rowData[0][12] . "', '" . $rowData[0][13] . "','" . $rowData[0][14] . "')";

            if (mysqli_query($conn, $sql)) {
                $exceldata[] = $rowData[0];
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }

    $sql3 = "DELETE FROM 12nc WHERE Status='Status'";

    if ($conn->query($sql3) === TRUE) {
        //echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

Function DeleteFunction()
{

    $conn = mysqli_connect('localhost', 'root', '', 'asmlcompare');
    //$sqldel1 = "DELETE FROM 12ncqcg WHERE 12NC NOT IN (SELECT MAX(12NC) FROM (SELECT * FROM 12ncqcg) AS something GROUP BY QCG);";
    $sqldel1 = "DELETE t1 FROM `12ncqcg` t1 INNER JOIN `12ncqcg` t2 WHERE t1.`12NC` < t2.`12NC` AND t1.`QCG` = t2.`QCG`;";
    if ($conn->query($sqldel1) === TRUE) {
        //echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $sqldel2 = "DELETE t1 FROM `12nc` t1 INNER JOIN `12nc` t2 WHERE t1.ID < t2.ID AND t1.`12NC` = t2.`12NC`;";
    if ($conn->query($sqldel2) === TRUE) {
        //echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $sqldel3 = "DELETE t1 FROM `qcg` t1 INNER JOIN `qcg` t2 WHERE t1.ID < t2.ID AND t1.`Function_ID` = t2.`Function_ID`;";
    if ($conn->query($sqldel3) === TRUE) {
        //echo "Record deleted successfully";

    } else {
        echo "Error deleting record: " . $conn->error;
    }

}

Function TrucFunc()
{
    $conn = mysqli_connect('localhost', 'root', '', 'asmlcompare');
    $Trunc1 = "TRUNCATE TABLE 12ncqcg";
    if ($conn->query($Trunc1) === TRUE) {
        //echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $Trunc2 = "TRUNCATE TABLE 12nc";
    if ($conn->query($Trunc2) === TRUE) {
        //echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $Trunc3 = "TRUNCATE TABLE qcg";
    if ($conn->query($Trunc3) === TRUE) {
        //echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

Function SelectConnector()
{
    if(isset($_POST['choices']) && !empty($_POST['choices'])) {
        if ($_POST['choices'] == '1') {
            $conn = mysqli_connect('localhost', 'root', '', 'asmlcompare');
            $SQLSELECT = "SELECT qcg.*, mid.QCG, nc.`12NC` FROM qcg 
                              INNER JOIN `12ncqcg` AS mid ON qcg.Function_ID = mid.QCG 
                              INNER JOIN `12nc` AS nc ON mid.`12NC` = nc.`12NC`
                              WHERE qcg.Catalog_Group 
                              Like \"B%\" ORDER BY qcg.ID";


            //$result_set =  mysqli_query($SQLSELECT, $conn);
            $result = $conn->query($SQLSELECT);

            $row_cnt = $result->num_rows;

            printf("Result set has %d rows.\n", $row_cnt);

            //while($row = mysqli_fetch_array($result_set))
            while ($row = $result->fetch_assoc()) {
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
        } elseif ($_POST['choices'] == '2') {
            $conn = mysqli_connect('localhost', 'root', '', 'asmlcompare');
            $SQLSELECT = "SELECT qcg.*, mid.QCG FROM qcg 
                              INNER JOIN `12ncqcg` AS mid ON qcg.Function_ID = mid.QCG
                              WHERE qcg.Catalog_Group 
                              Like \"C%\" ORDER BY qcg.ID";


            //$result_set =  mysqli_query($SQLSELECT, $conn);
            $result = $conn->query($SQLSELECT);

            $row_cnt = $result->num_rows;

            printf("Result set has %d rows.\n", $row_cnt);

            //while($row = mysqli_fetch_array($result_set))
            while ($row = $result->fetch_assoc()) {
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
        }
    }
}

Function SelectCables()
{
    $conn = mysqli_connect('localhost', 'root', '', 'asmlcompare');
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
    ?>

    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart2);
    function drawChart2()
    {
    var data = google.visualization.arrayToDataTable([
    ['Gender', 'Number'],
    <?php
    $Yes = "Does match";
    $No = "Does not match";
    echo "['".$Yes."', ".$row_cnt2."]," ;
    echo "['".$No."', ".$thingy2."],";


    ?>
    ]);
    var options = {
    slices:{0:{color: '#0F238C'},1:{color: '#ba0707'}},
    title: 'Difference Cables',
    is3D:true,
    pieHole: 0
    /*animation: {
    duration: 1000,
    easing: 'out',
    startup: true
    }*/
    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
    chart.draw(data, options);
    }
    </script>

<?php
}

Function SelectBoards()
{
    $conn = mysqli_connect('localhost', 'root', '', 'asmlcompare');
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

    ?>

    <script type="text/javascript">

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Gender', 'Number'],
                <?php
                $Yes = "Does match";
                $No = "Does not match";
                echo "['" . $Yes . "', " . $row_cnt . "],";
                echo "['" . $No . "', " . $thingy . "],";


                ?>
            ]);
            var options = {
                slices: {0: {color: '#0F238C'}, 1: {color: '#ba0707'}},
                title: 'Difference Boards',
                is3D: true,
                pieHole: 0.3

            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>

<?php
}

Function SelectDups()
{
    $conn = mysqli_connect('localhost', 'root', '', 'asmlcompare');

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
    echo "<br/>";

    ?>

    <script type="text/javascript">
    google.charts.load('visualization', '1', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawChart3);
    function drawChart3()
    {
        var data = google.visualization.arrayToDataTable([
            ['File', 'Amount', { role: "style"}],
            <?php
            $nc = "xDM_Exp 12NC";
            $qcg = "xDM_Exp QCG";
            $ncqcg = "xDM to EEE";
            $c1 = "color: #d51619";
            $c2 = "color: #0f238c";
            $c3 = "color: #ffe900";
            echo "['".$ncqcg."', ".$ADups2.", '".$c1."'],";
            echo "['".$nc."', ".$ADups1.", '".$c2."'],";
            echo "['".$qcg."', ".$ADups3.", '".$c3."'],";
            ?>
        ]);

        var options = {
            title: 'Difference Cables',
            width: 500,
            height: 700,
            is3D:true,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
            vAxis: {minValue: 200},
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('ColChart1'));
        chart.draw(data, options);
    }
    </script>

<?php
}
?>