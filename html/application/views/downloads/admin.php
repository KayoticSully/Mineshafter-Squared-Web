<div class="container">
    <div class="row">
        <div class="span2 well">
            <ul class="nav nav-list">
                <li class="nav-header">
                    Download Groups
                </li>
                <?php foreach($download_groups as $group): ?>
                    <li>
                        <a href="#">
                            <?php echo $group->name; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="span10">
        </div>
    </div>
</div>