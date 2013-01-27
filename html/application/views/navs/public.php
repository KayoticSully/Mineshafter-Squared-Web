<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="#">Mineshafter Squared</a>
            <ul class="nav">
                <li <?php if($active_menu == 'home') echo 'class="active"'; ?>>
                    <a href="/">
                        <i class="icon-home"></i>
                        Home
                    </a>
                </li>
                <li <?php if($active_menu == 'server_list') echo 'class="active"'; ?>>
                    <a href="/server_list">
                        <i class="icon-th-list"></i>
                        Server List
                    </a>
                </li>
                <li <?php if($active_menu == 'textures') echo 'class="active"'; ?>>
                    <a href="/textures">
                        <i class="icon-th-large"></i>
                        Skins / Capes
                    </a>
                </li>
                <li <?php if($active_menu == 'help') echo 'class="active"'; ?>>
                    <a href="#" rel="popover" data-toggle="popover" data-placement="bottom" data-content="Mineshafter Squared has honestly never had that great of a help system, thats about to change." data-original-title="Not Available Yet">
                        <i class="icon-question-sign"></i>
                        Help
                    </a>
                </li>
                <li>
                    <a href="#" rel="popover" data-toggle="popover" data-placement="bottom" data-content="The Mineshafter Squared forums have been offline for quite some time now, and I do apologize for that.  I hope the new community will be able to make up for it." data-original-title="Not Available Yet">
                        <i class="icon-globe"></i>
                        Community
                    </a>
                </li>
                <?php if ($user): ?>
                    <li class="dropdown">
                        <div id="user-logged-in" data-id"<?php echo $user->id; ?>"></div>
                        <a id="admin-menu" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i>
                            <?php echo $user->username; ?>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="admin-menu">
                            <li>
                                <a tabindex="-1" href="/auth/logout?page=<?php echo $_SERVER['REQUEST_URI']; ?>">
                                    Logout
                                </a>
                            </li>
                            <?php if ($user->is_admin()): ?>
                                <li class="nav-header">
                                    Admin
                                </li>
                                <li>
                                    <a tabindex="-1" href="/datas/admin">
                                        Data
                                    </a>
                                </li>
                                <li>
                                    <a tabindex="-1" href="/downloads/admin">
                                        Downloads
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php else: ?>
                    <li>
                        <a data-toggle="modal" href="/home/login_form" id="show-login" data-target="#login-modal" role="button"  >
                            <i class="icon-user"></i>
                            Log in
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>