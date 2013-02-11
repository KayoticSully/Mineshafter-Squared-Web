<?php echo form_open_multipart('textures/upload', array('id' => 'texture-form', 'class' => 'form-horizontal')); ?>
    <input type="submit" class="visibility-hidden" />
    <div class="control-group">
        <label class="control-label strong" for="name">Name</label>
        <div class="controls">
            <input required="required" type="text" id="name" name="name" placeholder="Skin Name">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label strong" for="userfile">File</label>
        <div class="controls">
            <input required="required" type="file" id="userfile" name="userfile">
        </div>
    </div>
<?php echo form_close(); ?>
<script>
    $('#texture-form').on('submit', create_texture);
</script>