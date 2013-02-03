$(document).ready(init);

function init() {
    $('#set-active').on('click', set_active_skin);
    $('#remove-active').on('click', remove_active_skin);
    $('#new-tag-form').on('submit', add_tag);
    $('#add-to-library').on('click', add_to_library);
    $('#remove-from-library').on('click', remove_from_library);
    
    // control tags popover
    if($('#tags').html().trim() != '') {
        $('#new-tag input[type=text]').popover('destroy');
    } else{
        $('#new-tag input[type=text]').popover('show');
    }
    
    init_iso_views();
    if(init3d()) {
        animate();
    }
}

function add_tag(event) {
    event.preventDefault();
    var $this = $(this);
    var data = $this.serialize();
    
    $this.find('input').attr('disabled', 'disabled');
    $this.find('input').popover('destroy');

    $.ajax({
        url:     '/textures/add_tag',
        type:    'get',
        data:    data,
        dataType:'json',
        context: $this,
        success: function(data) {
            
            var $this = $(this);
            var tags  = data['tags'];
            
            $this.find('input').val('').removeAttr('disabled');
            
            for(var tag in tags) {
                $('#tags').append("\n" + '<span class="label label-info">' + tags[tag] + '</span>');
            }
        }
    });
}