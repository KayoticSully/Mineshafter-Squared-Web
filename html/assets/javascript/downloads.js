var // page globals
group_class     = '.group',
group_action    = '.group-action',
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
    editable_table_init();
    $(group_class).off('click').on('click', select_group);
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