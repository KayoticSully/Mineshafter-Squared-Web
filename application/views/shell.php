<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="The Minecraft Proxy.  Play for free, join an awesome community, and enjoy a top-notch skin management system." />
    <meta name="keywords" content="minecraft, mineshafter, mineshafter squared, minecraft proxy" />
    <title>
        <?php echo $title; ?>
    </title>
    <link rel="canonical" href="http://mineshaftersquared.com" />
<!-- CSS -->
<?php echo $css_links; ?>
</head>
<body data-spy="scroll" data-target="#submenu">
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
    <?php
        $this->load->view($navbar, array('user' => $user));
    ?>
    <div id="shell-top-wrapper">
        <div id="shell-top">
            <div id="banner">
                <div id="social">
                    <div id="facebook">
                        <div class="fb-like" data-href="https://www.facebook.com/MineshafterSquared" data-send="false" data-layout="button_count" data-width="130" data-show-faces="false"></div>
                    </div>
                    <div id="googleplus">
                        <div class="g-plusone" data-size="medium"></div>
                    </div>
                    <div id="twitter">
                        <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                    </div> 
                </div>
            </div>
            <div id="topAd">
                <?php if (ENVIRONMENT == 'production'): ?>
                    <script type="text/javascript"><!--
                        google_ad_client = "ca-pub-2130540909688027";
                        /* MS2 3.0 Top */
                        google_ad_slot = "7136961453";
                        google_ad_width = 728;
                        google_ad_height = 90;
                        //--
                    </script>
                    <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
                <?php else: ?>
                    <img class="ad_placehold" src="http://placehold.it/728x90&text=Ad" />
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div id="shell-application">
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
                <a href="/signup">Trouble signing in?</a>&nbsp;
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button id="login" class="btn btn-primary">Log in</button>
            </div>
        </div>
    <?php endif; ?>
    <footer>
        Copyright 2011 - 2013
        <a href="http://www.kayoticlabs.com" alt="">Kayotic Labs</a> |
        <a href="http://www.ryansullivan.org">Ryan Sullivan</a>
    </footer>
    <!-- Google Analytics -->
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-24037493-1']);
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

<?php
if ($extra_js)
{
    echo $extra_js;
}
?>