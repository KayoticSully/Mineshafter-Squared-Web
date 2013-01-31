$(document).ready(function(){
    var heads = document.querySelectorAll('[data-minecrafthead]');
    
    for(var i = 0; i < heads.length; i++){
        var head = heads[i];
        var texture = head.dataset.minecrafthead;
        
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
        draw_hat('hat' + i, texture, 25);
        draw_head('head' + i, texture, 25);
    }
    
    var models = document.querySelectorAll('[data-minecraftmodel]');
    for(var i = 0; i < models.length; i++) {
        var model = models[i];
        var texture = model.dataset.minecraftmodel;
        
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
        
        draw_model('model_hat' + i, 'scratch_hat' + i, texture, 10, 'true'); // true = hat
        draw_model('model' + i, 'scratch' + i, texture, 10, 'false'); // false = no hat
    }
});