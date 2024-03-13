<?php
global $product;
$args = array(
    'orderby' => 'name',
    'order' => 'ASC',
);
$query = new WC_Product_Query($args);
$products = $query->get_products();

$arg_c = array(
    'post_type' => 'product',
    'posts_per_page' => -1,
);

$query = new WP_Query($arg_c);
$total_products = $query->post_count;

?>
<div class="row">
    <div class="w-100 p-3">
        <div class="w-100 p-3">
            <h1 class="font-weight-bold title-page"><?php echo(__('Products list', 'wpm-plugin')); ?></h1>
        </div>
        <div class="w-100 p-3">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo(__('image', 'wpm-plugin')); ?></th>
                        <th scope="col"><?php echo(__('Name', 'wpm-plugin')); ?></th>
                        <th scope="col"><?php echo(__('SKU', 'wpm-plugin')); ?></th>
                        <th scope="col"><?php echo(__('Stock', 'wpm-plugin')); ?></th>
                        <th scope="col"><?php echo(__('Price', 'wpm-plugin')); ?></th>
                        <th scope="col"><?php echo(__('categories', 'wpm-plugin')); ?></th>
                        <th scope="col"><?php echo(__('Tags', 'wpm-plugin')); ?></th>
                        <th scope="col"><?php echo(__('featured', 'wpm-plugin')); ?></th>
                        <th scope="col"><?php echo(__('Date', 'wpm-plugin')); ?></th>
                     </tr>
                </thead>
                <tbody>
                    <?php
                        $number_id = 1;
                        foreach ($products as $product) {
                            $image_id = $product->get_image_id();
                            $image_url = wp_get_attachment_image_url($image_id, 'full');
                            $name = $product->get_name();
                            $product_id = $product->get_id();
                            $sku = $product->get_sku();
                            $stock = $product->get_stock_quantity();
                            $price = $product->get_price();
                            $categories = $product->get_category_ids();
                            $tags = $product->get_tag_ids();
                            $featured = $product->is_featured();
                            $date = $product->get_date_created();
                            $product_link = get_permalink($product_id);
                    ?>
                    <tr id='product-<?php echo $product_id ; ?>'>
                        <th scope="row"><?php echo $number_id++; ?></th>
                        <td><?php
                                if ($image_url) {
                                    echo '<img width="80" height="80" src="' . $image_url . '" alt="' . $product->get_name() . '">';
                                }
                                else{
                                    echo '<img width="80" height="80" src="http://127.0.0.1/wordpress/wp-content/uploads/woocommerce-placeholder.png" class="woocommerce-placeholder wp-post-image" alt="مكان گيرنده" decoding="async" loading="lazy">';
                                }
                            ?>
                        </td>
                        <td class="name-product">
                            <div class="d-flex flex-column">
                                <div class="mb-auto p-2"><?php echo $name; ?></div>
                                <div id='p-operation-<?php echo $product_id ; ?>' class="operation invisible p-2">
                                   <a href="<?php $url = $_SERVER['REQUEST_URI']; $url = add_query_arg('action', 'edit', $url); $url = add_query_arg('id', $product_id, $url); echo $url; ?>"><?php echo __('edit', 'wpm-plugin'); ?></a>
                                    <a href="#"  href='javascript:void(0)' onclick="deleteProduct(<?php echo $product_id; ?>)"><?php echo(__('delete', 'wpm-plugin')); ?></a>
                                    <a href='<?php echo $product_link ; ?>' target="_blank"><?php echo(__('show', 'wpm-plugin')); ?></a>
                                </div>
                            </div>
                        </td>
                        <td><?php echo $sku; ?></td>
                        <td><?php echo $stock; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php
                                foreach ($categories as $category) {
                                    echo get_term($category, 'product_cat')->name . ' ';
                                }
                            ?>
                        </td>
                        <td><?php
                                foreach ($tags as $tag) {
                                    echo get_term($tag, 'product_tag')->name . ' ';
                                }
                            ?>
                        </td>
                        <td><?php echo ($featured ? 'بله' : 'خیر'); ?></td>
                        <td><?php echo $date; ?></td>
                        <td></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php 

