<?php

/**
 * Code executed when bundle is started
 */

// Shortcut to bundle path
$path = Bundle::path('photos');

// Create autoloader map
Autoloader::map(
    array(
        'Photos_Admin_Base_Controller' => $path . 'controllers/admin/base.php',
    )
);

// Create autoloader namespaces
Autoloader::namespaces(
    array(
        'Photos\Models' => $path . 'models',
        'Photos' => $path . 'libraries',
    )
);