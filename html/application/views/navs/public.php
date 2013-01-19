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