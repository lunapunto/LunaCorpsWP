<?php
/*
* Funciones de Wordpress
* Llama a las funciones globales.
*/
require_once 'global/funcs.php';
require_once '_vars.php';
require_once 'vendor/autoload.php';

/* Importa todas las clases del folder Classes */

$allClasses = scandir(get_stylesheet_directory().'/classes/');

$classes = array_diff($allClasses, array('.', '..'));

foreach($classes as $class){
  $ext = pathinfo($class, PATHINFO_EXTENSION);
  /* Verifica que el archivo sea .php */
  if($ext == 'php'){
    require_once 'classes/'.$class;
  }
}

function custom_title(){
  global $post;
  $subfix = get_bloginfo('name', 'raw');
  $name = $post->post_name;
  if($name == 'home'){
    return $subfix;
  }else{
    $prefix = $post->post_title.' | '.$subfix;
    return $prefix;
  }
}
function scriptsstyles(){
  wp_enqueue_script('bundle', js.'/bundle.js');
  wp_enqueue_style('master', dir.'/style.css');
}
add_action('wp_enqueue_scripts', 'scriptsstyles');

add_theme_support('post-thumbnails');

function get_thumbs($postid){
  $o = array('small'=>'','large'=>'');
  $s = wp_get_attachment_image_src(get_post_thumbnail_id($postid), 'thumbnail');
  $l = wp_get_attachment_image_src(get_post_thumbnail_id($postid), 'large');
  $o['small'] = $s[0];
  $o['large'] = $l[0];
  return $o;
}

remove_shortcode('gallery');
function new_gallery($atts){
  $ids = $atts['ids'];
  $ids = explode(',',$ids);
  $y = count($ids);
  $o = '<div class="gallery">';
  $x = 1;
  foreach($ids as $id){
      $img = wp_get_attachment_url($id);
      $class = '';
      if($y === 1){
      $class = 'one_gall';
      }
      if($y === 2){
      $class = 'two_gall';
      }
      $deg = rand(-5,5).'deg';
      $bimg = 'url('.$img.')';
      $o .= '<div onclick="showgal('.$x.')" id="gal_'.$x.'" data-index="'.$x.'" class="'.$class.' gall_thumb" style="transform: rotate('.$deg.'); background-image: '.$bimg.'"><input type="hidden" value="'.$img.'"></div>';
      $x++;
  }
  $o .= '<div style="clear: both"></div>';
  $o .= '</div>';
  return $o;
}
add_shortcode('gallery','new_gallery');

function post_excerpt($post){
  $default = wp_trim_words(apply_filters('the_content',$post->post_content), $num_words = 18, $more = '...');
  return $default;
}
function get_keywords(){
  global $post, $keywords;
  $tags_name = wp_get_post_tags( $post->ID, array( 'fields' => 'names' ) );
  $keywordsOG = array_merge($tags_name, $keywords);
  return $keywordsOG;
}
function get_meta_description(){
  global $post, $description;
  if(is_single($post)){
    $description = post_excerpt($post);
  }
  return $description;
}
function get_og_meta(){
  $o = array(
    'keywords'  => get_keywords(),
    'description' => get_meta_description()
  );
  return $o;
}
