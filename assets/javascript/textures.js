var private_skins = null;
var public_skins = null;
var new_page = false;
var loading = false;
var textureCap = false;
var timeoutLocation = null;
var controlBarLock = false;

$(document).ready(init);

function init() {
    $('#create-texture').on('click', create_texture);
    $('#remove-active').on('click', remove_active_skin);
    $('.toggle-action').on('click', toggle_textures);
    $(window).on('scroll', pageScroll);
    
    texture_actions();
    
    private_skins = new ObjectList();
    private_skins.cap = false;
    
    public_skins = new ObjectList();
    public_skins.cap = false;
    
    load_skins();
    
    $('#control-bar').css('height', $(document).height());
    
    $(document).scroll(function(){
        var scroll = parseInt($('body').scrollTop()) + 40;
        
        if(scroll >= 150 && !controlBarLock) {
            $('#control-bar').addClass('fixed-control-bar');
            controlBarLock = true;
        } else if(scroll < 150 && controlBarLock) {
            controlBarLock = false;
            $('#control-bar').removeClass('fixed-control-bar');
        }
    });
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
        if(data['info'] != undefined) {
            var alert = '<h4>Info!</h4> ' + data['info'];
            $('#upload-error').removeClass('alert-error').addClass('alert-info').html(alert).slideDown();
            
            timeoutLocation = '/skin/' + data['skin_data']['name'];
            
            setTimeout(function(){
                window.location = timeoutLocation;
            }, 2000);
        } else {
            window.location = '/skin/' + data['skin_data']['name'];
        }
    }
}

function load_skins() {
    $('.toggle-action.active').addClass('loading_link');
    loading = true;
    var type = 'public';
    if($('#toggle-private').hasClass('active')) {
        type = 'library';
    }
    
    if(new_page)
    {
        var $skin_pane = $('#skin-pane');
        $skin_pane.html('');
        new_page = false;
        
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
    
    var skin_list = null;
    switch(type) {
        case 'public':
            skin_list = public_skins;
        break;
        
        case 'library':
            skin_list = private_skins;
        break;
    }
    
    if(!skin_list.cap) {
        $.ajax({
            // always pass public_skin size since it is not used in private texture loading
            url: '/skins/json/' + type + '/' + skin_list.size(),
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
                    
                    // max response length
                    if(textures.length < 20) {
                        skin_list.cap = true;
                    }
                    
                    skin_list.add(texture);
                    
                }
                
                init_iso_views();
                
                $('.toggle-action.active').removeClass('loading_link');
                
                texture_actions();
                loading = false;
            }
        });
    } else {
        $('.toggle-action.active').removeClass('loading_link');
        texture_actions();
        loading = false;
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

function pageScroll(event) {
    var $window = $(window);
    var scrollTop = $window.scrollTop();
    var windowHeight = $window.height();
    var documentHeight = $(document).height();
    
    if(scrollTop + windowHeight >= documentHeight && !loading && !textureCap) {
        load_skins();
    }
}