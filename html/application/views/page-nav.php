<nav id="page-nav" class="navbar">
    <div class="navbar-inner">
        <ul class="nav">
<?php
    /**
     * This switch controls the page menu depending on the
     * controller that is loaded.  Most pages will only have
     * one controller function that outputs a page so this
     * works well.  If a controller needs to have more than
     * one page-output function, the logic required to
     * change the nav can be done within the controller's
     * case.
     */
    switch($this->router->fetch_class())
    {
        default:
        case 'home': ?>
            <li>
                <a href="#about">
                    <i class="icon-info-sign"></i>
                    About
                </a>
            </li>
            <li>
                <a href="#announcements">
                    <i class="icon-comment"></i>
                    Announcements
                </a>
            </li>
            <li>
                <a href="#downloads">
                    <i class="icon-download"></i>
                    Downloads
                </a>
            </li>
            <li>
                <a href="#videos">
                    <i class="icon-facetime-video"></i>
                    Videos
                </a>
            </li>
        <?php break;
    }
?>
        </ul>
    </div>
</nav>