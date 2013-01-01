<nav id="main-nav">
    <ul id="nav_list">
        <li <?php if($active_menu == 'downloads') echo 'class="active"'; ?>>
            <a href="/downloads/admin">
                <i class="icon-download"></i>
                Downloads
            </a>
        </li>
        <li <?php if($active_menu == 'datas') echo 'class="active"'; ?>>
            <a href="/datas/admin">
                <i class="icon-book-open"></i>
                Data
            </a>
        </li>
        <li>
            <a href="#">
                <i class="icon-question-sign"></i>
                ????
            </a>
        </li>
        <li>
            <a href="#">
                <i class="icon-question-sign"></i>
                ????
            </a>
        </li>
        <li>
            <a href="#">
                <i class="icon-question-sign"></i>
                ????
            </a>
        </li>
        <li>
            <a href="#">
                <i class="icon-question-sign"></i>
                ????
            </a>
        </li>
        <li>
            <a href="#">
                <i class="icon-question-sign"></i>
                ????
            </a>
        </li>
        <li>
            <a href="#">
                <i class="icon-question-sign"></i>
                ????
            </a>
        </li>
        <li>
            <a href="#">
                <i class="icon-question-sign"></i>
                ????
            </a>
        </li>
    </ul>
</nav>
<?php //$this->load->view('page-nav'); ?>
<div class="clearfix">
    <?php echo $content; ?>
</div>