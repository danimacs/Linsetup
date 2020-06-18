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

    if (isset($_SESSION['errors_signin'])){
        $_SESSION['errors_signin'] = null;
        $deleted = true;
    }

    if (isset($_SESSION['errors_change_password'])){
        $_SESSION['errors_change_password'] = null;
        $deleted = true;
    }

    if (isset($_SESSION['errors_change_data'])){
        $_SESSION['errors_change_data'] = null;
        $deleted = true;
    }
    
    if (isset($_SESSION['errors_recovery'])){
        $_SESSION['errors_recovery'] = null;
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

function searcherCategories0($connection){
    $sql = "SELECT * FROM categories WHERE id BETWEEN 0 AND 4";
    $searchs = mysqli_query($connection, $sql);

    $result = array();
    if ($searchs && mysqli_num_rows($searchs) >= 1) {
        $result = $searchs;
    }

    return $searchs;

}

function searcherCategories1($connection){
    $sql = "SELECT * FROM categories WHERE id BETWEEN 5 AND 7";
    $searchs = mysqli_query($connection, $sql);

    $result = array();
    if ($searchs && mysqli_num_rows($searchs) >= 1) {
        $result = $searchs;
    }

    return $searchs;

}

function searcherCategories2($connection){
    $sql = "SELECT * FROM categories WHERE id BETWEEN 8 AND 9";
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

function getsaveautoinstallers($connection, $user){

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




