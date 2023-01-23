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
            // echo $sql;
            // exit;
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
            // echo $sql;
            // exit;
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
        function getRow($table,$arrWhere=array(),$arrValue=array(),$selectField='*')
        {
            // print_r($arrWhere);
            // print_r($arrValue);
            $sql="SELECT $selectField FROM $table ";
            if(!empty($arrWhere))
            {
                $sql.='Where ';
                foreach($arrWhere as $key => $value)
                {
                    if($key!=0)
                    {
                        $sql.=" AND ";
                    }
                    $sql.="$value=$arrValue[$key]";
                }

            }
            // echo $sql;
            // exit;
            
            $res=mysqli_query($this->conn,$sql);
            $data=mysqli_fetch_assoc($res);
            return $data;
        }
        function getTable($table,$arrWhere=array(),$arrValue=array(),$orderField=false,$selectField='*')
        {
            $sql="SELECT $selectField FROM $table ";
            if(!empty($arrWhere))
            {
                $sql.='Where ';
                foreach($arrWhere as $key => $value)
                {
                    if($key!=0)
                    {
                        $sql.=" AND ";
                    }
                    $sql.="$value=$arrValue[$key]";
                }
            }
            if($orderField)
            {
                $sql.="ORDER BY $orderField";
            }
            // echo $sql;
            
            $res=mysqli_query($this->conn,$sql);
            $data=mysqli_fetch_all($res,MYSQLI_ASSOC);
            return $data;
        }
        function getCount($table,$column,$arrWhere=array(),$arrValue=array())
        {
            $sql="SELECT COUNT($column) AS count FROM $table";
            if(!empty($arrWhere))
            {
                $sql.='Where';
            }
            foreach($arrWhere as $key => $value)
            {
                if($key!=0)
                {
                    $sql.="AND";
                }
                $sql.="$value=$arrValue[$key]";
            }
            $res=mysqli_query($this->conn,$sql);
            $data=mysqli_fetch_assoc($res);
            return $data;
        }
    }
