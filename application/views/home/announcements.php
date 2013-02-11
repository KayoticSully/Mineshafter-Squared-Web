<?php foreach($posts as $post): ?>
    <article>
        <header>
            <a target="_blank" href="<?php echo $post->post_url; ?>">
                <?php echo $post->title; ?>
            </a>
        </header>
        <div class="body">
            <?php echo $post->body; ?>
        </div>
        <footer>
            <?php echo $post->date; ?>
        </footer>
    </article>
<?php endforeach; ?>