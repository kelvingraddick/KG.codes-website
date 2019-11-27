<?php include $_SERVER['DOCUMENT_ROOT'].'/js/google_analytics.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/js/facebook.php'; ?>
<table class="sidebar_header">
    <tr>
        <td>
            <a href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/">
                <div class="sidebar_header_icon"></div>
            </a>
        </td>
        <td>
            <a href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/">
                <img class="sidebar_header_logo" src="<?php echo $setting['logo']; ?>" alt="KG.codes" />
            </a>
        </td>
    </tr>
</table>
<div class="sidebar_footer">
    <div class="sidebar_footer_title">
        <h<?php echo $header_h_tag_number; ?>>
            Software Developer. <br />
            App + Website Maker. <br />
            Content Creator.
        </h<?php echo $header_h_tag_number; ?>>
    </div>
    <div class="sidebar_footer_description">
        <p>Hi. I'm Kelvin Graddick also known as KG.codes. I'm a software developer / programmer, app + website developer, and content creator. I'm all about digital creation.</p>
    </div>
    <div class="sidebar_footer_navigation_buttons">
        <a class="sidebar_footer_navigation_button" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>">Home</a>&nbsp;&nbsp;&nbsp;
        <a class="sidebar_footer_navigation_button" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/coding/">Coding</a>&nbsp;&nbsp;&nbsp;
        <a class="sidebar_footer_navigation_button" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/blog/">Blog</a>&nbsp;&nbsp;&nbsp;
        <a class="sidebar_footer_navigation_button" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/contact/">Contact</a>
    </div>
    <div class="sidebar_footer_social_buttons">
        <a class="sidebar_footer_social_button" target="_blank" href="<?php echo $setting['facebook_link']; ?>"><i class="fab fa-facebook"></i></a> &nbsp;&nbsp;&nbsp;
        <a class="sidebar_footer_social_button" target="_blank" href="<?php echo $setting['instagram_link']; ?>"><i class="fab fa-instagram"></i></a> &nbsp;&nbsp;&nbsp;
        <a class="sidebar_footer_social_button" target="_blank" href="<?php echo $setting['twitter_link']; ?>"><i class="fab fa-twitter"></i></a> &nbsp;&nbsp;&nbsp;
        <a class="sidebar_footer_social_button" target="_blank" href="https://www.youtube.com/c/kgcodes/"><i class="fab fa-youtube"></i></a> &nbsp;&nbsp;&nbsp;
        <a class="sidebar_footer_social_button" target="_blank" href="https://github.com/kelvingraddick"><i class="fab fa-github"></i></a>
    </div>
    <div class="fb-messengermessageus" 
        messenger_app_id="361862767338317" 
        page_id="483750908706702"
        color="white"
        size="xlarge">
    </div>
</div>