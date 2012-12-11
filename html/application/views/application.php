<nav id="main-nav">
    <ul id="nav_list">
        <li>
            <i class="icon-list"></i>
            Server List
        </li>
        <li>
            <i class="icon-group"></i>
            Skins / Capes
        </li>
        <li>
            <i class="icon-question-sign"></i>
            Help
        </li>
        <li>
            <i class="icon-group"></i>
            Community
        </li>
        <li id="login_wrapper">
            <div id="login_form">
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
            </div>
        </li>
    </ul>
</nav>
<?php //$this->load->view('page-nav'); ?>
<div id="content" data-spy="scroll" data-target="#page-nav">
    <?php echo $content; ?>
</div>