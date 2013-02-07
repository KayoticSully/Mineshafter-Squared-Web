<div id="texture-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="texture-modal" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>New Skin</h3>
    </div>
    <div class="alert alert-error hide" id="upload-error">
    </div>
    <div class="modal-body">
        <div class="center_load">
            &nbsp;
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary" id="create-texture">Upload</button>
    </div>
</div>
<div id="control-bar">
    <div id="preview-hints">
        <small>Click + Drag to change view</small>
    </div>
    <div id="preview" data-render3d data-url="/<?php if(isset($active_skin)){ echo $active_skin->file_path(); } ?>">
    </div>
    <div id="action-list">
        <a type="button" id="remove-active" data-default="/<?php if ($default_skin){ echo $default_skin->file_path(); } ?>" class="btn btn-link">Remove Skin</a>
        <?php if($user): ?>
            <a type="button" id="upload-skin" class="btn btn-link" href="/textures/form" data-toggle="modal" data-target="#texture-modal" >Upload Skin</a>
        <?php endif; ?>
    </div>
    <div id="toggle-search" class="toggle-action">
        <form class="form-search">
            <div class="input-append">
                <input type="text" class="span2 search-query" placeholder="tag, name, etc."
                       rel="popover"
                       data-toggle="popover"
                       data-trigger="focus"
                       data-placement="right"
                       data-original-title="<?php echo lang('search_popover_title'); ?>"
                       data-content="<?php echo lang('search_popover_content'); ?>" >
                <button type="submit" class="btn">Search</button>
            </div>
        </form>
    </div>
    <?php if($user):
        $public_active = '';
    ?>
        <div id="toggle-private" class="toggle-action active">
            My Library
        </div>
    <?php else:
            $public_active = 'active';
          endif; ?>
    <div id="toggle-public" class="toggle-action <?php echo $public_active ?>">
        Public
    </div>
    <div id="server_list_ad">
        <?php if (ENVIRONMENT == 'production'): ?>
            <script type="text/javascript">
                <!--
                google_ad_client = "ca-pub-2130540909688027";
                /* Mineshafter Squared Server List */
                google_ad_slot = "4694039834";
                google_ad_width = 250;
                google_ad_height = 250;
                //-->
            </script>
            <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
        <?php else: ?>
            <img class="ad_placehold" src="http://placehold.it/250x250&text=Ad" />
        <?php endif; ?>
    </div>
</div>
<div id="texture-display">
    <div id="skin-pane">
        
    </div>
</div>