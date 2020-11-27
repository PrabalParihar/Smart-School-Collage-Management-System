<footer>
    <div class="container text-center">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <h3 class="fo-title"><?php echo $this->lang->line('links'); ?></h3>
                <ul class="f1-list">
                    <?php
                    foreach ($footer_menus as $footer_menu_key => $footer_menu_value) {

                        $cls_menu_dropdown = "";
                        if (!empty($footer_menu_value['submenus'])) {

                            $cls_menu_dropdown = "dropdown";
                        }
                        ?>
                        <li class="<?php echo $cls_menu_dropdown; ?>">
                            <?php
                            $top_new_tab = '';
                            $url = '#';
                            if ($footer_menu_value['open_new_tab']) {
                                $top_new_tab = "target='_blank'";
                            }
                            if ($footer_menu_value['ext_url']) {
                                $url = $footer_menu_value['ext_url_link'];
                            } else {
                                $url = site_url($footer_menu_value['page_url']);
                            }
                            ?>

                            <a href="<?php echo $url; ?>" <?php echo $top_new_tab; ?>><?php echo $footer_menu_value['menu']; ?></a>

                            <?php
                            ?>


                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div><!--./col-md-3-->

            <div class="col-md-4 col-sm-6">
                <h3 class="fo-title"><?php echo $this->lang->line('follow_us'); ?></h3>
                <ul class="company-social">
                    <?php $this->view('/themes/default/social_media'); ?>        
                </ul>
            </div><!--./col-md-3-->
            
            <!--<div class="col-md-3 col-sm-6">
                <a class="twitter-timeline" data-tweet-limit="1" href="#"></a>
            </div>./col-md-3-->

             <div class="col-md-4 col-sm-4">
                <h3 class="fo-title"><?php echo $this->lang->line('feedback'); ?></h3>
                <?php
                if (in_array('complain', json_decode($front_setting->sidebar_options))) {
                    ?>
                    <div class="complain">
                        <a href="<?php echo site_url('page/complain') ?>"><i class="fa fa-pencil-square"></i><?php echo $this->lang->line('complain'); ?></a>
                    </div><!--./complain-->

                    <?php
                }
                ?>
            </div><!--./col-md-3-->

            <div class="col-md-12 col-sm-12">
                <!-- <h3 class="fo-title"><?php //echo $this->lang->line('contact'); ?></h3> -->
                <ul class="co-list">
                    <li><i class="fa fa-envelope"></i>
                        <a href="mailto:<?php echo $school_setting->email; ?>"><?php echo $school_setting->email; ?></a></li>
                    <li><i class="fa fa-phone"></i><?php echo $school_setting->phone; ?></li>
                    <li><i class="fa fa-map-marker"></i><?php echo $school_setting->address; ?></li>
                </ul>
            </div><!--./col-md-12-->

            <div class="col-md-12 col-sm-12">
                <p><?php echo $front_setting->footer_text; ?></p>
            </div>
        </div><!--./row-->
    </div><!--./container-->
  <a class="scrollToTop" href="#"><i class="fa fa-arrow-up"></i></a>  
</footer>

