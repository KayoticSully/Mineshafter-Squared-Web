/**
 * 3-D Minecraft Skin Viewer
 * By Kent Rasmussen @ earthiverse.ath.cx
 * Using Three.Js HTML5 3D Engine from https://github.com/mrdoob/three.js/
 *
 * Modified (slightly) by Ryan Sullivan @ mineshaftersquared.com
 */
var container, info, url;
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
    init3d();
    animate();
});

function init3d() {
    container = document.querySelectorAll('[data-render3d]')[0];
    url  = container.dataset.url;
    var $container = $(container);
    
    // Camera :ToDo: Figure out what these parameters are and what they do
    camera = new THREE.Camera(20, window.innerWidth / window.innerHeight, 1, 1000);
    
    // set camera target
    camera.target.position.x = 0;
    camera.target.position.y = -11;
    camera.target.position.z = 0;
    
    // get Scene
    scene = new THREE.Scene();
    
    //Hat
    var hat_materials = [];
    hat_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/hat_right.png')})]);
    hat_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/hat_left.png')})]);
    hat_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/hat_top.png')})]);
    hat_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/hat_bottom.png')})]);
    hat_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/hat_back.png')})]);
    hat_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/hat_front.png')})]);
    
    hat = new THREE.Mesh( new THREE.CubeGeometry(9, 9, 9, 0, 0, 0, hat_materials), new THREE.MeshFaceMaterial());
    hat.position.x = 0;
    hat.position.y = 0;
    hat.position.z = 0;
    hat.overdraw = true;
    scene.addObject(hat);
    
    //Body
    var body_materials = [];
    body_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/body_right.png')})]);
    body_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/body_left.png')})]);
    body_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/body_top.png')})]);
    body_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/body_bottom.png')})]);
    body_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/body_back.png')})]);
    body_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/body_front.png')})]);
    
    body = new THREE.Mesh( new THREE.CubeGeometry(8, 12, 4, 0, 0, 0, body_materials), new THREE.MeshFaceMaterial());
    body.position.x = 0;
    body.position.y = -10;
    body.position.z = 0;
    body.overdraw = true;
    scene.addObject(body);
    
    //Arm_Left
    var arm_left_materials = [];
    arm_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/arm_left_inner.png')})]);
    arm_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/arm_left_outer.png')})]);
    arm_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/arm_left_top.png')})]);
    arm_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/arm_left_bottom.png')})]);
    arm_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/arm_left_back.png')})]);
    arm_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/arm_left_front.png')})]);
    
    arm_left = new THREE.Mesh( new THREE.CubeGeometry(4, 12, 4, 0, 0, 0, arm_left_materials), new THREE.MeshFaceMaterial());
    arm_left.position.x = 6;
    arm_left.position.y = -10;
    arm_left.position.z = 0;
    arm_left.overdraw = true;
    scene.addObject(arm_left);
    
    //Arm_Right
    var arm_right_materials = [];
    arm_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/arm_right_outer.png')})]);
    arm_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/arm_right_inner.png')})]);
    arm_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/arm_right_top.png')})]);
    arm_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/arm_right_bottom.png')})]);
    arm_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/arm_right_back.png')})]);
    arm_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/arm_right_front.png')})]);
    
    arm_right = new THREE.Mesh( new THREE.CubeGeometry(4, 12, 4, 0, 0, 0, arm_right_materials), new THREE.MeshFaceMaterial());
    arm_right.position.x = -6;
    arm_right.position.y = -10;
    arm_right.position.z = 0;
    arm_right.overdraw = true;
    scene.addObject(arm_right);
    
    //Leg_Left
    var leg_left_materials = [];
    leg_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/leg_left_inner.png')})]);
    leg_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/leg_left_outer.png')})]);
    leg_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/leg_left_top.png')})]);
    leg_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/leg_left_bottom.png')})]);
    leg_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/leg_left_back.png')})]);
    leg_left_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/leg_left_front.png')})]);
    
    leg_left = new THREE.Mesh( new THREE.CubeGeometry(4, 12, 4, 0, 0, 0, leg_left_materials), new THREE.MeshFaceMaterial());
    leg_left.position.x = 2;
    leg_left.position.y = -22;
    leg_left.position.z = 0;
    leg_left.overdraw = true;
    scene.addObject(leg_left);
    
    //Leg_Right
    var leg_right_materials = [];
    leg_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/leg_right_inner.png')})]);
    leg_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/leg_right_outer.png')})]);
    leg_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/leg_right_top.png')})]);
    leg_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/leg_right_bottom.png')})]);
    leg_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/leg_right_back.png')})]);
    leg_right_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/leg_right_front.png')})]);
    
    leg_right = new THREE.Mesh( new THREE.CubeGeometry(4, 12, 4, 0, 0, 0, leg_right_materials), new THREE.MeshFaceMaterial());
    leg_right.position.x = -2;
    leg_right.position.y = -22;
    leg_right.position.z = 0;
    leg_right.overdraw = true;
    scene.addObject(leg_right);
    
    //Head
    var head_materials = [];
    head_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/head_right.png')})]);
    head_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/head_left.png')})]);
    head_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/head_top.png')})]);
    head_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/head_bottom.png')})]);
    head_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/head_back.png')})]);
    head_materials.push([new THREE.MeshBasicMaterial({map: THREE.ImageUtils.loadTexture(url + '/head_front.png')})]);
    
    head = new THREE.Mesh( new THREE.CubeGeometry(8, 8, 8, 0, 0, 0, head_materials), new THREE.MeshFaceMaterial());
    head.position.x = 0;
    head.position.y = 0;
    head.position.z = 0;
    head.overdraw = true;
    scene.addObject(head);
    
    // Create render NOTE: there is a WebGL version but it is buggy
    renderer = new THREE.CanvasRenderer();
    // make sure size is only as big as the containing div
    
    renderer.setSize(container.offsetWidth, container.offsetHeight);
    container.appendChild( renderer.domElement );
    
    // add events
    container.addEventListener( 'mousedown', onDocumentMouseDown, false );
    container.addEventListener( 'touchstart', onDocumentTouchStart, false );
    container.addEventListener( 'touchmove', onDocumentTouchMove, false );
}

function onDocumentMouseDown( event ) {
    event.preventDefault();
    // setup events
    document.addEventListener( 'mousemove', onDocumentMouseMove, false );
    document.addEventListener( 'mouseup', onDocumentMouseUp, false );
    //document.addEventListener( 'mouseout', onDocumentMouseOut, false );
    
    // save initial X - half window
    mouseXOnMouseDown = event.clientX - windowHalfX;
    // save initial X rotation
    targetRotationXOnMouseDown = targetRotationX;
    // save initial Y - half window
    mouseYOnMouseDown = event.clientY - windowHalfY;
    // save initial Y rotation
    targetRotationYOnMouseDown = targetRotationY;
}

function onDocumentMouseMove( event ) {
    // get current X - half window
    mouseX = event.clientX - windowHalfX;
    // calculate new X rotation (initial rotation) - (delta X) * scalar
    targetRotationX = targetRotationXOnMouseDown - ( mouseX - mouseXOnMouseDown ) * 0.015;
    
    // get current Y - half window
    mouseY = event.clientY - windowHalfY;
    // calculate new Y rotation (initial rotation) + (delta Y) * scalar
    targetRotationY = targetRotationYOnMouseDown - ( mouseY - mouseYOnMouseDown ) * 0.015;
}

/**
 * If Mouse click is released
 */
function onDocumentMouseUp( event ) {
    // Kill Event Listeners
    document.removeEventListener( 'mousemove', onDocumentMouseMove, false );
    document.removeEventListener( 'mouseup', onDocumentMouseUp, false );
    //document.removeEventListener( 'mouseout', onDocumentMouseOut, false );
}

/**
 * If Mouse leaves canvas or document
 */
function onDocumentMouseOut( event ) {
    // Kill Event Listeners
    document.removeEventListener( 'mousemove', onDocumentMouseMove, false );
    document.removeEventListener( 'mouseup', onDocumentMouseUp, false );
    //document.removeEventListener( 'mouseout', onDocumentMouseOut, false );
}

function onDocumentTouchStart( event ) {
    if ( event.touches.length == 1 ) {
        event.preventDefault();
        
        // save initial X - half window
        mouseXOnMouseDown = event.touches[ 0 ].pageX - windowHalfX;
        // save initial Y - half window
        mouseYOnMouseDown = event.touches[ 0 ].pageY - windowHalfY;
        
        // save initial X rotation
        targetRotationXOnMouseDown = targetRotationX;
        // save initial Y rotation
        targetRotationYOnMouseDown = targetRotationY;
    }
}

function onDocumentTouchMove( event ) {
    if ( event.touches.length == 1 ) {
        event.preventDefault();
        
        // calculate current X
        mouseX = event.touches[ 0 ].pageX - windowHalfX;
        // calculate new X rotation (initial rotation) - (delta X) * scalar
        targetRotationX = targetRotationXOnMouseDown + ( mouseX - mouseXOnMouseDown ) * 0.05;
        // calculate new Y rotation (initial rotation) - (delta Y) * scalar
        targetRotationY = targetRotationYOnMouseDown + ( mouseY - mouseYOnMouseDown ) * 0.05;
    }
}

function animate() {
    requestAnimationFrame( animate );
    render();
}

function render() {
    // calculate camera x position around player
    camera.position.x = 0 - 100 * Math.sin(targetRotationX);
    // calculate camera y position around player
    var yRot = 0 - 50 * targetRotationY;
    if(yRot > 0) {
        yRot = Math.min(yRot, 100);
    } else {
        yRot = Math.max(yRot, -100);
    }
    
    camera.position.y = yRot;
    
    // calculate camera z position around player
    camera.position.z = 0 - 100 * Math.cos(targetRotationX);
    
    xvar += Math.PI/180
    
    //Leg Swing
    leg_left.rotation.x = Math.cos(xvar);
    leg_left.position.z = 0 - 6 * Math.sin(leg_left.rotation.x);
    leg_left.position.y = -16 - 6 * Math.abs(Math.cos(leg_left.rotation.x));
    leg_right.rotation.x = Math.cos(xvar + (Math.PI));
    leg_right.position.z = 0 - 6 * Math.sin(leg_right.rotation.x);
    leg_right.position.y = -16 - 6 * Math.abs(Math.cos(leg_right.rotation.x));
    
    //Arm Swing
    arm_left.rotation.x = Math.cos(xvar + (Math.PI));
    arm_left.position.z = 0 - 6 * Math.sin(arm_left.rotation.x);
    arm_left.position.y = -4 - 6 * Math.abs(Math.cos(arm_left.rotation.x));
    arm_right.rotation.x = Math.cos(xvar);
    arm_right.position.z = 0 - 6 * Math.sin(arm_right.rotation.x);
    arm_right.position.y = -4 - 6 * Math.abs(Math.cos(arm_right.rotation.x));
    
    renderer.render( scene, camera );
}

/**
 * Provides requestAnimationFrame in a cross browser way.
 * http://paulirish.com/2011/requestanimationframe-for-smart-animating/
 */
var requestAnimationFrame = (function() {
    return  window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            window.oRequestAnimationFrame ||
            window.msRequestAnimationFrame ||
            function( /* function FrameRequestCallback */ callback, /* DOMElement Element */ element ) {
		window.setTimeout( callback, 1000 / 60 );
	    };
} )();