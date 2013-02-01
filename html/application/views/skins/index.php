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
        <div class="media">
            <a class="pull-left" href="#">
                <div class="minecraft_head" data-size="5" data-minecrafthead="/<?php echo $skin->owner->active_skin()->base_location();?>">
                </div>
            </a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo $skin->owner->username; ?></h4>
                Uploaded on <?php echo date('F jS, Y', strtotime($skin->created_at)); ?>
            </div>
        </div>
    </div>
</div>