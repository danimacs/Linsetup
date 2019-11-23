<?php
require_once '.././configs/connection.php';
require_once '.././configs/isset_session.php';
require_once '.././configs/functions.php';
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include_once '.././configs/meta.php'; ?>
        <title>LINSETUP - Settings</title>
    </head>

     <body class="container">

  <nav class="navbar navbar-expand-sm bg-dark navbar-light">

         <ul class="list-unstyled">

             <li class="nav-item">
                 <h1><a href=".././index.php" class="nav-link">LINSETUP</a></h1>
             </li>

            <?php if (isset($_SESSION['user_identify'])): ?>
                 <li class="nav-item text-right">
                     <a href=".././user/my_user.php" class="nav-link"><?=$_SESSION['user_identify']['user'];?></a>
                     <a href=".././user/my_data.php" class="nav-link">Settings</a>
                     <a href=".././configs/logout.php" class="nav-link">Sign Off</a>
                 </li>
             <?php endif; ?>

         </ul>

     </nav>

        <article class="data">
            <?php if(isset($_SESSION['completed'])): ?>
                <div class="alert alert-success alert-dismissible">
                    <?=$_SESSION['completed']?>
                </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['errors']['general'])): ?>
                <div class="alert alert-danger alert-dismissible">
                    <?=$_SESSION['errors']['general']?>
                </div>
            <?php endif; ?>

                <h2>Edit my data</h2>

                <form method="POST" action="../validate_data/user_data/change_my_data.php" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="user">User:</label><br/>
                        <input type="text" name="user" autofocus value="<?=$_SESSION['user_identify']['user']; ?>" class="form-control"/><br/>
                        <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'user') : ''; ?>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label><br/>
                        <input type="email" name="email" value="<?=$_SESSION['user_identify']['email']; ?>" class="form-control"/><br/>
                        <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'email') : ''; ?>
                    </div>

                    <input type="submit" value="Actualizar" name="submit" class="btn btn-primary"/>
                </form>
        </article>

        <article class="password">

            <h2>Change my Password</h2>

            <form method="POST" action="../validate_data/user_data/change_password.php">
                <div class="form-group">
                    <label for="password_old">Last password:</label><br/>
                    <input type="password" name="password_old" class="form-control"/><br/>
                    <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'password_old') : ''; ?>
                </div>

                <div class="form-group">
                    <label for="password_new">New password:</label><br/>
                    <input type="password" name="password_new" class="form-control"/><br/>
                    <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'password_new') : ''; ?>
                </div>

                <input type="submit" value="Actualizar" name="submit" class="btn btn-primary"/>
            </form>
        </article>
        <?php deleteErrors(); ?>

           <footer class="text-right"> Developed by Daniel Macias </footer>
    </body>
</html>
