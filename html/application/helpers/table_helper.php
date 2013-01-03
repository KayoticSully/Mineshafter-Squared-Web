<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @name    editable_table
 *
 * Builds a table to be used with the interactive table library
 *
 * @access	public
 * @return	true on success false otherwise
 */

// helper functions for this controller
if (! function_exists('editable_table'))
{
    function editable_table($table_name, $ajax_uri, $data_object, $header_settings)
    {
        // build table headers
        $header_html = '';
        $headers = array();
        
        foreach($header_settings as $key => $value)
        {
            // parse input, we need to determine the
            // column name and if the field should
            // be editable
            if (is_numeric($key))
            {
                // nothing was set so the column is the array value
                // default editable value to false
                $headers[] = array($value, 'false');
            }
            else
            {
                if ($value)
                    $editable = 'true';
                else
                    $editable = 'false';
                    
                // editable setting was set, so key is the column
                // pass editable setting though
                $headers[] = array($key, $editable);
            }
            
            // get the column name that was just added and capitalize the first
            // character in every word.
            $column = ucwords($headers[count($headers) - 1][0]);
            $header_html .="<th>$column</th>";
        }
        
        // add the extra header for actions
        $header_html .="<th>Actions</th>";
        
        ?>
            <legend>
                <?php echo $table_name; ?>
            </legend>
            <table id="editable" class="table table-striped" data-ajax-uri="<?php echo $ajax_uri; ?>">
                <thead>
                    <tr>
                        <?php echo $header_html; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data_object as $data): ?>
                        <tr data-row-id="<?php echo $data->id; ?>">
                            <?php foreach ($headers as $header): ?>
                                <td <?php if($header[1]) echo 'class="editable"'; ?> data-column="<?php echo $header[0]; ?>">
                                    <?php echo $data->$header[0]; ?>
                                </td>
                            <?php endforeach; ?>
                            <td>
                                <div class="actions">
                                    <i class="icon-edit row-action" title="Edit" data-action="edit"></i>
                                    <i class="icon-trash row-action" title="Delete" data-action="delete"></i>
                                </div>
                                <div class="edit-actions hide">
                                    <i class="icon-ok row-action" title="Save" data-action="save"></i>
                                    <i class="icon-remove row-action" title="Cancel" data-action="cancel"></i>
                                </div>
                                <div class="loading hide">
                                    &nbsp;
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php
    }
}