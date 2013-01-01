<div class="container">
    <div class="row">
        <div class="span12">
            <section>
                <legend>
                    All of the Datas
                </legend>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>
                                Key
                            </th>
                            <th>
                                Value
                            </th>
                            <th>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datas as $data): ?>
                            <tr data-file-id="<?php echo $data->id; ?>">
                                <td class="editable" data-field="key">
                                    <?php echo $data->key; ?>
                                </td>
                                <td class="editable" data-field="value">
                                    <?php echo $data->value; ?>
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
        </div>
    </div>
</div>
