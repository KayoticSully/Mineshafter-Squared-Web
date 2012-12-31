<nav id="main-nav">
    <ul id="nav_list">
        <li <?php if($active_menu == 'server list') echo 'class="active"'; ?>>
            <a href="#">
                <i class="icon-list"></i>
                Server List
            </a>
        </li>
        <li>
            <a href="#">
                <i class="icon-group"></i>
                Skins / Capes
            </a>
        </li>
        <li>
            <a href="#">
                <i class="icon-question-sign"></i>
                Help
            </a>
        </li>
        <li>
            <a href="#">
                <i class="icon-group"></i>
                Community
            </a>
        </li>
        <li id="login_form_wrapper">
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
        </li>
    </ul>
</nav>
<?php //$this->load->view('page-nav'); ?>
<div id="site-body" class="clearfix">
    <?php echo $content; ?>
</div>