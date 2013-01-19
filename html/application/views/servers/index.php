<div id="server-<?php echo $server->id; ?>" class="container extra-top-padding">
    <div id="server-data" data-json="<?php echo html_escape($json); ?>"></div>
    <div class="navbar">
        <div class="navbar-inner">
            <span id="online-badge" class="badge">
                ?
            </span>
            <span class="brand">
                <?php echo $server->name; ?>
                <span id="HostName" class="loading light">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </span>
            </span>
        </div>
    </div>
    <div id="leftInfo">
        <script type="text/javascript">
        <!--
            google_ad_client = "ca-pub-2130540909688027";
            /* MS^2 Server Wide */
            google_ad_slot = "2958771438";
            google_ad_width = 160;
            google_ad_height = 600;
        //-->
        </script>
        <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
    </div>
    <div id="rightInfo">
        <section>
            <div class="row">
                <div class="span10">
                    <div class="well">
                        <?php echo $server->description; ?>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <div class="span6">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2">Server Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>IP / URL</th><td><?php echo $server->full_address(); ?></td>
                            </tr>
                            <tr>
                                <th>Status</th><td id="Online"></td>
                            </tr>
                            <tr>
                                <th>Game Type</th><td id="GameType"></td>
                            </tr>
                            <tr>
                                <th>Version</th><td id="Version"></td>
                            </tr>
                            <tr>
                                <th>Map</th><td id="Map"></td>
                            </tr>
                            <tr>
                                <th>Software</th><td id="Software"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="span4">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th id="Players">Players</th>
                            </tr>
                        </thead>
                        <tbody id="PlayerList">
                        </tbody>
                    </table>
                </div>
        </section>
        <section>
            <div class="row">
                <div class="span6">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th colspan="2">Plugins</th>
                            </tr>
                        </thead>
                        <tbody id="Plugins">
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>