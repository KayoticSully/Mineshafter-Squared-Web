<!DOCTYPE html>
<html>
<head>
    <title>
        Mineshafter Squared
    </title>
<!-- CSS -->
<?php echo $css_links; ?>
</head>
<body>
    <div id="shell-top-wrapper">
        <div id="shell-top">
            <div id="logo">
                Mineshafter Squared
                <div id="login_form_inline" class="hidden-desktop">
                    <input type="text" placeholder="Username" />
                    <input type="password" placeholder="Password" />
                    <input type="submit" value="Login" class="btn" />
                    <a class="formLink" target="_blank" href="http://minecraft.net/resetpassword">lost password?</a>
                </div>
            </div>
            <div id="login_form" class="visible-desktop">
                <input type="text" placeholder="Username" />
                <input type="password" placeholder="Password" />
                <input type="submit" value="Login" class="btn" />
                <a class="formLink" target="_blank" href="http://minecraft.net/resetpassword">lost password?</a>
            </div>
            <div id="topAd">
                <script type="text/javascript"><!--
                    google_ad_client = "ca-pub-2130540909688027";
                    /* MS2 3.0 Top */
                    google_ad_slot = "7136961453";
                    google_ad_width = 728;
                    google_ad_height = 90;
                    //--
                </script>
                <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div id="shell-application">
        <?php echo $application; ?>
    </div>
    <footer>
        Copyright 2011 - 2012
        <a href="http://www.kayoticlabs.com" alt="">Kayotic Labs</a> |
        <a href="http://www.ryansullivan.org">Ryan Sullivan</a> | 
        <a href="http://www.jasonparraga.com" alt="">Jason Parraga</a>
        &nbsp;
        Icons from <a href="http://www.glyphicons.com/">Glyphicons Free</a> licensed under
        <a href="http://creativecommons.org/licenses/by/3.0/">CC BY 3.0</a>
    </footer>
</body>
</html>
<!-- JAVASCRIPT -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<?php echo $javascript_links; ?>