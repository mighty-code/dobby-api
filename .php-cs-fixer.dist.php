<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$rules = [
    '@PSR12' => true,
    '@PSR12:risky' => true,
    '@PHP81Migration' => true,
    'psr_autoloading' => true,
    'array_syntax' => [
        'syntax' => 'short',
    ],
    'array_indentation' => true,
    'binary_operator_spaces' => [
        'default' => 'single_space',
        'operators' => [
            '=>' => 'single_space',
        ],
    ],
    'blank_line_after_namespace' => true,
    'blank_line_before_statement' => [
        'statements' => [
            0 => 'return',
        ],
    ],
    'braces' => true,
    'cast_spaces' => true,
    'class_attributes_separation' => [
        'elements' => [
            'method' => 'one',
            'trait_import' => 'none',
            'property' => 'one'
        ],
    ],
    'class_definition' => true,
    'concat_space' => [
        'spacing' => 'none',
    ],
    'elseif' => true,
    'encoding' => true,
    'full_opening_tag' => true,
    'function_declaration' => true,
    'function_typehint_space' => true,
    'heredoc_to_nowdoc' => true,
    'include' => true,
    'increment_style' => [
        'style' => 'post',
    ],
    'indentation_type' => true,
    'linebreak_after_opening_tag' => true,
    'line_ending' => true,
    'constant_case' => true,
    'lowercase_keywords' => true,
    'magic_method_casing' => true,
    'magic_constant_casing' => true,
    'method_argument_space' => true,
    'native_function_casing' => true,
    'no_extra_blank_lines' => [
        'tokens' => [
            0 => 'extra',
            1 => 'throw',
            2 => 'use',
        ],
    ],
    'no_blank_lines_after_phpdoc' => true,
    'no_closing_tag' => true,
    'no_empty_phpdoc' => true,
    'no_empty_statement' => true,
    'no_leading_namespace_whitespace' => true,
    'no_mixed_echo_print' => [
        'use' => 'echo',
    ],
    'no_multiline_whitespace_around_double_arrow' => true,
    'multiline_whitespace_before_semicolons' => [
        'strategy' => 'no_multi_line',
    ],
    'no_short_bool_cast' => true,
    'no_singleline_whitespace_before_semicolons' => true,
    'no_spaces_after_function_name' => true,
    'no_spaces_around_offset' => true,
    'no_spaces_inside_parenthesis' => true,
    'no_trailing_comma_in_list_call' => true,
    'no_trailing_comma_in_singleline_array' => true,
    'no_trailing_whitespace' => true,
    'no_trailing_whitespace_in_comment' => true,
    'no_unneeded_control_parentheses' => true,
    'no_whitespace_before_comma_in_array' => true,
    'normalize_index_brace' => true,
    'not_operator_with_successor_space' => true,
    'object_operator_without_whitespace' => true,
    'ordered_imports' => [
        'sort_algorithm' => 'alpha',
        'imports_order' => ['class', 'function', 'const'],
    ],
    'phpdoc_indent' => true,
    'phpdoc_inline_tag_normalizer' => true,
    'phpdoc_no_access' => true,
    'phpdoc_no_package' => true,
    'phpdoc_no_useless_inheritdoc' => true,
    'phpdoc_scalar' => true,
    'phpdoc_single_line_var_spacing' => true,
    'phpdoc_summary' => true,
    'phpdoc_to_comment' => true,
    'phpdoc_trim' => true,
    'phpdoc_types' => true,
    'phpdoc_var_without_name' => true,
    'single_blank_line_at_eof' => true,
    'single_class_element_per_statement' => true,
    'single_import_per_statement' => true,
    'single_line_after_imports' => true,
    'single_line_comment_style' => [
        'comment_types' => [
            0 => 'hash',
        ],
    ],
    'single_quote' => true,
    'space_after_semicolon' => true,
    'standardize_not_equals' => true,
    'switch_case_semicolon_to_colon' => true,
    'switch_case_space' => true,
    'trailing_comma_in_multiline' => ['elements' => ['arrays', 'parameters']],
    'trim_array_spaces' => true,
    'unary_operator_spaces' => true,
    'whitespace_after_comma_in_array' => true,
    'no_unused_imports' => true,
    'method_chaining_indentation' => true,
    'explicit_string_variable' => true,
];

$finder = Symfony\Component\Finder\Finder::create()
    ->in([
        __DIR__ . '/app',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/resources',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ])
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new Config)
    ->setFinder($finder)
    ->setRules($rules)
    ->setRiskyAllowed(true)
    // this is disabled, due to unexpected errors in some environments. Fell free to enable this to fits your needs.
    ->setUsingCache(false);
