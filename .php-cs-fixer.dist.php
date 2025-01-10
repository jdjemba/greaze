<?php

$finder = (new PhpCsFixer\Finder())
  ->in(__DIR__)
  ->exclude('var')
;

return (new PhpCsFixer\Config())
  ->setRules([
      '@Symfony' => true,
  ])
  ->setFinder($finder)
  ->setCacheFile(__DIR__.'/var/.php-cs-fixer.cache')
;
