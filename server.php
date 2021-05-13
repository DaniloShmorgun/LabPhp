<?php


$post = json_decode(file_get_contents('php://input'), true);





if ($post["first_name"] == null) {
    $post["first_name"] = "";

}
if ($post["last_name"] == null) {
    $post["last_name"] = "";

}
if (!(array_key_exists("getOrSet", $post))) {
    $post["getOrSet"] = "";
}
if (!(array_key_exists("target", $post))) {
    $post["target"] = "";
}

$post["kafedra"] = "";
$post["date"] = "";
$post["group"] = "";
$post["father"] = "";
$post["faculty"] = "";


    $user = new Student($post);
 
    if ($post["getOrSet"] === "set"){
        if ($post["target"] === "first_name"){
            $user->setfirst_name($post["value"]);
        }
        else if ($post["target"] === "last_name"){
            $user->setlast_name($post["value"]);
        }
        else if ($post["target"] === "father"){
            $user->setFather($post["value"]);
        }
        else if ($post["target"] === "date"){
            $user->setDate($post["value"]);
        }
        else if ($post["target"] === "group"){
            $user->setGroup($post["value"]);
        }
        else if ($post["target"] === "kafedra"){
            $user->setKafedra($post["value"]);
        }
        else if ($post["target"] === "faculty"){
            $user->setFaculty($post["value"]);
        }

        $storage = json_decode(file_get_contents("data.txt"),true);
        
        
        
        foreach ($storage as $storage_key => $storage_value) {
            foreach ($user as $user_key => $user_value) {
                if (($user_key === $storage_key) && ($user_value === ""  && $storage_key !=
                $post["target"]))  {
                    $user->$user_key = $storage_value;
                }
            }
        }
        
        $fw = fopen('data.txt','w+');
        fwrite($fw, json_encode($user));
        fclose($fw);
       
        echo json_encode($user, JSON_UNESCAPED_UNICODE);
    }
    else {
        $storage = json_decode(file_get_contents("data.txt"),true);
            foreach ($storage as $storage_key => $storage_value) {
            foreach ($user as $user_key => $user_value) {
                if (($user_key === $storage_key) && ($user_value === ""  && $storage_key !=
                $post["target"]))  {
                    $user->$user_key = $storage_value;
                }
            }
        }
        
        $fw = fopen('data.txt','w+');
        fwrite($fw, json_encode($user));
        fclose($fw);
       

           
        if($post["target"] === "age"){
            echo $user->calcAge();
        }
        else if($post["target"] === "entryYear"){
            echo $user->entry();
        }
        else if($post["target"] === "subNumber"){
            echo $user->subGroup();
        }
        echo json_encode($user, JSON_UNESCAPED_UNICODE);
    }

    class User {
        public $last_name;
        public $first_name;
        public $father;
        public $date;
        public function setfirst_name($newValue){
            $this->first_name = $newValue;
        }
        public function setlast_name($newValue){
            $this->last_name = $newValue;
        }
        public function setFather($newValue){
            $this->father = $newValue;
        }
        public function setDate($newValue){
            $this->date = $newValue;
        }
        public function getfirst_name(){
            echo $this->first_name;
        }
        public function getlast_name(){
            echo $this->last_name;
        }
        public function getFather(){
            echo $this->father;
        }
        public function getDate(){
            echo $this->date;
        }
        public function __construct($info){
        
                $this->last_name = $info["last_name"];
                $this->first_name = $info["first_name"];
                $this->father = $info["father"];
                $this->date = $info["date"];
            
            
        }
        public function calcAge(){
            $birthday = new DateTime($this->date);
            $currentDate = new DateTime();
            $interval = $currentDate->diff($birthday);
            echo json_encode($interval->y);
            exit();
        }
    }
    
    class Student extends User{
        public $group;
        public $kafedra;
        public $faculty;
        public function setGroup($newValue){
            $this->group = $newValue;
        }
        public function getGroup(){
            echo $this->group;
        }
        public function setKafedra($newValue){
            $this->kafedra = $newValue;
        }
        public function getKafedra(){
            echo $this->kafedra;
        }
        public function setFaculty($newValue){
            $this->faculty = $newValue;
        }
        public function getFaculty(){
            echo $this->faculty;
        }
        public function __construct($info){
            parent::__construct($info);
            $this->group = $info["group"];
            $this->kafedra = $info["kafedra"];
            $this->faculty = $info["faculty"];
        }
        public function entry(){
            $year = intval(date('Y'));
            $entryYear = explode('-', $this->group );
            $currentLastCypherOfYear = intval(substr(date('Y'), -1));
            $modulo = intval($entryYear[1][0]);
            if ($currentLastCypherOfYear < $modulo) {
                $year = (($year - 10) - ($year % 10)) + $modulo;
            }
            else {
               $year = ($year - ($year % 10)) + $modulo;
            }
            echo strval($year);
            exit();
        }
        public function subGroup(){
            $entryNumber = explode('-', $this->group );
            echo $entryNumber[1];
            exit();
        }
    }
?>




