function set_active_skin(event) {
    var $this = $(this);
    var id = $this.data('id');
    
    $.ajax({
        url: '/skin/set_active/' + id,
        context: $this,
        success: function(data){
            if(data) {
                if($this.is('button')) {
                    $this.html('Remove Active').removeClass('btn-primary');
                    $this.attr('id', 'remove-active');
                    
                    var $remove = $('#add-to-library');
                    $remove.html('Remove from Library').removeClass('btn-success').addClass('btn-danger');
                    $remove.attr('id', 'remove-from-library');
                } else {
                    var model = $(this).data('minecraftmodel');
                    model = model.replace('/base.png', '');
                    container.dataset.url = model.substring(1);
                    init3d();
                }
            }
        }
    });
}

function remove_active_skin(event) {
    var $this = $(this);
    
    $.ajax({
        url: '/skin/remove_active',
        context: $this,
        success: function(data){
            if(data) {
                if($this.is('button')) {
                    $this.html('Set Active').addClass('btn-primary');
                    $this.attr('id', 'set-active');
                } else {
                    container.dataset.url = $this.data('default');
                    init3d();
                }
            }
        }
    });
}

function add_to_library(event) {
    var $this = $(this);
    var id = $this.data('id');
    
    $.ajax({
        url: '/skin/add_to_library/' + id,
        context: $this,
        success: function(data){
            var $this = $(this);
            
            if(data) {
                if($this.is('button')) {
                    $this.html('Remove from Library').removeClass('btn-success').addClass('btn-danger');
                    
                } else {
                    $this.html('&times;');
                    $this.attr('title', 'Remove from library');
                }
                
                $this.attr('id', 'remove-from-library');
                
                if(private_skins !== undefined) {
                    // don't make a needless call if the id is already in the list
                    if(!private_skins.has_id(id)) {
                        $.ajax({
                            url : '/skin/json/' + id,
                            dataType:'json',
                            success: function(json) {
                                var texture = new Texture(json);
                                
                                var texture = public_skins.find_by_id(id);
                                
                                if(texture) {
                                    texture.in_library = true;
                                }
                                
                                if($('#toggle-private').hasClass('active')) {
                                    $('#skin_pane').append(texture.toString());
                                    init_iso_views();
                                }
                                
                                private_skins.add(texture);
                            }
                        });
                    }
                }
            }
        }
    });
}

function remove_from_library(event) {
    var $this = $(this);
    var id = $this.data('id');
    
    $.ajax({
        url: '/skin/remove_from_library/' + id,
        context: $this,
        success: function(data){
            var $this = $(this);
            if(data) {
                if($this.is('button')) {
                    $this.html('Add to Library').removeClass('btn-danger').addClass('btn-success');
                } else {
                    $this.html('<i class="icon-ok"></i>');
                    $this.attr('title', 'Add to library');
                }
                
                $this.attr('id', 'add-to-library');
                
                if(private_skins !== undefined) {
                    var texture = public_skins.find_by_id(id);
                    
                    if(texture) {
                        texture.in_library = false;
                    }
                    
                    private_skins.remove(id);
                }
            }
        }
    });
}