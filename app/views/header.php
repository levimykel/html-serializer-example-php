<?php

if (!isset($title)) {
  $title = SITE_TITLE;
}
if (!isset($description)) {
  $description = SITE_DESCRIPTION;
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta content="text/html; Charset=UTF-8" http-equiv="Content-Type" />
    <title><?= $title ?></title>
    <meta name="description" content="<?php echo $description; ?>">
    <link rel="stylesheet" href="/stylesheets/reset.css">
    <link rel="stylesheet" href="/stylesheets/common.css">
    <link rel="stylesheet" href="/stylesheets/style.css">
    <link rel="icon" type="image/png" href="/images/punch.png" />
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lora:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <? /* Required for previews and experiments */ ?>
    <script>
      window.prismic = {
        endpoint: '<?= PRISMIC_URL ?>'
      };
    </script>
    <script src="//static.cdn.prismic.io/prismic.js"></script>
  </head>
  <body>
    
    <header class="site-header">
      <a href="/">
        <div class="logo">ExampleSite</div>
      </a>
      
      <?php
        // if the navigation is set up in prismic.io
        if ( $menuContent != null ) { 
      ?>
      <nav>
        <ul>
          
          <?php 
            // loop through each menu item
            foreach ( $menuContent->getGroup('navigation.navLinks')->getArray() as $link ) { 
          ?>
          <li><a href="<?= $link->getLink("link")->getUrl($prismic->linkResolver) ?>"><?= $link->getText("label") ?></a></li>
          <?php } ?>
        </ul>
      </nav>
      <?php } ?>
      
    </header>