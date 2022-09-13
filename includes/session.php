<?php 
    session_start();

    function login($username, $password){
        global $con;
        $sql = "SELECT * FROM `admin` WHERE username = '$username'  AND password = '$password'  LIMIT 1";
        $result = $con->query($sql);

        if( $result->num_rows > 0 ){
            $_SESSION['loggedIn']  = true;
            $_SESSION['user']  = $result->fetch_assoc();
            return true;
        }

        return false;
    }


    function logout($to, $msg = ''){
        session_destroy();
        redirect($to, $msg);
    }


    function guard($to, $msg){
        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true)
            redirect($to, $msg);
    }

    function getUserSession($key){
        
        if(isset($_SESSION['user']) && isset($_SESSION['user'][$key]))
            return $_SESSION['user'][$key];

        return '';
    }

?>