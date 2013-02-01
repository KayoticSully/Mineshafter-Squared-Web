<?php foreach($download_groups as $group): ?>
    <article>
        <header>
            <?php echo $group->name; ?>
        </header>
        <div class="body download">
            <div class="description">
                <?php echo $group->description; ?>
            </div>
            <ul class="download links">
                <?php foreach($group->downloads as $download): ?>
                    <li>
                        <a href="<?php echo $download->link; ?>">
                            <?php echo $download->name; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <footer>
            Version <?php echo $group->version; ?>
        </footer>
    </article>
<?php endforeach; ?>