<?php
use BinaryCarpenter\BC_SD\Helpers;

$all_categories = (Helpers::getAllCategories());
$all_tags = (Helpers::getAllProductTags());


?>
<div id="slider-tabs">
    <ul class="row">
        <li class="col" style="margin-right: 20px;"><a href="#welcome-tab"><h2 style="color: #eb4034;">Welcome</h2></a></li>
        <li class="col"><a href="#woo-slider-pro-maker"><h2 style="color: #3493eb;">Create sliders</h2></a></li>
    </ul>
    <div id="welcome-tab">

        <div class="container">
            <div class="row">

                <div class="col-sm-6">
                    <h1>Welcome</h1>
                    <p>Thank you very much for using my plugin. Hopefully, you enjoy using it.</p>
                    <p>Make sure you check the latest tutorials <a  href="https://www.youtube.com/playlist?list=PL6rw2AEN42EqJ3MW5zeQWoqxGOnJNDo-N" target="b
">Here</a></p>
                    <p>In case you need assistance, please contact me <a href="https://tickets.binarycarpenter.com/open.php" target="b
"> here</a></p>
                </div>
                <div class="col-sm-6">
                    <h2>Recommended plugins</h2>
                    <p>You are definitely interested in the following plugins</p>
                    <div id="bc-recommended-products">

                    </div>

                </div>

            </div>


        </div>
    </div>

    <div class="container" id="woo-slider-pro-maker">

        <div class="">
            <div id="woo-slider-top-row" class="row shadow-box">
                <div class="col-sm-4">
                    <button id="save-slider"><i class="fa fa-save"></i> Save slider</button>
                    <button id="get-sliders-list" data-rel="lightcase" href="#list-slider"><i class="fa fa-pencil"></i> Edit slider</button>
                    <!--                <button id="preview-slider" href="" data-rel="lightcase"><i class="fa fa-eye"></i> Preview the slider</button>-->
                </div>

                <div class="col-sm-4">
                    <div><label for="">Slider title</label></div>
                    <input type="text" id="slider-title" placeholder="Enter the slider's title here">
                </div>
                <div class="col-sm-4">
                    <label for="slider-shortcode">Your slider shortcode is here</label>
                    <div><code id="slider-shortcode"></code></div>
                </div>

            </div>


        </div>



        <div class="row" id="main-content">
            <div class="col-sm-3" >
                <div id="elements-list-container" >
                    <h2>Elements</h2>
                    <div id="elements-list">
                        <ul id="elements-tab-header">
                            <li><a href="#product-elements">Elements</a></li><li><a href="#layout-elements">Layout options</a></li>
                        </ul>

                        <div id="product-elements">
                            <ul class="ui cards">
                                <li class="product-element" data-element="title"><i class="fa fa-font"></i> Product's Title</li>
                                <li class="product-element" data-element="regular_price"><i class="fa fa-dollar"></i> Regular Price</li>
                                <li class="product-element" data-element="sale_price"><i class="fa fa-dollar"></i> Discount price</li>
                                <li class="product-element" data-element="product_image"><i class="fa fa-image"></i> Product image</li>
                                <!--                    <li class="product-element" data-element="more-info-button"><i class="fa fa-info"></i> More info button</li>-->
                                <li class="product-element" data-element="add_to_cart_button"><i class="fa fa-cart-plus"></i> Add to cart button</li>
                                <li class="product-element" data-element="add_to_wishlist_button"><i class="fa fa-heart"></i> Add to YITH Wishlist</li>
                                <li class="product-element" data-element="star_rating"><i class="fa fa-star"></i> Star rating</li>
                                <li class="product-element" data-element="short_description"><i class="fa fa-file-text"></i> Short description</li>

                                <!--        PREMIUM            -->
                                <li class="product-element" data-element="stock_status"><i class="fa fa-inbox"></i> Stock status</li>
                                <li class="product-element" data-element="dimensions"><i class="fa fa-crosshairs"></i> Dimensions</li>
                                <li class="product-element" data-element="weight"><i class="fa fa-bath"></i> Weight</li>
                                <li class="product-element" data-element="category"><i class="fa fa-folder"></i> Category's name</li>
                                <li class="product-element" data-element="sku"><i class="fa fa-tag"></i> SKU</li>

                            </ul>
                        </div>

                        <div id="layout-elements">
                            <ul class="ui cards">
                                <li class="layout-option card" data-layout="12"><i class="fa fa-columns"></i> 1</li>
                                <li class="layout-option card" data-layout="6-6"><i class="fa fa-columns"></i> 1/2 + 1/2</li>
                                <li class="layout-option card" data-layout="8-4"><i class="fa fa-columns"></i> 2/3 + 1/3</li>
                                <li class="layout-option card" data-layout="4-8"><i class="fa fa-columns"></i> 1/3 + 2/3</li>
                                <li class="layout-option card" data-layout="4-4-4"><i class="fa fa-columns"></i> 1/3 + 1/3 + 1/3</li>
                            </ul>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div id="slider-builder">
                    <h2>Elements' orders</h2>
                    <ul id="elements-container">

                        <div class="element-container"></div>
                    </ul>
                </div>
            </div>

            <div class="col-sm-4">
                <div id="slider-settings-container">
                    <h2>Slider's settings</h2>
                    <form class="ui form" id="slider-settings">

                        <ul id="slider-settings-heading-tab">
                            <li><a href="#common-settings">Settings</a></li><li><a href="#slider-styles">CSS</a></li><li><a href="#slider-presets">Presets</a></li>
                        </ul>

                        <div id="common-settings">

                            <h3>Products selection</h3>
                            <label for="product_source">Get product from</label>
                            <div class="field">
                                <select class="" id="product_source">
                                    <option value="category">Categories</option>
                                    <option value="featured_products">Featured products</option>
                                    <option value="tag">Product tags</option>
                                </select>
                            </div>


                            <div id="categories-list">
                                <label for="categories_list">Categories list</label>
                                <select multiple="multiple" id="categories_list" name="categories_list[]">
                                    <?php foreach ($all_categories as $category): ?>
                                        <option value="<?php echo $category['ID']; ?>"><?php echo $category['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>

                            <div id="tags-list">
                                <label for="tags_list">Tags list</label>
                                <select multiple="multiple" id="tags_list" name="tags_list[]">
                                    <?php foreach ($all_tags as $tag): ?>
                                        <option value="<?php echo $tag['ID']; ?>"><?php echo $tag['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>


                            <h3 for="responsive_display">Visible items</h3>
                            <p>Number of items that is visible on the screen</p>
                            <div id="responsive_display">
                                <ul>
                                    <li><a href="#visible-mobile"><i class="fa fa-mobile"></i></a></li><li><a href="#visible-tablet"><i class="fa fa-tablet"></i></a></li><li><a href="#visible-desktop"><i class="fa fa-desktop"></i></a></li>
                                </ul>

                                <div id="visible-mobile">
                                    <div class="field">
                                        <input value="1" type="text" placeholder="enter number of visible item on mobile">
                                    </div>

                                </div>
                                <div id="visible-tablet">
                                    <div class="field">
                                        <input value="2" type="text" placeholder="enter number of visible item on tablet">
                                    </div>

                                </div>
                                <div id="visible-desktop">
                                    <div class="field">
                                        <input value="3" type="text" placeholder="enter number of visible item on desktop">
                                    </div>

                                </div>

                            </div>

                            <h3>Products' order</h3>
                            <label for="">Order product by</label>

                            <select class="" name="order_by" id="order-by">
                                <option value="price">Price</option>
                                <option value="date">Date</option>
                                <option value="name">Name</option>
                                <option value="sku">SKU</option>
                                <option value="rating">Rating</option>
                            </select>


                            <div class="ui radio checkbox">
                                <p>
                                    <input type="radio" name="order" checked value="asc">
                                    Ascending
                                </p>


                            </div>

                            <div class="ui radio checkbox">
                                <p>
                                    <input type="radio" name="order" value="desc">
                                    Descending
                                </p>

                            </div>



                            <h3>Slider display options</h3>
                            <div class="row" id="wsp-display-options">

                                <div class="one column">
                                    <p>
                                        <input type="checkbox" id="display_out_of_stock" />
                                        Display out of stock products?
                                    </p>

                                    <p>
                                        <input type="checkbox" id="slider_loop" />
                                        Loop animation?
                                    </p>

                                    <p>
                                        <input type="checkbox" id="show_nav_button" />
                                        Show next, prev button
                                    </p>

                                    <p>
                                        <input type="checkbox" id="show_dots" />
                                        Show dots
                                    </p>


                                    <p>
                                        <input type="checkbox" id="autoplay" />
                                        Autoplay slider on load
                                    </p>
                                </div>



                            </div>



                        </div>
                        <div id="slider-styles">
                            <div>
                                <label for="slider_custom_css">Slider custom CSS</label>
                                <p id="slider_css_id"></p>
                                <p>Use .woo-slider-pro-single-product for single slider item</p>
                                <textarea name="" placeholder="enter your custom css for the slider here" id="slider_custom_css" cols="30" rows="10"></textarea>
                            </div>

                        </div>
                        <div id="slider-presets">
                            <div class="row">
                                <div class="col-sm-4">
                                    <!--                                <img data-rel="lightcase" href="--><?php //echo plugins_url('/../bundle/images/presets/preset-placeholder.png', __FILE__); ?><!--" src="--><?php //echo plugins_url('/../bundle/images/presets/preset-placeholder.png', __FILE__); ?><!--" alt="">-->
                                    <p>Default</p>
                                    <input value="" type="radio" name="preset">
                                </div>

                                <div class="col-sm-4">
                                    <!--                                <img data-rel="lightcase" href="--><?php //echo plugins_url('/../bundle/images/presets/preset-placeholder.png', __FILE__); ?><!--" src="--><?php //echo plugins_url('/../bundle/images/presets/preset-placeholder.png', __FILE__); ?><!--" alt="">-->
                                    <p>Style one</p>
                                    <input value="woo-slider-pro-preset-0" type="radio" name="preset">
                                </div>

                                <div class="col-sm-4">
                                    <!--                                <img data-rel="lightcase" href="--><?php //echo plugins_url('/../bundle/images/presets/preset-placeholder.png', __FILE__); ?><!--" src="--><?php //echo plugins_url('/../bundle/images/presets/preset-placeholder.png', __FILE__); ?><!--" alt="">-->
                                    <p>Style 2</p>
                                    <input value="woo-slider-pro-preset-1" type="radio" name="preset">
                                </div>
                                <!---->
                                <!---->
                                <!--                    <div class="col-sm-4">-->
                                <!--                        <img data-rel="lightcase" href="--><?php //echo plugins_url('/../bundle/images/presets/preset-placeholder.png', __FILE__); ?><!--" src="--><?php //echo plugins_url('/../bundle/images/presets/preset-placeholder.png', __FILE__); ?><!--" alt="">-->
                                <!--                        <input value="woo-slider-pro-preset-2" type="radio" name="preset">-->
                                <!--                    </div>-->
                                <!---->
                                <!--                    <div class="col-sm-4">-->
                                <!--                        <img data-rel="lightcase" href="--><?php //echo plugins_url('/../bundle/images/presets/preset-placeholder.png', __FILE__); ?><!--" src="--><?php //echo plugins_url('/../bundle/images/presets/preset-placeholder.png', __FILE__); ?><!--" alt="">-->
                                <!--                        <input value="woo-slider-pro-preset-3" type="radio" name="preset">-->
                                <!--                    </div>-->
                                <!---->
                                <!--                    <div class="col-sm-4">-->
                                <!--                        <img data-rel="lightcase" href="--><?php //echo plugins_url('/../bundle/images/presets/preset-placeholder.png', __FILE__); ?><!--" src="--><?php //echo plugins_url('/../bundle/images/presets/preset-placeholder.png', __FILE__); ?><!--" alt="">-->
                                <!--                        <input value="woo-slider-pro-preset-4" type="radio" name="preset">-->
                                <!--                    </div>-->
                                <!---->
                                <!--                    <div class="col-sm-4">-->
                                <!--                        <img data-rel="lightcase" href="--><?php //echo plugins_url('/../bundle/images/presets/preset-placeholder.png', __FILE__); ?><!--" src="--><?php //echo plugins_url('/../bundle/images/presets/preset-placeholder.png', __FILE__); ?><!--" alt="">-->
                                <!--                        <input value="woo-slider-pro-preset-5" type="radio" name="preset">-->
                                <!--                    </div>-->
                                <!---->
                                <!--                    <div class="col-sm-4">-->
                                <!--                        <img data-rel="lightcase" href="--><?php //echo plugins_url('/../bundle/images/presets/preset-placeholder.png', __FILE__); ?><!--" src="--><?php //echo plugins_url('/../bundle/images/presets/preset-placeholder.png', __FILE__); ?><!--" alt="">-->
                                <!--                        <input value="woo-slider-pro-preset-6" type="radio" name="preset">-->
                                <!--                    </div>-->
                                <!---->
                                <!--                    <div class="col-sm-4">-->
                                <!--                        <img data-rel="lightcase" href="--><?php //echo plugins_url('/../bundle/images/presets/preset-placeholder.png', __FILE__); ?><!--" src="--><?php //echo plugins_url('/../bundle/images/presets/preset-placeholder.png', __FILE__); ?><!--" alt="">-->
                                <!--                        <input value="woo-slider-pro-preset-7" type="radio" name="preset">-->
                                <!--                    </div>-->
                            </div>

                        </div>



                    </form>
                </div>
            </div>



        </div> <!-- end row  -->
    </div> <!-- end container  -->
</div>














<div id="hidden-data">
    <div id="list-slider" style="display: none">

    </div>
</div>


