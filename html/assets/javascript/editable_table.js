var // page globals
action_class    = '.row-action',
ajax_uri        = '',
delete_function = 'delete_row',
save_function   = 'save_row';

// Initialize the page
function editable_table_init()
{
    // acts as init
    ajax_uri = $('table#editable').data('ajax-uri');
    $(action_class).off('click').on('click', do_action);
}

// handles actions on records
function do_action()
{
    var $this = $(this),
        row   = $this.parents('tr');
    
    switch($this.data('action'))
    {
        case 'edit':
            edit_row(row);
        break;
        
        case 'delete':
            delete_row(row);
        break;
        
        case 'save':
            save_row(row);
        break;
        
        case 'cancel':
            cancel_edit(row);
        break;
    }
}

// edit action handler
function edit_row(row)
{
    // switch all editable fields over to input
    row.find('.editable').each(function(){
        var $this   = $(this),
            data    = $this.html().trim(),
            field   = $this.data('field'),
            html    = '<input type="text" name="' + field + '" value="' + data + '" />';
            
        $this.html(html);
        $this.data('old', data);
    });
    
    // switch actions over
    row.find('.actions').hide();
    row.find('.edit-actions').show();
}

function delete_row(row)
{
    var row_id = row.data('row-id');
    
    // make server request
    $.ajax({
        url     : ajax_uri + '/' + delete_function + '/' + row_id,
        context : row,
        success : function(response)
        {
            if(response == true)
                $(this).detach();
        }
    });
}

function cancel_edit(row)
{
    // switch all editable fields over to old values
    row.find('.editable').each(function(){
        var $this   = $(this),
            data    = $this.data('old').trim();
            
        $this.html(data);
    });
    
    // switch actions over
    row.find('.edit-actions').hide();
    row.find('.actions').show();
}

function save_row(row)
{
    // remove actions
    row.find('.edit-actions').hide();
    
    // add loading animation
    row.find('.loading').show();
    
    // serialize row
    var data_map = {},
        row_id  = row.data('row-id');
    
    row.find('.editable').each(function(){
        var $this   = $(this),
            data    = $this.find('input').val().trim(),
            field   = $this.data('column').trim();
        
        data_map[field] = data;
    });
    
    // make server request
    $.ajax({
        url     : ajax_uri + '/' + save_function + '/' + row_id,
        type    : 'post',
        data    : data_map,
        context : row,
        success : function(response)
        {
            if(response == 'true')
            {
                var $this = $(this);
                $this.find('.editable').each(function(){
                    var $this   = $(this),
                        data    = $this.find('input').val().trim();
                        
                    $this.html(data);
                });
                
                // remove loading animation
                $this.find('.loading').hide();
                
                // switch actions over
                $this.find('.edit-actions').hide();
                $this.find('.actions').show();
            }
        }
    });
}