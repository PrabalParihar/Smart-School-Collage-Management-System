<!DOCTYPE html>
<html dir="<?php echo ($front_setting->is_active_rtl) ? "rtl" : "ltr"; ?>" lang="<?php echo ($front_setting->is_active_rtl) ? "ar" : "en"; ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $page['title']; ?></title>
        <meta name="title" content="<?php echo $page['meta_title']; ?>">
        <meta name="keywords" content="<?php echo $page['meta_keyword']; ?>">
        <meta name="description" content="<?php echo $page['meta_description']; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php echo base_url($front_setting->fav_icon); ?>" type="image/x-icon">
        <link href="<?php echo $base_assets_url; ?>css/owl.carousel.css" rel="stylesheet"> 
        <link href="<?php echo $base_assets_url; ?>css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo $base_assets_url; ?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $base_assets_url; ?>css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo $base_assets_url; ?>datepicker/bootstrap-datepicker3.css"/>
        <script src="<?php echo $base_assets_url; ?>js/jquery.min.js"></script>
             <script type="text/javascript">
            var base_url = "<?php echo base_url() ?>";
        </script>
        <?php
        //$this->load->view('layout/theme');

        if ($front_setting->is_active_rtl) {
            ?>
            <link href="<?php echo $base_assets_url; ?>rtl/bootstrap-rtl.min.css" rel="stylesheet">
            <link href="<?php echo $base_assets_url; ?>rtl/style-rtl.css" rel="stylesheet">
            <?php
        }
        ?>


        <?php echo $front_setting->google_analytics; ?> 
    </head>
    <body>
     <div class="toparea">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <ul class="social">
                            <?php $this->view('/themes/darkgray/social_media'); ?>

                        </ul>
                    </div><!--./col-md-3-->

                    <div class="col-lg-9 col-md-8 col-sm-6">
                        <ul class="top-right">
                            <li><a href="<?php echo site_url('site/userlogin') ?>"><i class="fa fa-user"></i>Login</a></li>

                        </ul>
                    </div><!--./col-md-5-->
                </div>
            </div>
        </div><!--./toparea-->

        <?php echo $header; ?>

        <?php echo $slider; ?>

        <?php if (isset($featured_image) && $featured_image != "") {
            ?>

            <?php
        }
        ?> 

        <div class="container spacet50">
            <div class="row"> 
                <?php
                $page_colomn = "col-md-12";

                if ($page_side_bar) {

                    $page_colomn = "col-md-12 col-sm-12";
                }
                ?>
                <div class="<?php echo $page_colomn; ?>">
                    <?php echo $content; ?> 
                </div>  
                <?php
                if ($page_side_bar) {
                    ?>


                    <?php
                }
                ?>


            </div><!--./row-->
        </div><!--./container-->  

        <?php echo $footer; ?>
        
        <script src="<?php echo $base_assets_url; ?>js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $base_assets_url; ?>js/jquery.waypoints.min.js"></script>
        <script type="text/javascript" src="<?php echo $base_assets_url; ?>js/jquery.counterup.min.js"></script>
        <script src="<?php echo $base_assets_url; ?>js/owl.carousel.min.js"></script>
        <script src="<?php echo $base_assets_url; ?>js/ss-lightbox.js"></script>
        <script src="<?php echo $base_assets_url; ?>js/custom.js"></script>
        <script type="text/javascript" src="<?php echo $base_assets_url; ?>datepicker/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript">
            $(function(){
    jQuery('img.svg').each(function(){
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');
    
        jQuery.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');
    
            // Add replaced image's ID to the new SVG
            if(typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if(typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass+' replaced-svg');
            }
    
            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');
            
            // Check if the viewport is set, else we gonna set it if we can.
            if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
            }
    
            // Replace image with new SVG
            $img.replaceWith($svg);
    
        }, 'xml');
    
    });
});

        </script>
    </body>
</html>