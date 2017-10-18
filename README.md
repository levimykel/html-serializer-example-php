# prismic.io Example Website with a working HTML Serializer in PHP

This is a simple PHP website example with a working HTML Serializer for prismic.io.

The HTML Serializer function is located in the **app/HtmlSerializer.php** file. 

```
$htmlSerializer = function($element, $content)
{
  
  global $WPGLOBAL;
  $linkResolver = $WPGLOBAL['prismic']->linkResolver;
  
  switch(true) {
    
    // Add a class to paragraph elements
    case $element instanceof ParagraphBlock:
      return '<p class="paragraph-class">' . $content . '</p>';
    
    // Don't wrap images in a <p> tag
    case $element instanceof ImageBlock:
      $imageView = $element->getView();
      return '<img src="' . $imageView->getUrl() . '" alt="' . htmlentities($imageView->getAlt()) . '">';
    
    // Add a class to hyperlinks
    case $element instanceof HyperlinkSpan:
      if ($element->getLink() instanceof DocumentLink) {
        $linkUrl = $linkResolver ? $linkResolver($element->getLink()) : '';
      } else {
        $linkUrl = $element->getLink()->getUrl();
      }
      if ($linkUrl === null) {
        return $content;
      }
      $target = $element->getTarget() ? ' target="' . $element->getTarget() . '" rel="noopener"' : null;
      return '<a class="link-class" href="' . $linkUrl . '"' . $target . '>' . $content . '</a>';
      
    // Return null to stick with the default behavior for everything else
    default:
      return null;
  }
};
```

It is required then stored as a global variable in **public/index.php**.

```
require_once '../app/includes/PrismicHelper.php';
...
global $WPGLOBAL;
$WPGLOBAL = array(
  'app' => $app,
  'prismic' => $prismic,
  'htmlSerializer' => $htmlSerializer,
);
```


It is then used in **app/views/homepage.php**. Here is what it looks like.

```
<div class="container"  data-wio-id=<?= $homeContent->getId() ?>>
  <?= $homeContent->getStructuredText('homepage.site-title')->asHtml($prismic->linkResolver) ?>
  <img src="<?= $homeContent->getImage('homepage.image')->getUrl() ?>" />
  <?= $homeContent->getStructuredText('homepage.text')->asHtml($prismic->linkResolver, $htmlSerializer) ?>
</div>
```

It is also called in **app/views/page.php**. Here is an example.

```
<div class="container" data-wio-id=<?= $pageContent->getId() ?>>
  <?= $pageContent->getStructuredText('page.title')->asHtml($prismic->linkResolver) ?>
  <?= $pageContent->getStructuredText('page.text')->asHtml($prismic->linkResolver, $htmlSerializer) ?>
</div>
```

## Licence

This software is licensed under the Apache 2 license, quoted below.

Copyright 2017 Prismic.io (http://www.prismic.io).

Licensed under the Apache License, Version 2.0 (the "License"); you may not use this project except in compliance with the License. You may obtain a copy of the License at http://www.apache.org/licenses/LICENSE-2.0.

Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.