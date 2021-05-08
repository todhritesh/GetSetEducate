<?php

    session_start();

    class first4indian{
        private $hostname = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname = "GetSetEducate";

        private $connect ;

        //for db connection
        public function __construct(){
            $this->connect = new mysqli($this->hostname , $this->username , $this->password , $this->dbname);

            return $this->connect;
        }


        //for insertion in db
        public function insertData($table,$fields,$page="index"){
            $col = implode(",",array_keys($fields));
            $rows = implode("','",array_values($fields));

            $query = $this->connect->query("insert into $table ($col) values ('$rows')");

            $this->redirect($page);
        }

        
        //page redirecting 
        public function redirect($page="index"){
            echo "<script>window.open('$page.php','_self')</script>";
        }


        //for counding data
        public function countData($query){
            $rows = $this->connect->query($query);

            return $rows->num_rows;
        }


        //for fetching data
        public function getData($query){
            $run = $this->connect->query($query);

            $array = [];
            if($run->num_rows > 0){
                while($row = $run->fetch_assoc()){
                    $array[] = $row ;
                }
                return $array;
            }
            else{
                echo "No records";
                return $array;
            }
        }


        //for getting user id
        public function getUserId(){
            $log = $_SESSION['user'];
            $run = $this->connect->query("select * from signup where email='$log'");
            $data = $run->fetch_assoc();

            return $data['id'];
        }

        
        //for data deletion 
        public function deleteData($query){
            $run = $this->connect->query($query);
            return $run;
        }


        //for giving alert
        public function giveAlert($msg){
            $run = "<script> alert('$msg') </script>";
            echo $run;
        }


        //update data 
        public function updateData($query){
            $run = $this->connect->query($query);
            return $run;
        }

    }

    
    $book = new first4indian();

?>