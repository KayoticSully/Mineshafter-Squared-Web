<div id="skin-container" class="clearfix extra-top-padding">
    <div id="preview-wrapper">
        <?php if($user): ?>
            <div id="actions">
                <?php if($user->active_skin()->id == $skin->id): ?>
                    <button id="remove-active" class="btn" data-id="<?php echo $skin->id; ?>">Remove Active</button>
                <?php else: ?>
                    <button id="set-active" class="btn btn-primary" data-id="<?php echo $skin->id; ?>">Set Active</button>
                <?php endif; ?>
                
                <?php if(in_array_id_check($user, $skin->users)): ?>
                    <button id="remove-from-library" data-id="<?php echo $skin->id; ?>" class="btn btn-danger">Remove From Library</button>
                <?php else: ?>
                    <button id="add-to-library" data-id="<?php echo $skin->id; ?>" class="btn btn-success">Add to Library</button>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div id="preview-hints">
            <small>Click + Drag to change view</small>
        </div>
        <div id="preview" data-render3d data-url="/<?php echo $skin->file_path(); ?>">
        </div>
    </div>
    <div id="skindata">
        <h1>
            <?php echo $skin->name; ?>
        </h1>
        <div id="tags">
            <?php foreach($skin->texture->tags as $tag): ?>
                <span class="label label-<?php echo $tag->color; ?>"><?php echo $tag->name; ?></span>
            <?php endforeach; ?>
        </div>
        <div id="new-tag">
            <?php if($user): ?>
                <form id="new-tag-form">
                    <input type="hidden" name="texture_id" value="<?php echo $skin->id; ?>" />
                    <input type="text" name="tag" placeholder="<?php echo lang('newtag_placeholder'); ?>" rel="popover"
                           data-toggle="popover"
                           data-trigger="manual"
                           data-placement="right"
                           data-original-title="<?php echo lang('newtag_popover_title'); ?>"
                           data-content="<?php echo lang('newtag_popover_content'); ?>"/>
                </form>
            <?php endif; ?>
        </div>
        <div class="media">
            <a class="pull-left" href="#">
                <div class="minecraft_head" data-size="8" data-minecrafthead="/<?php echo $skin->owner->active_skin()->base_location();?>">
                </div>
            </a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo $skin->owner->username; ?></h4>
                Uploaded on <?php echo date('F jS, Y', strtotime($skin->created_at)); ?>
            </div>
        </div>
    </div>
</div>