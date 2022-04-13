<?php
/**
 * Template Name: Custom home
 */
get_header(); ?>

<main role="main" id="maincontent">
  <?php do_action( 'advance_startup_above_slider' ); ?>

  <?php if( get_theme_mod( 'advance_startup_slider_hide', false) != '' || get_theme_mod( 'advance_startup_responsive_slider', false) != '') { ?>
    <section id="slider" class="mw-100 m-auto p-0">
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-interval="<?php echo esc_attr(get_theme_mod('advance_startup_slider_speed_option', 3000)); ?>"> 
        <?php $advance_startup_slider_pages = array();
          for ( $count = 1; $count <= 4; $count++ ) {
            $mod = intval( get_theme_mod( 'advance_startup_slider_page' . $count ));
            if ( 'page-none-selected' != $mod ) {
              $advance_startup_slider_pages[] = $mod;
            }
          }
          if( !empty($advance_startup_slider_pages) ) :
            $args = array(
              'post_type' => 'page',
              'post__in' => $advance_startup_slider_pages,
              'orderby' => 'post__in'
            );
            $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            $i = 1;
        ?>     
        <div class="carousel-inner" role="listbox">
          <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
            <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
              <?php the_post_thumbnail(); ?>
              <div class="carousel-caption">
                <div class="inner_carousel text-center">
                  <?php if( get_theme_mod('advance_startup_slider_title_Show_hide',true) != ''){ ?>
                    <h1 class="text-capitalize my-2"><?php the_title(); ?></h1>
                  <?php } ?>
                  <?php if( get_theme_mod('advance_startup_slider_content_Show_hide',true) != ''){ ?>
                    <p><?php $excerpt = get_the_excerpt(); echo esc_html( advance_startup_string_limit_words( $excerpt, esc_attr(get_theme_mod('advance_startup_slider_excerpt_length','20')))); ?></p>
                  <?php } ?>
                  <?php if( get_theme_mod('advance_startup_slider_button','READ MORE') != ''){ ?>
                    <div class="readbtn mt-md-3">
                      <a href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('advance_startup_slider_button','READ MORE'));?><i class="fas fa-angle-right ms-2"></i><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('advance_startup_slider_button','READ MORE'));?><i class="fas fa-angle-right"></i></span></a>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          <?php $i++; endwhile; 
          wp_reset_postdata();?>
        </div>
        <?php else : ?>
          <div class="no-postfound"></div>
        <?php endif;
        endif;?>
        <div class="slider-nex-pre">
          <a class="carousel-control-prev" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev" role="button">
            <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
            <span class="screen-reader-text"><?php esc_html_e( 'Previous','tech-startup' );?></span>
          </a>
          <a class="carousel-control-next" data-bs-target="#carouselExampleCaptions" data-bs-slide="next" role="button">
            <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
            <span class="screen-reader-text"><?php esc_html_e( 'Next','tech-startup' );?></span>
          </a>
        </div>
      </div>
      <div class="clearfix"></div>
    </section>
  <?php } ?>

  <?php do_action( 'advance_startup_below_slider' ); ?>

  <?php 
    // Logo image URLs
    $feature1 = get_theme_mod('tbs-logo1');
    $feature2 = get_theme_mod('tbs-logo2');
    $feature3 = get_theme_mod('tbs-logo3');
    $feature4 = get_theme_mod('tbs-logo4');

    // Post ids and alt text respectively
    if ($feature1 != '') {
      $feature1_id = attachment_url_to_postid($feature1);
      $image1_alt = get_post_meta( $feature1_id, '_wp_attachment_image_alt', true );
    }
    if ($feature2 != '') {
      $feature2_id = attachment_url_to_postid($feature2);
      $image2_alt = get_post_meta( $feature2_id, '_wp_attachment_image_alt', true );
    }
    if ($feature3 != '') {
    $feature3_id = attachment_url_to_postid($feature3);
    $image3_alt = get_post_meta( $feature3_id, '_wp_attachment_image_alt', true );
    }
    if ($feature4 != '') {
      $feature4_id = attachment_url_to_postid($feature4);
      $image4_alt = get_post_meta( $feature4_id, '_wp_attachment_image_alt', true );
    }
  ?>

  <?php if( get_theme_mod('tbs-logo1') != '' || get_theme_mod('tbs-logo2') != '' || get_theme_mod('tbs-logo3') != '' || get_theme_mod('tbs-logo4') != '' ){ ?>
    <section id="partners" class="py-5 px-0 text-center">
      <!-- <h2>Partners</h2> -->
      <?php if( get_theme_mod('tbs-logo1') != ''){ ?>
        <img src="<?php echo esc_url( $feature1 ); ?>" alt="<?php echo esc_html( $image1_alt ); ?>">
      <?php }?>
      <?php if( get_theme_mod('tbs-logo2') != ''){ ?>
        <img src="<?php echo esc_url( $feature2 ); ?>" alt="<?php echo esc_html( $image2_alt ); ?>">
      <?php }?>
      <?php if( get_theme_mod('tbs-logo3') != ''){ ?>
        <img src="<?php echo esc_url( $feature3 ); ?>" alt="<?php echo esc_html( $image3_alt ); ?>">
      <?php }?>
      <?php if( get_theme_mod('tbs-logo4') != ''){ ?>
        <img src="<?php echo esc_url( $feature4 ); ?>" alt="<?php echo esc_html( $image4_alt ); ?>">
      <?php }?>
      <?php if( get_theme_mod('tbs-partners-page') != ''){ ?>
        <div class="read-more-btn">
          <a href="<?php echo get_permalink( get_theme_mod ( 'tbs-partners-page' ) ); ?>">
            SEE ALL PARTNERS
            <i class="fas fa-angle-right ms-2"></i>
            <span class="screen-reader-text">
              SEE ALL PARTNERS
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      <?php } ?>
    </section>
  <?php } ?>

  <?php do_action( 'advance_startup_above_we_provide_section' ); ?>

  <?php if( get_theme_mod('advance_startup_title') != '' || get_theme_mod( 'advance_startup_we_provide_category' )!= ''){ ?>
    <section id="we_provide" class="py-5 px-0 text-center">
      <div class="container">
        <?php if( get_theme_mod('advance_startup_title') != ''){ ?>
          <h2><?php echo esc_html(get_theme_mod('advance_startup_title','')); ?></h2>
        <?php } ?>
        <div class="row">
          <?php 
           $advance_startup_catData =  get_theme_mod('advance_startup_we_provide_category');
           if($advance_startup_catData){
            $page_query = new WP_Query(array( 'category_name' => esc_html($advance_startup_catData,'tech-startup')));?>
              <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
                <div class=" col-lg-4 col-md-6">
                  <div class="cat-posts p-3 my-2">
                    <?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?>
                    <div class="cat_body mb-2">
                      <h3 class="title"><?php the_title(); ?></h3>
                      <p>
                        <?php $excerpt = get_the_excerpt(); echo esc_html( advance_startup_string_limit_words( $excerpt,12 ) ); ?>
                      </p> 
                      <div class="theme_button my-2 mx-0">
                        <?php if( get_theme_mod('advance_startup_category_button_text','VIEW DETAILS') != ''){ ?>
                          <a href="<?php the_permalink(); ?>"><?php echo esc_html( get_theme_mod('advance_startup_category_button_text',__('VIEW DETAILS', 'tech-startup')) ); ?><i class="fas fa-angle-right ms-2"></i><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('advance_startup_category_button_text',__('VIEW DETAILS', 'tech-startup')) ); ?></span>
                          </a>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div> 
              <?php endwhile;
              wp_reset_postdata();
              }
            ?>
        </div>
      </div>
    </section>
  <?php }?>

  <div class="header-nav">
    <?php do_action( 'advance_startup_below_we_provide_section' ); ?>
  </div>

  <div id="content">
    <div class="container entry-content">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; // end of the loop. ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>