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
                       data-original-title="Help me make search great"
                       data-content="In order to make search well, I first need data. Please tag and name skins appropriately so search can be as useful as possible for everyone when it is finished." >
                <button type="submit" class="btn">Search</button>
            </div>
        </form>
    </div>
    <?php if($user): ?>
        <div id="toggle-private" class="toggle-action">
            My Library
        </div>
    <?php endif; ?>
    <div id="toggle-public" class="toggle-action">
        Public
    </div>
</div>
<div id="texture-display">
    <div id="skin-pane">
        <?php foreach($skins as $skin): ?>
            <div class="skin">
                <?php if ($user): ?>
                    <?php if(in_array_id_check($user, $skin->users)): ?>
                        <a class="close remove-from-library" data-id="<?php echo $skin->id; ?>" title="Remove from library">&times;</a>
                    <?php else: ?>
                        <a class="close add-to-library" data-id="<?php echo $skin->id; ?>" title="Add to library"><i class="icon-ok"></i></a>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="name">
                    <a href="/skin/<?php echo $skin->name; ?>" title="Preview Skin" class="btn btn-link btn-large">
                        <?php echo $skin->name; ?>
                    </a>
                </div>
                <div class="minecraft_model" data-size="5" title="Set Active"
                     data-minecraftmodel="/<?php echo $skin->base_location(); ?>"
                     data-id="<?php echo $skin->id; ?>">
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>