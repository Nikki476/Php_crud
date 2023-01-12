<?php 
    class dbOperation 
    {
        private $conn;
        function __construct()
        {
            $host='localhost';
            $user='root';
            $pass='Nik99sql';
            $dbname='booking_app';
            $this->conn=mysqli_connect($host,$user,$pass,$dbname);
        }
        function insert($table,$fields,$values)
        {
            $sql="INSERT INTO $table($fields) VALUES($values)";
            $res=mysqli_query($this->conn,$sql);
            if($res)
            {
                return mysqli_affected_rows($this->conn);
            }
            else
            {
                return 0;
            }
        }
        function update($table,$fieldValue,$wField,$wValue)
        {
            $sql="UPDATE $table SET $fieldValue WHERE $wField=$wValue";
            $res=mysqli_query($this->conn,$sql);
            if($res)
            {
                return mysqli_affected_rows($this->conn);
            }
            else
            {
                return 0;
            }
        }
        function delete($table,$field,$value)
        {
            $sql="DELETE FROM $table WHERE $field=$value";
            $res=mysqli_query($this->conn,$sql);
            if($res)
            {
                return mysqli_affected_rows($this->conn);
            }
            else
            {
                return 0;
            }
        }
        function getRow($table,$field,$id,)
        {
            $sql="SELECT FROM $table WHERE $field=$id";
            $res=mysqli_query($this->conn,$sql);
            $data=mysqli_fetch_assoc($res);
            return $data;
        }
    }
?>