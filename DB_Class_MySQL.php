<?php

class DBMySQL 
{
    var $_dbConn = 0;
    var $_queryResource = 0;
    
    function DBMySQL()
    {
        //do nothing
    }//猜測...應該是建構子
    
    function connect_db($host, $user, $pwd, $dbname,$clientflag)
    {
        $dbConn = mysql_connect($host, $user, $pwd,'',$clientflag);
        if (! $dbConn)
            die ("無法連接MySQL資料庫");
        mysql_query("SET NAMES utf8");
        if (! mysql_select_db($dbname, $dbConn))
            die ("無法選至正確的MySQL資料庫");
        $this->_dbConn = $dbConn;
        return true;
    }//連線的function，需要傳入IP、資料庫使用者、資料庫密碼、資料庫名稱，建議新開一個使用者不要使用root
    
    function query($sql)
    {
        if (! $queryResource = mysql_query($sql, $this->_dbConn))
		{
			echo "SQL Qurey Message：".mysql_error()."<br>";
            die ("MySQL Query Error<br>");
		}
        $this->_queryResource = $queryResource;
        return $queryResource;        
    }//執行SQL Query
    
    /** Get array return by MySQL */
    function fetch_array()
    {
        return mysql_fetch_array($this->_queryResource, MYSQL_ASSOC);
    }
    
    function get_num_rows()
    {
        return mysql_num_rows($this->_queryResource);
    }

    /** Get the cuurent id */    
    function get_insert_id()
    {
        return mysql_insert_id($this->_dbConn);
    } 
    
}
?>