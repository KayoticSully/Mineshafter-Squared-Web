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
                <li>
                    <a href="#">
                        <i class="icon-th-large"></i>
                        Skins / Capes
                    </a>
                </li>
                <li <?php if($active_menu == 'help') echo 'class="active"'; ?>>
                    <a href="/help">
                        <i class="icon-question-sign"></i>
                        Help
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-globe"></i>
                        Community
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php /*
<nav id="main-nav">
    <ul id="nav_list">
        
        <li id="login_form_wrapper">
            <?php if ($user): ?>
                <div class="nav_form_label">
                    <code class="comment">Active Skin Here</code>
                </div>
                <div class="login_section">
                    <a href="#" id="username">
                        <?php echo $user->username; ?>
                    </a>
                    <br>
                    <code class="comment">Other info here</code>
                </div>
                <div class="login_section">
                    <?php if ($user->type->level <= 0): ?>
                        <a href="/admin" class="btn btn-small btn-info">Admin</a>
                        <br>
                    <?php endif; ?>
                    <a href="/auth/logout" class="btn btn-small btn-primary">Logout</a>
                </div>
            <?php else: ?>
                <form action="/auth/login" method="POST" id="login_form">
                    <div class="nav_form_label">
                        <i class="icon-user"></i>
                        Login
                    </div>
                    <div class="login_section" id="login_fields">
                        <input type="text" id="username" name="username" placeholder="Username" />
                        <input type="password" id="password" name="password" placeholder="Password" />
                    </div>
                    <div class="login_section" id="login_actions">
                        <input type="submit" value="Login" class="btn btn-small btn-primary" />
                        <a class="btn btn-link" target="_blank" href="http://minecraft.net/resetpassword">Lost Password?</a>
                    </div>
                    <div class="login_section login_load hide">&nbsp;</div>
                    <div class="login_section login_message hide">
                        &nbsp;
                    </div>
                    <div class="login_section message_dismiss hide">
                        <input type="button" class="btn btn-small btn-primary" id="dismiss" value="Ok" />
                    </div>
                </form>
            <?php endif; ?>
        </li>
    </ul>
</nav>
*/ ?>