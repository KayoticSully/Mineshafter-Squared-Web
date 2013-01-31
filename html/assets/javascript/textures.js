$(document).ready(init);

function init() {
    $('#create-texture').on('click', create_texture);
    $('.minecraft_model').on('click', set_active_skin);
    init_iso_views();
    if(init3d()) {
        animate();
    }
}

function create_texture(event) {
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
            window.location.reload(true);
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

function init_iso_views() {
    var heads = document.querySelectorAll('[data-minecrafthead]');
    
    for(var i = 0; i < heads.length; i++){
        var head = heads[i];
        var texture = head.dataset.minecrafthead;
        var size = head.dataset.size;
        
        if(size == undefined) {
            size = 25;
        }
        
        // create hat
        var hat_canvas = document.createElement('canvas');
        hat_canvas.className = 'hat';
        hat_canvas.id = 'hat' + i;
        head.appendChild(hat_canvas);
        
        // creat head
        var head_canvas = document.createElement('canvas');
        head_canvas.className = 'head';
        head_canvas.id = 'head' + i;
        head.appendChild(head_canvas);
        
        // draw
        draw_hat('hat' + i, texture, size);
        draw_head('head' + i, texture, size);
    }
    
    var models = document.querySelectorAll('[data-minecraftmodel]');
    for(var i = 0; i < models.length; i++) {
        var model = models[i];
        var texture = model.dataset.minecraftmodel;
        var size = model.dataset.size;
        
        if(size == undefined) {
            size = 10;
        }
        
        // create hat scratch
        var hat_scratch = document.createElement('canvas');
        hat_scratch.className = 'scratch';
        hat_scratch.id = 'scratch_hat' + i;
        model.appendChild(hat_scratch);
        
        // create model hat
        var model_hat = document.createElement('canvas');
        model_hat.className = 'hat';
        model_hat.id = 'model_hat' + i;
        model.appendChild(model_hat);
        
        // create scratch
        var scratch = document.createElement('canvas');
        scratch.className = 'scratch';
        scratch.id = 'scratch' + i;
        model.appendChild(scratch);
        
        // create model
        var model_canvas = document.createElement('canvas');
        model_canvas.className = 'head';
        model_canvas.id = 'model' + i;
        model.appendChild(model_canvas);
        
        draw_model('model_hat' + i, 'scratch_hat' + i, texture, size, true); // true = hat
        draw_model_left('model' + i, 'scratch' + i, texture, size, true); // false = no hat
    }
}