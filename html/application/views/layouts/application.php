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
        <li id="login_form">
            <form action="#" method="GET">
                <div class="nav_form_label">
                    <i class="icon-user"></i>
                    Login
                </div>
                <div class="login_section">
                    <input type="text" placeholder="Username" />
                    <input type="password" placeholder="Password" />
                </div>
                <div class="login_section">
                    <input type="submit" value="Login" class="btn btn-primary" />
                    <a class="btn btn-link" target="_blank" href="http://minecraft.net/resetpassword">Lost Password?</a>
                </div>
            </form>
        </li>
    </ul>
</nav>
<?php //$this->load->view('page-nav'); ?>
<div class="clearfix">
    <?php echo $content; ?>
</div>