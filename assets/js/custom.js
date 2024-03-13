jQuery(document).ready(function ($) {
    $('td.name-product').hover(function () {
        $(this).find('.operation').removeClass('invisible');
    }, function () {
        $(this).find('.operation').addClass('invisible');
    });
});

function deleteProduct(id) {
    $.ajax({
        url: '../wp-content/plugins/WooCommerce-product-management-dashboard/function.php',
        type: 'POST',
        data: {
            action: 'delete_product',
            product_id: id
        },
        success: function (response) {
            //location.reload();
            console.log(response);
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
        }
    });
}


jQuery(document).ready(function ($) {
    $('a.add-new-category').click(function (event) {
        event.preventDefault();
        $('.snew-category').toggleClass('d-none');
        return false;
    });
});
document.addEventListener("DOMContentLoaded", function () {
    var selectElement = document.getElementById("parent");
    if (selectElement) {
        selectElement.classList.add("btn", "dropdown-toggle", "w-100", "border", "radius-2", "text-start");
    }
});

jQuery(document).ready(function ($) {
    $('.add-gallery-product').on('click', function (e) {
        e.preventDefault();
        if (this.window === undefined) {
            this.window = wp.media({
                library: {
                    type: 'image'
                },
                multiple: true
            });

            var self = this;
            this.window.on('select', function () {
                var images = self.window.state().get('selection').toJSON();
                var galleryDiv = $('.gallery-images');
                galleryDiv.empty();

                for (var i = 0; i < images.length; i++) {
                    var image = images[i];
                    var imageDiv = $('<div>').addClass('image-item-' + image.id + ' image-item-h');
                    var imageElement = $('<img>').attr('src', image.url).css({
                        width: '100px',
                        height: '65px'
                    });
                    var imageInfo = $('<p>').text('ID: ' + image.id);

                    imageDiv.append(imageElement);
                    imageDiv.append(imageInfo);
                    galleryDiv.append(imageDiv);
                }
            });
        }
        this.window.open();
        return false;
    });
});


$(document).ready(function () {
    $('.tabs .tab-links a').on('click', function (e) {
        var currentAttrValue = $(this).attr('href');

        // Show/Hide Tabs
        $('.tabs ' + currentAttrValue).fadeIn(400).siblings().hide();
        // Change/remove current tab to active
        $(this).parent('li').addClass('active').siblings().removeClass('active');

        e.preventDefault();


    });
});

var submitProduct = document.getElementsByClassName("psubmit-post");

// تعریف تابع برای رویداد کلیک
function handleClick(event) {
    var productId = event.target.dataset.id;
    var postImages = document.getElementsByClassName("post-img-id");

    for (var i = 0; i < postImages.length; i++) {
        var imageId = postImages[i].dataset.id;
        var imageUrl = postImages[i].getElementsByTagName("img")[0].getAttribute("src");
    }
    $.ajax({
        url: '../wp-content/plugins/WooCommerce-product-management-dashboard/function.php',
        type: 'POST',
        data: {
            action1: 'fp_ajax',
            action2: 'submit_product',
            product_id: productId,
            image_Id: imageId,
            image_Url: imageUrl
        },
        success: function (response) {
            //location.reload();
            console.log(response);
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
        }
    });

}

// اختصاص رویداد کلیک به همه دکمه‌ها
for (var i = 0; i < submitProduct.length; i++) {
    submitProduct[i].addEventListener("click", handleClick);
}

