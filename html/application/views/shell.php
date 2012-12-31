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
            <nav id="home_nav">
                <a href="<?php echo $home_link ?>">
                    <ul>
                        <li <?php if($active_menu == 'home') echo 'class="active"'; ?>>
                            <i class="icon-home"></i>
                            Home
                        </li>
                        <li id="logo">
                            Mineshafter Squared
                        </li>
                    </ul>
                </a>
            </nav>
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
    <script type="text/javascript">
        var _urq = _urq || [];
        _urq.push(['initSite', '6eade05c-3cd7-440a-be2d-d38963acaa7e']);
        (function() {
        var ur = document.createElement('script'); ur.type = 'text/javascript'; ur.async = true;
        ur.src = 'http://sdscdn.userreport.com/userreport.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ur, s);
        })();
    </script>
</body>
</html>
<!-- JAVASCRIPT -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<?php echo $javascript_links; ?>