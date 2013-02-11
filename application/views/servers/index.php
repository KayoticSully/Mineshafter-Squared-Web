<div id="server-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="server-modal" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 id="myModalLabel">Edit Server</h3>
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
        <input type="submit" value="Save" id="update-server" class="btn btn-primary" />
    </div>
</div>
<div id="server-<?php echo $server->id; ?>" class="container extra-top-padding">
    <div id="server-data" data-json="<?php echo html_escape($json); ?>"></div>
    <div class="navbar navbar-inverse">
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
            <?php if ($owner): ?>
                <ul class="nav pull-right">
                    <li>
                        <form id="owner-actions" class="navbar-form">
                            <a data-toggle="modal" href="/servers/form/<?php echo $server->id; ?>" data-target="#server-modal" class="btn btn-primary">Edit Server</a>
                        </form>
                    </li>
                </ul>
            <?php endif; ?>
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
                    <table class="table table-bordered table-striped table-hover">
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
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th colspan="2">Plugins</th>
                                </tr>
                            </thead>
                            <tbody id="Plugins">
                            </tbody>
                        </table>
                    </table>
                </div>
                <div class="span4">
                    <table class="table table-bordered table-striped table-hover">
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
    </div>
</div>