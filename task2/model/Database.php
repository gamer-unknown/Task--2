<?php

class Database
{
    protected $DBNAME='task2';
    protected $DBHOST='localhost';
    protected $DBUSER='root';
    protected $DBPASS='';

    private function connect()
    {
        $str='mysql:hostname='.$this->DBHOST.';dbname='.$this->DBNAME;
        $con = new PDO($str,$this->DBUSER,$this->DBPASS);
        return $con;
    }

    public function test()
    {
        echo '<h1>testing</h1>';
    }

    public function query($query,$data=[])
    {
        $con = $this->connect();
        $stm = $con->prepare($query);
        $check = $stm->execute($data);
        if($check)
        {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result))
            {
                return $result;
            }
        }
        else{
            return false;
        }
    }

    
}