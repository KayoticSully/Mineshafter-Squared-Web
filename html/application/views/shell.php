<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>
        Mineshafter Squared
    </title>
<!-- CSS -->
<?php echo $css_links; ?>
</head>
<body>
    <?php
        $admin = $user && $user->type->level == 0 ? true : false;
        $this->load->view($navbar, array('admin' => $admin));
    ?>
    <div id="shell-top-wrapper">
        <div id="shell-top">
            <nav id="home_nav">
                <?php if ($user): ?>
                    <div class="login_section">
                        <div id="user-logged-in" data-id"<?php echo $user->id; ?>"></div>
                        <br>
                        <a href="#" id="username" class="btn btn-link">
                            <?php echo $user->username; ?>
                        </a>
                        -
                        <a href="/auth/logout?page=<?php echo $_SERVER['REQUEST_URI']; ?>" class="btn btn-link">
                            Logout
                        </a>
                    </div>
                <?php else: ?>
                    <form action="/auth/login" method="POST" id="login_form">
                        <div class="login_section" id="login_fields">
                            <input type="text" id="username" name="username" placeholder="Username" />
                            <input type="password" id="password" name="password" placeholder="Password" />
                        </div>
                        <div class="login_section hide" id="login_actions">
                            <input type="submit" value="Login" class="btn btn-small btn-primary" />
                            <a class="btn btn-link" target="_blank" href="http://minecraft.net/resetpassword">Lost Password?</a>
                        </div>
                        <div class="login_section login_load hide">&nbsp;</div>
                        <div class="login_section login_message hide">
                            &nbsp;
                        </div>
                        <div class="login_section message_dismiss hide">
                            <input type="button" class="btn btn-small btn-primary" id="dismiss" value="Ok" />
                        </div>
                    </form>
                <?php endif; ?>
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
        <?php if($browser == "Internet Explorer"): ?>
            <div class="alert alert-block alert-error center">
                This website does not work well with Internet Explorer.  I make no guarantees that any features on this site
                will work.  For a better experience on the web consider <a href="http://browsehappy.com/">
                upgrading to a better browser.</a>
            </div>
        <?php endif; ?>
        <?php echo $application; ?>
    </div>
    <footer>
        Copyright 2011 - 2012
        <a href="http://www.kayoticlabs.com" alt="">Kayotic Labs</a> |
        <a href="http://www.ryansullivan.org">Ryan Sullivan</a>
        &nbsp;
        Icons from <a href="http://www.glyphicons.com/">Glyphicons Free</a> licensed under
        <a href="http://creativecommons.org/licenses/by/3.0/">CC BY 3.0</a>
    </footer>
    <!-- Google Analytics -->
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-24037493-2']);
        _gaq.push(['_trackPageview']);
        (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
</body>
</html>
<!-- JAVASCRIPT -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<?php echo $javascript_links; ?>