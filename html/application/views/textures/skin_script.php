<script type="text/javascript">
var container, info;
var camera, scene, renderer;
var xvar = 0;
var targetRotationX = 0;
var targetRotationXOnMouseDown = 0;
var targetRotationY = 0;
var targetRotationYOnMouseDown = 0;
var mouseX = 0;
var mouseXOnMouseDown = 0;
var mouseY = 0;
var mouseYOnMouseDown = 0;
var windowHalfX = window.innerWidth / 2;
var windowHalfY = window.innerHeight / 2;

$(document).ready(function(){
    init();
    animate();
});

function init() {
    container = document.getElementById( 'display' );

    camera = new THREE.Camera(20, window.innerWidth / window.innerHeight, 1, 1000 );
    camera.target.position.x = 0;
    camera.target.position.y = -11;
    camera.target.position.z = 0;
    scene = new THREE.Scene();
    
    //Hat
    var hat_materials = [];
    hat_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/hat_right.png')})]);
    hat_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/hat_left.png')})]);
    hat_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/hat_top.png')})]);
    hat_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/hat_bottom.png')})]);
    hat_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/hat_back.png')})]);
    hat_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/hat_front.png')})]);
    
    hat = new THREE.Mesh( new THREE.CubeGeometry(9, 9, 9, 0, 0, 0, hat_materials), new THREE.MeshFaceMaterial());
    hat.position.x = 0;
    hat.position.y = 0;
    hat.position.z = 0;
    hat.overdraw = true;
    scene.addObject(hat);
    
    //Body
    var body_materials = [];
    body_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/body_right.png')})]);
    body_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/body_left.png')})]);
    body_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/body_top.png')})]);
    body_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/body_bottom.png')})]);
    body_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/body_back.png')})]);
    body_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/body_front.png')})]);
    
    body = new THREE.Mesh( new THREE.CubeGeometry(8, 12, 4, 0, 0, 0, body_materials), new THREE.MeshFaceMaterial());
    body.position.x = 0;
    body.position.y = -10;
    body.position.z = 0;
    body.overdraw = true;
    scene.addObject(body);
    
    //Arm_Left
    var arm_left_materials = [];
    arm_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/arm_left_inner.png')})]);
    arm_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/arm_left_outer.png')})]);
    arm_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/arm_left_top.png')})]);
    arm_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/arm_left_bottom.png')})]);
    arm_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/arm_left_back.png')})]);
    arm_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/arm_left_front.png')})]);
    
    arm_left = new THREE.Mesh( new THREE.CubeGeometry(4, 12, 4, 0, 0, 0, arm_left_materials), new THREE.MeshFaceMaterial());
    arm_left.position.x = 6;
    arm_left.position.y = -10;
    arm_left.position.z = 0;
    arm_left.overdraw = true;
    scene.addObject(arm_left);
    
    //Arm_Right
    var arm_right_materials = [];
    arm_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/arm_right_outer.png')})]);
    arm_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/arm_right_inner.png')})]);
    arm_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/arm_right_top.png')})]);
    arm_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/arm_right_bottom.png')})]);
    arm_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/arm_right_back.png')})]);
    arm_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/arm_right_front.png')})]);
    
    arm_right = new THREE.Mesh( new THREE.CubeGeometry(4, 12, 4, 0, 0, 0, arm_right_materials), new THREE.MeshFaceMaterial());
    arm_right.position.x = -6;
    arm_right.position.y = -10;
    arm_right.position.z = 0;
    arm_right.overdraw = true;
    scene.addObject(arm_right);
    
    //Leg_Left
    var leg_left_materials = [];
    leg_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/leg_left_inner.png')})]);
    leg_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/leg_left_outer.png')})]);
    leg_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/leg_left_top.png')})]);
    leg_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/leg_left_bottom.png')})]);
    leg_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/leg_left_back.png')})]);
    leg_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/leg_left_front.png')})]);
    
    leg_left = new THREE.Mesh( new THREE.CubeGeometry(4, 12, 4, 0, 0, 0, leg_left_materials), new THREE.MeshFaceMaterial());
    leg_left.position.x = 2;
    leg_left.position.y = -22;
    leg_left.position.z = 0;
    leg_left.overdraw = true;
    scene.addObject(leg_left);
    
    //Leg_Right
    var leg_right_materials = [];
    leg_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/leg_right_inner.png')})]);
    leg_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/leg_right_outer.png')})]);
    leg_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/leg_right_top.png')})]);
    leg_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/leg_right_bottom.png')})]);
    leg_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/leg_right_back.png')})]);
    leg_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/leg_right_front.png')})]);
    
    leg_right = new THREE.Mesh( new THREE.CubeGeometry(4, 12, 4, 0, 0, 0, leg_right_materials), new THREE.MeshFaceMaterial());
    leg_right.position.x = -2;
    leg_right.position.y = -22;
    leg_right.position.z = 0;
    leg_right.overdraw = true;
    scene.addObject(leg_right);
    
    //Head
    var head_materials = [];
    head_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/head_right.png')})]);
    head_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/head_left.png')})]);
    head_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/head_top.png')})]);
    head_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/head_bottom.png')})]);
    head_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/head_back.png')})]);
    head_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture('<?php echo $location; ?>/head_front.png')})]);
    
    head = new THREE.Mesh( new THREE.CubeGeometry(8, 8, 8, 0, 0, 0, head_materials), new THREE.MeshFaceMaterial());
    head.position.x = 0;
    head.position.y = 0;
    head.position.z = 0;
    head.overdraw = true;
    scene.addObject(head);
    
    renderer = <?php if(isset($_GET['webgl'])) echo 'new THREE.WebGLRenderer();'; else echo 'new THREE.CanvasRenderer();'; ?>
    //renderer.setSize( window.innerWidth, window.innerHeight );
    renderer.setSize( 800, 400);
    container.appendChild( renderer.domElement );
    document.addEventListener( 'mousedown', onDocumentMouseDown, false );
    document.addEventListener( 'touchstart', onDocumentTouchStart, false );
    document.addEventListener( 'touchmove', onDocumentTouchMove, false );
}

function onDocumentMouseDown( event ) {
    event.preventDefault();
    document.addEventListener( 'mousemove', onDocumentMouseMove, false );
    document.addEventListener( 'mouseup', onDocumentMouseUp, false );
    document.addEventListener( 'mouseout', onDocumentMouseOut, false );
    mouseXOnMouseDown = event.clientX - windowHalfX;
    targetRotationXOnMouseDown = targetRotationX;
    mouseYOnMouseDown = event.clientY - windowHalfY;
    targetRotationYOnMouseDown = targetRotationY;
}

function onDocumentMouseMove( event ) {
    mouseX = event.clientX - windowHalfX;
    targetRotationX = targetRotationXOnMouseDown - ( mouseX - mouseXOnMouseDown ) * 0.02;
    mouseY = event.clientY - windowHalfY;
    targetRotationY = targetRotationYOnMouseDown + ( mouseY - mouseYOnMouseDown ) * 0.02;
}

function onDocumentMouseUp( event ) {
    document.removeEventListener( 'mousemove', onDocumentMouseMove, false );
    document.removeEventListener( 'mouseup', onDocumentMouseUp, false );
    document.removeEventListener( 'mouseout', onDocumentMouseOut, false );
}

function onDocumentMouseOut( event ) {
    document.removeEventListener( 'mousemove', onDocumentMouseMove, false );
    document.removeEventListener( 'mouseup', onDocumentMouseUp, false );
    document.removeEventListener( 'mouseout', onDocumentMouseOut, false );
}

function onDocumentTouchStart( event ) {
    if ( event.touches.length == 1 ) {
        event.preventDefault();
        mouseXOnMouseDown = event.touches[ 0 ].pageX - windowHalfX;
        mouseYOnMouseDown = event.touches[ 0 ].pageY - windowHalfY;
        targetRotationXOnMouseDown = targetRotationX;
        targetRotationYOnMouseDown = targetRotationY;
    }
}

function onDocumentTouchMove( event ) {
    if ( event.touches.length == 1 ) {
        event.preventDefault();
        mouseX = event.touches[ 0 ].pageX - windowHalfX;
        targetRotationX = targetRotationXOnMouseDown + ( mouseX - mouseXOnMouseDown ) * 0.05;
        targetRotationY = targetRotationYOnMouseDown + ( mouseY - mouseYOnMouseDown ) * 0.05;
    }
}

function animate() {
    requestAnimationFrame( animate );
    render();
}

function render() {
    camera.position.x = 0 - 100*Math.sin(targetRotationX);
    camera.position.y = 0 - 50*Math.sin(targetRotationY);
    camera.position.z = 0 - 100*Math.cos(targetRotationX);
    
    xvar += Math.PI/180
    
    //Leg Swing
    leg_left.rotation.x = Math.cos(xvar);
    leg_left.position.z = 0 - 6*Math.sin(leg_left.rotation.x);
    leg_left.position.y = -16 - 6*Math.abs(Math.cos(leg_left.rotation.x));
    leg_right.rotation.x = Math.cos(xvar + (Math.PI));
    leg_right.position.z = 0 - 6*Math.sin(leg_right.rotation.x);
    leg_right.position.y = -16 - 6*Math.abs(Math.cos(leg_right.rotation.x));
    
    //Arm Swing
    arm_left.rotation.x = Math.cos(xvar + (Math.PI));
    arm_left.position.z = 0 - 6*Math.sin(arm_left.rotation.x);
    arm_left.position.y = -4 - 6*Math.abs(Math.cos(arm_left.rotation.x));
    arm_right.rotation.x = Math.cos(xvar);
    arm_right.position.z = 0 - 6*Math.sin(arm_right.rotation.x);
    arm_right.position.y = -4 - 6*Math.abs(Math.cos(arm_right.rotation.x));
    
    renderer.render( scene, camera );
}
</script>