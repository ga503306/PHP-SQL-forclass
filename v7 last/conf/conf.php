<?php
/*
AAConf類別 - 資料庫連接設定, 
儲存連接MySQL資料庫的設定
*/

class AAConf{
    private $databaseURL = "localhost";    // 主機
    private $databaseUName = "nhu1421";       // 使用者
    private $databasePWord = "TSVQD355";           // 密碼
    private $databaseName = "nhu1421"; // 資料庫名稱

    function get_databaseURL(){
            return $this->databaseURL;
        }
    function get_databaseUName(){
            return $this->databaseUName;
        }
    function get_databasePWord(){
            return $this->databasePWord;
        } 
    function get_databaseName(){
            return $this->databaseName;
        } 
}
?>