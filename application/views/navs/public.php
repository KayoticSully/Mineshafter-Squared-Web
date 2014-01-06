<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="brand">Mineshafter Squared</div>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li <?php if($active_menu == 'home') echo 'class="active"'; ?>>
                        <a href="/">
                            <i class="icon-home icon-white"></i>
                            Home
                        </a>
                    </li>
                    <li <?php if($active_menu == 'server_list') echo 'class="active"'; ?>>
                        <a href="/server_list">
                            <i class="icon-th-list icon-white"></i>
                            Server List
                        </a>
                    </li>
                    <li <?php if($active_menu == 'textures') echo 'class="active"'; ?>>
                        <a href="/textures">
                            <i class="icon-th-large icon-white"></i>
                            Skins / Capes
                        </a>
                    </li>
                    <li>
                        <a href="http://www.reddit.com/r/MineshafterSquared" rel="popover">
                            <i class="icon-globe icon-white"></i>
                            Community
                        </a>
                    </li>
                    <?php if ($user): ?>
                        <li class="dropdown">
                            <div id="user-logged-in" data-id"<?php echo $user->id; ?>"></div>
                            <a id="admin-menu" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-user icon-white"></i>
                                <?=$user->username;?>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="admin-menu">
                                <li>
                                    <a id="profile" tabindex="-1" href="/user/<?php echo $user->username; ?>">
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a id="logout" tabindex="-1" href="/auth/logout?page=<?php echo $_SERVER['REQUEST_URI']; ?>">
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
                                <i class="icon-user icon-white"></i>
                                Login
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
