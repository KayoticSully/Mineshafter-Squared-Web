$(document).ready(init);

function init() {
    $('#create-texture').on('click', create_texture);
    $('#texture-form').on('submit', create_texture);
    $('.minecraft_model').on('click', set_active_skin);
    init_iso_views();
    if(init3d()) {
        animate();
    }
}

function create_texture(event) {
    event.preventDefault();
    
    // change to loading cursor
    $('html').css('cursor', 'wait');
    
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
        success:function(data) {
            if(data['skin_data'] != undefined) {
                window.location = '/skin/' + data['skin_data']['name'];
            }
        }
    });
}

function set_active_skin(event) {
    var $this = $(this);
    var id = $this.data('id');
    
    $.ajax({
        url: '/textures/set_active_skin/' + id,
        context: $this,
        success: function(data){
            if(data) {
                var model = $(this).data('minecraftmodel');
                model = model.replace('/base.png', '');
                container.dataset.url = model.substring(1);
                init3d();
            }
        }
    });
}