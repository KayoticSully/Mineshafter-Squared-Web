var private_skins = null;
var public_skins = null;
var new_page = false;
$(document).ready(init);

function init() {
    $('#create-texture').on('click', create_texture);
    $('#remove-active').on('click', remove_active_skin);
    $('.toggle-action').on('click', toggle_textures);
    
    texture_actions();
    
    private_skins = new ObjectList();
    public_skins = new ObjectList();
    
    load_skins();
    if(init3d()) {
        animate();
    }
}

function texture_actions() {
    $('.remove-from-library').off('click').on('click', remove_from_library);
    $('.add-to-library').off('click').on('click', add_to_library);
    $('.minecraft_model').off('click').on('click', set_active_skin);
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

function load_skins() {
    var type = 'public';
    if($('#toggle-private').hasClass('active')) {
        type = 'library';
    }
    
    var skin_list = null;
    if(new_page)
    {
        var $skin_pane = $('#skin-pane');
        $skin_pane.html('');
        
        switch(type) {
            case 'public':
                $skin_pane.html(public_skins.toString());
                init_iso_views();
            break;
            
            case 'library':
                $skin_pane.html(private_skins.toString());
                init_iso_views();
            break;
        }
    }
    
    if(type != 'library' || private_skins.size() == 0) {
        $.ajax({
            // always pass public_skin size since it is not used in private texture loading
            url: '/skins/json/' + type + '/' + public_skins.size(),
            dataType:'json',
            context: this,
            success: function(textures) {
                for(var index in textures) {
                    // create texture object
                    var texture = new Texture(textures[index]);
                    // add texture to page
                    $('#skin-pane').append(texture.toString());
                    // keep track of loaded textures
                    
                    var skin_list = null;
                    switch(type) {
                        case 'public':
                            skin_list = public_skins;
                        break;
                        case 'library':
                            skin_list = private_skins;
                        break;
                    }
                    
                    skin_list.add(texture);
                }
                
                init_iso_views();
                
                texture_actions();
            }
        });
    } else {
        texture_actions();
    }
}

function toggle_textures(event) {
    $this = $(this);
    
    if($('.toggle-action.active').attr('id') != $this.attr('id')){
        $('.toggle-action').removeClass('active');
        
        $this.addClass('active');
        new_page = true;
        load_skins();
    }
}