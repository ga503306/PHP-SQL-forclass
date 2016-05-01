<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>顯示書籍資訊</title>
        <meta name="keywords" content="fight info, info" />
        <meta name="description" content="This page provides flight info." />
        <link href="css/default.css" rel="stylesheet" type="text/css" />
    </head>
    <?php
        include("itinerarymanager.php");
        $FID = 0;
        if(isset($_REQUEST["FID"])){
            $FID = $_REQUEST["FID"];
        }
    ?>    
    <body>
        <div id="wrapper">
        <?php include 'include/header.php'; ?>
            <!-- end div#header -->
            <div id="page">
                <div id="content">
                    <div id="welcome">
                        <h1>顯示書籍資訊</h1>
                        <p>
                           以下為本書局  所販賣之書籍。
                        </p>
                        <!-- Fetch Rows -->
                        <table class="aatable">
                            <tr>
                                <th>書名</th>
                                <th>出版商</th>
                                <th>書籍語言</th>
                                <th>是否有貨</th>                                 
                            </tr>
                            <?php
                            $flightData = getFlightInfo($FID);
$a[0]='C程式設計藝術';
$a[1]="C程式設計藝術";
$a[2]="CCNA 年薪百萬";
$a[3]="CCNA 年薪百萬";
$a[4]="工程數學(一)";
$a[5]="工程數學(一)";
$a[6]="Visual C# 2012";
$a[7]="微電子學";
$a[8]="網頁資料庫程式設計";
$a[9]="PAD > TOW";
             
                            for($index=0;$index < count($flightData);$index++){
                                $flight = $flightData[$index];
                                echo "<tr>";
			
                                echo "<td>".$a[$flight->get_FID()-1]."</td>";
                                echo "<td>".$flight->get_FName()."</td>";
                            
                                echo "<td>".$flight->get_source()."</td>";
                                echo "<td>"."是"."</td>";
                            
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                    <!-- end div#welcome -->		                    
                </div>
                <!-- end div#content -->
                <div id="sidebar">
                    <ul>
                        <?php include 'include/nav.php'; ?>
                        <!-- end navigation -->
                            <?php include 'include/updates.php'; ?>
                        <!-- end updates -->
                    </ul>
                </div>
                <!-- end div#sidebar -->
                <div style="clear: both; height: 1px"></div>
            </div>
                <?php include 'include/footer.php'; ?>
        </div>
        <!-- end div#wrapper -->
    </body>
</html>
