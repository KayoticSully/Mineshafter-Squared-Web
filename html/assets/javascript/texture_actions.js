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
                }
            }
        }
    });
}