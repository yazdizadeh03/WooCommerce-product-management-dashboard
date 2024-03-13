<?php
global $wpdb;
global $product;
if (isset($_POST['action']) && $_POST['action'] === 'delete_product') {
    if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
         $pr = wc_get_product($product_id); // دریافت محصول بر اساس آیدی


    if ($pro) {
        $product_name = $pro->get_name(); // دریافت نام محصول
        return $product_name;
    }
}
}


if (isset($_POST['action2']) && $_POST['action2'] === 'submit_product') {
    $productId = $_POST['product_id'];
    $imageId = $_POST['image_Id'];
    $imageUrl = $_POST['image_Url'];
    echo $productId;
    $pr = wc_get_product($product_id);
    update_post_meta($productId, '_thumbnail_id', $imageId);


    echo "Product ID: " . $productId . "<br>";
    echo "Image ID: " . $imageId . "<br>";
    echo "Image URL: " . $imageUrl . "<br>";
}