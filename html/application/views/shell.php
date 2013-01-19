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
    <?php $this->load->view($navbar); ?>
    <div id="shell-top-wrapper">
        <div id="shell-top">
            <nav id="home_nav">
                <?php if ($user): ?>
                    <div class="login_section">
                        <a href="#" id="username">
                            <?php echo $user->username; ?>
                        </a>
                        <br>
                    </div>
                    <div class="login_section">
                        <?php if ($user->type->level <= 0): ?>
                            <a href="/admin" class="btn btn-small btn-info">Admin</a>
                            <br>
                        <?php endif; ?>
                        <a href="/auth/logout?page=<?php echo $_SERVER['REQUEST_URI']; ?>" class="btn btn-small btn-primary">Logout</a>
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<?php echo $javascript_links; ?>