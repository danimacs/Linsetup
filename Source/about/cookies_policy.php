<?php
require_once '.././configs/connection.php';
require_once '.././configs/functions.php';
?>
    <!DOCTYPE html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <meta name="title" content="">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="robots" content="index, follow, all">
        <meta http-equiv="Content-Language" content="en">
        <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
        <title>WPM</title>
        <link rel="stylesheet" type="text/css" href="../resources/css/about.css">
    </head>
<body>
<h1><a href=".././index.php">WPM</a></h1>
    <?php if (isset($_SESSION['user_identify'])): ?>
    <header>
        <form action=".././social/searcher.php" method="POST" class="searcher_header">
            <input type="search" name="search" class="searcher_header_input" placeholder="Searcher:">
            <input type="submit" value="Search">
        </form>
        <a href="../user/my_user.php"><?=$_SESSION['user_identify']['user'];?></a>
        <a href="../user/my_data.php">Settings</a>
        <a href="../configs/logout.php">Sign Off</a>
    </header>
    <br/>
    <?php endif;?>
   <?php if(!isset($_SESSION['user_identify'])):?>
     <?php if (isset($_SESSION['errors']['login'])) : ?>
          <div class="errors_login">
              <?=$_SESSION['errors']['login'];?>
          </div>
      <?php endif;?>
      <?php if(isset($_SESSION['completed'])): ?>
          <div class="completed">
              <?=$_SESSION['completed']?>
          </div>
      <?php endif; ?>
       <form method="POST" action=".././validate_data/sessions/validate_login.php" class="login">
           <input type="text" name="email_user" placeholder="Email or User:"/>
           <input type="password" name="password" placeholder="Password:"/>
           <input type="submit" value="Login"/>
       </form>
    <?php endif; ?>
    <hr>
    <main>
        <h2>Cookies Policy</h2>

        <p>Last updated: April 17, 2019</p>

        <p>WPM ("us", "we", or "our") uses cookies on the www.WPM.com website (the "Service"). By using the Service, you consent to the use of cookies.</p>

        <p>Our Cookies Policy explains what cookies are, how we use cookies, how third-parties we may partner with may use cookies on the Service, your choices regarding cookies and further information about cookies.</p>

        <h2>What are cookies</h2>

        <p>Cookies are small pieces of text sent to your web browser by a website you visit. A cookie file is stored in your web browser and allows the Service or a third-party to recognize you and make your next visit easier and the Service more useful to you.</p>

        <p>Cookies can be "persistent" or "session" cookies. Persistent cookies remain on your personal computer or mobile device when you go offline, while session cookies are deleted as soon as you close your web browser.</p>

        <h2>How WPM uses cookies</h2>

        <p>When you use and access the Service, we may place a number of cookies files in your web browser.</p>

        <p>We use cookies for the following purposes:</p>

        <ul>
            <li>
                <p>To enable certain functions of the Service</p>
            </li>
            <li>
                <p>To provide analytics</p>
            </li>
            <li>
                <p>To store your preferences</p>
            </li>
        </ul>

        <p>We use both session and persistent cookies on the Service and we use different types of cookies to run the Service:</p>

        <ul>
            <li>
                <p>Essential cookies. We may use cookies to remember information that changes the way the Service behaves or looks, such as a user's language preference on the Service.</p>
            </li>
            <li>
                <p>Accounts-related cookies. We may use accounts-related cookies to authenticate users and prgame_session fraudulent use of user accounts. We may use these cookies to remember information that changes the way the Service behaves or looks, such as the "remember me" functionality.</p>
            </li>
            <li>
                <p>Analytics cookies. We may use analytics cookies to track information how the Service is used so that we can make improvements. We may also use analytics cookies to test new advertisements, pages, features or new functionality of the Service to see how our users react to them.</p>
            </li>
        </ul>

        <h2>Third-party cookies</h2>

        <p>In addition to our own cookies, we may also use various third-parties cookies to report usage statistics of the Service, deliver advertisements on and through the Service, and so on.</p>

        <h2>What are your choices regarding cookies</h2>

        <p>If you'd like to delete cookies or instruct your web browser to delete or refuse cookies, please visit the help pages of your web browser.</p>

        <p>Please note, however, that if you delete cookies or refuse to accept them, you might not be able to use all of the features we offer, you may not be able to store your preferences, and some of our pages might not display properly.</p>

        <ul>
            <li>
                <p>For the Chrome web browser, please visit this page from Google: <a href="https://support.google.com/accounts/answer/32050">https://support.google.com/accounts/answer/32050</a></p>
            </li>
            <li>
                <p>For the Internet Explorer web browser, please visit this page from Microsoft: <a href="http://support.microsoft.com/kb/278835">http://support.microsoft.com/kb/278835</a></p>
            </li>
            <li>
                <p>For the Firefox web browser, please visit this page from Mozilla: <a href="https://support.mozilla.org/en-US/kb/delete-cookies-remove-info-websites-stored">https://support.mozilla.org/en-US/kb/delete-cookies-remove-info-websites-stored</a></p>
            </li>
            <li>
                <p>For the Safari web browser, please visit this page from Apple: <a href="https://support.apple.com/guide/safari/manage-cookies-and-website-data-sfri11471/mac">https://support.apple.com/guide/safari/manage-cookies-and-website-data-sfri11471/mac</a></p>
            </li>
            <li>
                <p>For any other web browser, please visit your web browser's official web pages.</p>
            </li>
        </ul>

        <h2>Where can you find more information about cookies</h2>

        <p>You can learn more about cookies and the following third-party websites:</p>

        <ul>
            <li>
                <p>AllAboutCookies: <a href="http://www.allaboutcookies.org/">http://www.allaboutcookies.org/</a></p>
            </li>
            <li>
                <p>Network Advertising Initiative: <a href="http://www.networkadvertising.org/">http://www.networkadvertising.org/</a></p>
            </li>
        </ul>
    </main>
      <footer>
          Developed by "Propietario" &copy; <?=date("Y")?>
          <nav>
              <a href=".././about/terms_and_conditions.php">Terms and Conditions</a>
              <a href=".././about/cookies_policy.php">Cookies Policy</a>
          </nav>
      </footer>
    </body>
</html>
