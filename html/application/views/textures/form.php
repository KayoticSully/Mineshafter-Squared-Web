<?php echo form_open_multipart('#', array('id' => 'texture-form', 'class' => 'form-horizontal')); ?>
    <input type="submit" class="visibility-hidden" />
    <div class="control-group">
        <label class="control-label strong" for="name">Name</label>
        <div class="controls">
            <input required="required" type="text" id="name" name="name" placeholder="Skin Name">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label strong" for="texture-file">File</label>
        <div class="controls">
            <input required="required" type="file" id="texture-file" name="texture-file">
        </div>
    </div>
<?php echo form_close(); ?>