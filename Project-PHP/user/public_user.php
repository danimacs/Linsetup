<?php
require_once '.././configs/connection.php';
require_once '.././configs/functions.php';


if (!isset($_GET['user'])){
    header('Location: .././index.php');
}

if ($_GET['user'] == $_SESSION['user_identify']['user']){
    header('Location: .././user/my_user.php');
}

$user = getUserFromUser($db, $_GET['user']);
$user = mysqli_fetch_assoc($user);

$anyrequest = checkRequest($db, $_SESSION['user_identify']['id'], 'user_send');
$requests1 = checkFriends($db, $_SESSION['user_identify']['id'], $user['id']);
?>
<!doctype html>
    <!DOCTYPE html>
<head>
    <?php require_once '.././configs/config.php'; ?>
    <link rel="stylesheet" type="text/css" href="../resources/css/social/public_user.css">
    <title>PROJECT - <?=$user['user']?></title>
</head>
 <body>
    <h1><a href="../index.php">PROJECT</a></h1>
    <header>
     <form action="../social/searcher.php" method="POST" class="searcher_header">
        <input type="search" name="search" class="searcher_header_input" placeholder="Searcher:">
        <input type="submit" value="Search">
    </form>
    <a href="my_user.php"><?=$_SESSION['user_identify']['user'];?></a>
    <a href="my_data.php">Settings</a>
    <a href="../configs/logout.php">Sign Off</a>
</header>
<br/>
<hr>
    <?php if ($requests1->num_rows == 1 || $user['private_account'] == 0): ?>
        <aside class="data">
            <h2>Data</h2>
            <?php if (!empty($user['steam'])): ?>
                <label>Steam:</label><br/>
                <p><?=$user['steam']; ?></p>
            <?php endif; ?>

            <?php if (!empty($user['twitter'])): ?>
                <label>Twitter:</label><br/>
                <p><?=$user['twitter']; ?></p>
            <?php endif; ?>

            <?php if (!empty($user['youtube'])): ?>
                <label>Youtube:</label><br/>
                <p><?=$user['youtube']; ?></p>
            <?php endif; ?>

            <?php if (!empty($user['discord'])): ?>
                <label>Discord:</label><br/>
                <p><?=$user['discord']; ?></p>
            <?php endif; ?>
        </aside>
    <?php endif; ?>
<main>
    <img width="60px" src="/database/social/<?=$user['profile_picture'];?>" class="profile_picture"/>
    <?=$user['user']?>
    <?php
    if ($requests1->num_rows == 0 && $anyrequest->num_rows == 0):
    ?>
   <a href=".././validate_data/social/add_follow.php?id_send=<?=$_SESSION['user_identify']['id'];?>&id_receive=<?=$user['id']?>&private_account=<?=$user['private_account'];?>">Follow</a>
    <?php endif; ?>
    <?php if ($requests1->num_rows == 1 && $anyrequest->num_rows == 1):?>
   <a href=".././validate_data/social/delete_follow.php?id_send=<?=$_SESSION['user_identify']['id'];?>&id_receive=<?=$user['id']?>">Delete Follow</a>
    <?php endif; ?>
    <aside class="entries">
    <h2>Entries</h2>
    <?php
    $entries = getEntriesByIDUser($db, $user['id']);
    if(!empty($entries)):
        while($entry = mysqli_fetch_assoc($entries)):
            $user = getUserFromId($db, $entry['user_id']);
            $user = mysqli_fetch_assoc($user);
            $ext = pathinfo($entry['file_entry'], PATHINFO_EXTENSION);
            if ($user['private_account'] == 0 && $entry['only_followers'] == 0 && $requests1->num_rows == 0):
            ?>
                <?php if($_SESSION['user_identify'] && $_SESSION['user_identify']['user'] == $user):?>
                    <a href="edit_entry.php?id=<?=$entry['id']?>">Edit entry</a>
                    <a href="../validate_data/social/delete_entry.php?id=<?=$entry['id']?>">Delete entry</a>
                <?php endif; ?>
                <p><?=$entry['entry']?></p>
                <?php if(!empty($entry['file_entry']) && $ext != "mp4"):?>
                    <img width="30%" src="/database/entries/<?=$entry['file_entry']?>" class="profile_picture"><br/><br/>
                <?php endif; ?>
                <?php if(!empty($entry['file_entry']) && $ext == "mp4"):?>
                    <video controls class="media_entry">
                        <source src="/database/entries/<?=$entry['file_entry']?>" type="video/mp4">
                    </video><br/><br/>
                    <a href="../validate_data/social/add_point_plays.php?id=<?=$entry['id']?>">Vote clips</a>
                    <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'vote_plays') : ''; ?>
                    <br/><br/>
                <?php endif; ?>
                <?php if(!empty($entry['community'])):?>
                    <a href="community.php?community=<?=$entry['community']?>"><?=$entry['community']?></a>
                <?php endif; ?>
                <span><?=$entry['create_datetime']?></span> <a href="public_user.php?user=<?=$user['user']?>"><?=$user['user']?></a><hr/>
        <?php
        endif;
        endwhile;
    endif;
    ?>
    <?php
    $entries = getEntriesByIDUser($db, $user['id']);
    if(!empty($entries)):
        while($entry = mysqli_fetch_assoc($entries)):
            $user = getUserFromId($db, $entry['user_id']);
            $user = mysqli_fetch_assoc($user);
            $ext = pathinfo($entry['file_entry'], PATHINFO_EXTENSION);
            if ($requests1->num_rows == 1):
            ?>
                <?php if($_SESSION['user_identify'] && $_SESSION['user_identify']['user'] == $user):?>
                    <a href="edit_entry.php?id=<?=$entry['id']?>">Edit entry</a>
                    <a href="../validate_data/social/delete_entry.php?id=<?=$entry['id']?>">Delete entry</a>
                <?php endif; ?>
                <p><?=$entry['entry']?></p>
                <?php if(!empty($entry['file_entry']) && $ext != "mp4"):?>
                    <img width="30%" src="/database/entries/<?=$entry['file_entry']?>" class="profile_picture"><br/><br/>
                <?php endif; ?>
                <?php if(!empty($entry['file_entry']) && $ext == "mp4"):?>
                    <video controls class="media_entry">
                        <source src="/database/entries/<?=$entry['file_entry']?>" type="video/mp4">
                    </video><br/>
                    <a href="../validate_data/social/add_point_plays.php?id=<?=$entry['id']?>">Vote clips</a>
                    <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'vote_plays') : ''; ?>
                    <br/>
                <?php endif; ?>
                <?php if(!empty($entry['community'])):?>
                    <a href="community.php?community=<?=$entry['community']?>"><?=$entry['community']?></a>
                <?php endif; ?>
                <span><?=$entry['create_datetime']?></span> <a href="public_user.php?user=<?=$user['user']?>"><?=$user['user']?></a><hr/>
            </article>
        <?php
            endif;
        endwhile;
    endif;
    ?>
    <?php if ($entries->num_rows == 0): ?>
    <p>The user has not yet published anything</p>
    <?php endif; ?>
    </aside>
    <?php if ($user['private_account'] == 1 && $requests1->num_rows == 0 && $anyrequest->num_rows == 0): ?>
    <p>This account is private</p>
    <?php endif; ?>

    <?php if ($user['private_account'] == 1 && $requests1->num_rows == 0 && $anyrequest->num_rows == 1): ?>
    <p>Wait the answer</p>
    <p>This account is private</p>
    <?php endif; ?>
</main>
    <aside class="aside-top">
        <img width="50px" src="/database/social/<?=$_SESSION['user_identify']['profile_picture'];?>" class="profile_picture"/>
        <a href="my_user.php"><?=$_SESSION['user_identify']['user']?></a>
</aside>
    <br/>
    <aside class="aside-bottom">
    <a href="homepage.php">HOME</a>
    <a href="clips.php">CLIPS</a>
    <a href="communities.php">COMMUNITIES</a>
    <a href="game_sessions.php">GAME SESSIONS</a>
</aside>
<footer>
    Developed by "Propietario" &copy; <?=date("Y")?>
</footer>
</body>
</html>


