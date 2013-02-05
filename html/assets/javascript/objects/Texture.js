/*
 |---------------------------------------------------------------------
 | Texture
 |---------------------------------------------------------------------
 | Represents a texture
 |---------------------------------------------------------------------
 | Author(s): Ryan Sullivan
 |   Created: 2/4/2013
 |   Updated: 2/4/2013
 |---------------------------------------------------------------------
 */
var Texture = (function() {
    function Texture(baseObject) {
        /**
         * Variables that are loaded:
         * id:int
         * name:string
         * location:string
         * in_library:bool
         */
        for(key in baseObject) {
            this[key] = baseObject[key];
        }
    }
    
    return Texture;
})();

Texture.prototype.toString = function() {
    var str = '<div class="skin">';
    
    // adds proper add/remove from library button
    if(this.in_library) {
        str += '<a class="close remove-from-library" data-id="' + this.id + '" title="Remove from library">&times;</a>';
    } else {
        str += '<a class="close add-to-library" data-id="' + this.id + '" title="Add to library"><i class="icon-ok"></i></a>';
    }
    
        str += '<div class="name">' +
                    '<a href="/skin/' + this.name + '" title="Preview Skin" class="btn btn-link btn-large">' +
                        this.name +
                    '</a>' +
                '</div>' +
                '<div class="minecraft_model" data-size="5" title="Set Active" ' +
                     'data-minecraftmodel="/' + this.location + '" ' +
                     'data-id="' + this.id + '">' +
                '</div>' +
            '</div>'; // closes the div opened earlier of class skin
    return str;
}