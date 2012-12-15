<form class="form-horizontal">
    <fieldset>
        <legend>
            <?php echo $group->name; ?>
        </legend>
        <div class="control-group">
            <label class="control-label" for="rename">Rename</label>
            <div class="controls">
                <input type="text" id="rename" name="rename" placeholder="<?php echo $group->name; ?>" />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="version">Version</label>
            <div class="controls">
                <input type="text" id="version" name="version" value="<?php echo $group->version; ?>" />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="description">Description</label>
            <div class="controls">
                <textarea rows="5" id="description" name="description"><?php echo $group->description; ?></textarea>
            </div>
        </div>
    </fieldset>
</form>