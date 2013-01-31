$(document).ready(function(){
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
        
        draw_model('model_hat' + i, 'scratch_hat' + i, texture, size, 'true'); // true = hat
        draw_model('model' + i, 'scratch' + i, texture, size, 'false'); // false = no hat
    }
});