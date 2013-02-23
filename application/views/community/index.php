<script>
    // get async token from server
    var async_token = "<?php echo $async_token; ?>";
</script>
<div id="submenu" class="navbar navbar-static-top">
    <div class="navbar-inner">
        <div class="submenu-container clearfix">
            <ul class="nav">
                <li><a href="#"><i class="icon-th-list"></i> Topical View</a></li>
                <li><a href="#"><i class="icon-list"></i> List View</a></li>
            </ul>
            <form class="navbar-search form-search pull-left">
                <div class="input-append">
                    <input type="text" class="span2 search-query">
                    <button type="submit" class="btn">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span6 offset2 topics">
            <article id="new-topic" class="topic">
                <div class="media title-post">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64&text=">
                    </a>
                    <div class="media-body">
                        <h3 class="media-heading">
                            <input type="text" class="new-title" placeholder="Create a Topic" />
                        </h3>
                        <textarea class="input" placeholder="Say something about it"></textarea>
                    </div>
                </div>
                <div class="actions">
                    Create your topic, watch what people say.
                </div>
            </article>
            <?php /*for($i = 0; $i < 5; $i++): ?>
            <article class="topic">
                <div class="media title-post">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64&text=">
                    </a>
                    <div class="media-body">
                        <h3 class="media-heading">
                            Topic Title
                        </h3>
                    </div>
                </div>
                <div class="actions">
                    <?php $comments = rand(0, 100); ?>
                    <div class="show-comments">
                        <i class="icon-comment icon-white" title="older"></i>
                        <span class="underline">Comments (<?php echo $comments; ?>)</span>
                    </div>
                    <div class="get-older">
                        <i class="icon-time icon-white" title="older"></i>
                        <span class="underline">History (<?php echo $comments - 2; ?>)</span>
                    </div>
                </div>
                <div class="topic-thread">
                    <div class="comments">
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64&text=">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    Username
                                </h4>
                               
                            </div>
                        </div>
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64&text=">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    Username
                                </h4>
                               
                            </div>
                        </div>
                        <div class="media respond">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64&text=">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    Username
                                </h4>
                                <textarea class="input" placeholder="What do you think?"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            <?php endfor; */ ?>
        </div>
        <div class="span2">
            <br>
            <div>
                Tag Cloud
            </div>
            <div id="sideAd">
                <img class="ad_placehold" src="http://placehold.it/250x250&amp;text=Ad">
            </div>
        </div>
    </div>
</div>