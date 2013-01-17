<div id="server-list" class="container">
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
            <ul class="nav pull-right">
                <li>
                    <form class="navbar-form">
                        <a class="btn btn-success" id="add-server">Add a Server</a>
                    </form>
                </li>
            </ul>
        </div>
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
               <button type="button" class="btn btn-success">Save Server</button>
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
    <?php for($i = 0; $i < 2; $i++): ?>
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
                    <a href="#">
                        Mineshafter Squared Official Server
                    </a>
                </div>
                <div class="info">
                    server.mineshaftersquared.com
                </div>
                <hr />
                <div class="description">
                    The official Mineshafter Squared server is a place where everyone is welcome (except griefers).
                    It also provides you with a way to make sure your proxy is working.
                </div>
            </div>
        </section>
    <?php endfor; ?>
</div>