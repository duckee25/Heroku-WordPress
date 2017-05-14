<?php

/*
if aesop story engine plugin is active then include the fixes file
*/

include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
$plugin = 'aesop-story-engine/aesop-core.php';
if(is_plugin_active($plugin) ) include('fixes.php');