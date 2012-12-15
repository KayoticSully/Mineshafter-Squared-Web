var // page globals
group_class     = '.group',
action_class    = '.file-action',
group_action    = '.group-action',
save_file_url   = '/downloads/save_file/',
save_group_url   = '/downloads/save_group/';

// Start JS only when DOM is ready
$(document).ready(init);

// Initialize the page
function init()
{
    // acts as init
    events_reset();
}

// Set up all events for this page
function events_reset()
{
    $(group_class).off('click').on('click', select_group);
    $(action_class).off('click').on('click', do_action);
    $(group_action + '#edit').off('click').on('click', edit_group);
    $(group_action + '#save').off('click').on('click', save_group);
    $(group_action + '#cancel').off('click').on('click', cancel_edit_group);
}

// Loads page for selected group
function select_group( event )
{
    // we don't want to reload the page if JS is working
    event.preventDefault();
    
    // display feedback for loading 
    $(this).addClass('loading_link');
    
    // load page content for that group
    $.ajax({
        url     : $(this).find('a').attr('href'),
        context : this,
        success : function( html )
        {
            // display page
            $('#app-body').html(html);
            
            // visually select group
            $(group_class).removeClass('loading_link active');
            $(this).addClass('active');
            
            // reset events
            events_reset();
        }
    });
}

// handles actions on file records
function do_action()
{
    var $this = $(this),
        row   = $this.parents('tr');
    
    
    switch($this.data('action'))
    {
        case 'edit':
            edit_download(row);
        break;
        
        case 'delete':
            delete_download(row);
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
function edit_download(row)
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

function delete_download(row)
{
    var file_id = row.data('file-id');
    
    // make server request
    $.ajax({
        url     : save_file_url + file_id,
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
        file_id  = row.data('file-id');
    
    row.find('.editable').each(function(){
        var $this   = $(this),
            data    = $this.find('input').val().trim(),
            field   = $this.data('field').trim();
        
        data_map[field] = data;
    });
    
    // make server request
    $.ajax({
        url     : save_file_url + file_id,
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

function edit_group(event)
{
    event.preventDefault();
    
    // get the group form
    var form        = $('#edit_group_form'),
        name        = form.find('#name-field').html().trim(),
        version     = form.find('#version-field').html().trim(),
        description = form.find('#description-field').html().trim();
    
    form.find('legend').after(
                '<div class="control-group">' +
                    '<label class="control-label" for="name">Name</label>' +
                    '<div class="controls">' +
                        '<input type="text" id="name" name="name" value="' + name + '" />' +
                    '</div>' +
                '</div>').data('name', name);
    
    form.find('#version-field').html('<input type="text" id="version" name="version" value="' + version + '" />')
    form.find('input#version').data('old', version);
    
    form.find('#description-field').html('<textarea rows="5" id="description" name="description">' + description + '</textarea>');
    form.find('textarea#description').data('old', description);
    
    var button = form.find('#edit');
    button.attr('id', 'save');
    button.html('Save');
    
    var cancel_button = button.clone();
    cancel_button.attr('id', 'cancel');
    cancel_button.html('Cancel');
    
    button.after(cancel_button);
    
    events_reset();
}

function save_group(event)
{
    event.preventDefault();
    
    var form        = $('#edit_group_form'),
        group_id    = form.data('group-id'),
        form_data   = form.serialize();
    
    form.find('legend button').hide();
    form.find('#name-field').after('<div class="loading_legend">&nbsp</div>')
    
    $.ajax({
        url     : save_group_url + group_id,
        type    : 'post',
        data    : form_data,
        context : form,
        success : function(response)
        {
            if(response == 'true')
            {
                var $this       = $(this),
                    name        = $this.find('input#name').val().trim(),
                    version     = $this.find('input#version').val().trim(),
                    description = $this.find('textarea#description').val().trim();
                
                $this.find('#name-field').html(name);
                $this.find('#version-field').html(version);
                $this.find('#description-field').html(description);
                
                $this.find('.control-group').first().detach();
                
                var button = form.find('#save');
                button.attr('id', 'edit');
                button.html('Edit');
                
                form.find('#cancel').detach();
                
                form.find('legend button').show();
                form.find('legend .loading_legend').detach();
                
                events_reset();
            }
        }
    });
}

function cancel_edit_group(event)
{
    event.preventDefault();
    
    var form        = $('#edit_group_form'),
        version     = form.find('input#version').data('old').trim(),
        description = form.find('textarea#description').data('old').trim();
    
    form.find('#version-field').html(version);
    form.find('#description-field').html(description);
    
    form.find('.control-group').first().detach();
    
    var button = form.find('#save');
    button.attr('id', 'edit');
    button.html('Edit');
    
    form.find('#cancel').detach();
    
    events_reset();
}