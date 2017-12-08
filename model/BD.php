<?php
class BD{
    private static $instance;
    public static function getInstance(){
        if (self::$instance==null){
            self::$instance=new BD();
        }
        return self::$instance;
    }
    private function __construct()
    {
        $host='localhost';
        $login='root';
        $password='';
        $db_name='boom';
        mysql_connect($host,$login, $password) or die ('We can\'t access to DB');
        mysql_select_db($db_name)  or die ('We can\'t access to table');
    }
    public function select($query){


        $query= mysql_query($query);
        $result=array();
        if(!empty($query)){
            while ($rez = mysql_fetch_assoc($query)) {
                $result[]=$rez;
            }
       /*     print_r('<pre>');
            print_r($result);
           print_r('</pre>');*/

           return $result;
        }
        return null;
    }
    public function insert($table, $object){
        $column=array();
        $value=array();
        foreach ($object as $key=>$value){
            $column[]=$key;
            $value[]=$value;
        }
        $query="INSERT INTO $table ($column) VALUES ('$value')";
        $query=mysql_real_escape_string($query);
        mysql_query($query);
        return mysql_insert_id();
    }
    public function update($table, $object, $where){
        $query="UPDATE $table SET $object WHERE $where";
        $query=mysql_real_escape_string($query);
        mysql_query($query);
        return mysql_affected_rows();
    }
    public function delete($table, $where){
        $query="DELETE FROM $table WHERE $where";
        $query=mysql_real_escape_string($query);
        mysql_query($query);
        return mysql_affected_rows();
    }
    public function __destruct()
    {
        mysql_close();
        // TODO: Implement __destruct() method.
    }
}
?>