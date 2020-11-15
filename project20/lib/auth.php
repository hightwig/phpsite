<?php
$current_user=NULL;
$currentuser_id=NULL;


define('session_expiration_time', 7*24*3600);
function get_current_user_data(){

    global $current_user;
    return   $current_user;
}
function get_current_user_id(){

    global $currentuser_id;
    return $currentuser_id;

            
}


function is_user_log_in(){
    global $currentuser_id;
    if($currentuser_id ){return true;
    }
    return FALSE;
    
}
function unset_user_session(){
     unset($_SESSION['last_access']);
        unset( $_SESSION['user_id']);
        unset( $_SESSION['username']);
        unset($_SESSION['password']);
    
}

function check_for_previous_login(){
    if(isset($_SESSION['last_access'])){
        $last_access=$_SESSION['last_access'];
    }
    
     
    $expired=((time()-$last_access)>session_expiration_time);
    
    if($expired){
        unset_user_session();
        return;
        
    }
     $username=$_SESSION['username'];
    $user= get_user($username);
    if ($user){
    
    $user_id=$_SESSION['user_id'];
    
    if($user_id!=$user['id']){
        unset_user_session();
        return;
    }
    
     $password=$_SESSION['password'];
     if($password!=$user['password']){
         unset_user_session();
         
         
         
         
     }
    
     global  $current_user;
     global   $currentuser_id;

     $current_user=$user;
     $currentuser_id=$user['id'];
     
    }
    
}

function user_logout(){
        unset_user_session();
        global $current_user;
        global $currentuser_id;
        $current_user=null;
        $currentuser_id=null;
    
    }



function user_login($username,$password){
    user_logout();
    $user= get_user($username);
    if(!$user){
        return;
    }
    $password= sha1($password);
    if($password!=$user['password']){
        return;
    }
     global $current_user;
        global $currentuser_id;
        $current_user=$username;
        $currentuser_id=$user['id'];
        
        $_SESSION['last_access']= time();
         $_SESSION['user_id']=$currentuser_id;
         $_SESSION['username']=$current_user;
        $_SESSION['password']=$user['password'];
}