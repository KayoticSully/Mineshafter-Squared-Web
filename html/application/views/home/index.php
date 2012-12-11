<section id="announcements" class="col">
    <h1>
        Announcements
    </h1>
    <div id="post_track">
        
    </div>
</section>
<section id="downloads" class="col">
    <h1>
        Downloads
    </h1>
    <div>
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
                                <a href="<?php echo $download->link; ?>" class="btn btn-link">
                                    <?php echo $download->name; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <footer class="center">
                    Version <?php echo $group->version; ?>
                </footer>
            </article>
        <?php endforeach; ?>
    </div>
</section>