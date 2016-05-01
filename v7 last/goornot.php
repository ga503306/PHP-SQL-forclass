<!DOCTYPE html>
<?php
     include("itinerarymanager.php");
?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>查詢是否出貨</title>
        <meta name="keywords" content="schedule, list" />
        <meta name="description" content="This page provides a list of all schedule" />
        <link href="css/default.css" rel="stylesheet" type="text/css" />
    </head>    
    <body>
        <div id="wrapper">
        <?php include 'include/header.php'; ?>
            <!-- end div#header -->
            <div id="page">
                <div id="content">
                    <div id="welcome">
                        <h1>查詢是否出貨</h1>
                        <p>
                            在下列表格顯示出貨進度 , 這是所有會已訂但未出貨的的書籍清單.
                        </p>
                        <!-- Fetch Rows -->
                        <table class="aatable">
                            <tr>
                                <th>書名</th>
                                <th>出版社</th>
                                <th>書籍語言</th>
                                <th>是否出貨</th>
                            </tr>
                            <?php
                            $itineraryData = getItinerary(0);
                            

                            for($index=0;$index < count($itineraryData);$index++){
                                $guestItinerary = $itineraryData[$index];
                                echo "<tr>";
                                echo "<td>".$guestItinerary->get_travelDate()."</td>";
                                echo "<td><a class='data' href='bookinfo.php?FID=".$guestItinerary->get_FID()."'>".$guestItinerary->get_FName()."</a></td>";
                            
                                echo "<td>".$guestItinerary->get_source()."</td>";
                                echo "<td>"."尚未出貨"."</td>";                                
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                    <div id="note">
                        <p>按一下書籍名稱可以顯示資訊</p>
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
