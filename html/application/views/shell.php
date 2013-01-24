<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>
        Mineshafter Squared
    </title>
    <link rel="canonical" href="http://mineshaftersquared.com" />
<!-- CSS -->
<?php echo $css_links; ?>
</head>
<body>
    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=250095618338485";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <div id="shell-top-wrapper">
        <div id="shell-top">
            <div id="banner">
                <div id="brand">
                    Mineshafter Squared
                </div>
                <div id="social">
                    <div id="facebook">
                        <div class="fb-like" data-href="https://www.facebook.com/MineshafterSquared" data-send="false" data-layout="box_count" data-width="130" data-show-faces="false"></div>
                    </div>
                    <div id="googleplus">
                        <div class="g-plusone" data-size="tall"></div>
                    </div>
                </div>
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
        </div>
        <?php
            $this->load->view($navbar, array('user' => $user));
        ?>
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
    <!-- Modals -->
    <?php if (!$user): ?>
        <div id="login-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="login-modal" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Log in</h3>
            </div>
            <div class="alert alert-error hide" id="login-error">
            </div>
            <div class="modal-body">
                <div class="center_load">
                    &nbsp;
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button id="login" class="btn btn-primary">Log in</button>
            </div>
        </div>
    <?php endif; ?>
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
        _gaq.push(['_setDomainName', 'mineshaftersquared.com']);
        _gaq.push(['_addIgnoredRef', 'mineshaftersquared.com']);
        _gaq.push(['_trackPageview']);
        (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
    <!-- Google Plus -->
    <script type="text/javascript">
        (function() {
          var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
          po.src = 'https://apis.google.com/js/plusone.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        })();
    </script>
    <!-- User Report -->
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