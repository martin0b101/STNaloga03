<?php

require_once "DBInit.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class SocialNetworkDB {


    public static function getAllFeedPost(){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM post");
        $statement -> execute();

        return $statement->fetchAll();
    }

    public static function insert($media, $description, $user_id){

        

        $db = DBInit::getInstance();
        $date = date("Y-m-d h:m:s");

        $statement = $db ->prepare("INSERT INTO post (media, description, date, user_id) VALUES (:media, :description, :date, :user_id)");
        $statement->bindParam(":media", $media);
        $statement->bindParam(":description", $description);
        $statement->bindParam(":date", $date);
        $statement->bindParam(":user_id", $user_id);
        $statement -> execute();

    }

    public static function checkIfUsernameExist($email) {
        $db = DBInit::getInstance();
        $statement = $db ->prepare("SELECT * FROM user WHERE email='".$email."'");
        $statement -> execute();

        $result = count($statement->fetchAll());
        return $result;
    }

    public static function signUpUser($email, $fullname, $password){
        $db = DBInit::getInstance();

        $statement = $db -> prepare("INSERT INTO user (full_name, email, password) VALUES (:full_name, :email, :password)");
        $statement->bindParam(":full_name", $fullname);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password);
        $statement->execute();
    }


    public static function signInUser($email, $password){
        $db = DBInit::getInstance();

        $statement = $db -> prepare("SELECT COUNT(user_id) FROM user WHERE email=:email AND password=:password");
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password);
        $statement->execute();
        return $statement->fetchColumn(0) == 1;

    }

    public static function getUserIdFromEmail($email){
        $db = DBInit::getInstance();

        $statement = $db -> prepare("SELECT user_id FROM user WHERE email=:email");
        $statement->bindParam(":email", $email);
        $statement->execute();
        return $statement->fetch();
    }

    public static function getUserName($email) {
        $db = DBInit::getInstance();

        $statement = $db -> prepare("SELECT full_name FROM user WHERE email=:email");
        $statement->bindParam(":email", $email);
        $statement->execute();
        return $statement->fetch();
        
    }

    public static function getAllPostFromUser($userId){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM post WHERE user_id=:user_id");
        $statement->bindParam(":user_id", $userId);
        $statement -> execute();

        return $statement->fetchAll();
    }
}
