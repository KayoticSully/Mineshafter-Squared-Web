<div id="server-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="server-modal" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>New Server</h3>
    </div>
    <div class="alert alert-error hide" id="serverlist-error">
    </div>
    <div class="modal-body">
        <div class="center_load">
            &nbsp;
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button id="create-server" class="btn btn-primary">Create</button>
    </div>
</div>
<div id="submenu" class="navbar navbar-static-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="#">Filters - <small>Not yet available</small></a>
            <?php if ($user): ?>
                <ul class="nav pull-right">
                    <li>
                        <form class="navbar-form">
                            <a data-toggle="modal" href="/servers/form" data-target="#server-modal" class="btn btn-primary">Add a Server</a>
                        </form>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>
<div id="server-list" class="container extra-top-padding">
</div>
<div class="fixed-bottom-wrapper">
    <div class="listAd">
        <?php if (ENVIRONMENT == 'production'): ?>
            <script type="text/javascript">
                <!--
                google_ad_client = "ca-pub-2130540909688027";
                /* Server List */
                google_ad_slot = "3737500637";
                google_ad_width = 728;
                google_ad_height = 90;
                //-->
            </script>
            <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
        <?php else: ?>
            <img class="ad_placehold" src="http://placehold.it/728x90&text=Ad" />
        <?php endif; ?>
    </div>
</div>