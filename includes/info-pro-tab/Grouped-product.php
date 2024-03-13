<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<section>
<div class="tabs">
    <ul class="tab-links">
        <li class="active"><a href="#inventory_product_data"><?php echo(__('Inventory', 'wpm-plugin')); ?></a></li>
        <li><a href="#linked_product_data"><?php echo(__('linked product', 'wpm-plugin')); ?></a></li>
        <li><a href="#product_attributes"><?php echo(__('attributes', 'wpm-plugin')); ?></a></li>
        <li><a href="#advanced_product_data"><?php echo(__('advanced', 'wpm-plugin')); ?></a></li>
    </ul>
 
    <div class="tab-content">
        <div id="inventory_product_data" class="tab active">
            <label class="required form-label"><?php echo(__('Product SKU', 'wpm-plugin')); ?></label>
            <input type="text" name="_sku" class="form-control mb-2">           
        </div>
        <div id="linked_product_data" class="tab">
            <div class="linked-products border-bottom pb-4">
                <label class="required form-label"><?php echo(__('Group products', 'wpm-plugin')); ?></label>
                <div class="d-flex gap-3">
                    <input type="text" name="slink-product" id="slink-product" class="form-control mb-2 radius-2" >
                    <button class="btn btn-outline-primary w-25 radius-2 add-lproduct-btn" type="button"><?php echo(__('add', 'wpm-plugin')); ?></button>
                </div>
                <div class="spinner-border spinner-border-sm text-primary search-spin d-none" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>    
                <div class="position-absolute border link-product-search-result p-4 bg-white d-none" style="width: 54.3% !important;"></div>
                <div class="d-block border radius-2 fs-10 p-4 lproduct-list"></div>
            </div>
            <div class="Encouragement-buy-more pt-3">
                <label class="required form-label"><?php echo(__('Encouragement to buy more', 'wpm-plugin')); ?></label>
                <div class="d-flex gap-3">
                    <input type="text" name="Enco-buy-more" id="Enco-buy-more" class="form-control mb-2 radius-2" >
                    <button class="btn btn-outline-primary w-25 radius-2 add-enbuymore-btn" type="button"><?php echo(__('add', 'wpm-plugin')); ?></button>
                </div>
                <div class="spinner-border spinner-border-sm text-primary search-spin d-none" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>    
                <div class="position-absolute border enbuy-more-search-result p-4 bg-white d-none" style="width: 54.3% !important;"></div>
                <div class="d-block border radius-2 fs-10 p-4 enbuy-more-list"></div>
            </div>
        </div>
 
        <div id="product_attributes" class="tab">
            <div class="d-flex gap-3">
                <div class="w-40">
                    <?php 
                    $attributes = wc_get_attribute_taxonomies();
                    if ($attributes) {
                        ?>
                        <select name="p-attributes" id="p-attributes" data-placeholder="<?php echo(__('Available feature', 'wpm-plugin')); ?>" class="postform btn dropdown-toggle w-100 border radius-2 text-start mb-3 pl-80" style="padding-left:80px;" /*onchange="selectattributes(this.value)"*/>
                        <?php
                        foreach ($attributes as $attribute) {
                            echo '<option value="' . $attribute->attribute_name . '">' . $attribute->attribute_name . '</option>';
                        }
                        ?>
                        </select>
                        <?php
                    }
                    ?>
                </div>
                <a class="btn btn-outline-primary w-20 radius-2" href="#"><?php echo(__('add attribute', 'wpm-plugin')); ?></a>
            </div>
            <div id="attributes-list">
            </div>   
        </div>
 
        <div id="advanced_product_data" class="tab">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="ch-enable-reviews">
                <label class="form-check-label" for="ch-enable-reviews"><?php echo(__('Enable reviews', 'wpm-plugin')); ?></label>
            </div>
           
        </div>

    </div>

</div>

</section>