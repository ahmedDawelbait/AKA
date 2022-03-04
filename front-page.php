
<?php
  get_header();
?>

<section class="hero-section">
  <div class="pana-accordion" id="accordion">
    <div class="pana-accordion-wrap">

      <?php
        $projects = new WP_Query(array(
          'posts_per_page' => 6,
          'post_type'      => 'projects',
          'orderby' => 'publish_date',
          'order' => 'DESC',
        ));

        if( $projects->have_posts() ){
          while( $projects->have_posts() ){
              $projects->the_post();
              ?>
                <div class="pana-accordion-item set-bg" data-setbg="<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); ?>">
                    <div class="pa-text">
                        <div class="pa-tag"><?php
                            global $wpdb ;
                            $project_id = get_the_id();
                            $db         = $wpdb->prefix . 'project_details';
                            $address    = $wpdb->get_var("SELECT `address` FROM $db WHERE `id` = $project_id");
                            echo $address;                             
                        ?></div>
                        <a href="<?php the_permalink(); ?>">
                          <h2><?php the_title(); ?></h2>
                          <h4>See More</h4>
                        </a>
                        <!-- <div class="pa-btn">
                            <a href="project-details.html" class="btn defult_btn">
                            See Project
                            </a>
                        </div> -->
                    </div>
                </div>
              <?php
          }
      }
      ?>

    </div>
  </div>
</section>

<?php
    get_footer();
?>