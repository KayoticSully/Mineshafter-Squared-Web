$(document).ready(init);

function init() {
    init_iso_views();
    if(init3d()) {
        animate();
    }
}