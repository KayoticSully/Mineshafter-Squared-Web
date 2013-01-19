<div id="server-list" class="container">
    <div class="alert alert-block">
        <h4>Warning!</h4>
        Since this is an alpha there is a chance that the server list
        information might need to be deleted before release.  I will put up
        announcements anytime data on the alpha needs to be purged.
    </div>
    <div class="navbar">
        <div class="navbar-inner">
            <a class="brand" href="#">Filters</a>
            <ul class="nav">
                <li><a href="#">Online</a></li>
            </ul>
            <ul class="nav">
                <li>
                    <form class="navbar-form">
                        <input type="text" class="span2">
                        <button type="submit" class="btn">Search</button>
                    </form>
                </li>
            </ul>
            <?php if ($user): ?>
                <ul class="nav pull-right">
                    <li>
                        <form class="navbar-form">
                            <a class="btn btn-success" id="add-server">Add a Server</a>
                        </form>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
    <div class="alert alert-error hide" id="serverlist-error">
    </div>
    <section id="new-server">
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
    </section>
    <?php foreach($servers as $server): ?>
        <section>
            <div class="quick-info">
                <div class="online-info">
                    <?php /*<span class="badge badge-important">
                        <i class="icon-remove icon-white"></i>
                    </span> */ ?>
                    <span class="badge badge-success">
                        <i class="icon-ok icon-white"></i>
                    </span>
                    <span class="players">
                        ? / 20
                    </span>
                </div>
                <hr>
                <div class="vote-info">
                   <i class="icon-arrow-up"></i> 999 <span class="small-text">votes</span>
                </div>
            </div>
            <div class="details">
                <div class="name">
                    <a href="<?php echo $server->page_link(); ?>">
                        <?php echo $server->name; ?>
                    </a>
                </div>
                <div class="info">
                    <?php
                        echo $server->address;
                        if ($server->port != '25565')
                        {
                            echo ':' . $server->port;
                        }
                    ?>
                </div>
                <hr />
                <div class="description">
                    <?php echo $server->description; ?>
                </div>
            </div>
        </section>
    <?php endforeach; ?>
</div>