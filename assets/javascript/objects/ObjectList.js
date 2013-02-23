/*
 |---------------------------------------------------------------------
 | Object List
 |---------------------------------------------------------------------
 | Represents a list of objects
 |---------------------------------------------------------------------
 | Author(s): Ryan Sullivan
 |   Created: 1/18/2013
 |   Updated: 2/4/2013
 |---------------------------------------------------------------------
 */
var object_count = 0;

var ObjectList = (function() {
    function ObjectList() {
        this.objects = new Array();
        
        this.add = function(object) {
            if(object instanceof ObjectList) {
                this.objects = this.objects.concat(object.objects);
            } else {
                this.objects.push(object);
            }
        }
        
        this.size = function() {
            return this.objects.length;
        }
    }
    
    return ObjectList;
})();

ObjectList.prototype.toString = function() {
    var str = '';
    for(var object in this.objects) {
        str += this.objects[object];
        object_count++;
    }
    
    return str;
}

ObjectList.prototype.has_id = function(id) {
    for(var index in this.objects) {
        var object = this.objects[index];
        if(object.id == id)
        {
            return true;
        }
    }
    
    return false;
}

ObjectList.prototype.find_by_id = function(id) {
    for(var index in this.objects) {
        var object = this.objects[index];
        if(object.id == id)
        {
            return object;
        }
    }
    
    return false;
}

/**
 * remove
 *
 * Removes an object in the objects array if that object has an element called id
 * and the id matches the parameter
 */
ObjectList.prototype.remove = function(id) {
    for(var index in this.objects) {
        var object = this.objects[index];
        if(object.id == id)
        {
            this.objects.splice(index, 1);
            return true;
        }
    }
    
    return false;
}