<?php
/*
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}
*/

// Added css and scripts to the Child theme
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles');
function child_enqueue_styles() {
  // slider css and script
  wp_enqueue_style ('swiper-style', get_stylesheet_directory_uri().'/css/swiper.min.css');
  wp_enqueue_script( 'swiper-script', get_stylesheet_directory_uri().'/js/swiper.min.js');
  // main css and script
  wp_enqueue_style ('main-style', get_stylesheet_directory_uri().'/css/main.css');
  wp_enqueue_script( 'main-script', get_stylesheet_directory_uri() . '/js/main.js');
  // additional styles
  wp_enqueue_style ('additional-style', get_stylesheet_directory_uri().'/css/additional.css');
}

// Remove parent theme inline styles
function dequeue_parent_theme_css() {
  wp_dequeue_style('atomic-blocks-style');
  wp_deregister_style('atomic-blocks-style');

  // atomic-blocks-shared-styles
  wp_dequeue_style('atomic-blocks-shared-styles');
  wp_deregister_style('atomic-blocks-shared-styles');

  wp_dequeue_style( 'wp-block-library' );
  wp_deregister_style('wp-block-library');
}
add_action('wp_enqueue_scripts','dequeue_parent_theme_css', 100);
/*
function wpassist_remove_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_enqueue_scripts', 'wpassist_remove_block_library_css' );
*/

/*
 * Build markup for the Quote block
 */
// filter for Frontend output.
add_filter( 'lazyblock/quote-block/frontend_callback', 'media_quote_block', 10, 2 );
// filter for Editor output.
//add_filter( 'lazyblock/quote-block/editor_callback', 'media_quote_block', 10, 2 );
if ( ! function_exists( 'media_quote_block' ) ) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function media_quote_block( $output, $attributes ) {
        ob_start();
        $align_quote = (strpos($attributes['media_align'], 'left') !== false ? 'left' : 'right');
        ?>

        <div class="clients-flex <?php echo 'clients-flex_'.$align_quote; ?> brown">

          <?php if ( $align_quote == 'left'): ?>
          <div class="clients-flex__preview">
            <?php if ($attributes['quote_video_link'] != ''): ?>
            <div class="video-thumb">
            <?php endif; ?>
              <div class="preview-circle">
                <div class="preview-circle__crop">
                  <?php if ($attributes['quote_video_link'] == ''): ?>
                    <a href="<?php echo $attributes['quote_link']; ?>">
                  <?php endif; ?>
                      <img src="<?php echo $attributes['quote_image']['url']; ?>" alt="<?php echo $attributes['quote_image']['alt']; ?>">
                  <?php if ($attributes['quote_video_link'] == ''): ?>
                    </a>
                  <?php endif; ?>
                </div>
                <?php if ($attributes['quote_video_link'] != ''): ?>
                  <span class="video-play">
                    [video_popup url="<?php echo $attributes['quote_video_link']; ?>" text="" title=""]
                  </span>
                <?php endif; ?>
              </div>
            <?php if ($attributes['quote_video_link'] != ''): ?>
            </div>
            <?php endif; ?>

            <span class="clients-flex__preview-description"><?php echo $attributes['quote_media_caption']; ?></span>

          </div>
          <?php endif; ?>

          <article class="clients-flex__content">
            <h3><?php echo $attributes['quote_header']; ?></h3>
            <p><?php echo $attributes['quote_body']; ?></p>
            <address class="author">
                <a href="<?php echo $attributes['quote_link']; ?>">
                  – <?php echo $attributes['quote_author']; ?>
                </a>
            </address>
          </article>

          <?php if ( $align_quote == 'right'): ?>
            <div class="clients-flex__preview">
              <?php if ( !empty($attributes['quote_video_link']) ): ?>
              <div class="video-thumb">
              <?php endif; ?>
                <div class="preview-circle">
                  <div class="preview-circle__crop">
                    <?php if ($attributes['quote_video_link'] == ''): ?>
                      <a href="<?php echo $attributes['quote_link']; ?>">
                    <?php endif; ?>
                        <img src="<?php echo $attributes['quote_image']['url']; ?>" alt="<?php echo $attributes['quote_image']['alt']; ?>">
                    <?php if ($attributes['quote_video_link'] == ''): ?>
                      </a>
                    <?php endif; ?>
                  </div>
                  <?php if ( !empty($attributes['quote_video_link']) ): ?>
                    <span class="video-play">
                      [video_popup url="<?php echo $attributes['quote_video_link']; ?>" text="" title=""]
                    </span>
                  <?php endif; ?>
                </div>
              <?php if ( !empty($attributes['quote_video_link']) ): ?>
              </div>
              <?php endif; ?>

              <span class="clients-flex__preview-description"><?php echo $attributes['quote_media_caption']; ?></span>

            </div>
          <?php endif; ?>

        </div>

        <?php
        return ob_get_clean();
    }
endif;

/*
 * Build markup for the Icons block
 */
// filter for Frontend output.
add_filter( 'lazyblock/icons-block/frontend_callback', 'icons_block', 10, 2 );
// filter for Editor output.
//add_filter( 'lazyblock/icons-block/editor_callback', 'media_quote_block', 10, 2 );
if ( ! function_exists( 'icons_block' ) ) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function icons_block( $output, $attributes ) {
        ob_start();
        ?>
        <div class="open-icons gray">
              <div class="container"><span class="sub-title"><?php echo $attributes['subtitle']; ?></span>
                <h2 class="title"><?php echo $attributes['title']; ?></h2>
                <ul class="list-icons">
                  <li class="list-icon">
        			      <a href="<?php echo $attributes['icon_1_link']; ?>">
        				      <img class="icon" src="<?php echo $attributes['icon_1_image']['url']; ?>" alt="<?php echo $attributes['icon_1_image']['alt']; ?>">
        				      <img class="icon icon__hover" src="<?php echo $attributes['icon_1_image_hover']['url']; ?>" alt="<?php echo $attributes['icon_1_image_hover']['alt']; ?>">
                      <div class="list-icon-wrap">
                        <span class="list-icon__title"><?php echo $attributes['icon_1_title']; ?></span>
                        <p class="list-icon__content"><?php echo $attributes['icon_1_description']; ?></p>
                      </div>
                    </a>
                  </li>
                  <li class="list-icon">
        			      <a href="<?php echo $attributes['icon_2_link']; ?>">
        				      <img class="icon" src="<?php echo $attributes['icon_2_image']['url']; ?>" alt="<?php echo $attributes['icon_2_image']['alt']; ?>">
        				      <img class="icon icon__hover" src="<?php echo $attributes['icon_2_image_hover']['url']; ?>" alt="<?php echo $attributes['icon_2_image_hover']['alt']; ?>">
                      <div class="list-icon-wrap">
                        <span class="list-icon__title"><?php echo $attributes['icon_2_title']; ?></span>
                        <p class="list-icon__content"><?php echo $attributes['icon_2_description']; ?></p>
                      </div>
                    </a>
                  </li>
                  <li class="list-icon">
        			      <a href="<?php echo $attributes['icon_3_link']; ?>">
        				      <img class="icon" src="<?php echo $attributes['icon_3_image']['url']; ?>" alt="<?php echo $attributes['icon_3_image']['alt']; ?>">
        				      <img class="icon icon__hover" src="<?php echo $attributes['icon_3_image_hover']['url']; ?>" alt="<?php echo $attributes['icon_3_image_hover']['alt']; ?>">
                      <div class="list-icon-wrap">
                        <span class="list-icon__title"><?php echo $attributes['icon_3_title']; ?></span>
                        <p class="list-icon__content"><?php echo $attributes['icon_3_description']; ?></p>
                      </div>
                    </a>
                  </li>
                  <li class="list-icon">
        			      <a href="<?php echo $attributes['icon_4_link']; ?>">
        				      <img class="icon" src="<?php echo $attributes['icon_4_image']['url']; ?>" alt="<?php echo $attributes['icon_4_image']['alt']; ?>">
        				      <img class="icon icon__hover" src="<?php echo $attributes['icon_4_image_hover']['url']; ?>" alt="<?php echo $attributes['icon_4_image_hover']['alt']; ?>">
                      <div class="list-icon-wrap">
                        <span class="list-icon__title"><?php echo $attributes['icon_4_title']; ?></span>
                        <p class="list-icon__content"><?php echo $attributes['icon_4_description']; ?></p>
                      </div>
                    </a>
                  </li>
                  <li class="list-icon">
        			      <a href="<?php echo $attributes['icon_5_link']; ?>">
        				      <img class="icon" src="<?php echo $attributes['icon_5_image']['url']; ?>" alt="<?php echo $attributes['icon_5_image']['alt']; ?>">
        				      <img class="icon icon__hover" src="<?php echo $attributes['icon_5_image_hover']['url']; ?>" alt="<?php echo $attributes['icon_5_image_hover']['alt']; ?>">
                      <div class="list-icon-wrap">
                        <span class="list-icon__title"><?php echo $attributes['icon_5_title']; ?></span>
                        <p class="list-icon__content"><?php echo $attributes['icon_5_description']; ?></p>
                      </div>
                    </a>
                  </li>
                  <li class="list-icon">
        			      <a href="<?php echo $attributes['icon_6_link']; ?>">
        				      <img class="icon" src="<?php echo $attributes['icon_6_image']['url']; ?>" alt="<?php echo $attributes['icon_6_image']['alt']; ?>">
        				      <img class="icon icon__hover" src="<?php echo $attributes['icon_6_image_hover']['url']; ?>" alt="<?php echo $attributes['icon_6_image_hover']['alt']; ?>">
                      <div class="list-icon-wrap">
                        <span class="list-icon__title"><?php echo $attributes['icon_6_title']; ?></span>
                        <p class="list-icon__content"><?php echo $attributes['icon_6_description']; ?></p>
                      </div>
                    </a>
                  </li>
                  <li class="list-icon">
        			      <a href="<?php echo $attributes['icon_7_link']; ?>">
        				      <img class="icon" src="<?php echo $attributes['icon_7_image']['url']; ?>" alt="<?php echo $attributes['icon_7_image']['alt']; ?>">
        				      <img class="icon icon__hover" src="<?php echo $attributes['icon_7_image_hover']['url']; ?>" alt="<?php echo $attributes['icon_7_image_hover']['alt']; ?>">
                      <div class="list-icon-wrap">
                        <span class="list-icon__title"><?php echo $attributes['icon_7_title']; ?></span>
                        <p class="list-icon__content"><?php echo $attributes['icon_7_description']; ?></p>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
        <?php
        return ob_get_clean();
    }
endif;

/*
 * Build markup for the Video block
 */
// filter for Frontend output.
add_filter( 'lazyblock/video-lazy-block/frontend_callback', 'video_lazy_block', 10, 2 );
// filter for Editor output.
//add_filter( 'lazyblock/video-lazy-block/editor_callback', 'video_lazy_block', 10, 2 );
if ( ! function_exists( 'video_lazy_block' ) ) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function video_lazy_block( $output, $attributes ) {
        ob_start();
        ?>
        <div class="intro-video">
          <div class="container flex">

        	<div class="intro-video__circle">
        		<div class="video-thumb">
                    <img src="<?php echo $attributes['image']['url']; ?>" alt="<?php echo $attributes['image']['alt']; ?>"/>
                </div>
                <span class="video-play">
                    [video_popup url="<?php echo $attributes['video_link']; ?>" text="" title="" auto="" n="" p="" wrap="" rv="" w="" h="" co="" dc="" di="" img="" iv=""]
                </span>
        	</div>

            <div class="intro-video__content">
              <h1 class="intro-video__title"><?php echo $attributes['title']; ?></h1>
        		<p><?php echo $attributes['text']; ?></p>
              <p><b><?php echo $attributes['sub_title']; ?></b></p>
              <a href="<?php echo $attributes['learn_more']; ?>" class="intro-video__link">Learn More</a>
            </div>
          </div>
        </div>
        <?php
        return ob_get_clean();
    }
endif;

/*
 * Build markup for the Book Section block
 */
// filter for Frontend output.
add_filter( 'lazyblock/book-section/frontend_callback', 'book_section', 10, 2 );
// filter for Editor output.
//add_filter( 'lazyblock/book-section/editor_callback', 'book_section', 10, 2 );
if ( ! function_exists( 'book_section' ) ) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function book_section( $output, $attributes ) {
        ob_start();
        ?>
      <div class="book-orange home-book-section">
        <div class="container flex">
          <div class="book-orange__img">
            <a href="<?php echo $attributes['book_link']; ?>">
              <img src="<?php echo $attributes['book_image']['url']; ?>" alt="<?php echo $attributes['book_image']['alt']; ?>">
            </a>
          </div>
          <div class="book-orange__content"><span class="book-orange__subtitle"><?php echo $attributes['book_subtitle']; ?></span>
            <h2 class="book-orange__title">
              <a class="home-book-link" href="<?php echo $attributes['book_link']; ?>"><?php echo $attributes['book_title']; ?></a>
            </h2>
            <?php echo $attributes['book_copy']; ?>
            <p>
              <a href="<?php echo $attributes['book_download_link']; ?>"><span class="book-orange__subtitle"><?php echo $attributes['book_download_title']; ?></span></a>
            </p>
          </div>
        </div>
      </div>
        <?php
        return ob_get_clean();
    }
endif;

/*
 * Build markup for the Founder Slide block
 */
// filter for Frontend output.
add_filter( 'lazyblock/founder-slide-block/frontend_callback', 'founder_slide_block', 10, 2 );
// filter for Editor output.
//add_filter( 'lazyblock/founder-slide-block/editor_callback', 'founder_slide_block', 10, 2 );
if ( ! function_exists( 'founder_slide_block' ) ) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function founder_slide_block( $output, $attributes ) {
        ob_start();
        ?>
  <a href="<?php echo $attributes['link']; ?>">
  	<img class="slide__img" src="<?php echo $attributes['image']['url']; ?>" alt="<?php echo $attributes['image']['alt']; ?>">
  	<div class="slide__content">
  		<h3 class="slide__title"><?php echo $attributes['name']; ?></h3>
  		<h4 class="slide__subtitle"><?php echo $attributes['position']; ?></h4>
  		<?php echo $attributes['slider_text']; ?>
  	</div>
  </a>
        <?php
        return ob_get_clean();
    }
endif;

/*
 * Build markup for the Company Slide block
 */
// filter for Frontend output.
add_filter( 'lazyblock/company-slide-block/frontend_callback', 'company_slide_block', 10, 2 );
// filter for Editor output.
//add_filter( 'lazyblock/company-slide-block/editor_callback', 'company_slide_block', 10, 2 );
if ( ! function_exists( 'company_slide_block' ) ) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function company_slide_block( $output, $attributes ) {
        ob_start();
        ?>
      <img class="icons-slider__icon" src="<?php echo $attributes['image']['url']; ?>" alt="<?php echo $attributes['image']['alt']; ?>">
    	<div class="icons-slider__description">
    		<p><?php echo $attributes['description']; ?></p>
    		<a href="<?php echo $attributes['link']; ?>">Learn more</a>
    	</div>
        <?php
        return ob_get_clean();
    }
endif;

/*
 * Build markup for the News - Book item block
 */
// filter for Frontend output.
add_filter( 'lazyblock/news-book-item-block/frontend_callback', 'news_book_item_block', 10, 2 );
// filter for Editor output.
//add_filter( 'lazyblock/news-book-item-block/editor_callback', 'news_book_item_block', 10, 2 );
if ( ! function_exists( 'news_book_item_block' ) ) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function news_book_item_block( $output, $attributes ) {
        ob_start();
        ?>
        <a href="<?php echo $attributes['book_link']; ?>">
        	<img class="books-item__img" src="<?php echo $attributes['image']['url']; ?>" alt="<?php echo $attributes['image']['alt']; ?>"/>
        	<span class="books-item__orange"><?php echo $attributes['title']; ?>:</span>
        	<p class="books-item__title"><?php echo $attributes['subtitle']; ?></p>
        	<p class="books-item__author"><?php echo $attributes['author']; ?></p>
        	<p class="books-item__description"><?php echo $attributes['description']; ?></p>
        </a>
        <?php
        return ob_get_clean();
    }
endif;

/*
 * Build markup for the Book review Image
 */
// filter for Frontend output.
add_filter( 'lazyblock/book-review-image/frontend_callback', 'book_review_image', 10, 2 );
// filter for Editor output.
//add_filter( 'lazyblock/book-review-image/editor_callback', 'book_review_image', 10, 2 );
if ( ! function_exists( 'book_review_image' ) ) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function book_review_image( $output, $attributes ) {
        ob_start();
        ?>
        <div class="preview-circle">
          <img src="<?php echo $attributes['book_image']['url']; ?>" alt="<?php echo $attributes['book_image']['alt']; ?>">
        </div>
        <?php
        return ob_get_clean();
    }
endif;

/*
 * Build markup for the Bridgewater - Icon block
 */
// filter for Frontend output.
add_filter( 'lazyblock/bridgewater-icon-block/frontend_callback', 'bridgewater_icon_block', 10, 2 );
// filter for Editor output.
//add_filter( 'lazyblock/bridgewater-icon-block/editor_callback', 'bridgewater_icon_block', 10, 2 );
if ( ! function_exists( 'bridgewater_icon_block' ) ) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function bridgewater_icon_block( $output, $attributes ) {
        ob_start();
        ?>
        <div class="preview-circle">
        	<img src="<?php echo $attributes['image']['url']; ?>" alt="<?php echo $attributes['image']['alt']; ?>"/>
        </div>
        <?php
        return ob_get_clean();
    }
endif;

/*
 * Build markup for the Bridgewater - Video block
 */
// filter for Frontend output.
add_filter( 'lazyblock/bridgewater-video-block/frontend_callback', 'bridgewater_video_block', 10, 2 );
// filter for Editor output.
//add_filter( 'lazyblock/bridgewater-video-block/editor_callback', 'bridgewater_video_block', 10, 2 );
if ( ! function_exists( 'bridgewater_video_block' ) ) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function bridgewater_video_block( $output, $attributes ) {
        ob_start();
        ?>
        <div class="video-full">
        	<div class="video-shadow">
        		<img src="<?php echo $attributes['video_image']['url']; ?>" alt="<?php echo $attributes['video_image']['alt']; ?>"/>
        		<span class="video-play video-play_orange">
        			[video_popup url="<?php echo $attributes['video_url']; ?>" text="" title=""]
        		</span>
        	</div>
        </div>
        <?php
        return ob_get_clean();
    }
endif;

/*
 * Build markup for the Bridgewater - Book Review block
 */
// filter for Frontend output.
add_filter( 'lazyblock/bridgewater-book-review-block/frontend_callback', 'bridgewater_book_review_block', 10, 2 );
// filter for Editor output.
//add_filter( 'lazyblock/bridgewater-book-review-block/editor_callback', 'bridgewater_book_review_block', 10, 2 );
if ( ! function_exists( 'bridgewater_book_review_block' ) ) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function bridgewater_book_review_block( $output, $attributes ) {
        ob_start();
        ?>
        <div class="flex half-content-cols">
        	<div class="case-poster"><img src="<?php echo $attributes['image']['url']; ?>" alt="<?php echo $attributes['image']['alt']; ?>"/></div>
        	<div class="book__content">
        		<h2 class="book-reviews__title">Reviews</h2>
        		<p>
        			<?php echo $attributes['review_text']; ?> <span class="book-reviews__author">– <?php echo $attributes['author']; ?></span>
        		</p>
        	</div>
        </div>
        <?php
        return ob_get_clean();
    }
endif;

/*
 * Build markup for the Team Bio - Member Info block
 */
// filter for Frontend output.
add_filter( 'lazyblock/team-bio-member-info-block/frontend_callback', 'team_bio_member_info_block', 10, 2 );
// filter for Editor output.
//add_filter( 'lazyblock/team-bio-member-info-block/editor_callback', 'team_bio_member_info_block', 10, 2 );
if ( ! function_exists( 'team_bio_member_info_block' ) ) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function team_bio_member_info_block( $output, $attributes ) {
        ob_start();
        ?>
        <div class="flex half-content-cols">
        	<div class="team-bio__photo">
        		<div class="preview-circle">
        			<img src="<?php echo $attributes['image']['url']; ?>" alt="<?php echo $attributes['image']['alt']; ?>"/>
        		</div>
        	</div>
        	<div class="team-bio__short">
        		<h2 class="title"><?php echo $attributes['name']; ?></h2>
        		<span class="sub-title"><?php echo $attributes['position']; ?></span>
        		<?php echo $attributes['description']; ?>
        		<a class="button-circle" href="/contact">Contact</a>
        	</div>
        </div>
        <?php
        return ob_get_clean();
    }
endif;

/*
 * Build markup for the Services - 3 columns block
 */
// filter for Frontend output.
add_filter( 'lazyblock/services-columns-block/frontend_callback', 'services_columns_block', 10, 2 );
// filter for Editor output.
//add_filter( 'lazyblock/services-columns-block/editor_callback', 'services_columns_block', 10, 2 );
if ( ! function_exists( 'services_columns_block' ) ) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function services_columns_block( $output, $attributes ) {
        ob_start();
        ?>
  <div id="<?php echo $attributes['block_id']; ?>" class="preview-circle">
  	<img src="<?php echo $attributes['column_icon']['url']; ?>" alt="<?php echo $attributes['column_icon']['alt']; ?>" /></div>
  	<span class="sub-title"><?php echo $attributes['column_subtitle']; ?></span>
  	<h3 class="title"><?php echo $attributes['column_title']; ?></h3>
  	<div class="cols-content-wrap">
  	<?php echo $attributes['column_content']; ?>
  </div>
  <div class="small-cols-content__action">
  	<a href="<?php echo $attributes['column_file']; ?>"><?php echo $attributes['file_link_text']; ?></a>
  	<a class="button-circle" href="/contact">Learn More</a>
    <?php if ($attributes['column_file'] == '/download-the-developmental-sprints/'): ?>
      <a class="button-circle sign-up" href="/newsthinking/#events">sign up</a>
    <?php endif; ?>
  </div>
        <?php
        return ob_get_clean();
    }
endif;

/*
 * Build markup for the Services - Row content Item
 */
// filter for Frontend output.
add_filter( 'lazyblock/services-row-content-item/frontend_callback', 'services_row_content_item', 10, 2 );
// filter for Editor output.
//add_filter( 'lazyblock/services-row-content-item/editor_callback', 'services_row_content_item', 10, 2 );
if ( ! function_exists( 'services_row_content_item' ) ) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function services_row_content_item( $output, $attributes ) {
        ob_start();
        ?>
        <div id="<?php echo $attributes['block_id']; ?>" class="icon-content-item">
        	<div class="icon-content-item__icon">
        		<div class="preview-circle">
        			<img src="<?php echo $attributes['icon']['url']; ?>" alt="<?php echo $attributes['icon']['alt']; ?>"/>
        		</div>
        	</div>
        	<div class="icon-content-item__text">
        		<span class="sub-title"><?php echo $attributes['subtitle']; ?></span>
        		<h3 class="title"><?php echo $attributes['title']; ?></h3>
        		<?php echo $attributes['content']; ?>
        		<a class="orange-warning" href="<?php echo $attributes['read_more_link']; ?>"><?php echo $attributes['read_more_text']; ?></a>
        	</div>
        </div>
        <?php
        return ob_get_clean();
    }
endif;

/*
 * Build markup for the Team page Member block
 */
// filter for Frontend output.
add_filter( 'lazyblock/team-page-member-block/frontend_callback', 'team_page_member_block', 10, 2 );
// filter for Editor output.
//add_filter( 'lazyblock/team-page-member-block/editor_callback', 'team_page_member_block', 10, 2 );
if ( ! function_exists( 'team_page_member_block' ) ) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function team_page_member_block( $output, $attributes ) {
        ob_start();
        ?>
<a class="team-member" href="<?php echo $attributes['link_to_profile']; ?>">
	<div class="preview-circle">
		<img src="<?php echo $attributes['member_image']['url']; ?>" alt="<?php echo $attributes['member_image']['alt']; ?>"/>
	</div>
	<h3 class="team-member__name"><?php echo $attributes['member_name']; ?></h3>
	<h4 class="team-member__position"><?php echo $attributes['member_position']; ?></h4>
	<p><?php echo $attributes['member_description']; ?></p>
</a>
        <?php
        return ob_get_clean();
    }
endif;

/*
 * Build markup for the News - Row content Item
 */
// filter for Frontend output.
add_filter( 'lazyblock/news-row-content-item/frontend_callback', 'news_row_content_item', 10, 2 );
// filter for Editor output.
//add_filter( 'lazyblock/news-row-content-item/editor_callback', 'news_row_content_item', 10, 2 );
if ( ! function_exists( 'news_row_content_item' ) ) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function news_row_content_item( $output, $attributes ) {
        ob_start();
        ?>
      <div class="icon-content-item" id="<?php echo $attributes['block_id']; ?>">
      	<div class="icon-content-item__icon">
      	<div class="preview-circle">
      		<img src="<?php echo $attributes['icon']['url']; ?>" alt="<?php echo $attributes['icon']['alt']; ?>"/></div>
      	</div>
      	<div class="icon-content-item__text">
      		<span class="sub-title"><?php echo $attributes['subtitle']; ?></span>
      		<h3 class="title"><?php echo $attributes['title']; ?></h3>
      		<?php echo $attributes['content']; ?>
      	</div>
      </div>
        <?php
        return ob_get_clean();
    }
endif;

/*
 * Build markup for the Trajectory block
 */
// filter for Frontend output.
add_filter( 'lazyblock/trajectory-block/frontend_callback', 'trajectory_block', 10, 2 );
// filter for Editor output.
//add_filter( 'lazyblock/trajectory-block/editor_callback', 'trajectory_block', 10, 2 );
if ( ! function_exists( 'trajectory_block' ) ) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function trajectory_block( $output, $attributes ) {
        ob_start();
        ?>
        <div class="half-content-cols half-content-cols_right">
          <div class="container flex">
            <div class="half-content-cols__content"><span class="sub-title"><?php echo $attributes['sub_header']; ?></span>
              <h2 class="title"><?php echo $attributes['header']; ?></h2>
              <p><?php echo $attributes['content']; ?></p>
              <div class="half-content-cols__action flex">
                <span><?php echo $attributes['cta']; ?></span>
                <a class="button-circle" href="<?php echo $attributes['link']; ?>">Learn more</a></div>
            </div>
            <div class="half-content-cols__media">
              <div class="video-shadow"><img src="<?php echo $attributes['video_image']['url']; ?>" alt="<?php echo $attributes['video_image']['alt']; ?>">
              	<span class="video-play video-play_orange">
        [video_popup url="<?php echo $attributes['video_url']; ?>" text="" title="" auto="" n="" p="" wrap="" rv="" w="" h="" co="" dc="" di="" img="" iv=""]
              	</span>
              </div>
            </div>
          </div>
        </div>
        <?php
        return ob_get_clean();
    }
endif;

/*
 * Build markup for the Image and Text block
 */
// filter for Frontend output.
add_filter( 'lazyblock/image-and-text-block/frontend_callback', 'image_text_block', 10, 2 );
// filter for Editor output.
//add_filter( 'lazyblock/image-and-text-block/editor_callback', 'iamge_text_block', 10, 2 );
if ( ! function_exists( 'image_text_block' ) ) :
    /**
     * Test Render Callback
     *
     * @param string $output - block output.
     * @param array  $attributes - block attributes.
     */
    function image_text_block( $output, $attributes ) {
        ob_start();
        $align_image = (strpos($attributes['image_align'], 'left') !== false ? 'left' : 'right');
        ?>

        <div class="half-content-item <?php echo 'half-content-cols_'.$align_image; ?>">
          <div class="container flex">

          <?php if ( $align_image == 'left'): ?>
            <div class="half-content-cols__media">
              <div class="preview-circle">
                <img src="<?php echo $attributes['image']['url']; ?>" alt="<?php echo $attributes['image']['alt']; ?>">
              </div>
            </div>

          <?php endif; ?>

            <div class="half-content-cols__content"><span class="sub-title"><?php echo $attributes['sub_header']; ?></span>
              <h2 class="title"><?php echo $attributes['header']; ?></h2>
              <?php echo $attributes['text']; ?>

              <?php if ( !empty($attributes['learn_more_link']) ): ?>
                <div class="half-content-cols__action flex">
                  <span><?php echo $attributes['learn_more_title']; ?></span>
                  <a class="button-circle" href="<?php echo $attributes['learn_more_link']; ?>">Learn more</a>
                </div>
              <?php endif; ?>
            </div>

            <?php if ( $align_image == 'right'): ?>
              <div class="half-content-cols__media">
                <div class="preview-circle">
                  <img src="<?php echo $attributes['image']['url']; ?>" alt="<?php echo $attributes['image']['alt']; ?>">
                </div>
              </div>

            <?php endif; ?>

          </div>
        </div>

        <?php
        return ob_get_clean();
    }
endif;

/*
 * Build markup for the Services One-on-One Row block
 */
// filter for Frontend output.
add_filter( 'lazyblock/services-oneonone-row/frontend_callback', 'services_oneonone_row', 10, 2 );
// filter for Editor output.
//add_filter( 'lazyblock/services-oneonone-row/editor_callback', 'services_oneonone_row', 10, 2 );

if ( ! function_exists( 'services_oneonone_row' ) ) :
    function services_oneonone_row( $output, $attributes ) {
      ob_start();
      $align_image = (strpos($attributes['image_align'], 'left') !== false ? 'left' : 'right');
      ?>

      <div id="<?php echo $attributes['block_id']; ?>" class="experts-col <?php echo 'experts-col_' . $align_image; ?>">

        <?php if ( $align_image == 'left'): ?>
        <div class="experts-col__poster">
          <div class="video-shadow">
            <img src="<?php echo $attributes['image']['url']; ?>" alt="<?php echo $attributes['image']['alt']; ?>"/>
          </div>
          <p><?php echo $attributes['image_caption']; ?></p>
        </div>
        <?php endif; ?>

        <div class="experts-col__text">
          <div class="preview-circle"><img src="<?php echo $attributes['icon']['url']; ?>" alt="<?php echo $attributes['icon']['alt']; ?>"/></div>
          <div class="experts-col__header">
            <span class="sub-title"><?php echo $attributes['subtitle']; ?></span>
            <h3 class="title"><?php echo $attributes['title']; ?></h3>
          </div>
          <?php echo $attributes['content']; ?>
          <a class="button-circle" href="<?php echo $attributes['more_link_url']; ?>"><?php echo $attributes['more_link_text']; ?></a>
        </div>

        <?php if ( $align_image == 'right'): ?>
        <div class="experts-col__poster">
          <div class="video-shadow">
            <img src="<?php echo $attributes['image']['url']; ?>" alt="<?php echo $attributes['image']['alt']; ?>"/>
          </div>
          <p><?php echo $attributes['image_caption']; ?></p>
        </div>
        <?php endif; ?>

      </div>

      <?php
        return ob_get_clean();
    }
endif;

/*
 * Build markup for the Accoprdion block
 */
// filter for Frontend output.
add_filter( 'lazyblock/tean-bio-accordion-item/frontend_callback', 'tean_bio_accordion_item', 10, 2 );

if ( ! function_exists( 'tean_bio_accordion_item' ) ) :
    function tean_bio_accordion_item( $output, $attributes ) {
      print_r($output);
      ob_start();
      $attributes['item_content'] = str_replace('<a href="https://youtu', '<a class="vp-a" href="https://youtu', $attributes['item_content']);
      $attributes['item_content'] = str_replace('<a href="https://vimeo.com/', '<a class="vp-a" href="https://vimeo.com/', $attributes['item_content']);
      ?>
      <div class="accordion-info__item">
      	<span class="accordion-info__title"><?php echo $attributes['item_title']; ?></span>
      	<div class="accordion-info__content"><?php echo $attributes['item_content']; ?></div>
      </div>
      <?php
        return ob_get_clean();
    }
endif;

/*
 * Build markup for the News page Video block
 */
// filter for Frontend output.
add_filter( 'lazyblock/news-video-block/frontend_callback', 'news_video_block', 10, 2 );
// filter for Editor output.
//add_filter( 'lazyblock/news-video-block/editor_callback', 'news_video_block', 10, 2 );

if ( ! function_exists( 'news_video_block' ) ) :
    function news_video_block( $output, $attributes ) {
      ob_start();
      $align_video = (strpos($attributes['video_align'], 'left') !== false ? 'left' : 'right');
      ?>

      <div class="news-2cols">

        <?php if ( $align_video == 'left'): ?>
          <div class="news-col">
            <div class="video-shadow">
              <img src="<?php echo $attributes['video_image']['url']; ?>" alt="<?php echo $attributes['video_image']['alt']; ?>"/>

              <?php if ($attributes['video_url'] != ''): ?>
                <span class="video-play video-play_orange">
                  [video_popup url="<?php echo $attributes['video_url']; ?>" text="" title=""]
                </span>
              <?php endif; ?>

            </div>
          </div>
        <?php endif; ?>

        <div class="news-col">
          <p><?php echo $attributes['content']; ?></p>

          <?php if ($attributes['learn_more_link'] != ''): ?>
          <a class="button-circle" href="<?php echo $attributes['learn_more_link']; ?>">Learn more</a>
          <?php endif; ?>
        </div>

        <?php if ( $align_video == 'right'): ?>
          <div class="news-col">
            <div class="video-shadow">
              <img src="<?php echo $attributes['video_image']['url']; ?>" alt="<?php echo $attributes['video_image']['alt']; ?>"/>

              <?php if ($attributes['video_url'] != ''): ?>
                <span class="video-play video-play_orange">
                  [video_popup url="<?php echo $attributes['video_url']; ?>" text="" title=""]
                </span>
              <?php endif; ?>

            </div>
          </div>
        <?php endif; ?>

      </div>

      <?php
        return ob_get_clean();
    }
endif;

/*
 * Build markup for the Services - Row content Item image - Block
 */
 // filter for Frontend output.
 add_filter( 'lazyblock/services-row-content-item-image/frontend_callback', 'services_row_content_item_image', 10, 2 );
 // filter for Editor output.
 //add_filter( 'lazyblock/services-row-content-item-image/editor_callback', 'services_row_content_item_image', 10, 2 );

if ( ! function_exists( 'services_row_content_item_image' ) ) :
   function services_row_content_item_image( $output, $attributes ) {
     ob_start();
     ?>

     <div class="icon-content-item__poster">
    	<div class="video-shadow">
    		<img src="<?php echo $attributes['image']['url']; ?>" alt="<?php echo $attributes['image']['alt']; ?>"/>
    	</div>
    	<p>
        <?php if ($attributes['link'] != ''): ?>
        <a class="caption-link" href="<?php echo $attributes['link']; ?>">
        <?php endif; ?>
          <?php echo $attributes['image_caption']; ?>
        <?php if ($attributes['link'] != ''): ?>
        </a>
        <?php endif; ?>
      </p>
    </div>

     <?php
       return ob_get_clean();
   }
endif;

/*
 * Build markup for the News definition guide item - Block
 */
 // filter for Frontend output.
 add_filter( 'lazyblock/news-definition-guide-item/frontend_callback', 'news_definition_guide_item', 10, 2 );
 // filter for Editor output.
 //add_filter( 'lazyblock/news-definition-guide-item/editor_callback', 'news_definition_guide_item', 10, 2 );

if ( ! function_exists( 'news_definition_guide_item' ) ) :
   function news_definition_guide_item( $output, $attributes ) {
     ob_start();
     ?>

    <div class="guide-section">
      <p><?php echo $attributes['text'] ?></p>

      <?php if ($attributes['link_to_blog_post'] != ''): ?>
        <a class="guide-section__link" href="<?php echo $attributes['link_to_blog_post'] ?>">Read the blog post</a>
      <?php endif; ?>
    </div>

     <?php
       return ob_get_clean();
   }
endif;


function trademark_shortcode() {
   return '<sup>™</sup>';
}
add_shortcode( 'trademark', 'trademark_shortcode' );


function wpb_custom_new_menu() {
  register_nav_menus(
    array(
      'bottom-menu' => __( 'Bottom Menu' )
    )
  );
}
add_filter('wp_nav_menu_args', 'prefix_nav_menu_args');
function prefix_nav_menu_args($args = ''){
    $args['container'] = false;
    return $args;
}
add_action( 'init', 'wpb_custom_new_menu' );

function registered_trademark_shortcode() {
   return '<sup>®</sup>';
}

add_shortcode( 'registered_trademark', 'registered_trademark_shortcode' );

function year_shortcode () {
$year = date_i18n ('Y');
return $year;
}

add_shortcode ('year', 'year_shortcode');

function copyright_shortcode() {
   return '<sup>©</sup>';
}
add_shortcode( 'copyright', 'copyright_shortcode' );

function italic_text_shortcode($atts, $content, $name){
	return '<i>'.$content.'</i>';
}
add_shortcode( 'italic_text', 'italic_text_shortcode' );
?>
