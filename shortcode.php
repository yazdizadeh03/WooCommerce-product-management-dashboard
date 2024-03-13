<?php

if (!defined('ABSPATH')) {
    exit;
}

// ==================== ADMIN ==================== //
// auctions management
function products_list()
{
    require_once 'includes\admin-product-list.php';
    require_once 'includes\includes-file.php';
}
add_shortcode('products_list', 'products_list');
