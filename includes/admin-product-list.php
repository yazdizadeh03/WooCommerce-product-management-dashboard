<?php
$current_url = $_SERVER['REQUEST_URI'];

if (strpos($current_url, 'edit') !== false) {
    require_once 'Product-edit.php';
} else {
    require_once 'Product-list.php';
}