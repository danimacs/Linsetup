<?php

function showErrors ($errors, $field){
	$alert = '';
	if(isset($errors[$field]) && !empty($field)) {
		$alert = "<div class='errors'>".$errors[$field].'</div>';
	}

	return $alert; 
}



function deleteErrors (){
    $deleted = false;

    if (isset($_SESSION['errors'])){
        $_SESSION['errors'] = null;
        $deleted = true;
    }

    if (isset($_SESSION['notify'])){
        $_SESSION['notify'] = null;
        $deleted = true;
    }

    if (isset($_SESSION['completed'])){
        $_SESSION['completed']= null;
        $deleted = true;
    }
    return $deleted;
}

function getEntriesByIDUser($connection, $id){
    $sql = "SELECT * FROM entries WHERE user_id = $id ORDER BY create_datetime DESC";
    $entry = mysqli_query($connection, $sql);

    $result = array();
     if($entry && mysqli_num_rows($entry) >= 1){
         $result = $entry;
     }

    return $entry;
}


function getUserFromId($connection, $id){
    $sql = "SELECT * FROM users WHERE id= $id";
    $user = mysqli_query($connection, $sql);

    $result =  array();
    if($user && mysqli_num_rows($user) >= 1){
        $result = $user;
    }

    return $user;
}

function getLastIDEntries($connection, $table){
    $sql = "SELECT id FROM $table ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($connection, $sql);

    while($row = mysqli_fetch_array($result)){
        $id = $row['id'];
    }

    return $id;
}

function checkRecovery($connection, $user, $token){
    $sql = "SELECT * FROM tokens WHERE user = $user AND token = '$token'";
    $request = mysqli_query($connection, $sql);

    $result =  array();
    if($request && mysqli_num_rows($request) >= 1){
        $result = $request;
    }

    return $request;

}


function searcherPacketsFromID($conncetion, $id)
{
    $sql = "SELECT * FROM software WHERE id = '$id'";
    $searchs = mysqli_query($conncetion, $sql);

    $result = array();
    if ($searchs && mysqli_num_rows($searchs) >= 1) {
        $result = $searchs;
    }

    return $searchs;

}

function searcherNamePacketsFromID($conncetion, $id)
{
    $sql = "SELECT name FROM software WHERE id = '$id'";
    $searchs = mysqli_query($conncetion, $sql);

    $result = array();
    if ($searchs && mysqli_num_rows($searchs) >= 1) {
        $result = $searchs;
    }

    return $searchs;

}

function searcherPacketsMostDownloads($conncetion)
{
    $sql = "SELECT * FROM software ORDER BY download DESC LIMIT 11";
    $searchs = mysqli_query($conncetion, $sql);

    $result = array();
    if ($searchs && mysqli_num_rows($searchs) >= 1) {
        $result = $searchs;
    }

    return $searchs;

}

function searcherPackets($conncetion, $search)
{

    $sql = "SELECT * FROM software WHERE name LIKE '$search' ORDER BY download DESC";
    $searchs = mysqli_query($conncetion, $sql);

    $result = array();
    if ($searchs && mysqli_num_rows($searchs) >= 1) {
        $result = $searchs;
    }

    return $searchs;

}

function searcherPacketsComplements($conncetion, $search)
{

    $sql = "SELECT * FROM software WHERE name LIKE '%$search%' ORDER BY download DESC LIMIT 11";
    $searchs = mysqli_query($conncetion, $sql);

    $result = array();
    if ($searchs && mysqli_num_rows($searchs) >= 1) {
        $result = $searchs;
    }

    return $searchs;

}

function getsaveautoinstaller($conncetion, $user)
{

    $sql = "SELECT * FROM saveautoinstaller WHERE user = $user ORDER BY create_datetime DESC";
    $searchs = mysqli_query($conncetion, $sql);

    $result = array();
    if ($searchs && mysqli_num_rows($searchs) >= 1) {
        $result = $searchs;
    }

    return $searchs;

}







