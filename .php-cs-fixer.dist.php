<?php

$header = <<<EOF
This file is part of Handcrafted in the Alps - Rest Routing Bundle Project.

(c) 2011-2020 FriendsOfSymfony <http://friendsofsymfony.github.com/>
(c) 2020 Sulu GmbH <hello@sulu.io>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'ordered_imports' => true,
        'concat_space' => ['spacing' => 'one'],
        'array_syntax' => ['syntax' => 'short'],
        'phpdoc_align' => false,
        'class_definition' => [
            'multi_line_extends_each_single_line' => true,
        ],
        'linebreak_after_opening_tag' => true,
        'declare_strict_types' => false,
        'no_php4_constructor' => true,
        'no_superfluous_phpdoc_tags' => false,
        'no_unreachable_default_argument_value' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'php_unit_strict' => false,
        'single_line_throw' => false,
        'phpdoc_order' => true,
        'semicolon_after_instruction' => true,
        'strict_comparison' => true,
        'strict_param' => true,
        'modernize_strpos' => false,
        'nullable_type_declaration_for_default_null_value' => false,
        'operator_linebreak' => false,
        'visibility_required' => false,
        'get_class_to_class_keyword' => false,
        'phpdoc_separation' => false,
        'fully_qualified_strict_types' => false,
    ])
    ->setRiskyAllowed(true)
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(__DIR__)
    )
    ;
