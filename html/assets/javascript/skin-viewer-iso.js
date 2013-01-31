//Draw an isometric model of a minecraft character
function draw_model(canvas_id,scratch_id,url,scale,hat) {
    var model = document.getElementById(canvas_id).getContext('2d');
    var scratch = document.getElementById(scratch_id).getContext('2d');
    
    //Resize Scratch
    document.getElementById(scratch_id).width = 64*scale;
    document.getElementById(scratch_id).height = 32*scale;
    
    //Resize Isometric Area (Found by trial and error)
    document.getElementById(canvas_id).width = 20*scale;
    document.getElementById(canvas_id).height = 44.8*scale;
    
    var skin = new Image();
    skin.src = url;
    
    skin.onload = function(){
        //Draw the skin on to the scratch
        scratch.drawImage(skin,0,0,64,32,0,0,64,32);
        //Scale it
        scale_image(scratch.getImageData(0,0,64,32), scratch, 0, 0, scale);
        //Left Leg
        //Left Leg - Front
        model.setTransform(1,-0.5,0,1.2,0,0);
        model.scale(-1,1);
        model.drawImage(document.getElementById(scratch_id), 4*scale, 20*scale, 4*scale, 12*scale, -16*scale, 34.4/1.2*scale, 4*scale, 12*scale);
        
        //Right Leg
        //Right Leg - Right
        model.setTransform(1,0.5,0,1.2,0,0);
        model.drawImage(document.getElementById(scratch_id), 0*scale, 20*scale, 4*scale, 12*scale, 4*scale, 26.4/1.2*scale, 4*scale, 12*scale);
        //Right Leg - Front
        model.setTransform(1,-0.5,0,1.2,0,0);
        model.drawImage(document.getElementById(scratch_id), 4*scale, 20*scale, 4*scale, 12*scale, 8*scale, 34.4/1.2*scale, 4*scale, 12*scale);
        
        //Arm Left
        //Arm Left - Front
        model.setTransform(1,-0.5,0,1.2,0,0);
        model.scale(-1,1);
        model.drawImage(document.getElementById(scratch_id), 44*scale, 20*scale, 4*scale, 12*scale, -20*scale, 20/1.2*scale, 4*scale, 12*scale);
        //Arm Left - Top
        model.setTransform(-1,0.5,1,0.5,0,0);
        model.drawImage(document.getElementById(scratch_id), 44*scale, 16*scale, 4*scale, 4*scale, 0, 16*scale, 4*scale, 4*scale);
        
        //Body
        //Body - Front
        model.setTransform(1,-0.5,0,1.2,0,0);
        model.drawImage(document.getElementById(scratch_id), 20*scale, 20*scale, 8*scale, 12*scale, 8*scale, 20/1.2*scale, 8*scale, 12*scale);
        
        //Arm Right
        //Arm Right - Right
        model.setTransform(1,0.5,0,1.2,0,0);
        model.drawImage(document.getElementById(scratch_id), 40*scale, 20*scale, 4*scale, 12*scale, 0, 16/1.2*scale, 4*scale, 12*scale);
        //Arm Right - Front
        model.setTransform(1,-0.5,0,1.2,0,0);
        model.drawImage(document.getElementById(scratch_id), 44*scale, 20*scale, 4*scale, 12*scale, 4*scale, 20/1.2*scale, 4*scale, 12*scale);
        //Arm Right - Top
        model.setTransform(-1,0.5,1,0.5,0,0);
        model.scale(-1,1);
        model.drawImage(document.getElementById(scratch_id), 44*scale, 16*scale, 4*scale, 4*scale, -16*scale, 16*scale, 4*scale, 4*scale);
        
        //Head
        //Head - Front
        model.setTransform(1,-0.5,0,1.2,0,0);
        model.drawImage(document.getElementById(scratch_id), 8*scale, 8*scale, 8*scale, 8*scale, 10*scale, 13/1.2*scale, 8*scale, 8*scale);
        //Head - Right
        model.setTransform(1,0.5,0,1.2,0,0);
        model.drawImage(document.getElementById(scratch_id), 0, 8*scale, 8*scale, 8*scale, 2*scale, 3/1.2*scale, 8*scale, 8*scale);
        //Head - Top
        model.setTransform(-1,0.5,1,0.5,0,0);
        model.scale(-1,1);
        model.drawImage(document.getElementById(scratch_id), 8*scale, 0, 8*scale, 8*scale, -3*scale, 5*scale, 8*scale, 8*scale);
        
        if(hat == true) {
            if(!is_one_color(scratch.getImageData(40*scale,8*scale,8*scale,8*scale))) {
                //Hat
                //Hat - Front
                model.setTransform(1,-0.5,0,1.2,0,0);
                model.drawImage(document.getElementById(scratch_id), 40*scale, 8*scale, 8*scale, 8*scale, 10*scale, 13/1.2*scale, 8*scale, 8*scale);
                //Hat - Right
                model.setTransform(1,0.5,0,1.2,0,0);
                model.drawImage(document.getElementById(scratch_id), 32*scale, 8*scale, 8*scale, 8*scale, 2*scale, 3/1.2*scale, 8*scale, 8*scale);
                //Hat - Top
                model.setTransform(-1,0.5,1,0.5,0,0);
                model.scale(-1,1);
                model.drawImage(document.getElementById(scratch_id), 40*scale, 0, 8*scale, 8*scale, -3*scale, 5*scale, 8*scale, 8*scale);
            }
        }
    }
}

//Draw the model facing the other way (left)
function draw_model_left(canvas_id,scratch_id,url,scale,hat) {
    //Draws an isometric model of the given minecraft url
    var model = document.getElementById(canvas_id).getContext('2d');
    var scratch = document.getElementById(scratch_id).getContext('2d');
    
    //Resize Scratch
    document.getElementById(scratch_id).width = 64*scale;
    document.getElementById(scratch_id).height = 32*scale;
    
    //Resize Isometric Area (Found by trial and error)
    document.getElementById(canvas_id).width = 20*scale;
    document.getElementById(canvas_id).height = 44.8*scale;
    
    var skin = new Image();
    //skin.src = 'http://s3.amazonaws.com/MinecraftSkins/' + url + '.png' - Causes DOM Security Errors. So I made a php script that grabs it instead.
    skin.src = url;
    
    skin.onload = function(){
        //Draw the skin on to the scratch
        scratch.drawImage(skin,0,0);
        //Scale it
        scale_image(scratch.getImageData(0,0,64,32), scratch, 0, 0, scale);
        
        //Left Leg
        //Left Leg - Left
        model.setTransform(1,-0.5,0,1.2,0,0);
        model.scale(-1,1);
        model.drawImage(document.getElementById(scratch_id), 0*scale, 20*scale, 4*scale, 12*scale, -16*scale, 36.4/1.2*scale, 4*scale, 12*scale);
        //Left Leg - Front
        model.setTransform(1,0.5,0,1.2,0,0);
        model.scale(-1,1);
        model.drawImage(document.getElementById(scratch_id), 4*scale, 20*scale, 4*scale, 12*scale, -12*scale, 24.4/1.2*scale, 4*scale, 12*scale);
        
        //Right Leg
        //Right Leg - Front
        model.setTransform(1,0.5,0,1.2,0,0);
        model.drawImage(document.getElementById(scratch_id), 4*scale, 20*scale, 4*scale, 12*scale, 4*scale, 24.4/1.2*scale, 4*scale, 12*scale);
        
        //Arm Left
        //Arm Left - Left
        model.setTransform(1,-0.5,0,1.2,0,0);
        model.scale(-1,1);
        model.drawImage(document.getElementById(scratch_id), 40*scale, 20*scale, 4*scale, 12*scale, -20*scale, 26/1.2*scale, 4*scale, 12*scale);
        //Arm Left - Front
        model.setTransform(1,0.5,0,1.2,0,0);
        model.scale(-1,1);
        model.drawImage(document.getElementById(scratch_id), 44*scale, 20*scale, 4*scale, 12*scale, -16*scale, 10/1.2*scale, 4*scale, 12*scale);
        //Arm Left - Top
        model.setTransform(1,0.5,-1,0.5,0,0);
        model.scale(-1,1);
        model.drawImage(document.getElementById(scratch_id), 44*scale, 16*scale, 4*scale, 4*scale, -26*scale, 6*scale, 4*scale, 4*scale);
        
        //Body
        //Body - Front
        model.setTransform(1,0.5,0,1.2,0,0);
        model.drawImage(document.getElementById(scratch_id), 20*scale, 20*scale, 8*scale, 12*scale, 4*scale, 10/1.2*scale, 8*scale, 12*scale);
        
        //Arm Right - Front
        model.setTransform(1,0.5,0,1.2,0,0);
        model.drawImage(document.getElementById(scratch_id), 44*scale, 20*scale, 4*scale, 12*scale, 0*scale, 10/1.2*scale, 4*scale, 12*scale);
        //Arm Right - Top
        model.setTransform(1,0.5,-1,0.5,0,0);
        model.drawImage(document.getElementById(scratch_id), 44*scale, 16*scale, 4*scale, 4*scale, 10*scale, 6*scale, 4*scale, 4*scale);
        
        //Head
        //Head - Left
        model.setTransform(1,-0.5,0,1.2,0,0);
        model.drawImage(document.getElementById(scratch_id), 16*scale, 8*scale, 8*scale, 8*scale, 10*scale, 13/1.2*scale, 8*scale, 8*scale);
        //Head - Front
        model.setTransform(1,0.5,0,1.2,0,0);
        model.drawImage(document.getElementById(scratch_id), 8*scale, 8*scale, 8*scale, 8*scale, 2*scale, 3/1.2*scale, 8*scale, 8*scale);
        //Head - Top
        model.setTransform(1,0.5,-1,0.5,0,0);
        model.drawImage(document.getElementById(scratch_id), 8*scale, 0, 8*scale, 8*scale, 5*scale, -5*scale, 8*scale, 8*scale);
        
        if(hat == true) {
            if(!is_one_color(scratch.getImageData(40*scale,8*scale,8*scale,8*scale))) {
                //Hat
                //Hat - Left
                model.setTransform(1,-0.5,0,1.2,0,0);
                model.drawImage(document.getElementById(scratch_id), 48*scale, 8*scale, 8*scale, 8*scale, 10*scale, 13/1.2*scale, 8*scale, 8*scale);
                //Hat - Front
                model.setTransform(1,0.5,0,1.2,0,0);
                model.drawImage(document.getElementById(scratch_id), 40*scale, 8*scale, 8*scale, 8*scale, 2*scale, 3/1.2*scale, 8*scale, 8*scale);
                //Hat - Top
                model.setTransform(1,0.5,-1,0.5,0,0);
                model.drawImage(document.getElementById(scratch_id), 40*scale, 0, 8*scale, 8*scale, 5*scale, -5*scale, 8*scale, 8*scale);
            }
        }
    }
}

//Draw minecraft skin's hat over head
function draw_hat(canvas_id,url,scale) {
    var hat = document.getElementById(canvas_id).getContext('2d');
    
    //Resize Canvas
    document.getElementById(canvas_id).width = 8*scale;
    document.getElementById(canvas_id).height = 8*scale;
    
    //User's Minecraft Skin
    var skin = new Image();
    skin.src = url;
    
    skin.onload = function(){
        //Draw hat initially so we can test if it's one color
        hat.drawImage(skin,40,8,8,8,0,0,8,8);
        if(is_one_color(hat.getImageData(0,0,8,8))) {
            //Clear the canvas
            hat.clearRect(0,0,8,8);
            //Draw the head
            hat.drawImage(skin,8,8,8,8,0,0,8,8);
        } else {
            //Draw the head
            hat.drawImage(skin,8,8,8,8,0,0,8,8);
            //Draw the hat
            hat.drawImage(skin,40,8,8,8,0,0,8,8);
        }
        
        //Scale the hat
        scale_image(hat.getImageData(0,0,8,8), hat, 0, 0, scale);
    };
}

//Draw minecraft skin's head
function draw_head(canvas_id,url,scale) {
    var canvas = document.getElementById(canvas_id).getContext('2d');
    
    //Resize Canvas
    document.getElementById(canvas_id).width = 8*scale;
    document.getElementById(canvas_id).height = 8*scale;
    
    //User's Minecraft Skin
    var head_original = new Image();
    head_original.src = url;
    
    head_original.onload = function(){
        //Draw the head
        canvas.drawImage(head_original,8,8,8,8,0,0,8,8);
        //Scale the head
        scale_image(canvas.getImageData(0,0,8,8), canvas, 0, 0, scale);
    };
}

//Checks if the provided imageData is one color
function is_one_color(imageData) {
    var width = imageData.width;
    var height = imageData.height;
    var is_one_color = true;
    
    //Get First Pixel Color
    var pixel_data = "" + imageData.data[0] + imageData.data[1] + imageData.data[2]
    for(y=0; y<height; y++) { //height original
        for(x=0; x<width; x++) { //width original
            //Gets original colour, then makes a rectangle of it
            var index = (x + y * width) * 4;
            var compare = "" + imageData.data[index+0] + imageData.data[index+1] + imageData.data[index+2]
            if (compare !== pixel_data) {
                //Break loop if not one color
                is_one_color = false;
                break;
            }
            //Break loop if not one color
            if(is_one_color == false) break;
        }
    }
    
    return is_one_color;
}

//Scales using nearest neighbour
function scale_image(imageData, context, d_x, d_y, scale) {
    var width = imageData.width;
    var height = imageData.height;
    context.clearRect(0,0,width,height); //Clear the spot where it originated from
    for(y=0; y<height; y++) { //height original
        for(x=0; x<width; x++) { //width original
            //Gets original colour, then makes a scaled square of the same colour
            var index = (x + y * width) * 4;
            context.fillStyle = "rgba(" + imageData.data[index+0] + "," + imageData.data[index+1] + "," + imageData.data[index+2] + "," + imageData.data[index+3] + ")";
            context.fillRect(d_x + x*scale, d_y + y*scale, scale, scale);
        }
    }
}