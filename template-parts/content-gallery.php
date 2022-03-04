<section class="gallery-section ">
    <div class="p-img">
        <img src="<?php the_post_thumbnail_url(); ?>">
        <div class="pa-text">
            <div class="pa-tag">
                <?php
                    the_category();
                ?>
            </div>
            <h2><?php 
                the_title();
            ?></h2>
            <p>
                <?php 
                    the_excerpt();
                ?>
            </p>
                </div>
            </div>

            <div class="nice-scroll ">
                <div class="gallery-warp ">
                    <div class="grid-sizer "></div>
                    <?php 
                        $images = get_post_meta(get_the_ID(), 'custom_image_data', true);
                        for($i = 0; $i < count($images); $i++) { 
                            ?>
                                <img src="" id="item<?php echo $i?>" />   
                            <?php 
                        } 
                        ?>
                            <script>
                                let sources = <?php echo json_encode($images) ?>;
                                for(i = 0; i < customUploads.length; i++){
                                    var elem = document.getElementById("item"+i);
                                    elem.setAttribute("src", customUploads[i].src);
                                }    
                            </script>    
                        <?php
                    ?>    
                </div>
            </div>

        </div>
    </div>
</section>    