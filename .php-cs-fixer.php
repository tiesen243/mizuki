<?php

$finder = PhpCsFixer\Finder::create()
  ->in(__DIR__.'/app')
  ->in(__DIR__.'/public')
  ->in(__DIR__.'/resources')
  ->in(__DIR__.'/src');

return (new PhpCsFixer\Config())
  ->setRules([
    '@Symfony' => true,
    'assign_null_coalescing_to_coalesce_equal' => true,
    'braces_position' => [
      'allow_single_line_empty_anonymous_classes' => true,
      'allow_single_line_anonymous_functions' => true,
      'functions_opening_brace' => 'same_line',
    ],
    'echo_tag_syntax' => ['format' => 'short'],
    'group_import' => ['group_types' => ['classy', 'functions', 'constants']],
    'single_import_per_statement' => false,
  ])
  ->setIndent('  ')
  ->setFinder($finder)
  ->setRiskyAllowed(true)
  ->setUsingCache(true);
