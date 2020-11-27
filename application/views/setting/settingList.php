<style type="text/css">
  .wrapper {overflow: visible;}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1><i class="fa fa-gears"></i> <?php echo $this->lang->line('system_settings'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-12 uploadsticky">
                <div class="box box-primary">
                    <div class="box-body text-center">
                        <?php
                        if ($settinglist[0]['image'] == "") {
                            ?>
                            <img src="<?php echo base_url() ?>uploads/school_content/logo/images.png" class="img-thumbnail" alt="Cinque Terre" width="304" height="236">
                            <?php
                        } else {
                            ?>
                            <img src="<?php echo base_url() ?>uploads/school_content/logo/<?php echo $settinglist[0]['image']; ?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236">
                            <?php
                        }
                        ?>
                        <br/>
                        <br/>
                        <a href="#schsetting" role="button" class="btn btn-primary btn-sm upload_logo" data-toggle="tooltip" title="<?php echo $this->lang->line('edit')." ".$this->lang->line('print')." ".$this->lang->line('logo'); ?>" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"><i class="fa fa-picture-o"></i> <?php echo $this->lang->line('edit')." ".$this->lang->line('print')." ".$this->lang->line('logo'); ?></a>
                    </div>
                </div>
                    
                <div class="box box-primary">
                    <div class="box-body text-center">
                        <?php
                        if ($settinglist[0]['admin_logo'] == "") {
                            ?>
                            <img src="<?php echo base_url() ?>uploads/school_content/admin_logo/images.png" class="img-thumbnail " alt="Cinque Terre" width="204" height="60">
                            <?php
                        } else {
                            ?>
                            <img src="<?php echo base_url() ?>uploads/school_content/admin_logo/<?php echo $settinglist[0]['admin_logo']; ?>" class="img-thumbnail" alt="" width="204" height="60">
                            <?php
                        }
                        ?>
                        <br/>
                        <br/>
                        <a href="#admin_logo" role="button" class="btn btn-primary btn-sm upload_admin_logo" data-toggle="tooltip" title="<?php echo $this->lang->line('edit')." ".$this->lang->line('admin')." ".$this->lang->line('logo'); ?>" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"><i class="fa fa-picture-o"></i> <?php echo $this->lang->line('edit')." ".$this->lang->line('admin')." ".$this->lang->line('logo'); ?></a>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-body text-center">
                        <?php
                        if ($settinglist[0]['admin_small_logo'] == "") {
                            ?>
                            <img src="<?php echo base_url() ?>uploads/school_content/logo/images.png" class="img-thumbnail" alt="Cinque Terre" width="" height="">
                            <?php
                        } else {
                            ?>
                            <img src="<?php echo base_url() ?>uploads/school_content/admin_small_logo/<?php echo $settinglist[0]['admin_small_logo']; ?>" class="" alt="Cinque Terre" width="" height="">
                            <?php
                        }
                        ?>
                        <br/>
                        <br/>
                        <a href="#admin_small_logo" role="button" class="btn btn-primary btn-sm upload_admin_small_logo" data-toggle="tooltip" title="<?php echo $this->lang->line('edit')." ".$this->lang->line('admin')." ".$this->lang->line('small')." ".$this->lang->line('logo'); ?>" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"><i class="fa fa-picture-o"></i> <?php echo $this->lang->line('edit')." ".$this->lang->line('admin')." ".$this->lang->line('small')." ".$this->lang->line('logo'); ?></a>
                    </div>
                </div>
                
                 <div class="box box-primary">
                    <div class="box-body text-center">
                        <?php
                        if ($result->app_logo == "") {
                            ?>
                            <img src="<?php echo base_url() ?>uploads/school_content/logo/images.png" class="img-thumbnail img-responsive " alt="" width="" height="">
                            <?php
                        } else {
                            ?>
                            <img src="<?php echo base_url() ?>uploads/school_content/logo/app_logo/<?php echo $result->app_logo; ?>" class="img-responsive" alt="" width="" height="">
                            <?php
                        }
                        ?>
                        <br/>
                        <a href="#app_logo" role="button" class="btn btn-primary btn-sm upload_app_logo" data-toggle="tooltip" title="<?php echo $this->lang->line('edit_app_logo'); ?>" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"><i class="fa fa-picture-o"></i> <?php echo $this->lang->line('edit_app_logo');?></a>
                    </div>
                </div>






            </div>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><i class="fa fa-gear"></i> <?php echo $this->lang->line('general_settings'); ?></h3>
                        <div class="box-tools pull-right">

                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="">
                        <form role="form" id="schsetting_form" action="<?php //echo site_url('schsettings/ajax_schedit_new')    ?>" class="" method="post" enctype="multipart/form-data">

                            <div class="box-body">
                                
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4"><?php echo $this->lang->line('school_name'); ?><small class="req"> *</small></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="name" name="sch_name" value="<?php echo $result->name; ?>">
                                                <span class="text-danger"><?php echo form_error('name'); ?></span> <input type="hidden" name="sch_id" value="<?php echo $result->id; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4"><?php echo $this->lang->line('school_code'); ?></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="dise_code" name="sch_dise_code" value="<?php echo $result->dise_code; ?>">
                                                <span class="text-danger"><?php echo form_error('dise_code'); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                </div><!--./row-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2"><?php echo $this->lang->line('address'); ?><small class="req"> *</small></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="address" name="sch_address" value="<?php echo $result->address; ?>"> <span class="text-danger"><?php echo form_error('address'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--./row-->
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4"><?php echo $this->lang->line('phone'); ?><small class="req"> *</small></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="phone" name="sch_phone" value="<?php echo $result->phone; ?>"><span class="text-danger"><?php echo form_error('phone'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4"><?php echo $this->lang->line('email'); ?><small class="req"> *</small></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control"  id="email" name="sch_email" value="<?php echo $result->email; ?>">
                                                <span class="text-danger"><?php echo form_error('email'); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                </div><!--./row-->
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="settinghr"></div>
                                        <h4 class="session-head"><?php echo $this->lang->line('academic') . " " . $this->lang->line('session'); ?></h4>
                                    </div><!--./col-md-12-->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4"><?php echo $this->lang->line('session'); ?><small class="req"> *</small></label>
                                            <div class="col-sm-8">
                                                <select  id="session_id" name="sch_session_id" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php foreach ($sessionlist as $session) {
                                                        ?>
                                                        <option value="<?php echo $session['id'] ?>" <?php
                                                        if ($session['id'] == $result->session_id) {
                                                            echo "selected";
                                                        }
                                                        ?>><?php echo $session['session'] ?></option>
                                                            <?php } ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('session_id'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4"><?php echo $this->lang->line('session_start_month'); ?><small class="req"> *</small></label>
                                            <div class="col-sm-8">
                                                <select  id="start_month" name="sch_start_month" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php foreach ($monthList as $key => $month) {
                                                        ?>
                                                        <option value="<?php echo $key ?>" <?php
                                                        if ($key == $result->start_month) {
                                                            echo "selected";
                                                        }
                                                        ?> ><?php echo $month ?></option>
                                                            <?php } ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('start_month'); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                </div><!--./row-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="settinghr"></div>
                                        <h4 class="session-head"><?php echo $this->lang->line('attendence') . " " . $this->lang->line('type'); ?></h4>
                                    </div><!--./col-md-12-->


                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-6"><?php echo $this->lang->line('attendence'); ?></label>
                                            <div class="col-sm-6">
                                                <label class="radio-inline">
                                                    <input type="radio" name="attendence_type" value="0" <?php
                                                    if (!$result->attendence_type) {
                                                        echo "checked";
                                                    }
                                                    ?> ><?php echo $this->lang->line('day')." ".$this->lang->line('wise'); ?>
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="attendence_type" value="1" <?php
                                                    if ($result->attendence_type) {
                                                        echo "checked";
                                                    }
                                                    ?>><?php echo $this->lang->line('period') . " " . $this->lang->line('wise') ?>
                                                </label>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-6"> <?php echo $this->lang->line('biometric')." ".$this->lang->line('attendance'); ?></label>
                                            <div class="col-sm-6">
                                                <label class="radio-inline">
                                                    <input type="radio" name="biometric" value="0" <?php
                                                    if (!$result->biometric) {
                                                        echo "checked";
                                                    }
                                                    ?> ><?php echo $this->lang->line('disabled'); ?>
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="biometric" value="1" <?php
                                                    if ($result->biometric) {
                                                        echo "checked";
                                                    }
                                                    ?>><?php echo $this->lang->line('enabled'); ?>
                                                </label>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-sm-3"> <?php echo $this->lang->line('devices')." (".$this->lang->line('seprate')." ".$this->lang->line('by')." ".$this->lang->line('coma').")"; ?> </label>
                                                <div class="col-sm-9">
                                                   
                                                        <input type="text" class="form-control" id="name" name="biometric_device" value="<?php echo $result->biometric_device; ?>">
                                                        <span class="text-danger"><?php echo form_error('biometric_device'); ?></span> 
                                                    </div>

                                               
                                            </div>
                                        </div>

                                    </div>
                                </div><!--./row-->


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="settinghr"></div>
                                        <h4 class="session-head"><?php echo $this->lang->line('language'); ?></h4>
                                    </div><!--./col-md-12-->

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4"><?php echo $this->lang->line('language'); ?><small class="req"> *</small></label>
                                            <div class="col-sm-8">
                                                <select  id="language_id" name="sch_lang_id" class="form-control" >
                                                    <option value="">--<?php echo $this->lang->line('select') ?>--</option>
                                                    <?php foreach ($languagelist as $language) {
                                                        ?>
                                                        <option value="<?php echo $language['id']; ?>" <?php
                                                        if ($language['id'] == $result->lang_id) {
                                                            echo "selected";
                                                        }
                                                        ?> ><?php echo $language['language']; ?></option>
                                                            <?php } ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('language_id'); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-6"><?php echo $this->lang->line('language_rtl_text_mode'); ?></label>
                                            <div class="col-sm-6">
                                                <label class="radio-inline">
                                                    <input type="radio" name="sch_is_rtl" value="disabled" <?php
                                                    if ($result->is_rtl == "disabled") {
                                                        echo "checked";
                                                    }
                                                    ?> ><?php echo $this->lang->line('disabled'); ?>
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="sch_is_rtl" value="enabled" <?php
                                                    if ($result->is_rtl == "enabled") {
                                                        echo "checked";
                                                    }
                                                    ?>><?php echo $this->lang->line('enabled'); ?>
                                                </label>

                                            </div>
                                        </div>
                                    </div>


                                </div><!--./row-->


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="settinghr"></div>
                                        <h4 class="session-head"><?php echo $this->lang->line('date') . " " . $this->lang->line('time'); ?></h4>
                                    </div><!--./col-md-12-->


                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4"><?php echo $this->lang->line('date_format'); ?><small class="req"> *</small></label>
                                            <div class="col-sm-8">
                                                <select  id="date_format" name="sch_date_format" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php foreach ($dateFormatList as $key => $dateformat) {
                                                        ?>
                                                        <option value="<?php echo $key ?>" <?php
                                                        if ($key == $result->date_format) {
                                                            echo "selected";
                                                        }
                                                        ?>><?php echo $dateformat; ?></option>
                                                            <?php } ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('date_format'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4"><?php echo $this->lang->line('timezone'); ?><small class="req"> *</small></label>
                                            <div class="col-sm-8">
                                                <select  id="language_id" name="sch_timezone" class="form-control" >
                                                    <option value="">--<?php echo $this->lang->line('select') ?>--</option>
                                                    <?php foreach ($timezoneList as $key => $timezone) {
                                                        ?>
                                                        <option value="<?php echo $key ?>" <?php
                                                        if ($key == $result->timezone) {
                                                            echo "selected";
                                                        }
                                                        ?> ><?php echo $timezone ?></option>
                                                            <?php } ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('timezone'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--./row-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="settinghr"></div>
                                        <h4 class="session-head"><?php echo $this->lang->line('currency') ?></h4>
                                    </div><!--./col-md-12-->


                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4"><?php echo $this->lang->line('currency'); ?><small class="req"> *</small></label>
                                            <div class="col-sm-8">
                                                <select  id="currency" name="sch_currency" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php foreach ($currencyList as $currency) {
                                                        ?>
                                                        <option value="<?php echo $currency ?>" <?php
                                                        if ($currency == $result->currency) {
                                                            echo "selected";
                                                        }
                                                        ?> ><?php echo $currency; ?></option>
                                                            <?php } ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('currency'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4"><?php echo $this->lang->line('currency_symbol'); ?><small class="req"> *</small></label>
                                            <div class="col-sm-8">
                                                <input id="currency_symbol" name="sch_currency_symbol" placeholder="" type="text" class="form-control" value="<?php echo $result->currency_symbol; ?>" />
                                                <span class="text-danger"><?php echo form_error('currency_symbol'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 hidden">
                                        <div class="form-group row">
                                            <label class="col-sm-3"><?php echo $this->lang->line('currency_symbol') . " " . $this->lang->line('place') ?><small class="req"> *</small></label>
                                            <div class="col-sm-9">
                                                <?php foreach ($currencyPlace as $currency_place_k => $currency_place_v) {
                                                    ?>
                                                    <label class="radio-inline hidden">
                                                        <input type="hidden" name="currency_place" value="<?php echo $currency_place_k; ?>" <?php
                                                        if ($result->currency_place == $currency_place_k) {
                                                            echo "checked";
                                                        }
                                                        ?>  ><?php echo $currency_place_v; ?>
                                                    </label>

                                                <?php } ?>
                                            </div>
                                            <span class="text-danger"><?php echo form_error('currency_symbol'); ?></span>
                                        </div>
                                    </div>
                                </div><!--./row-->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="settinghr"></div>
                                        <h4 class="session-head"><?php echo $this->lang->line('student_admission_no_auto_generation'); ?></h4>
                                    </div><!--./col-md-12-->

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4"><?php echo $this->lang->line('auto') . " " . $this->lang->line('admission') . " " . $this->lang->line('no'); ?></label>
                                            <div class="col-sm-8">
                                                <label class="radio-inline">
                                                    <input type="radio" name="adm_auto_insert" value="0" <?php
                                                    if ($result->adm_auto_insert == 0) {
                                                        echo "checked"; 
                                                    }
                                                    ?>  ><?php echo $this->lang->line('disabled'); ?>
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="adm_auto_insert" value="1" <?php
                                                    if ($result->adm_auto_insert == 1) {
                                                        echo "checked";
                                                    }
                                                    ?> ><?php echo $this->lang->line('enabled'); ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4"><?php echo $this->lang->line('admission_no_prefix'); ?><small class="req"> *</small></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="adm_prefix" id="adm_prefix" class="form-control" value="<?php echo $result->adm_prefix; ?>">
                                                <span class="text-danger"><?php echo form_error('adm_prefix'); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4"><?php echo $this->lang->line('admission_no_digit'); ?><small class="req"> *</small></label>
                                            <div class="col-sm-8">
                                                <select  id="adm_no_digit" name="adm_no_digit" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php foreach ($digitList as $digit) {
                                                        ?>
                                                        <option value="<?php echo $digit ?>" <?php
                                                        if ($result->adm_no_digit == $digit) {
                                                            echo "selected";
                                                        }
                                                        ?> ><?php echo $digit; ?></option> <?php } ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('adm_no_digit'); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4"><?php echo $this->lang->line('admission') . " " . $this->lang->line('start') . " " . $this->lang->line('from') ?><small class="req"> *</small></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="adm_start_from" id="adm_start_from" class="form-control" value="<?php echo $result->adm_start_from; ?>">
                                                <span class="text-danger"><?php echo form_error('adm_start_from'); ?></span>
                                            </div>
                                        </div>
                                    </div>


                                </div><!--./row-->


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="settinghr"></div>
                                        <h4 class="session-head"><?php echo $this->lang->line('staff_id_auto_generation'); ?></h4>
                                    </div><!--./col-md-12-->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4"><?php echo $this->lang->line('auto_staff_id'); ?></label>
                                            <div class="col-sm-8">
                                                <label class="radio-inline">
                                                    <input type="radio" name="staffid_auto_insert" value="0" <?php
                                                    if ($result->staffid_auto_insert == 0) {
                                                        echo "checked";
                                                    }
                                                    ?>  ><?php echo $this->lang->line('disabled'); ?>
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="staffid_auto_insert" value="1" <?php
                                                    if ($result->staffid_auto_insert == 1) {
                                                        echo "checked";
                                                    }
                                                    ?>><?php echo $this->lang->line('enabled'); ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4"><?php echo $this->lang->line('staff_id_prefix') ?><small class="req"> *</small></label>
                                            <div class="col-sm-8">
                                                <input id="staffid_prefix" value="<?php echo $result->staffid_prefix; ?>" name="staffid_prefix" placeholder="" type="text" class="form-control" />
                                                <span class="text-danger"><?php echo form_error('staffid_prefix'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4"><?php echo $this->lang->line('staff_no_digit') ?><small class="req"> *</small></label>
                                            <div class="col-sm-8">
                                                <select  id="staffid_no_digit" name="staffid_no_digit" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php foreach ($digitList as $digit) {
                                                        ?>
                                                        <option value="<?php echo $digit ?>" <?php
                                                        if ($digit == $result->staffid_no_digit) {
                                                            echo "selected";
                                                        }
                                                        ?>><?php echo $digit; ?></option>
                                                            <?php } ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('staffid_no_digit'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4"><?php echo $this->lang->line('staff_id_start_from') ?><small class="req"> *</small></label>
                                            <div class="col-sm-8">

                                                <input id="staffid_start_from" value="<?php echo $result->staffid_start_from; ?>" name="staffid_start_from" placeholder="" type="text" class="form-control" />
                                                <span class="text-danger"><?php echo form_error('staffid_start_from'); ?></span>
                                            </div>
                                        </div>
                                    </div>


                                </div><!--./row-->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="settinghr"></div>
                                        <h4 class="session-head"><?php echo $this->lang->line('miscellaneous'); ?></h4>
                                    </div><!--./col-md-12-->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4"> <?php echo $this->lang->line('duplicate') . " " . $this->lang->line('fees') . " " . $this->lang->line('invoice'); ?></label>
                                            <div class="col-sm-8">
                                                <label class="radio-inline">
                                                    <input type="radio" name="is_duplicate_fees_invoice" value="0" <?php
                                                    if ($result->is_duplicate_fees_invoice == 0) {
                                                        echo "checked";
                                                    }
                                                    ?> ><?php echo $this->lang->line('disabled'); ?>
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="is_duplicate_fees_invoice" value="1"  <?php
                                                    if ($result->is_duplicate_fees_invoice == 1) {
                                                        echo "checked";
                                                    }
                                                    ?>><?php echo $this->lang->line('enabled'); ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4"><?php echo $this->lang->line('fee_due_days'); ?><small class="req"> *</small></label>
                                            <div class="col-sm-8">
                                                <input type="number" name="fee_due_days" id="fee_due_days" class="form-control" value="<?php echo $result->fee_due_days; ?>">
                                                <span class="text-danger"><?php echo form_error('fee_due_days'); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4"><?php echo $this->lang->line('teacher_restricted_mode'); ?></label>
                                            <div class="col-sm-8">
                                                <label class="radio-inline">
                                                    <input type="radio" name="class_teacher" value="no"  <?php
                                                    if ($result->class_teacher == "no") {
                                                        echo "checked";
                                                    }
                                                    ?> ><?php echo $this->lang->line('disabled'); ?>
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="class_teacher"  <?php
                                                    if ($result->class_teacher == "yes") {
                                                        echo "checked";
                                                    }
                                                    ?> value="yes"><?php echo $this->lang->line('enabled'); ?>
                                                </label>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4"><?php echo $this->lang->line('online') . " " . $this->lang->line('admission'); ?></label>
                                            <div class="col-sm-8">
                                                <label class="radio-inline">
                                                    <input type="radio" name="online_admission" value="0" <?php
                                                    if ($result->online_admission == 0) {
                                                        echo "checked";
                                                    }
                                                    ?> ><?php echo $this->lang->line('disabled'); ?>
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="online_admission" value="1" <?php
                                                    if ($result->online_admission == 1) {
                                                        echo "checked";
                                                    }
                                                    ?>><?php echo $this->lang->line('enabled'); ?>
                                                </label>
                                            </div>
                                         </div>
                                    </div>




                                 
                                </div><!--./row-->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="settinghr"></div>
                                        <h4 class="session-head"><?php echo $this->lang->line('mobile_app'); ?></h4>
                                    </div><!--./col-md-12-->

                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2"> <?php  echo $this->lang->line('mobile_app_api_url')?></label>
                                            <div class="col-sm-10">
                                                <input type="text" name="mobile_api_url" id="mobile_api_url" class="form-control" value="<?php echo $result->mobile_api_url; ?>">
                                                <span class="text-danger"><?php echo form_error('mobile_api_url'); ?></span>
                                            </div>
                                        </div>
                                    </div> 
                                         
                                     <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-5"> <?php  echo $this->lang->line('mobile_app_primary_color_code')?></label>
                                            <div class="col-sm-7">
                                                <input type="text" name="app_primary_color_code" id="app_primary_color_code" class="form-control" value="<?php echo $result->app_primary_color_code; ?>">
                                                <span class="text-danger"><?php echo form_error('app_primary_color_code'); ?></span>
                                            </div>
                                        </div>
                                    </div>  
                                     <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-6"> <?php echo $this->lang->line('mobile_app_secondary_color_code'); ?></label>
                                            <div class="col-sm-6">
                                                <input type="text" name="app_secondary_color_code" id="app_secondary_color_code" class="form-control" value="<?php echo $result->app_secondary_color_code; ?>">
                                                <span class="text-danger"><?php echo form_error('app_secondary_color_code'); ?></span>
                                            </div>
                                        </div>
                                    </div> 


                                </div><!--./row-->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="settinghr"></div>
                                        <h4 class="session-head"><?php echo $this->lang->line('current_theme'); ?></h4>
                                    </div><!--./col-md-12-->
                                    <div class="col-sm-12">

                                        <div id="input-type">
                                            <div class="row">
                                                <div class="col-sm-3 col-xs-6 col20">
                                                    <label class="radio-img">
                                                        <input name="theme" <?php
                                                        if ($settinglist[0]['theme'] == "white.jpg") {
                                                            echo "checked";
                                                        }
                                                        ?> value="white.jpg" type="radio" />
                                                        <img src="<?php echo base_url(); ?>backend/images/white.jpg">
                                                    </label>
                                                </div>
                                                <div class="col-sm-3 col-xs-6 col20">
                                                    <label class="radio-img">
                                                        <input name="theme" <?php
                                                        if ($settinglist[0]['theme'] == "default.jpg") {
                                                            echo "checked";
                                                        }
                                                        ?>  value="default.jpg" type="radio" />
                                                        <img src="<?php echo base_url(); ?>backend/images/default.jpg">
                                                    </label>
                                                </div>
                                                <div class="col-sm-3 col-xs-6 col20">
                                                    <label class="radio-img">
                                                        <input name="theme" <?php
                                                        if ($settinglist[0]['theme'] == "red.jpg") {
                                                            echo "checked";
                                                        }
                                                        ?> value="red.jpg" type="radio" />
                                                        <img src="<?php echo base_url(); ?>backend/images/red.jpg">
                                                    </label>
                                                </div>
                                                <div class="col-sm-3 col-xs-6 col20">
                                                    <label class="radio-img">
                                                        <input name="theme" <?php
                                                        if ($settinglist[0]['theme'] == "blue.jpg") {
                                                            echo "checked";
                                                        }
                                                        ?> value="blue.jpg" type="radio" />
                                                        <img src="<?php echo base_url(); ?>backend/images/blue.jpg">
                                                    </label>
                                                </div>
                                                <div class="col-sm-3 col-xs-6 col20">
                                                    <label class="radio-img">
                                                        <input name="theme" <?php
                                                        if ($settinglist[0]['theme'] == "gray.jpg") {
                                                            echo "checked";
                                                        }
                                                        ?> value="gray.jpg" type="radio" />
                                                        <img src="<?php echo base_url(); ?>backend/images/gray.jpg">
                                                    </label>
                                                </div>


                                            </div><!--./row-->

                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <?php 
                                if($this->rbac->hasPrivilege('general_settings','can_edit')){
                                    ?>
                                    <button type="button" class="btn btn-primary submit_schsetting pull-right edit_setting" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> <?php echo $this->lang->line('save'); ?></button>
                                    <?php
                                }
                                ?>
                                

                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
            <!-- right column -->

        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div class="modal fade" id="modal-upload_admin_logo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('edit')." ".$this->lang->line('admin')." ".$this->lang->line('logo'); ?></h4>
            </div>
            <div class="modal-body upload_logo_body">
                <!-- ==== -->
                <form class="box_upload boxupload has-advanced-upload" method="post" action="<?php echo site_url('schsettings/ajax_editlogo') ?>" enctype="multipart/form-data">
                    <input value="<?php echo $settinglist[0]['id'] ?>" type="hidden" name="id" id="id_logo_admin"/>
                    <input type="file" name="file" id="file_admin">
                    <!-- Drag and Drop container-->
                    <div class="box__input upload-admin_area"  id="uploadfile_admin">
                        <i class="fa fa-download box__icon"></i>
                        <label><strong><?php echo $this->lang->line('choose_a_file'); ?></strong><span class="box__dragndrop"> <?php echo $this->lang->line('or') ?> <span><?php echo $this->lang->line('drag') ?></span><?php echo $this->lang->line('it_here') ?></span>.</label>

                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="modal-upload_app_logo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('edit_app_logo');?></h4>
            </div>
            <div class="modal-body upload_logo_body">
                <!-- ==== -->
                <form class="box_upload boxupload has-advanced-upload" method="post" action="<?php echo site_url('schsettings/ajax_editlogo') ?>" enctype="multipart/form-data">
                    <input value="<?php echo $result->id ?>" type="hidden" name="id" id="id_app_logo"/>
                    <input type="file" name="file" id="file_applogo">
                    <!-- Drag and Drop container-->
                    <div class="box__input upload-app_logo_area"  id="uploadapp_logo">
                        <i class="fa fa-download box__icon"></i>
                        <label><strong><?php echo $this->lang->line('choose_a_file'); ?></strong><span class="box__dragndrop"> <?php echo $this->lang->line('or') ?> <span><?php echo $this->lang->line('drag') ?></span><?php echo $this->lang->line('it_here') ?></span>.</label>

                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-upload_admin_small_logo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('edit')." ".$this->lang->line('admin')." ".$this->lang->line('small')." ".$this->lang->line('logo'); ?></h4>
            </div>
            <div class="modal-body upload_logo_body">
                <!-- ==== -->
                <form class="box_upload boxupload has-advanced-upload" method="post" action="<?php echo site_url('schsettings/ajax_editlogo') ?>" enctype="multipart/form-data">
                    <input value="<?php echo $settinglist[0]['id'] ?>" type="hidden" name="id" id="id_logo_small"/>
                    <input type="file" name="file" id="file_small">
                    <!-- Drag and Drop container-->
                    <div class="box__input upload-small_area"  id="uploadfile_small">
                        <i class="fa fa-download box__icon"></i>
                        <label><strong><?php echo $this->lang->line('choose_a_file'); ?></strong><span class="box__dragndrop"> <?php echo $this->lang->line('or') ?> <span><?php echo $this->lang->line('drag') ?></span><?php echo $this->lang->line('it_here') ?></span>.</label>

                    </div>

                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="modal-uploadfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('edit_logo'); ?></h4>
            </div>
            <div class="modal-body upload_logo_body">
                <!-- ==== -->
                <form class="box_upload boxupload has-advanced-upload" method="post" action="<?php echo site_url('schsettings/ajax_editlogo') ?>" enctype="multipart/form-data">
                    <input value="<?php echo $settinglist[0]['id'] ?>" type="hidden" name="id" id="id_logo"/>
                    <input type="file" name="file" id="file">
                    <!-- Drag and Drop container-->
                    <div class="box__input upload-area"  id="uploadfile">
                        <i class="fa fa-download box__icon"></i>
                        <label><strong><?php echo $this->lang->line('choose_a_file'); ?></strong><span class="box__dragndrop"> <?php echo $this->lang->line('or') ?> <span><?php echo $this->lang->line('drag') ?></span><?php echo $this->lang->line('it_here') ?></span>.</label>

                    </div>

                </form>
            </div>

        </div>
    </div>
</div>




<script type="text/javascript">
    var base_url = '<?php echo base_url(); ?>';
    var logo_type = "logo";
    $('.upload_logo').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        logo_type = $this.data('logo_type');

        $this.button('loading');
        $('#modal-uploadfile').modal({
            show: true,
            backdrop: 'static',
            keyboard: false
        });
    });
// set focus when modal is opened
    $('#modal-uploadfile').on('shown.bs.modal', function () {
        $('.upload_logo').button('reset');
    });

    $('.upload_admin_logo').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        logo_type = $this.data('logo_type');
        $this.button('loading');
        $('#modal-upload_admin_logo').modal({
            show: true,
            backdrop: 'static',
            keyboard: false
        });
    });
// set focus when modal is opened
    $('#modal-uploadadmin_logo').on('shown.bs.modal', function () {
        $('.upload_admin_logo').button('reset');
    });

 $('.upload_admin_small_logo').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        logo_type = $this.data('logo_type');

        $this.button('loading');
        $('#modal-upload_admin_small_logo').modal({
            show: true,
            backdrop: 'static',
            keyboard: false
        });
    }); 
// set focus when modal is opened
    $('#modal-upload_admin_small_logo').on('shown.bs.modal', function () {
        $('.upload_admin_small_logo').button('reset');
    });



    $(".edit_setting").on('click', function (e) {
        var $this = $(this);
        $this.button('loading');
        $.ajax({
            url: '<?php echo site_url("schsettings/ajax_schedit") ?>',
            type: 'POST',
            data: $('#schsetting_form').serialize(),
            dataType: 'json',

            success: function (data) {

                if (data.status == "fail") {
                    var message = "";
                    $.each(data.error, function (index, value) {

                        message += value;
                    });
                    errorMsg(message);
                } else {
                    successMsg(data.message);
                    window.location.reload(true);
                }

                $this.button('reset');
            }
        });
    });


</script>


<script type="text/javascript">
    $(function () {



        // Drag enter
        $('.upload-area').on('dragenter', function (e) {
            e.stopPropagation();
            e.preventDefault();
            $("h1").text("Drop");
        });

        // Drag over
        $('.upload-area').on('dragover', function (e) {
            e.stopPropagation();
            e.preventDefault();
            $("h1").text("Drop");
        });

        // Drop
        $('.upload-area').on('drop', function (e) {
            e.stopPropagation();
            e.preventDefault();

            $("h1").text("Upload");

            var file = e.originalEvent.dataTransfer.files;
            var fd = new FormData();

            fd.append('file', file[0]);
            fd.append("id", $('#id_logo').val());
            fd.append("logo_type", logo_type);

            uploadData(fd);
        });

        // Open file selector on div click
        $("#uploadfile").click(function () {
            $("#file").click();
        });

        // file selected
        $("#file").change(function () {
            var fd = new FormData();

            var files = $('#file')[0].files[0];

            fd.append('file', files);
            fd.append("id", $('#id_logo').val());
            fd.append("logo_type", logo_type);
            uploadData(fd);
        });
    });

// Sending AJAX request and upload file
    function uploadData(formdata) {

        $.ajax({
            url: '<?php echo site_url('schsettings/ajax_editlogo') ?>',
            type: 'post',
            data: formdata,
            contentType: false,
            processData: false,
            dataType: 'json',
            cache: false,

            beforeSend: function () {
                $('#modal-uploadfile').addClass('modal_loading');
            },
            success: function (response) {
                if (response.success) {
                    successMsg(response.message);
                    window.location.reload(true);
                } else {

                    errorMsg(response.error.file);
                }

            },
            error: function (xhr) { // if error occured

            },
            complete: function () {
                $('#modal-uploadfile').removeClass('modal_loading');

            }


        });
    }

     $(function () {



        // Drag enter
        $('.upload-small_area').on('dragenter', function (e) {
            e.stopPropagation();
            e.preventDefault();
            $("h1").text("Drop");
        });

        // Drag over
        $('.upload-small_area').on('dragover', function (e) {
            e.stopPropagation();
            e.preventDefault();
            $("h1").text("Drop");
        });

        // Drop
        $('.upload-small_area').on('drop', function (e) {
            e.stopPropagation();
            e.preventDefault();

            $("h1").text("Upload");

            var file = e.originalEvent.dataTransfer.files;
            var fd = new FormData();

            fd.append('file', file[0]);
            fd.append("id", $('#id_logo_small').val());
            fd.append("logo_type", logo_type);

            uploadSmallData(fd);
        });

        // Open file selector on div click
        $("#uploadfile_small").click(function () {
            $("#file_small").click();
        });

        // file selected
        $("#file_small").change(function () {
            var fd = new FormData();

            var files = $('#file_small')[0].files[0];

            fd.append('file', files);
            fd.append("id", $('#id_logo_small').val());
            fd.append("logo_type", logo_type);
            uploadSmallData(fd);
        });
    });

// Sending AJAX request and upload file
    function uploadSmallData(formdata) {

        $.ajax({
            url: '<?php echo site_url('schsettings/ajax_editadmin_smalllogo') ?>',
            type: 'post',
            data: formdata,
            contentType: false,
            processData: false,
            dataType: 'json',
            cache: false,

            beforeSend: function () {
                $('#modal-upload_admin_small_logo').addClass('modal_loading');
            },
            success: function (response) {
                
                if (response.success) {
                    successMsg(response.message);
                    window.location.reload(true);
                } else {

                    errorMsg(response.error.file);
                }

            },
            error: function (xhr) { // if error occured

            },
            complete: function () {
                $('#modal-upload_admin_small_logo').removeClass('modal_loading');

            }


        });
    }

    $(function () {



        // Drag enter
        $('.upload-admin_area').on('dragenter', function (e) {
            e.stopPropagation();
            e.preventDefault();
            $("h1").text("Drop");
        });

        // Drag over
        $('.upload-admin_area').on('dragover', function (e) {
            e.stopPropagation();
            e.preventDefault();
            $("h1").text("Drop");
        });

        // Drop
        $('.upload-admin_area').on('drop', function (e) {
            e.stopPropagation();
            e.preventDefault();

            $("h1").text("Upload");

            var file = e.originalEvent.dataTransfer.files;
            var fd = new FormData();

            fd.append('file', file[0]);
            fd.append("id", $('#id_logo_small').val());
            fd.append("logo_type", logo_type);

            uploadadminlData(fd);
        });

        // Open file selector on div click
        $("#uploadfile_admin").click(function () {
            $("#file_admin").click();
        });

        // file selected
        $("#file_admin").change(function () {
            var fd = new FormData();

            var files = $('#file_admin')[0].files[0];

            fd.append('file', files);
            fd.append("id", $('#id_logo_small').val());
            fd.append("logo_type", logo_type);
            uploadadminData(fd);
        });
    });

// Sending AJAX request and upload file
    function uploadadminData(formdata) {

        $.ajax({
            url: '<?php echo site_url('schsettings/ajax_editadmin_adminlogo') ?>',
            type: 'post',
            data: formdata,
            contentType: false,
            processData: false,
            dataType: 'json',
            cache: false,

            beforeSend: function () {
                $('#modal-upload_admin_logo').addClass('modal_loading');
            },
            success: function (response) {
                
                if (response.success) {
                    successMsg(response.message);
                    window.location.reload(true);
                } else {

                    errorMsg(response.error.file);
                }

            },
            error: function (xhr) { // if error occured

            },
            complete: function () {
                $('#modal-upload_admin_logo').removeClass('modal_loading');

            }


        });
    }

</script>


<script type="text/javascript">
     $('.upload_app_logo').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        logo_type = $this.data('logo_type');

        $this.button('loading');
        $('#modal-upload_app_logo').modal({
            show: true,
            backdrop: 'static',
            keyboard: false
        });
    });
// set focus when modal is opened
    $('#modal-upload_app_logo').on('shown.bs.modal', function () {
        $('.upload_app_logo').button('reset');
    });



 $(function () {



        // Drag enter
        $('.upload-app_logo_area').on('dragenter', function (e) {
            e.stopPropagation();
            e.preventDefault();
            $("h1").text("Drop");
        });

        // Drag over
        $('.upload-app_logo_area').on('dragover', function (e) {
            e.stopPropagation();
            e.preventDefault();
            $("h1").text("Drop");
        });

        // Drop
        $('.upload-app_logo_area').on('drop', function (e) {
            e.stopPropagation();
            e.preventDefault();

            $("h1").text("Upload");

            var file = e.originalEvent.dataTransfer.files;
            var fd = new FormData();

            fd.append('file', file[0]);
            fd.append("id", $('#id_app_logo').val());
            // fd.append("logo_type", logo_type);

            uploadSmallData(fd);
        });

        // Open file selector on div click
        $("#uploadapp_logo").click(function () {
            $("#file_applogo").click();
        });

        // file selected
        $("#file_applogo").change(function () {
            var fd = new FormData();

            var files = $('#file_applogo')[0].files[0];


            fd.append('file', files);
            fd.append("id", $('#id_app_logo').val());
            // fd.append("logo_type", logo_type);
            uploadAppData(fd);
        });
    });

// Sending AJAX request and upload file
    function uploadAppData(formdata) {

        $.ajax({
            url: '<?php echo site_url('schsettings/ajax_applogo') ?>',
            type: 'post',
            data: formdata,
            contentType: false,
            processData: false,
            dataType: 'json',
            cache: false,

            beforeSend: function () {
                $('#modal-upload_app_logo').addClass('modal_loading');
            },
            success: function (response) {
                
                if (response.success) {
                    successMsg(response.message);
                    window.location.reload(true);
                } else {

                    errorMsg(response.error.file);
                }

            },
            error: function (xhr) { // if error occured

            },
            complete: function () {
                $('#modal-upload_app_logo').removeClass('modal_loading');

            }


        });
    }


</script>