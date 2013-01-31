<div id="texture-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="texture-modal" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>New Skin</h3>
    </div>
    <div class="alert alert-error hide" id="texture-error">
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
<?php if ($user): ?>
    <div id="preview" data-render3d data-url="<?php echo $active_skin->file_path(); ?>">
    </div>
<?php endif; ?>
<div style="float:left">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#">Private</a>
        </li>
        <li>
            <a href="#">Public</a>
        </li>
        <li>
            <?php if($user): ?>
                <button type="button" id="upload-skin" class="btn btn-inverse" href="/textures/form" data-toggle="modal" data-target="#texture-modal" >Upload Skin</button>
            <?php endif; ?>
        </li>
    </ul>
</div>
<div class="tabbable tabs-left">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#lA" data-toggle="tab">Skins</a></li>
        <li class=""><a href="#lB" data-toggle="tab">Capes</a></li>
    </ul>
    <div id="skin-pane">
        <?php foreach($skins as $skin): ?>
            <!--<div class="minecraft_head" data-size="5" data-minecrafthead="/<?php echo $skin->base_location();?>">
            </div>-->
            <div class="skin">
                <button type="button" class="close">&times;</button>
                <div class="name">
                    <a href="#" title="Preview Skin" class="btn btn-link btn-large">
                        <?php echo $skin->name; ?>
                    </a>
                </div>
                <div class="minecraft_model" data-size="5" title="Set Active"
                     data-minecraftmodel="/<?php echo $skin->base_location();?>"
                     data-id="<?php echo $skin->id; ?>">
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>