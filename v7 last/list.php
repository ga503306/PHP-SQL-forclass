<!DOCTYPE html>
<?php
    include("itinerarymanager.php");
?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>顯示訂書資料</title>
        <meta name="keywords" content="itinerary, list" />
        <meta name="description" content="This page provides a list of all itineraries" />
        <link href="css/default.css" rel="stylesheet" type="text/css" />
    </head>    
    <body>
        <div id="wrapper">
             <?php include 'include/header.php'; ?>
            <!-- end div#header -->
            <div id="page">
                <div id="content">
                    <div id="welcome">
                        <h1>顯示訂書清單</h1>
                        <p>
                            顯示目前的所有訂書清單。
                        </p>
                        <!-- Fetch Rows -->
                               <table class="aatable">
                                   <tr>
                                    <th>訂書者姓名</th>
                                    <th>出版社</th>
                                    <th>書籍語言</th>
                                    <th>是否出貨</th>
                                    <th>書名</th>                                     
                                </tr>
                                <?php
                                    $itineraryData = getItinerary(0);
                                    
                                    for($index=0;$index < count($itineraryData);$index++){
                                        $guestItinerary = $itineraryData[$index];
                                        echo "<tr>";
                                        echo "<td>".$guestItinerary->get_lastName().$guestItinerary->get_firstName()."</td>";
                                        echo "<td><a class='data' href='bookinfo.php?FID=".$guestItinerary->get_FID()."'>".$guestItinerary->get_FName()."</a></td>";
                                       
                                        echo "<td>".$guestItinerary->get_source()."</td>";
                                      
										  echo "<td>"."尚未出貨"."</td>";     
                                        echo "<td>".$guestItinerary->get_travelDate()."</td>";                                        
                                        echo "</tr>";
                                    }
                                ?>
                                </table>
                    </div>
                    <div id="note">
                        <p>按一下出版社可以顯示進一步資訊</p>
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
