<section>
    <form id="edit_group_form" href="#" class="form-horizontal" data-group-id="<?php echo $group->id; ?>">
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
    </form>
</section>
<section>
    <legend>
        Files
    </legend>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>
                    Name
                </th>
                <th>
                    Link
                </th>
                <th>
                    Downloads
                </th>
                <th>
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($group->downloads as $download): ?>
                <tr data-file-id="<?php echo $download->id; ?>">
                    <td class="editable" data-field="name">
                        <?php echo $download->name; ?>
                    </td>
                    <td class="editable" data-field="link">
                        <?php echo $download->link; ?>
                    </td>
                    <td>
                        <?php echo $download->number_of_downloads; ?>
                    </td>
                    <td>
                        <div class="actions">
                            <i class="icon-edit file-action" title="Edit" data-action="edit"></i>
                            <i class="icon-trash file-action" title="Delete" data-action="delete"></i>
                        </div>
                        <div class="edit-actions hide">
                            <i class="icon-ok file-action" title="Save" data-action="save"></i>
                            <i class="icon-remove file-action" title="Cancel" data-action="cancel"></i>
                        </div>
                        <div class="loading hide">
                            &nbsp;
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>