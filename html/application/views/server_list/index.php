<div id="server-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="server-modal" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 id="myModalLabel">New Server</h3>
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
        <input type="submit" value="Create" id="create-server" class="btn btn-primary" />
    </div>
</div>
<div id="server-list" class="container extra-top-padding">
    <div class="alert alert-block">
        <strong>Warning!</strong> Since this is an alpha there is a chance that the server list
        information might need to be deleted before release.  I will put up
        announcements anytime data on the alpha needs to be purged.
    </div>
    <div class="navbar">
        <div class="navbar-inner">
            <a class="brand" href="#">Filters</a>
            <?php /*<ul class="nav">
                <li><a href="#">Online</a></li>
            </ul>
            <ul class="nav">
                <li>
                    <form class="navbar-form">
                        <input type="text" class="span2">
                        <button type="submit" class="btn">Search</button>
                    </form>
                </li>
            </ul>*/ ?>
            <?php if ($user): ?>
                <ul class="nav pull-right">
                    <li>
                        <form class="navbar-form">
                            <a data-toggle="modal" href="/servers/form" data-target="#server-modal" class="btn">Add a Server</a>
                        </form>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
    
    <?php /*<section id="new-server">
        <div class="quick-info">
            <div class="online-info">
                <span class="badge">
                    ?
                </span>
                <span class="players">
                    ? / ?
                </span>
            </div>
            <hr>
            <div class="vote-info">
               <button type="button" class="btn btn-success" id="create-server">Save Server</button>
            </div>
        </div>
        <div class="details">
            <div class="name">
                <a href="#" class="editable" id="serverName" contenteditable>
                    Server Name
                </a>
            </div>
            <div class="info editable" id="serverAddress" contenteditable>
                Server IP / URL
            </div>
            <hr />
            <div class="description editable" id="serverText" contenteditable>
                Add a short description.
            </div>
        </div>
    </section> */ ?>
</div>