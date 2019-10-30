<?php include_once './functions/getpackets.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once './configs/meta.php'; ?>
        <title>WPM</title>
        <link rel="stylesheet" type="text/css" href="./resources/css/index.css">
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

        <h1><a href="./index.php">WPM</a></h1>

        <?php if (isset($_SESSION['user_identify'])): ?>
        <header class="data">
            <a href="user/my_user.php"><?=$_SESSION['user_identify']['user'];?></a>
            <a href="user/my_data.php">Settings</a>
            <a href="./configs/logout.php">Sign Off</a>
        </header>
        <?php endif; ?>

       <?php if (!isset($_SESSION['user_identify'])): ?>
           <a href="pages/login_signin.php" class="signin_login">Login | Signin</a>
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
                    while($mostdownload = mysqli_fetch_assoc($mostdownloads)):

                        echo $mostdownload['name'];

                        $issetarray = array_search($mostdownload['id'], $_SESSION['clickeds']);
                        if ($issetarray == false && $issetarray !== 0): ?>
                            <a href="./functions/clickeds.php?id=<?=$mostdownload['id']?>&action=add">ADD</a>
                        <?php else: ?>
                            <a href="./functions/clickeds.php?id=<?=$mostdownload['id']?>&action=delete&position=<?=$issetarray?>">DELETE</a>
                        <?php endif; ?><br/><br/>

                        <?php
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
                <?php  endif; ?>
                <?php while($searcher = mysqli_fetch_assoc($searchers)):

                echo $searcher['name'];

                $issetarray = array_search($searcher['id'], $_SESSION['clickeds']);

                if ($issetarray == false && $issetarray !== 0): ?>
                    <a href="./functions/clickeds.php?id=<?=$searcher['id']?>&action=add">ADD</a>
                <?php else: ?>
                    <a href="./functions/clickeds.php?id=<?=$searcher['id']?>&action=delete&position=<?=$issetarray?>">DELETE</a>
                <?php endif; ?><br/><br/>

                <?php
            endwhile;
            endif;?>
        </div>

        <br/>
        <?php
        if (!empty($_SESSION['clickeds'])): ?>
            <a href="./functions/createautoinstaller.php" class="buttons">Download Autoinstaller</a>
        <?php endif; ?>

       <?php
        if (!empty($_SESSION['clickeds']) && isset($_SESSION['user_identify'])): ?>
            <a href="./functions/saveautoinstaller.php" class="buttons">Save Autoinstaller</a>
        <?php endif; ?>

       <footer> Developed by Daniel Macias </footer>

    <?php deleteErrors(); ?>
  </body>
</html>
