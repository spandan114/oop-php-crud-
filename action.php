<?php

include "db.php";
class Dataoperation extends Database{

    //INSERT METHOD

    public function incert_record($table,$fields){
        $sql = "";
        $sql .= "INSERT INTO ".$table;
        $sql .= "(".implode(",",array_keys($fields)).") VALUES ";  
        $sql .= "('".implode("','",array_values($fields))."')";
        $query = mysqli_query($this->con,$sql);
        if($query){
            return true;
        }
    }

    //FETCH ALL METHOD

    public function fetch_record($table){
        $sql = "SELECT * FROM ".$table;
        $array = array();
        $query = mysqli_query($this->con,$sql);
        while ($row = mysqli_fetch_assoc($query)) {
            $array[] = $row; 
        }
        return $array;
    }

    //FETCH DATA BU ID METHOD

    public function select_databy_id($table,$where){
        $sql = "";
        $condition = "";
        foreach ($where as $key => $value){
            // id = '5' AND name = 'somthing'
            $condition .= $key . "='". $value ."' AND ";
        }
        $condition = substr($condition,0,-5);
        $sql = "SELECT * FROM ".$table." WHERE ".$condition;
        $query = mysqli_query($this->con,$sql);
        $row = mysqli_fetch_array($query);
        return $row;
    }

    //UPDATE METHOD

    public function update_data($table,$fields,$where){
        $sql = "";
        $condition = "";
        foreach ($where as $key => $value){
            // id = '5' AND name = 'somthing'
            $condition .= $key . "='". $value ."' AND ";
        }
        $condition = substr($condition,0,-5);

        foreach ($fields as $key => $value) {
            //UPDATE 'tablename' SET name='' , qty='' WHERE id='';
            $sql .= $key ."='".$value."', ";
        }
        $sql = substr($sql,0,-2);
        $sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
        $query = mysqli_query($this->con,$sql);
        if($query){
            return true;
        } 
    }

    //DELETE METHOD

    public function delete_by_id($table,$where){
        $sql = "";
        $condition = "";
        foreach ($where as $key => $value){
            // id = '5' AND name = 'somthing'
            $condition .= $key . "='". $value ."' AND ";
        }
        $condition = substr($condition,0,-5);
        $sql = "DELETE FROM ".$table." WHERE ".$condition;
        $query = mysqli_query($this->con,$sql);
        if($query){
            return true;
        }
    }

}


//==================CREATE OBJECT AND CALL METHODS=================//

$obj = new Dataoperation;

//INSERT DATA

if(isset($_POST['submit'])){
    $myArray = array(
        "name" => $_POST['name'] ,
        "qty"=> $_POST['qty']
    );
    if($obj->incert_record("medicene",$myArray)){
        header("location:index.php?msg=Record inserted syccessfully");
    }
}

//UPDATE DATA

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $where = array("id"=>$id);
    $myArray = array(
        "name" => $_POST['name'] ,
        "qty"=> $_POST['qty']
    );
    if($obj->update_data("medicene",$myArray,$where)){
        header("location:index.php?msg=Record updated syccessfully");
    }
}

//DELETE

if(isset($_GET['delete'])){
    $id = $_GET["id"] ?? null;
    $where = array("id"=>$id);
    if($obj->delete_by_id("medicene",$where)){
        header("location:index.php?msg=Record deleted successfully");
    }
}

?>