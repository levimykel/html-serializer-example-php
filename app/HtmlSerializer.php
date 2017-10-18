<?php

use Prismic\Fragment\Block\EmbedBlock;
use Prismic\Fragment\Block\HeadingBlock;
use Prismic\Fragment\Block\ImageBlock;
use Prismic\Fragment\Block\ListItemBlock;
use Prismic\Fragment\Block\ParagraphBlock;
use Prismic\Fragment\Block\PreformattedBlock;
use Prismic\Fragment\Link\DocumentLink;
use Prismic\Fragment\Span\EmSpan;
use Prismic\Fragment\Span\HyperlinkSpan;
use Prismic\Fragment\Span\StrongSpan;
use Prismic\Fragment\Span\LabelSpan;

/**
 * The HTML Serializer is used to change the output html for a Rich Text field
 */
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