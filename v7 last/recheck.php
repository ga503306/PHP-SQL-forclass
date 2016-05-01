<?php
        include("itinerarymanager.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>取消訂書</title>
        <meta name="keywords" content="reservation, list" />
        <meta name="description" content="This page confirm the reservations" />
        <link href="css/default.css" rel="stylesheet" type="text/css" />
    </head>    
    <body>
        <div id="wrapper">
        <?php include 'include/header.php'; ?>
            <!-- end div#header -->
            <div id="page">
                <div id="content">
                    <div id="welcome">
                        <h1>取消訂書</h1>
                        <p>
                            
                        </p>                            
                        <!--body-->                        
                        <?php   
                            $IID;                            
                            if(isset($_REQUEST["IID"])){
                                $IID = $_REQUEST["IID"];
                                
                                // 檢查是否是取消操作
                                $isCancelAction = false;
                                
                                if(isset($_REQUEST["action"])){
                                    $action = $_REQUEST["action"];
                                    if($action == "cancel"){
                                        $isCancelAction = true;
                                    }
                                }
                                if(!$isCancelAction){                                    
                                    // 取得指定編號的訂書資料
                                    $itineraryData = getItinerary($IID);
                                    if(count($itineraryData) > 0){   
                                        echo "<h3>訂書資料</h3>";
                                        echo "<table class='aatable'>";
                                        echo "<tr>";
                                        echo "<th>訂書者姓名</th>";
                                        echo "<th>出版社</th>";
                                        echo "<th>書籍語言</th>";
                                        echo "<th>出貨</th>";
                                        echo "<th>書名</th> ";
                                        echo "</tr>";
                                        
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
                                        echo "</table>";
                                         echo "<font size=1px0>";
										 echo "<font size=5>";
										 
											echo "<br><a href='recheck.php?action=cancel&IID=".$IID."'>取消訂書</a>";
											echo "</font>";
											echo "</font>";
                                    }
                                    else{
                                        echo "<br><br><h3>沒有找到編號, 請再次檢查編號</h3>";
                                        echo "<h4><a href='recheck.php'>請再試一次</a></h4>";
                                    }                                    
                                }
								
                                else{
                                    // 客戶取消訂書                                    
                                    $result = cancelReservation($IID);
                                    if($result == 0){
                                        echo "<h2>取消訂書</h2>";
                                        echo "<h4>你的訂書資料已經取消. 是否保留客戶資料來處理新訂書.</h4>";
										 echo "<font size=5>";
                                        echo "<p><a href='buy.php'>建立新訂書</a></p>";
											echo "</font>";
                                    }
                                }
                            }
                            else {
                            ?>
							
                                <form action="recheck.php">
                                   <input class="form_tfield" type="text" name="IID" value=""/>
								   <br><br>
                                   <input class="form_submitb" name="imageField" type="submit" value="送出"/>
								   <br><br>
                                </form>
                                <div id="note">
                                   <p>請輸入訂書編號. (例如: 5)</p>
                                </div>
                        <?php
                            }
                        ?>                        
                        <!--body ends-->
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