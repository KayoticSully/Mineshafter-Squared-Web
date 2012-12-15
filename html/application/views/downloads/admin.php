<div class="container">
    <div class="row">
        <div class="span2 well">
            <ul class="nav nav-list">
                <li class="nav-header">
                    Download Groups
                </li>
                <?php foreach($download_groups as $group): ?>
                    <li class="group">
                        <a href="<?php echo $group->edit_link(); ?>">
                            <?php echo $group->name; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="app-body" class="span9">
            <h4>
                Welcome to the downloads manager.  Select a group to the left to get started.
            </h4>
        </div>
    </div>
</div>