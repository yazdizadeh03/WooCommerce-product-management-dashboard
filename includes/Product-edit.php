<?php
if (!defined('ABSPATH')) {
    exit;
}


global $wpdb;
$current_url = $_SERVER['REQUEST_URI'];
$parsed_url = parse_url($current_url);
parse_str($parsed_url['query'], $query_params);
$product_id = isset($query_params['id']) ? $query_params['id'] : '';

$product = wc_get_product($product_id);

if ($product) {
    $name = $product->get_name();
    $price = $product->get_price();
    $description = $product->get_description();
    $short_description = get_post_field( 'post_excerpt', $product_id );
    $image_id = $product->get_image_id();
    $image_url = wp_get_attachment_image_url($image_id, 'full');
    $product_link = get_permalink($product_id);
    $product_categories = wp_get_post_terms($product_id, 'product_cat');
    
    global $product;
    $published_date=get_the_date('Y-m-d h:i:sa', $product_id);
//     // نمایش دسته‌ها در لیست کشویی
//     echo '<select>';
//     foreach ($product_categories as $category) {
//         echo '<option value="' . $category->term_id . '">' . $category->name . '</option>';
//     }
//     echo '</select>';


$categories = array(
    'taxonomy' => 'product_cat',
    'hide_empty' => false,
    'show_option_none' => '',
    'selected' => '',
    'echo' => 0,
    'hierarchical' => true,
    'depth' => 0,
);
}

?>
<div class="app-content flex-column-fluid ">
    <div class="app-container">
        <form class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework">
            <div class="d-flex flex-column gap-7 gap-lg-10 w-75 p-3">
                <div class="d-flex flex-column gap-30 gap-lg-10 p-3 shadow mb-5 bg-white rounded">
                    <div class="card-title">
                        <h2><?php echo(__('Edit product', 'wpm-plugin')); ?></h2>
                    </div>
                    <div>
                        <label class="required form-label"><?php echo(__('Product Name', 'wpm-plugin')); ?></label>
                        <input type="text" name="product_name" class="form-control mb-2" placeholder="Product name" value="<?php echo $name; ?>">
                    </div>
                    <div>
                        <label class="form-label"><?php echo(__('Product Description', 'wpm-plugin')); ?></label>
                        <?php wp_editor( $description, 'ProductDescription', [ 'textarea_name' => 'content' ] ); ?>
                    </div>
                    <div>
                        <label class="form-label"><?php echo(__('Short description about the product', 'wpm-plugin')); ?></label>
                        <?php wp_editor($short_description, 'Shortdescriptionproduct', [ 'textarea_name' => 'content' ] ); ?>
                    </div>
                    <div>
                        <div class="d-flex gap-3 align-items-center border-bottom">
                            <h5><?php echo(__('Product Information', 'wpm-plugin')); ?></h5>
                            <div class="w-20 ">
                                <select name="typeproduct" id="typeproduct" class="postform btn dropdown-toggle w-100 border radius-2 text-start mb-3" onchange="displaySelectedName(this.value)">
                                    <option class="level-0" value="01"><?php echo(__('Simple product', 'wpm-plugin')); ?></option>
                                    <option class="level-0" value="02"><?php echo(__('Grouped product', 'wpm-plugin')); ?></option>
                                    <option class="level-0" value="03"><?php echo(__('Introduced / foreign product', 'wpm-plugin')); ?></option>
                                    <option class="level-0" value="04"><?php echo(__('Variable product', 'wpm-plugin')); ?></option>
                                </select>
                            </div>
                        </div>
                        <div id="selectedNameDisplay" class=""></div>
                        <?php  require_once 'info-pro-tab\Variable-product.php';?>




                    </div>
                    <div>
                        <div class="d-flex justify-content-between align-items-center">
                            <h4><?php echo(__('Reviews', 'wpm-plugin')); ?></h4>
                            <a class="btn btn-outline-primary w-10 radius-2" ><?php echo(__('Submit a comment', 'wpm-plugin')); ?></a>
                        </div>
                        <?php
                        $reviews_args = array(
                            'post_id' => $product_id,
                            'status' => 'approve',
                            'type' => array('review', 'comment')
                        );
                        $reviews = get_comments($reviews_args);
                        if ($reviews) {
                            foreach ($reviews as $review) {
                                ?>
                                <div class="d-flex review align-items-center p-2">
                                    <h5 class="w-50"><?php echo $review->comment_author; ?></h5>
                                    <p class="w-50"><?php echo $review->comment_content; ?></p>
                                </div>
                                <?php
                            }
                        } else {
                            echo 'No reviews found.';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column w-25 p-3">
                <div class="d-flex flex-column gap-30 gap-lg-10 p-3 shadow mb-5 bg-white rounded">
                    <div class="border-bottom">
                        <label class="required form-label"><?php echo(__('Product image', 'wpm-plugin')); ?></label>
                        <div class="mb-1 post-img-browse">
                            <a class="post-img-id" href="" data-id="<?php echo $image_id; ?>">
                                <img class="border radius-2 post-img" src="<?php echo $image_url; ?>" width="100%">
                            </a>
                        </div>
                        <div class="mb-4">
                            <a class="text-danger fs-10 remove-img" href=""><?php esc_html_e('Remove img', 'wpm-plugin');?></a>
                        </div>
                    </div>
                    <div class="border-bottom">
                        <div class="h6 title-sec mb-3 text-primary"><?php esc_html_e('Product gallery', 'wpm-plugin');?></div>
                        <p class="add_product_images hide-if-no-js">
			                <a href="#" class="add-gallery-product" data-choose="افزودن تصویر به گالری تصاویر محصول" data-update="افزودن به گالری" data-delete="پاک کردن تصویر" data-text="حذف"><?php esc_html_e('Add a gallery image of the product', 'wpm-plugin');?></a>
                            <span class="woocommerce-help-tip" tabindex="0" aria-label="برای بهترین نتیجه، فایل&zwnj;های JPEG یا PNG را با ابعاد 1000 در 1000 پیکسل یا بزرگتر آپلود کنید. حداکثر اندازه فایل آپلود: 40 مگابایت."></span>
                            <div class="produt-gimage gallery-images d-flex"></div>
		                </p>
                    </div>
                    <div class="border-bottom">
                        <div class="h6 title-sec text-primary mb-3"><?php esc_html_e('Product categories', 'wpm-plugin');?></div>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle w-100 border radius-2 text-start" type="button" id="cat-checklist-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"><?php esc_html_e('Select ', 'wpm-plugin');?></button>
                            <div class="dropdown-menu dropdown-menu-start radius-2 px-3 dp-categories" aria-labelledby="cat-checklist-dropdown">
                                <div class="row mt-1">
                                    <?php
                                        if (!empty($categories)) {
                                                $category_check = wp_terms_checklist(0, $categories);
                                                echo  $category_check;
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 mt-3">
                            <a class="add-new-category text-primary fs-10" href=""><?php esc_html_e('Add new category +', 'wpm-plugin');?></a>
                        </div>
                        <div class="snew-category mb-4 mt-3 d-none">
                            <input type="text" name="new-category" class="form-control mb-2 new-category radius-2" placeholder='<?php esc_html_e('Category name', 'wpm-plugin');?>' >
                            <div class="w-100">
                            <?php
                                $dropdown_args = array(
                                    'hide_empty'       => 0,
                                    'hide_if_empty'    => false,
                                    'taxonomy'         => 'product_cat',
                                    'name'             => 'parent',
                                    'orderby'          => 'name',
                                    'hierarchical'     => true,
                                    'show_option_none' => __( 'None' ),
                                );
                                $dropdown_args = apply_filters( 'taxonomy_parent_dropdown_args', $dropdown_args, 'product_cat', 'edit' );
                                wp_dropdown_categories( $dropdown_args ); ?>
                            </div>
                            <button type="button" class="btn btn-primary mt-3"><?php esc_html_e('Add new category', 'wpm-plugin');?></button>
                        </div>
                    </div>
                    <!-- کار کن چون طبق فرانت پنل هسست و روی برچسب نوشته -->
                    <?php $post_tags = wp_get_post_terms($product_id,'product_tag');?>
                    <div class="border-bottom" id="<?php echo 'product_tag'; ?>">
                        <div class="position-relative post-tag-box <?php echo 'product_tag'; ?>">
                            <div class="h6 title-sec text-primary mb-2"><?php esc_html_e('Labels', 'wpm-plugin');?></div>
                            <div class="d-flex">
                                <div class="position-relative mb-1 me-1 w-75">
                                    <input class="form-control radius-2 new-tag-name" type="text">
                                    <div class="spinner-border spinner-border-sm text-primary search-spin d-none" role="status">
                                        <span class="visually-hidden"><?php esc_html_e('Loading...', 'wpm-plugin');?></span>
                                    </div>
                                </div>
                                <button class="btn btn-outline-primary w-25 radius-2 add-new-tag-btn" type="button"><?php esc_html_e('Add', 'wpm-plugin');?></button>
                            </div>
                            <div class="position-absolute bg-body border radius-2 mb-1 me-1 p-2 w-75 tag-search-result d-none"></div>
                            <div class="d-block border radius-2 py-2 fs-10 mb-4 tag-list">
                                <?php foreach ($post_tags as $post_tag) {?>
                                    <div class="mx-1">
                                        <a class="remove-tag" href=""><i class="panel-icon icon-close-circle5 text-danger"></i></a>
                                        <span class="tag-item"><?php echo $post_tag->name; ?></span>
                                    </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="h6 title-sec text-primary mb-3"><?php esc_html_e('status', 'wpm-plugin');?></div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="draftProduct">
                            <label class="form-check-label" for="draftProduct">
                                <?php esc_html_e('draft', 'wpm-plugin');?>   
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="Awaitingreviewproduct">
                            <label class="form-check-label" for="Awaitingreviewproduct">
                                <?php esc_html_e('Awaiting review', 'wpm-plugin');?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="publishedproduct" checked>
                            <label class="form-check-label" for="publishedproduct">
                                <?php esc_html_e('published', 'wpm-plugin');?>
                            </label>
                        </div>
                        <div class="mt-4 mb-8">
                            <label class="required form-label h6 title-sec text-primary mb-3"><?php echo(__('Publish date', 'wpm-plugin')); ?></label>
                            <input class="form-control radius-2 post-date" type="text" value="<?php echo fp_persian_datetime($published_date); ?>">
                        </div>
                        <div class="mb-8 mt-4">
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <button class="btn btn-primary w-100 radius-2 psubmit-post" type="button" value="edit" data-id="<?php echo $product_id; ?>"><?php echo(__('update', 'wpm-plugin')); ?></button>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <button class="btn btn-outline-danger w-100 radius-2 delete-post" type="button" value="edit" data-id="<?php echo $product_id.'delete'; ?>"><?php echo(__('Delete', 'wpm-plugin')); ?></button>
                                </div>
                                <div class="col-sm-6">
                                    <a class="btn btn-outline-primary w-100 radius-2" href="<?php echo  $product_link; ?>" target="_blank"><?php echo(__('Show', 'wpm-plugin')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<script>

function displaySelectedName(selectedValue) {
    var options = {
        '01': 'Simple product',
        '02': 'Grouped-product',
        '03': 'Introduced / foreign product',
        '04': 'Variable product'
    };

    var selectedName = options[selectedValue];
    document.getElementById('selectedNameDisplay').innerHTML = selectedName;
}
</script>