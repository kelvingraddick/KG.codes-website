<?php include $_SERVER['DOCUMENT_ROOT'].'/js/google_analytics.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/js/facebook.php'; ?>
<div class="container">
    <div class="header columns is-mobile is-gapless is-multiline">
        <div class="column is-full-mobile">
            <a href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/">
                <img class="logo" src="<?php echo $setting['logo']; ?>" />
            </a>
        </div>
        <div class="links column is-one-third-desktop is-one-third-tablet is-full-mobile">
            <a class="navigation_link" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>">HOME</a>&nbsp;&nbsp;&nbsp;
            <a class="navigation_link" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/blog/">BLOG</a>&nbsp;&nbsp;&nbsp;
            <!--<a class="navigation_link" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/coding/">CODING</a>&nbsp;&nbsp;&nbsp;-->
            <a class="navigation_link" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/beats/">BEATS</a>&nbsp;&nbsp;&nbsp;
            <a class="navigation_link" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/contact/">CONTACT</a>
        </div>
        <div class="links column is-one-third-desktop is-one-third-tablet is-full-mobile">
            <a class="social_link" href=""><i class="fab fa-facebook"></i></a> &nbsp;&nbsp;&nbsp;
            <a class="social_link" href=""><i class="fab fa-instagram"></i></a> &nbsp;&nbsp;&nbsp;
            <a class="social_link" href=""><i class="fab fa-twitter"></i></a>
        </div>
    </div>
</div>