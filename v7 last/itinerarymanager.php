<?php
// 設定報告等級
error_reporting(E_ERROR | E_WARNING);
/*
在PHP程式檔案提供資料庫相關操作, 
程式是使用Session變數取得資料庫屬性.
*/
// 含括所需的PHP類別宣告
include("classes/guestitinerary.php");
include("classes/book.php");
include("classes/schedule.php");

$databaseURL;
$databaseUName;
$databasePWord;
$databaseName; 
/*
建立資料庫連接的初始函數, 可以傳回資料庫連接變數.
*/
function initDB(){
    // 從Session變數取得航點資料
    if ( ! isset($_SESSION['databaseURL']) ){
       include("conf/conf.php");
       // 建立AAConf物件取得資料庫連接資訊
       $dbConf = new AAConf();
       $databaseURL = $dbConf->get_databaseURL();
       $databaseUName = $dbConf->get_databaseUName();
       $databasePWord = $dbConf->get_databasePWord();
       $databaseName = $dbConf->get_databaseName();
            
       // 指定資料庫連接資訊的Session變數
       $_SESSION['databaseURL']=$databaseURL; 
       $_SESSION['databaseUName']=$databaseUName; 
       $_SESSION['databasePWord']=$databasePWord; 
       $_SESSION['databaseName']=$databaseName;        
		
       $connection = mysql_connect($databaseURL,$databaseUName,$databasePWord)
                     or die ("錯誤: 連接伺服器錯誤!");
				      
       $db = mysql_select_db($databaseName,$connection)
             or die ("錯誤: 連接資料庫錯誤!"); 
		
       // 送出utf8編碼與校對      
       mysql_query('SET CHARACTER SET utf8');
       mysql_query("SET collation_connection = 'utf8_general_ci'");
       
       $rowArray;
       $rowID = 1;
       $query = "SELECT * FROM sectors";
       $result = mysql_query($query);
       while($row = mysql_fetch_array($result)){    
          $rowArray[$rowID] = $row['Sector'];   
          $rowID = $rowID + 1;
       }  
      
       $_SESSION['sectors'] = $rowArray;    
       mysql_close($connection);
    }
    $databaseURL = $_SESSION['databaseURL'];
    $databaseUName = $_SESSION['databaseUName'];
    $databasePWord = $_SESSION['databasePWord'];
    $databaseName = $_SESSION['databaseName']; 

    $connection = mysql_connect($databaseURL,$databaseUName,$databasePWord)
                  or die ("錯誤: 連接伺服器錯誤!");
    $db = mysql_select_db($databaseName,$connection)
          or die ("錯誤: 連接資料庫錯誤!"); 
    // 送出utf8編碼與校對      
    mysql_query('SET CHARACTER SET utf8');
    mysql_query("SET collation_connection = 'utf8_general_ci'");
    
    return $connection;
}

/*
關閉資料庫連接
*/
function closeDB($connection){
    mysql_close($connection);
}


function cancelReservation($IID){
    $connection = initDB();
    
    // 查詢訂書編號的行程編號
    $query2 = "SELECT * FROM itinerary WHERE IID='".$IID."'";
    $result2 = mysql_query($query2);
        //or die ("查詢失敗: ".mysql_error());
    $SID;
    // 取得編號
    while($row2 = mysql_fetch_array($result2)){        
            $SID = $row2['SID'];                         
        }
    // 刪除Schedule資料表的記錄資料
    $query2 = "DELETE FROM schedule WHERE SID='".$SID."'";
    $result2 = mysql_query($query2);
        //or die ("查詢失敗: ".mysql_error()); 
        
    // 刪除Itinerary資料表的記錄資料
    $query2 = "DELETE FROM itinerary WHERE IID='".$IID."'";
    $result2 = mysql_query($query2);
        //or die ("查詢失敗: ".mysql_error());

    closeDB($connection);
    return 0;
}


function processReservation($fname,$lname,$sourcelist,$flight,$sdate){
    $connection = initDB();
    $query2;
        
    // 更新資料表
    $query2 = "SELECT * FROM guest WHERE FirstName='".$fname."' AND LastName='".$lname."'";
    $result2 = mysql_query($query2);
        //or die ("查詢失敗: ".mysql_error());

    $registeredGuest = false;
    $guestID;

    while($row2 = mysql_fetch_array($result2)){        
       $guestID = $row2['GID'];
       $registeredGuest = true;               
    }
    // 客戶編號錯誤, 表示是第一次填資料.
    if(! $registeredGuest){        
        // 更新Guest資料表, 取得最後一個客戶編號
        $query2 = "SELECT MAX(GID) FROM guest";
        $result2 = mysql_query($query2);
                //or die ("查詢失敗: ".mysql_error());
        $row2 = mysql_fetch_array($result2);
        $MGID = $row2[0];  // 取得最後一個客戶編號
        
        $guestID = $MGID + 1;  // 取得新的客戶編號
        
        // 新增客戶資料
        $query2 = "INSERT INTO guest Values('".$guestID."','".$fname."','".$lname."')";
        $result2 = mysql_query($query2);
                //or die ("查詢失敗: ".mysql_error()); 
    }        
        
    // 取得編號
    $query = "SELECT * FROM flights WHERE FName='".$flight."'";
    $result = mysql_query($query);
        //or die ("查詢失敗: ".mysql_error());
    $row2 = mysql_fetch_array($result);  
    $FID = $row2['FID'];         
        
    // 取得Schedule資料表最後一個編號 
    $query2 = "SELECT MAX(SID) FROM schedule";
    $result2 = mysql_query($query2);
        //or die ("查詢失敗: ".mysql_error());
    $row2 = mysql_fetch_array($result2);
    $MSID = $row2[0];     // 取得最大的編號

    $SID = $MSID + 1;     // 取得新的編號     
    // 在新增Schedule和Itinerary資料表前, 檢查是否有重複記錄
    $query2 = "SELECT * FROM schedule WHERE GID='".$guestID."' AND FID='".$FID."' AND Date='".$sdate."'";
    $result2 = mysql_query($query2);
        //or die ("查詢失敗: ".mysql_error());

    $duplicateItinerary = false;
    $guestID;
    // 如果有查詢到記錄, 就表示重複訂書
    while($row2 = mysql_fetch_array($result2)){  
       $duplicateItinerary = true;               
    }

    if($duplicateItinerary){
        // 訂書資料重複, 傳回 -1.
        return -1;
    }   

    // 新增資料
    $query2 = "INSERT INTO schedule Values('".$SID."','".$guestID."','".$FID."','".$sdate."')";
    $result2 = mysql_query($query2);
        //or die ("查詢失敗: ".mysql_error());
        
    // 取得Itinerary資料表的最後一個訂書編號       
    $query2 = "SELECT MAX(IID) FROM itinerary";
    $result2 = mysql_query($query2);
        // or die ("查詢失敗: ".mysql_error());
    $row2 = mysql_fetch_array($result2);
    $MIID = $row2[0];     // 取得最大的訂書編號 
    
    $IID = $MIID + 1;     // 取得新的訂書編號 
    // 最後新增訂書資料 
    $query2 = "INSERT INTO itinerary Values('".$IID."','".$guestID."','".$FID."','".$SID."')";
    $result2 = mysql_query($query2);
        //or die ("查詢失敗: ".mysql_error());

    closeDB($connection);
    return $IID;
}


function getAvailableFlights($source){

    $connection = initDB();
    $query2;       
    
    $query2 = "SELECT * FROM sectors WHERE Sector='".$source."'";
    $result2 = mysql_query($query2);
        //or die ("查詢失敗: ".mysql_error());                
    $row2 = mysql_fetch_array($result2);
    $SourceSID = $row2['SID'];
    // 取得目的地點的編號SID
   
        
    // 取得Flights資料表
    $query3 = "SELECT * FROM flights WHERE SourceSID='".$SourceSID."'";
    $result3 = mysql_query($query3);
        //  or die ("查詢失敗: ".mysql_error()); 

    $flightsArray;
    $flightsID = 1;
    // 建立可用陣列
    while($row = mysql_fetch_array($result3)){        
       $fName= $row['FName'];
       $flightsArray[$flightsID] = $fName;
       $flightsID = $flightsID + 1;
    }
    closeDB($connection);
    return $flightsArray;
}


function getFlightInfo($FID){
    $connection = initDB();
    $query;
    // 以參數建立SQL指令查詢所有或只有指定書籍資料
    if( $FID == 0 ){
       $query = "SELECT * FROM flights";   // 全部             
    }
    else{
       $query = "SELECT * FROM flights WHERE FID='".$FID."'";               
    }

    $result = mysql_query($query);
        // or die ("查詢失敗: ".mysql_error());

    $flightData;
    $flightID = 0;

    while($row = mysql_fetch_array($result)){   
       $FID = $row['FID'];
	   $Date = $row['Date'];
       $FName = $row['FName'];
       $SourceSID = $row['SourceSID'];
       $DestSID = $row['DestSID'];
	  
       // 取得資訊
       $query2 = "SELECT * FROM sectors WHERE SID='".$SourceSID."'";
       $result2 = mysql_query($query2);
              //or die ("Query Failed ".mysql_error());                
       $row2 = mysql_fetch_array($result2);
       $source = $row2['Sector'];
     
       $query3 = "SELECT * FROM sectors WHERE SID='".$DestSID."'";
       $result3 = mysql_query($query3);
                //or die ("查詢失敗: ".mysql_error());                
       $row3 = mysql_fetch_array($result3);
       $dest= $row3['Sector'];

       // 建立Flight物件
       $flight = new Flight();        
       $flight->set_FID($FID);
       $flight->set_FName($FName);
       $flight->set_source($source);
       $flight->set_dest($dest);

           
       // 建立Flight物件陣列
       $flightData[$flightID] = $flight;
       $flightID = $flightID +1;              
    }
    closeDB($connection);
    return $flightData;
}

function getItinerary($IID){
    $connection = initDB();
    $query;
    // 以參數建立SQL指令查詢所有訂書或只有指定訂書資料
    if($IID == 0){
        $query = "SELECT * FROM itinerary";   // 全部             
    }
    else{
        $query = "SELECT * FROM itinerary WHERE IID='".$IID."'";               
    }

    $result = mysql_query($query);
        //or die ("查詢失敗: ".mysql_error());
        
    $itineraryID = 0;
    $itineraryData;

    while($row = mysql_fetch_array($result)){   
        $GID = $row['GID'];
        $FID = $row['FID'];
        $SID = $row['SID'];
               
        // 取得客戶姓名
        $query2 = "SELECT * FROM guest WHERE GID='".$GID."'";
        $result2 = mysql_query($query2);
        $row2 = mysql_fetch_array($result2);
        $firstName = $row2['FirstName'];
        $lastName = $row2['LastName'];
                
        // 取得書名
        $query3 = "SELECT * FROM schedule WHERE SID='".$SID."'";
        $result3 = mysql_query($query3);
        $row3 = mysql_fetch_array($result3);
        $travelDate = $row3['Date'];
                
        // 取得資料的名稱, 出發地點和目的地點
        $query3 = "SELECT * FROM flights WHERE FID='".$FID."'";
        $result3 = mysql_query($query3);
        $row3 = mysql_fetch_array($result3);
        $sourceSID = $row3['SourceSID'];
        $destSID = $row3['DestSID'];
        $fName = $row3['FName'];
        // 取得出發地點的資訊
        $query4 = "SELECT Sector FROM sectors WHERE SID='".$sourceSID."'";
        $result4 = mysql_query($query4);
        $row4 = mysql_fetch_array($result4);
        $source = $row4['Sector'];
      
                
        // 建立GuestItinerary物件  
        $guestItinerary = new GuestItinerary();
     
        $guestItinerary->set_FID($FID);
        $guestItinerary->set_FName($fName);
        $guestItinerary->set_SID($SID);
        $guestItinerary->set_source($source);
        $guestItinerary->set_dest($dest);
        $guestItinerary->set_travelDate($travelDate);
      
        $guestItinerary->set_GID($GID);
        $guestItinerary->set_firstName($firstName);
        $guestItinerary->set_lastName($lastName);    
        // 建立GuestItinerary物件陣列
        $itineraryData[$itineraryID]=$guestItinerary;
        $itineraryID = $itineraryID + 1;        
    }

    closeDB($connection);      
    return $itineraryData;
}
?>
