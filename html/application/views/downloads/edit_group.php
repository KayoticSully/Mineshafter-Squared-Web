<section>
    <?php echo form_open('#', array('id' => 'edit_group_form',
                                    'class' => 'form-horizontal',
                                    'data-group-id' => $group->id)); ?>
        <fieldset>
            <legend>
                <span id="name-field">
                    <?php echo $group->name; ?>
                </span>
                <button class="btn group-action" id="edit">Edit</button>
            </legend>
            <div class="control-group">
                <label class="control-label" for="version">Version</label>
                <div id="version-field" class="controls">
                    <?php echo $group->version; ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="description">Description</label>
                <div id="description-field" class="controls">
                    <?php echo $group->description; ?>
                </div>
            </div>
        </fieldset>
    <?php echo form_close(); ?>
</section>
<section>
    <?php editable_table("Files",
                         "/downloads",
                         $group->downloads,
                         array(
                               array('Name', 'name', true),
                               array('Link', 'link', true),
                               array('Downloads', 'number_of_downloads', false)
                         )
                        );
    ?>
</section>