<?php

class DB
{
    public $link;
    public $_result;

    /** Connects to database **/
    function __construct()
    {

        $this->link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
        if (!$this->link) {
            die('Ошибка соединения: ' . mysql_error());
        }
        $db_selected = mysql_select_db(DB_NAME, $this->link);
        if (!$db_selected) {
            die('Ошибка соединения: ' . mysql_error());
        }
    }

    /** Disconnects from database **/
    public function disconnects()
    {
        if (mysql_close($this->link) != 0) {
            return 1;
        } else {
            return 0;
        }
    }


    public function query($query, $singleResult = 0)
    {

        $this->_result = mysql_query($query);
        $res = array();
        if (preg_match("/select/i", $query)) {
            while ($row = mysql_fetch_array($this->_result)) {
                $res[] = $row;
            }
            mysql_free_result($this->_result);

        }
        return ($res);
    }

    public function delete($table_name, $row_id)
    {
        $sql = "DELETE FROM ".$table_name." WHERE id = ".$row_id;
        mysql_query($sql);
    }

    public function select_row($table_name, $where)
    {
        //SELECT TOP 1 * FROM table_name WHERE some_column = some_value;
        $query = 'SELECT * FROM '.$table_name.' WHERE some_column = some_value';
        $this->_result = mysql_query($query);
        $res = array();
        while ($row = mysql_fetch_array($this->_result)) {
            $res[] = $row;
        }
        mysql_free_result($this->_result);
        return $res;
    }

    public function select_rows($table_name, $where)
    {
        //SELECT * FROM table_name WHERE some_column = some_value;

        $res = array();

    }

    public function insert($table_name, $columns_array, $values_array)
    {
        //INSERT INTO Customers (CustomerName, ContactName, City, Country)VALUES ('Cardinal','Tom B. Erichsen','Stavanger','Norway');
        $sql = "INSERT INTO ".$table_name." ".$columns_array." VALUES ".$values_array;
        mysql_query($sql);
    }

    public function update($table_name, $array, $where)
    {
        //UPDATE table_name SET column1=value1,column2=value2,... WHERE some_column=some_value;
        $sql = "UPDATE ".$table_name." SET ".$array." WHERE ".$where;
        mysql_query($sql);
    }
}