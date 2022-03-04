<?php

function load_media_files() {
  wp_enqueue_media();
}


function register_admin_script(){
    ?>
    <script>
       var customUploads = (<?php echo json_encode(get_post_meta(get_the_ID(), 'custom_image_data', true));?>);
    </script>
    <?php
}

add_action( 'wp_print_scripts', 'register_admin_script' );

function aka_theme_support(){
  add_theme_support('title-tag');
  add_theme_support('custom-logo');
  add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'aka_theme_support');

function aka_menus(){
   $locations = array(
      'sidemenu' => 'top menu for both mobile and computer'
   );

   register_nav_menus($locations);
}

add_action('init', 'aka_menus');

function aka_register_styles(){
    $theme_version = wp_get_theme()->get('Version');
    wp_enqueue_style('aka-accordion', get_template_directory_uri() . '/assets/css/accordion.css', array(), $theme_version, 'all');
    wp_enqueue_style('aka-fresco', get_template_directory_uri() . '/assets/css/fresco.css', array(), $theme_version, 'all');
    wp_enqueue_style('aka-owl', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', array(), '2.3.4', 'all');
    wp_enqueue_style('aka-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.4.1', 'all');
    wp_enqueue_style('aka-fontawesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.7.0', 'all');
    wp_enqueue_style('aka-themify', get_template_directory_uri() . '/assets/css/themify-icons.css', array(), $theme_version, 'all');
    wp_enqueue_style('aka-style', get_template_directory_uri() . '/assets/css/style.css', array('aka-bootstrap', 'aka-fontawesome', 'aka-themify', 'aka-accordion', 'aka-accordion', 'aka-fresco'), $theme_version, 'all');
}


function aka_register_scripts(){
    $theme_version = wp_get_theme()->get('Version');
    wp_enqueue_script('aka-jquery', get_template_directory_uri() . '/assets/js/vendor/jquery-3.2.1.min.js', array(), '3.2.1', 'all', true);
    wp_enqueue_script('aka-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('aka-jquery'), '4.4.1', 'all', true);
    wp_enqueue_script('aka-owl', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), '2.3.4', 'all', true);
    wp_enqueue_script('aka-imagesloaded', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array(), '4.1.4', 'all', true);
    wp_enqueue_script('aka-isotope', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', array(), '3.0.6', 'all', true);
    wp_enqueue_script('aka-nicescroll', get_template_directory_uri() . '/assets/js/jquery.nicescroll.min.js', array(), '3.7.6', 'all', true);
    wp_enqueue_script('aka-circle-progress', get_template_directory_uri() . '/assets/js/circle-progress.min.js', array(), '1.2.2', 'all', true);
    wp_enqueue_script('aka-pana-accordion', get_template_directory_uri() . '/assets/js/pana-accordion.js', array(), '4.7.0', 'all', true);
    wp_enqueue_script('aka-main', get_template_directory_uri() . '/assets/js/main.js', array(), $theme_version, 'all', true);
}

add_action('wp_enqueue_scripts', 'aka_register_scripts');

add_action('wp_enqueue_scripts', 'aka_register_styles');


function custom_fields(){
    add_meta_box(
      'project_cf',
      'project details',
      'aka_custom_project_fields',
      'projects',
      'normal',
      'low'
    );
}

function aka_projects(){
    $labels = array(
      'name'          => _x('Projects', 'Post type general name', 'projects'),
      'singular_name' => _x('Proejct', 'Post type singular name', 'project')
    );  

    $args   = array(
      'labels' => $labels,
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'query_var' => true,
      'rewrite' =>  array('slug' => 'project'),
      'capability_type' => 'post',
      'has_archive' => true,
      'hierarchical' => false,
      'menu_position' => null,
      'supports' => array('title', 'editor', 'thumbnail')
    ); 

    register_post_type('projects', $args);
    
}

add_action('init', 'aka_projects');

function save_custom_image( $post_id ){
    $is_autosave    = wp_is_post_autosave( $post_id );
    $is_revision    = wp_is_post_revision( $post_id );
    // $is_valid_nonce = (isset( $_POST['custom_image_nonce'] ) && wp_verify_nonce( $_POST['custom_image_nonce'], 'my-nonce' ));

    if( $is_autosave || $is_revision){
        return true;
    }

    $data = [];

    if( isset( $_POST['custom_image_data'] ) ){

        $image_data = json_decode( stripslashes( $_POST['custom_image_data'] ) );

        for($x = 0; $x < count($image_data); $x++){
            array_push( $data, array('id' => intval($image_data[$x]->id) , 'src' =>  $image_data[$x]->url  ) );
            //  $data .= $image_data[$x]->url .',';
        }

        update_post_meta( $post_id, 'custom_image_data', $data );

    }
}

add_action('save_post', __NAMESPACE__ .'\save_custom_image', 10, 2);

function aka_custom_project_fields(){
  wp_nonce_field( basename( __FILE__ ), 'custom_image_nonce');
  ?>
    <style>
      .mt-2{
        margin-top:10px;
      }
    </style>  

    <?php
        global $wpdb;
        $db      = $wpdb->prefix . 'project_details';
        $id      = get_the_id();
        $address = $wpdb->get_var("SELECT `address` FROM $db WHERE `id` = $id");
    ?>
    <div class="form">
        <div class="form-group">
            <label class="form-control-label">address</label>
            <input type="text" class="form-control" placeholder="project address" name="address" value="<?php echo $address?>"/>
        </div>

        <div class="form-group mt-2" id="images-container">
        </div>

        <div class="form-group mt-2">
            <label class="form-control-label">Images</label>
            <input type="text" class="form-control" accept="image/*" hidden name="custom_image_data" id="custom_image_data"/>
            <button type="button" class="btn btn-success" id="add-btn" >Add images</button>
            <button type="button" class="btn btn-danger" id="remove-btn" >Remove images</button>
        </div>
    </div>
    <script>
         var addButton    = document.getElementById('add-btn');
         var removeButton = document.getElementById('remove-btn');
         var images       = document.getElementById('images');
         var hidden       = document.getElementById('custom_image_data');

         jQuery(document).ready( function($){ 

              var customUploader = wp.media(
                {
                    title  : 'select images',
                    button : {
                        text : 'use this image'
                    },
                    multiple: true
                }
              );

              addButton.addEventListener('click', function(){
                    if(customUploader){
                      customUploader.open();
                    }
              });

              customUploader.on('select', function(){
                    var attachment = customUploader.state().get('selection').toJSON();
                    let images = [];
                    document.getElementById("images-container").innerHTML = '';
                    for(x = 0; x < attachment.length; x++){
                      var elem = document.createElement("img");
                      elem.setAttribute("src", attachment[x].url);
                      images [x] = {id : attachment[x].id, url : attachment[x].url};
                      document.getElementById("images-container").appendChild(elem);
                    }
                    images = JSON.stringify(images);
                    hidden.setAttribute( 'value', images );
              });

              for(i = 0; i < customUploads.length; i++){
                var elem = document.createElement("img");
                elem.setAttribute("src", customUploads[i].src);
                document.getElementById("images-container").appendChild(elem);                   
              }

         });

    </script>  
  <?php
}

add_action('admin_init', 'custom_fields');
add_action('admin_enqueue_scripts', 'load_media_files');

function save_details(){
  $address = $_POST['address'];
  
  global $wpdb ;
  $project_id = get_the_id();
  $db      = $wpdb->prefix . 'project_details';
  $exist   = $wpdb->get_var("SELECT `address` FROM $db WHERE `id` = $project_id");

  if(!$exist){    
    $wpdb->insert(
      $wpdb->prefix . 'project_details',
      [
        'address'    => $address,
        'id'         => $project_id
      ]
    );
  }else{
    $wpdb->update(
      $wpdb->prefix . 'project_details',
      [
        'address'    => $address,
      ],
      [
        'id'         => $project_id
      ]
    );
  }
}

add_action('save_post', 'save_details');


function pw_show_gallery_image_urls( $content ) {

  global $post;

  // Only do this on singular items
  if( ! is_singular() )
    return $content;

  // Make sure the post has a gallery in it
  if( ! has_shortcode( $post->post_content, 'gallery' ) )
    return $content;

  // Retrieve all galleries of this post
  $galleries = get_post_galleries_images( $post );

 $image_list = '<ul>';

 // Loop through all galleries found
 foreach( $galleries as $gallery ) {

   // Loop through each image in each gallery
   foreach( $gallery as $image ) {

     $image_list .= '<li>' . $image . '</li>';

   }

 }

 $image_list .= '</ul>';

 // Append our image list to the content of our post
 $content .= $image_list;

  return $content;

}
add_filter( 'the_content', 'pw_show_gallery_image_urls' );


//widgets

function aka_custom_widget(){
    if(current_user_can('manage_options')){
        wp_add_dashboard_widget('custom_contact_widget', 'Contact details', 'custom_dashboard_contact');
    }
}

if(!function_exists('custom_dashboard_contact')){

  function custom_dashboard_contact(){
      ?>
        <div class="wrap">
            <form method="post" action="options.php">
                <?php wp_nonce_field('update-options'); ?>

                <table>
                    <tr>
                        <th scope="row" width="120" align="left" valign="top">Phone Number:</th>
                        <td>
                              <input type="text" name="phone_number" style="width:100%;" size="255" value="<?php echo get_option('phone_number')?>">
                        </td> 
                    </tr>
                    <tr>
                        <th scope="row" width="120" align="left" valign="top">Email:</th>
                        <td>
                              <input type="email" name="email" style="width:100%;" size="255" value="<?php echo get_option('email')?>">
                        </td> 
                    </tr>
                    <tr>
                        <th scope="row" width="120" align="left" valign="top">Address:</th>
                        <td>
                              <input type="text" name="address" style="width:100%;" size="255" value="<?php echo get_option('address')?>">
                        </td> 
                    </tr>
                    <tr>
                        <th scope="row" width="120" align="left" valign="top">Facebook:</th>
                        <td>
                              <input type="text" name="facebook" style="width:100%;" size="255" value="<?php echo get_option('facebook')?>">
                        </td> 
                    </tr>
                    <tr>
                        <th scope="row" width="120" align="left" valign="top">Instagram:</th>
                        <td>
                              <input type="text" name="instagram" style="width:100%;" size="255" value="<?php echo get_option('instagram')?>">
                        </td> 
                    </tr>
                    <tr>
                        <th scope="row" width="120" align="left" valign="top">Linkedin:</th>
                        <td>
                              <input type="text" name="linkedin" style="width:100%;" size="255" value="<?php echo get_option('linkedin')?>">
                        </td> 
                    </tr>
                    <tr>
                        <th scope="row" width="120" align="left" valign="top">Twitter:</th>
                        <td>
                              <input type="text" name="twitter" style="width:100%;" size="255" value="<?php echo get_option('twitter')?>">
                        </td> 
                    </tr>
                </table>
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="page_options" value="phone_number, email, address, facebook, linkedin, twitter, instagram">
                <p class="submit">
                    <input type="submit" class="button-primary" value="<?php _e('Save changes'); ?>">
                </p>  
            </form>
        </div>
      <?php
  }

}

add_action('wp_dashboard_setup', 'aka_custom_widget');
//widgets
?>
