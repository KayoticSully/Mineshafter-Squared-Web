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
    <code class="comment">
        // Downloads will be grouped by type and look similar to the announcements 
    </code>
    <div>
        <?php foreach($downloads as $download): ?>
            <?php echo $download->name; ?>
            <br>
        <?php endforeach; ?>
    </div>
</section>