<?php
require_once './configs/connection.php';
require_once './configs/functions.php';

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['searcher']) && !empty($_POST['searcher'])) {

    if (isset($_POST['complement'])){
        $searchers = searcherPacketsComplements($db, $_POST['searcher']);
    }else{
        $searchers = searcherPackets($db, $_POST['searcher']);
    }

}else{
    $mostdownloads = searcherPacketsMostDownloads($db);
}

if (!isset($_SESSION['clickeds'])){
    $_SESSION['clickeds'] = array();
}

if (isset($_SESSION['clean_clickeds'])){
    $_SESSION['clickeds'] = array();
    unset($_SESSION['clean_clickeds']);
}

?>
<!DOCTYPE HTML>
  <head>
      <?php require_once './configs/config.php'; ?>
      <title>Project</title>
      <link rel="stylesheet" type="text/css" href="resources/css/index.css">
</head>
   <body>
   <?php if (isset($_SESSION['errors'])) : ?>
       <div class="errors">
           <?=$_SESSION['errors'];?><br/><br/>
       </div>
   <?php endif;?>
   <?php if(isset($_SESSION['completed'])): ?>
       <div class="completed">
           <?=$_SESSION['completed']?><br/><br/>
       </div>
   <?php endif; ?>

    <h1><a href="./index.php">PROJECT</a></h1>

    <?php if (isset($_SESSION['user_identify'])): ?>
    <header class="data">
        <a href="user/my_user.php"><?=$_SESSION['user_identify']['user'];?></a>
        <a href="user/my_data.php">Settings</a>
        <a href="./configs/logout.php">Sign Off</a>
    </header>
    <?php endif; ?>

   <?php if (!isset($_SESSION['user_identify'])): ?>
       <p class="data"><a href="./user/signin.php">Signin </a><a href="./user/login.php">Login</a></p>
   <?php endif; ?>

   <header>
    <form method="POST">
        <input type="text" name="searcher" placeholder="Searcher:">
        <input type="checkbox" value="1" name="complement">
        <input type="submit" value="Searcher:">
    </form>
    </header>
   <hr/>

    <div class="list_software">
        <?php
        $long = count($_SESSION['clickeds']);
        $long--;
        for ($i = 0; $i <= $long; $i++) {
            $namesclickeds = searcherNamePacketsFromID($db, $_SESSION['clickeds'][$i]);
            $nameclickeds = mysqli_fetch_assoc($namesclickeds);
            $list = implode(" ", $nameclickeds);
            $id = $_SESSION['clickeds'][$i];
            $issetarray = array_search($_SESSION['clickeds'][$i], $_SESSION['clickeds']);
            echo "<a href='./functions/clickeds.php?id=$id&action=delete&position=$issetarray'>".$list."</a>"."<br/>"."<br/>";
        } ?>
    </div>

    <div class="software">
        <?php
        if (!isset($_POST['searcher']) || empty($_POST['searcher'])):
            if (!empty($mostdownloads)):
                while($mostdownload = mysqli_fetch_assoc($mostdownloads)): ?>

                    <p><?=$mostdownload['name']?></p>

                    <?php
                    $issetarray = array_search($mostdownload['id'], $_SESSION['clickeds']);
                    if ($issetarray == false && $issetarray !== 0): ?>
                        <a href="./functions/clickeds.php?id=<?=$mostdownload['id']?>&action=add">ADD</a>
                    <?php else: ?>
                        <a href="./functions/clickeds.php?id=<?=$mostdownload['id']?>&action=delete&position=<?=$issetarray?>">DELETE</a>

                    <?php
                    endif;
                endwhile;
            endif;
        endif;
        ?>
    </div>

    <div class="software">
        <?php
        if (!empty($searchers)):
            if (mysqli_num_rows($searchers) < 1): ?>
                <p>No results found</p>
            <?php  endif; while($searcher = mysqli_fetch_assoc($searchers)): ?>

            <p><?=$searcher['name']?></p>

            <?php
            $issetarray = array_search($searcher['id'], $_SESSION['clickeds']);

            if ($issetarray == false && $issetarray !== 0): ?>
                <a href="./functions/clickeds.php?id=<?=$searcher['id']?>&action=add">ADD</a>
            <?php else: ?>
                <a href="./functions/clickeds.php?id=<?=$searcher['id']?>&action=delete&position=<?=$issetarray?>">DELETE</a>
            <?php
            endif;
        endwhile;
        endif;?>
    </div>

    <?php
    if (!empty($_SESSION['clickeds'])): ?>
        <a href="./functions/createautoinstaller.php" class="buttons">Download Autoinstaller</a>
    <?php endif; ?>

    <?php
    if (!empty($_SESSION['clickeds']) && isset($_SESSION['user_identify'])): ?>
        <a href="./functions/saveautoinstaller.php" class="buttons">Save Autoinstaller</a>
    <?php endif; ?>

    </body>
    <?php deleteErrors(); ?>
      <footer> Developed by "Propietario" &copy; <?=date("Y")?> </footer>
  </body>
</html>
