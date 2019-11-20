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

function searcherPacketsFromID($connection, $id)
{
    $sql = "SELECT * FROM software WHERE id = '$id'";
    $searchs = mysqli_query($connection, $sql);

    $result = array();
    if ($searchs && mysqli_num_rows($searchs) >= 1) {
        $result = $searchs;
    }

    return $searchs;

}

function searcherCategorieshead($connection){
    $sql = "SELECT * FROM categories ORDER BY id ASC LIMIT 5";
    $searchs = mysqli_query($connection, $sql);

    $result = array();
    if ($searchs && mysqli_num_rows($searchs) >= 1) {
        $result = $searchs;
    }

    return $searchs;

}

function searcherCategoriesfooter($connection){
    $sql = "SELECT * FROM categories ORDER BY id DESC LIMIT 4";
    $searchs = mysqli_query($connection, $sql);

    $result = array();
    if ($searchs && mysqli_num_rows($searchs) >= 1) {
        $result = $searchs;
    }

    return $searchs;

}

function getSoftware(
    $connection, $id_category){
    $sql = "SELECT * FROM software WHERE category = $id_category";
    $searchs = mysqli_query($connection, $sql);

    $result = array();
    if ($searchs && mysqli_num_rows($searchs) >= 1) {
        $result = $searchs;
    }

    return $searchs;

}

function getsaveautoinstallers($connection, $user)
{

    $sql = "SELECT * FROM saveautoinstaller WHERE user = $user ORDER BY create_datetime DESC";
    $searchs = mysqli_query($connection, $sql);

    $result = array();
    if ($searchs && mysqli_num_rows($searchs) >= 1) {
        $result = $searchs;
    }

    return $searchs;

}

function getsaveautoinstaller($connection, $id){

    $sql = "SELECT * FROM saveautoinstaller WHERE id = $id";
    $searchs = mysqli_query($connection, $sql);

    $result = array();
    if ($searchs && mysqli_num_rows($searchs) >= 1) {
        $result = $searchs;
    }

    return $searchs;

}

?>




