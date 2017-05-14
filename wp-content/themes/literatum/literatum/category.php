<?php
/**
 * The template for displaying Category pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

$category_id = $cat;
$default_template = 'category-template-list.php';
$current_template = get_taxonomy_meta($category_id, ktt_var_name('category_template'), true);
if (!$current_template) $current_template = $default_template;
include($current_template);