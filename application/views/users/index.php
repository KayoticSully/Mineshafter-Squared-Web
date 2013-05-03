<div class="container extra-top-padding">
    <h1>
        <?php echo $user->username; ?>'s Profile
    </h1>
    <div id="info">
        <div class="clearfix">
            <div id="preview-wrapper">
                <div id="preview-hints">
                    <small>Click + Drag to change view</small>
                </div>
                <div id="preview" data-render3d data-url="/<?php echo $user->active_skin()->file_path(); ?>">
                </div>
            </div>
            <div id="data">
                <div class="row">
                    <div class="span7">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th colspan="2">User Info</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Last Web Login</th><td><?php echo date('D, d M Y \a\t H:i:s e', $user->last_web_login); ?></td>
                                </tr>
                                <tr>
                                    <th>Last Game Login</th><td><?php echo date('D, d M Y \a\t H:i:s e', $user->last_game_login); ?></td>
                                </tr>
                                <tr>
                                    <th>Joined MS^2</th><td><?php echo date('D, d M Y \a\t H:i:s e', strtotime($user->created_at)); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="server-info">
                <h2>
                    Servers
                </h2>
                <div id="server-list">
                    <div class="server_list_load remove">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="side-ad">
        <?php if (ENVIRONMENT == 'production'): ?>
            <script type="text/javascript"><!--
                google_ad_client = "ca-pub-2130540909688027";
                /* Mineshafter Squared - User Profile Page */
                google_ad_slot = "1592359034";
                google_ad_width = 160;
                google_ad_height = 600;
                //-->
            </script>
            <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
        <?php else: ?>
            <img src="http://placehold.it/160x600&text=Ad" />
        <?php endif; ?>
    </div>
</div>
<script>
    var servers = <?php echo json_encode($servers); ?>
</script>