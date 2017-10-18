<?php

$prismic = $WPGLOBAL['prismic'];
$htmlSerializer = $WPGLOBAL['htmlSerializer'];
$homeContent = $WPGLOBAL['homeContent'];
$menuContent = $WPGLOBAL['menuContent'];

$title = SITE_TITLE;

?>

<?php include 'header.php'; ?>

<div class="container"  data-wio-id=<?= $homeContent->getId() ?>>
  <?= $homeContent->getStructuredText('homepage.site-title')->asHtml($prismic->linkResolver) ?>
  <img src="<?= $homeContent->getImage('homepage.image')->getUrl() ?>" />
  <?= $homeContent->getStructuredText('homepage.text')->asHtml($prismic->linkResolver, $htmlSerializer) ?>
</div>

<?php include 'footer.php'; ?>