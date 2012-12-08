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
            <?php foreach($downloads as $download): ?>
                <?php echo $download->name; ?>
                <br>
            <?php endforeach; ?>
    </div>
</section>