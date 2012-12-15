var // page globals
group_class     = '.group';

// Start JS only when DOM is ready
$(document).ready(init);

// Initialize the page
function init()
{
    events_init();
}

// Set up all events for this page
function events_init()
{
    $(group_class).on('click', select_group);
}

// Loads page for selected group
function select_group( event )
{
    // we don't want to reload the page if JS is working
    event.preventDefault();
    
    // display feedback for loading 
    $(this).addClass('loading');
    
    // load page content for that group
    $.ajax({
        url     : $(this).find('a').attr('href'),
        context : this,
        success : function( html )
        {
            // display page
            $('#app-body').html(html);
            
            // visually select group
            $(group_class).removeClass('loading active');
            $(this).addClass('active');
        }
    });
}