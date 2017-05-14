<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */



$frontpage_style = get_option(ktt_var_name('frontpage_style'));
if (!$frontpage_style) $frontpage_style = 'grid';

include('elements-frontpage-design-' . $frontpage_style . '.php');
