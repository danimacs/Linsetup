<head>

    <title>LINSETUP | <?=$title?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="title" content="LINSETUP">
    <meta name="description" content="Linseetup allows you to select from a variety of programs and create a script that will allow you to install them at once on Linux.">
    <meta name="keywords" content="Linux, Installer, Script, Generator">
    <meta name="robots" content="index, follow, all">
    <meta name="google" content="notranslate">
    <meta http-equiv="Content-Language" content="en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- Functions JS -->
    <script src="/configs/functions.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/resources/custom.css">
    
    <!-- Icons -->
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

    <?php
    //Refresh Session
    if (isset($_SESSION['user_identify'])) {
        $sql = "SELECT * FROM users WHERE id =".$_SESSION['user_identify']['id'];
        $refresh = mysqli_query($db, $sql);
        $_SESSION['user_identify'] = mysqli_fetch_assoc($refresh);
    }
    ?>

    <?php if (isset($_SESSION['errors_signin'])) : ?>
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#signin').modal('show');
            });
        </script>
    <?php endif; ?>

    <?php if (isset($_GET['change_password'])) : ?>
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#settings').modal('show');
            });
        </script>
    <?php endif; ?>

    <?php if (isset($_GET['recovery_password'])) : ?>
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#password').modal('show');
            });
        </script>
    <?php endif; ?>

    <?php if (isset($_SESSION['errors_change_data'])) : ?>
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#settings').modal('show');
            });
        </script>
    <?php endif; ?>

</head>
