<!-- Login -->
<div class="modal" id="login">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Login</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form method="POST" action="../validate_data/validate_login.php">

                    <div class="form-group">
                        <input type="text" name="email_user" placeholder="Email or User" class="form-control" required/>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" class="form-control" required/>
                    </div>

                    <input type="submit" value="Login" class="btn btn-primary"/>

                    <a href="" data-dismiss="modal" data-toggle="modal" data-target="#password" class="d-inline-block float-right text-primary mt-2">Forgot Password?</a>

                </form>

            </div>
        </div>
    </div>
</div>

<!-- Signin -->
<div class="modal" id="signin">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Sign in</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST" action="../validate_data/validate_signin.php">

                    <div class="form-group">
                        <input type="text" name="user" class="form-control" placeholder="User" required/>
                        <?php echo isset($_SESSION['errors_signin']) ? showErrors($_SESSION['errors_signin'], 'user') : ''; ?>
                    </div>

                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required/>
                        <?php echo isset($_SESSION['errors_signin']) ? showErrors($_SESSION['errors_signin'], 'email') : ''; ?>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password"class="form-control" placeholder="Password" required/>
                        <?php echo isset($_SESSION['errors_signin']) ? showErrors($_SESSION['errors_signin'], 'password') : ''; ?>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password_verify" class="form-control" placeholder="Password verification" required/>
                        <?php echo isset($_SESSION['errors_signin']) ? showErrors($_SESSION['errors_signin'], 'password_verify') : ''; ?>
                    </div>

                    <p>By clicking on Sign Up you accept the <a href="./about/terms_and_conditions.php">Terms and Conditions</a>, also accept <a href="./about/cookies_policy.php">Cookies Policy</a>.</p>
                    <input type="submit" value="Sign Up" name="submit" class="btn btn-primary"/><br/>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Settings -->
<div class="modal" id="settings">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Settings</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <?php if(isset($_GET['change_password'])): ?>

                    <h3 class="title-modal mb-3 mt-2">Change password</h3>

                    <form method="POST" action="../validate_data/change_password.php">
                        <div class="form-group">
                            <input type="password" name="password_old" placeholder="Last password" class="form-control" required/>
                            <?php echo isset($_SESSION['errors_change_password']) ? showErrors($_SESSION['errors_change_password'], 'password_old') : ''; ?>
                        </div>

                        <div class="form-group">
                            <input type="password" name="password_new" placeholder="New password" class="form-control" required/>
                            <?php echo isset($_SESSION['errors_change_password']) ? showErrors($_SESSION['errors_change_password'], 'password_new') : ''; ?>
                        </div>

                        <input type="submit" value="Actualizar" name="submit" class="btn btn-primary"/>
                    </form>

                <?php else: ?>

                    <h3 class="title-modal mb-3 mt-2">My data</h3>

                    <form method="POST" action="../validate_data/change_data.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="user" placeholder="Put a user" value="<?=$_SESSION['user_identify']['user']; ?>" class="form-control" required/>
                            <?php echo isset($_SESSION['errors_change_data']) ? showErrors($_SESSION['errors_change_data'], 'user') : ''; ?>
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" placeholder="Put a email" value="<?=$_SESSION['user_identify']['email']; ?>" class="form-control" required/>
                            <?php echo isset($_SESSION['errors_change_data']) ? showErrors($_SESSION['errors_change_data'], 'email') : ''; ?>
                        </div>

                        <input type="submit" value="Actualizar" name="submit" class="btn btn-primary"/>

                        <a href="../index.php?change_password" class="d-inline-block float-right mt-2">Change Password</a>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Password -->
<div class="modal" id="password">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <?php if(isset($_GET['recovert_password'])): ?>
                    <h4 class="modal-title">Recovery password</h4>
                <?php else: ?>
                    <h4 class="modal-title">Forgot password?</h4>
                <?php endif; ?>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <?php if(isset($_GET['recovery_password'])): ?>

                    <form method="POST" action="../validate_data/recovery_password.php?user=<?=$_GET['user']?>&token=<?=$_GET['token']?>">

                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="New password" required/>
                            <?php echo isset($_SESSION['errors_recovery']) ? showErrors($_SESSION['errors_recovery'], 'password') : ''; ?>
                        </div>

                        <div class="form-group">
                            <input type="password" name="password_verify" class="form-control" placeholder="Verify new password" required/>
                            <?php echo isset($_SESSION['errors_recovery']) ? showErrors($_SESSION['errors_recovery'], 'password_verify') : ''; ?>
                        </div>

                        <input type="submit" value="Recovery my password" name="submit" class="btn btn-primary"/>

                    </form>
                    
                <?php else: ?>

                    <form method="POST" action="../validate_data/send_email.php?action=recovery">
                        <div class="form-group">
                            <input type="text" name="email_user" placeholder="Email or User" class="form-control"/>
                        </div>

                        <input type="submit" value="I forgot my password" name="submit" class="btn btn-primary"/>
                    </form>

                <?php endif; ?>

            </div>
        </div>
    </div>
</div>