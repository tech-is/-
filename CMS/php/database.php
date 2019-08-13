<?php
mb_internal_encoding("UTF-8");

class database
{
    const DB_NAME='world';
    const HOST='127.0.0.1';
    const UTF='utf8';
    const USER='root';
    const PASS='';
    //データベースに接続する関数
    public function __construct()
    {
        $dsn="mysql:dbname=".self::DB_NAME.";host=".self::HOST.";charset=".self::UTF;
        $user=self::USER;
        $pass=self::PASS;
        try{
            $pdo = new PDO($dsn,$user,$pass);
        }catch(Exception $e){
            echo 'error' .$e->getMesseage;
            die();
        }
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $this->link=$pdo;
    }

    /**
     * close_detabase
     * @param : なし
     * @return : なし
     */
    public function close_detabase()
    {
         $this->link=null;
    }

    /**
     * run_sql
     * @param : $sql : SQL文
     *        : $params : 
     * @return : セットしたSQLの戻り値
     */
    public function run_sql($sql)
    { 
        $stmt = $this->link->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

       public function select_all($data)
    { 
        $sql = "SELECT * FROM $data";
        $stmt = $this->link->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

        public function select_where_sql($sql)
    { 
        $stmt = $this->link->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //SELECT,INSERT,UPDATE,DELETE文の時に使用する関数。
    public function insert($sql, $item)
    {
        $stmt = $this->link->query($sql);
        $stmt->execute(array(':id'=>$item));//sql文のVALUES等の値が?の場合は$itemでもいい。
        return $stmt;
    }

    public function create_table($data)
    {
        $table = [];
        foreach($data as $tr)
        {
            $table[] = "<tr>";
            foreach ($tr as $td)
            {
                $table[]= "<td>".$td."</td>";
            }
            $table[] ="</tr>";
        }
        return $table;
    }
}

if(isset($_POST['table']))
{
    $sql = $_POST['table'];
    $database = new database; 
    $data = $database->select_all($sql);
    $table = $database->create_table($data);
    // header('content-type: application/json; charset=utf-8');
    // echo json_encode($table);
    print_r($table);
}

