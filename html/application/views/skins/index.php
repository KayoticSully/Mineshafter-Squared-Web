<div id="" class="container extra-top-padding">
    <div id="preview-wrapper">
        <div id="preview-hints">
            <small>Click + Drag to change view</small>
        </div>
        <div id="preview" data-render3d data-url="/<?php echo $skin->file_path(); ?>">
        </div>
    </div>
    <div id="skindata">
        <h1><?php echo $skin->name; ?></h1>
        <?php if($user): ?>
            <?php if($user->active_skin()->id == $skin->id): ?>
                <button id="remove-active" class="btn" data-id="<?php echo $skin->id; ?>">Remove Active</button>
            <?php else: ?>
                <button id="set-active" class="btn btn-primary" data-id="<?php echo $skin->id; ?>">Set Active</button>
            <?php endif; ?>
            <button class="btn btn-success">Add to Library</button>
        <?php endif; ?>
        <div class="media">
            <a class="pull-left" href="#">
                <div class="minecraft_head" data-size="5" data-minecrafthead="/<?php echo $skin->owner->active_skin()->base_location();?>">
                </div>
            </a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo $skin->owner->username; ?></h4>
                Uploaded on <?php echo date('F jS, Y', strtotime($skin->created_at)); ?>
            </div>
            <div>
                <span class="label label-important">Public</span>
                <span class="label label-info">Video Games</span>
                <span class="label label-info">Nintendo</span>
            </div>
            <div id="new-tag">
                <input type="text" placeholder="Add Tag" />
            </div>
        </div>
    </div>
</div>