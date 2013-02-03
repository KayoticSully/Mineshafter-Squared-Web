$(document).ready(init);

function init() {
    $('#create-texture').on('click', create_texture);
    $('.minecraft_model').on('click', set_active_skin);
    $('#remove-active').on('click', remove_active_skin);
    $('.remove-from-library').on('click', remove_from_library);
    $('.add-to-library').on('click', add_to_library);
    
    init_iso_views();
    if(init3d()) {
        animate();
    }
}

function create_texture(event) {
    event.preventDefault();
    
    // change to loading cursor
    $('html').css('cursor', 'wait');
    
    // hide last error
    $('#upload-error').fadeOut();
    
    // BAM File upload via Ajax!
    // Get form data. The element MUST BE THE FORM not an element
    // in the form (as obvious as that is, I need this comment here)
    var form_data = new FormData(document.getElementById('texture-form'));
    $.ajax({
        url: "/textures/upload_skin",
        type: "POST",
        data: form_data,
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery that you know better about the content
        dataType: 'json',
        success:handleUploadResponse
    });
}

function handleUploadResponse(data) {
    $('html').css('cursor', 'auto');
    
    if(data['error'] != undefined) {
        var alert = '<h4>Error!</h4> ' + data['error'];
        $('#upload-error').html(alert).slideDown();
    }
    
    if(data['skin_data'] != undefined) {
        window.location = '/skin/' + data['skin_data']['name'];
    }
}