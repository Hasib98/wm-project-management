<?php 
function hello_world_shortcode() {
    return '<div> shortcode try</div>';
}
add_shortcode('hello_world', 'hello_world_shortcode');
?>