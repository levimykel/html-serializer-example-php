<?php

$prismic = $WPGLOBAL['prismic'];
$htmlSerializer = $WPGLOBAL['htmlSerializer'];
$pageContent = $WPGLOBAL['pageContent'];
$menuContent = $WPGLOBAL['menuContent'];

$title = SITE_TITLE;

?>

<?php include 'header.php'; ?>
    
<div class="container" data-wio-id=<?= $pageContent->getId() ?>>
  <?= $pageContent->getStructuredText('page.title')->asHtml($prismic->linkResolver) ?>
  <?= $pageContent->getStructuredText('page.text')->asHtml($prismic->linkResolver, $htmlSerializer) ?>
</div>

<?php include 'footer.php'; ?>