<?php
global $post;
$oginfo = get_og_meta();
$tags_name = wp_get_post_tags( $post->ID, array( 'fields' => 'names' ) );
$keywords = $oginfo['keywords'];
$description = $oginfo['description'];
$bgOG = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title><?= custom_title();?></title>
  <meta charset="utf-8" />
  <meta content="width=device-width,initial-scale=1, user-scalable=no" name="viewport" />
  <!-- Favicons -->
  <link rel="icon" type="image/png" href="<?= asset.'/meta/favicon16x16.png';?>" sizes="16x16">
  <link rel="icon" type="image/png" href="<?= asset.'/meta/favicon32x32.png';?>" sizes="32x32">
  <link rel="icon" type="image/png" href="<?= asset.'/meta/favicon48x48.png';?>" sizes="48x48">
  <link rel="icon" type="image/png" href="<?= asset.'/meta/favicon64x64.png';?>" sizes="64x64">
  <link rel="icon" type="image/png" href="<?= asset.'/meta/favicon96x96.png';?>" sizes="96x96">
  <link rel="icon" type="image/png" href="<?= asset.'/meta/favicon120x120.png';?>" sizes="120x120">
  <!-- iOS Support-->
  <link rel="apple-touch-icon" href="<?= asset.'/meta/favicon120x120.png';?>">
  <link rel="apple-touch-icon" href="<?= asset.'/meta/favicon180x180.png';?>" sizes="180x180">
  <link rel="apple-touch-icon" href="<?= asset.'/meta/favicon152x152.png';?>" sizes="152x152">
  <link rel="apple-touch-icon" href="<?= asset.'/meta/favicon167x167.png';?>" sizes="167x167">

  <meta name="author" content="Luna Punto" />
  <?php if(mainColor):?>
    <meta name="theme-color" content="<?= mainColor;?>">
  <?php endif;?>
    <meta name="keywords" content="<?= implode(',', $keywords);?>" />
    <meta name="description" content="<?= $description;?>" />
    <meta property="og:url" content="<?= get_post_permalink($post);?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= custom_title();?>" />
    <meta property="og:description" content="<?= $description;?>" />
  <?php if(is_single()):?>
    <meta property="og:image" content="<?php echo $bgOG;?>" />
  <?php else:?>
    <meta property="og:image" content="<?= asset.'/meta/screenshot.png';?>" />
  <?php endif;?>
  <!-- Incluir Google Analytics -->
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    ga('create', '<?= googleUA;?>', 'auto');
    ga('send', 'pageview');
  </script>
  <?php wp_head();?>
</head>
<body class="<?= body_class();?>">
  <div id="wrapper">
    <div id="loader"></div>
