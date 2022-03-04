<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Abdulaziz Alkholief Architects">
    <meta name="keywords" content="AKA, Abdulaziz Alkholief Architects">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="/aka/wp-content/themes/aka/assets/images/favicon.png">
    
    <?php
        wp_head()
    ?>
    
</head>

<body>
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <div class="menu-wrapper">
        <div class="menu-switch">
            <i class="ti-menu"></i>
        </div>
        <div class="menu-social-warp">
            <div class="menu-social">
                <a href="<?php echo get_option('facebook'); ?>"><i class="ti-facebook"></i></a>
                <a href="<?php echo get_option('twitter'); ?>"><i class="ti-twitter-alt"></i></a>
                <a href="<?php echo get_option('linkedin'); ?>"><i class="ti-linkedin"></i></a>
                <a href="<?php echo get_option('instagram'); ?>"><i class="ti-instagram"></i></a>
            </div>
        </div>
    </div>
    <div class="side-menu-wrapper">
        <div class="sm-header">
            <div class="menu-close">
                <i class="ti-arrow-left"></i>
            </div>
            <!-- <a href="index.html" class="site-logo"> -->
            <div class="site-logo" >
                <?php
                    if(function_exists('the_custom_logo')){
                        the_custom_logo();
                    }
                ?>
            </div>    
                <!-- <img src="/aka/wp-content/themes/aka/assets/images/logo.png" alt=""> -->
            <!-- </a> -->
        </div>
        <nav class="main-menu">
            <?php
                wp_nav_menu(
                    array(
                        'menu'           => 'sidemenu',
                        'container'      => '',
                        'theme-template' => 'primary'
                    )
                );
            ?>
        </nav>
        <div class="sm-footer">
            <div class="sm-socail">
                <a href="<?php echo get_option('facebook'); ?>"><i class="ti-facebook"></i></a>
                <a href="<?php echo get_option('twitter'); ?>"><i class="ti-twitter-alt"></i></a>
                <a href="<?php echo get_option('linkedin'); ?>"><i class="ti-linkedin"></i></a>
                <a href="<?php echo get_option('instagram'); ?>"><i class="ti-instagram"></i></a>
            </div>
            <div class="copyright-text">
                <p>
                    Developed by <a href="" target="_blank">Desktop</a>
                </p>
            </div>
        </div>
    </div>

    