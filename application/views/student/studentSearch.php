<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>

<div class="content-wrapper" style="min-height: 946px;">  
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('student1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <div class="box-body">
                        
                        <?php if ($this->session->flashdata('msg')) { ?> <div class="alert alert-success">  <?php echo $this->session->flashdata('msg') ?> </div> <?php } ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <form role="form" action="<?php echo site_url('student/search') ?>" method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>
                                        <div class="col-sm-6">
                                            <div class="form-group"> 
                                                <label><?php echo $this->lang->line('class'); ?></label> <small class="req"> *</small> 
                                                <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
                                                    foreach ($classlist as $class) {
                                                        ?>
                                                        <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) echo "selected=selected" ?>><?php echo $class['class'] ?></option>
                                                        <?php
                                                        $count++;
                                                    }
                                                    ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                            </div>  
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('section'); ?></label>
                                                <select  id="section_id" name="section_id" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                            </div>   
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                    </form>    
                                </div>  
                                
                            </div><!--./col-md-6-->
                            <div class="col-md-6">
                                <div class="row">
                                    <form role="form" action="<?php echo site_url('student/search') ?>" method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('search_by_keyword'); ?></label>
                                        <input type="text" name="search_text" class="form-control" value="<?php  echo set_value('search_text'); ?>"   placeholder="<?php echo $this->lang->line('search_by_student_name'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" name="search" value="search_full" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                           </div><!--./col-md-6-->
                        </div><!--./row-->
                    </div>
                
                <?php
                if (isset($resultlist)) {
                    ?>
                    <div class="nav-tabs-custom border0 navnoshadow">
                      <div class="box-header ptbnull"></div>  
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><i class="fa fa-list"></i> <?php echo $this->lang->line('list'); ?>  <?php echo $this->lang->line('view'); ?></a></li>
                            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i class="fa fa-newspaper-o"></i> <?php echo $this->lang->line('details'); ?> <?php echo $this->lang->line('view'); ?></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="download_label"><?php echo $title; ?></div>
                            <div class="tab-pane active table-responsive no-padding" id="tab_1">
                                <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
								
                                            <th><?php echo $this->lang->line('admission_no'); ?></th>
									
                                            <th><?php echo $this->lang->line('student_name'); ?></th>
                                            <th><?php echo $this->lang->line('class'); ?></th>
											 <?php if ($sch_setting->father_name) {  ?>
                                            <th><?php echo $this->lang->line('father_name'); ?></th>
                                            <?php } ?>
                                            <th><?php echo $this->lang->line('date_of_birth'); ?></th>
                                            <th><?php echo $this->lang->line('gender'); ?></th>
											<?php if ($sch_setting->category) {
                                              ?>
                                              <?php if ($sch_setting->category) {  ?>
                                            <th><?php echo $this->lang->line('category'); ?></th>
											<?php }
                                             } if ($sch_setting->mobile_no) {
                                               ?>
                                            <th><?php echo $this->lang->line('mobile_no'); ?></th>
                                            <?php 
                                        }
                                            if (!empty($fields)) {

                                                foreach ($fields as $fields_key => $fields_value) {
                                                    ?>
                                                    <th><?php echo $fields_value->name; ?></th>
                                                    <?php
                                                }
                                            }
                                            ?>

                                            <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (empty($resultlist)) {
                                            ?>
                                                             
                                            <?php
                                        } else {
                                            $count = 1;
                                            foreach ($resultlist as $student) {
                                                ?>
                                                <tr>
												
                                                    <td><?php echo $student['admission_no']; ?></td>
											
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id']; ?>"><?php echo $student['firstname'] . " " . $student['lastname']; ?>
                                                        </a>
                                                    </td>
                                                    <td><?php echo $student['class'] . "(" . $student['section'] . ")" ?></td>
                                                    <?php if ($sch_setting->father_name) {  ?>
													<td><?php echo $student['father_name']; ?></td>
													<?php }?>
                                                    <td><?php
                                                        if ($student["dob"] != null) {
                                                            echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob']));
                                                        }
                                                        ?></td>
                                                    <td><?php echo $student['gender']; ?></td>
													<?php if ($sch_setting->category) {  ?>
                                                    <td><?php echo $student['category']; ?></td>
													<?php } if ($sch_setting->mobile_no) {  ?>
                                                    <td><?php echo $student['mobileno']; ?></td>
                                                    <?php }
                                                    if (!empty($fields)) {

                                                        foreach ($fields as $fields_key => $fields_value) {
                                                              $display_field=$student[$fields_value->name];
                                                      if($fields_value->type == "link"){
  $display_field= "<a href=".$student[$fields_value->name]." target='_blank'>".$student[$fields_value->name]."</a>";

  }
                                                            ?>
                                                            <td>
                                                                <?php echo $display_field; ?>
                                                                    
                                                                </td>
                                                            <?php
                                                        }
                                                    }
                                                    ?>

                                                    <td class="pull-right">
                                                        <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('show'); ?>" >
                                                            <i class="fa fa-reorder"></i>
                                                        </a>
                                                        <?php
                                                        if ($this->rbac->hasPrivilege('student', 'can_edit')) {
                                                            ?>
                                                            <a href="<?php echo base_url(); ?>student/edit/<?php echo $student['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <?php
                                                        }
                                                        if ($this->rbac->hasPrivilege('collect_fees', 'can_add')) {
                                                            ?>
                                                            <a href="<?php echo base_url(); ?>studentfee/addfee/<?php echo $student['student_session_id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('add_fees'); ?>">
                                                            <span ><?php echo $currency_symbol; ?></span>
                                                            </a>
                                                <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $count++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>                           
                            <div class="tab-pane" id="tab_2">
                                <?php if (empty($resultlist)) {
                                    ?>
                                    <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div>
                                    <?php
                                } else {
                                    $count = 1;
                                    foreach ($resultlist as $student) {

                                        if (empty($student["image"])) {
                                            $image = "uploads/student_images/no_image.png";
                                        } else {
                                            $image = $student['image'];
                                        }
                                        ?>
                                        <div class="carousel-row">
                                            <div class="slide-row">
                                                <div id="carousel-2" class="carousel slide slide-carousel" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        <div class="item active">
                                                            <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>"> <img class="img-responsive img-thumbnail width150" alt="<?php echo $student["firstname"] . " " . $student["lastname"] ?>" src="<?php echo base_url() . $image; ?>" alt="Image"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="slide-content">
                                                    <h4><a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>"> <?php echo $student['firstname'] . " " . $student['lastname'] ?></a></h4>
                                                    <div class="row">
                                                        <div class="col-xs-6 col-md-6">
                                                            <address>
                                                                <strong><b><?php echo $this->lang->line('class'); ?>: </b><?php echo $student['class'] . "(" . $student['section'] . ")" ?></strong><br>
                                                                <b><?php echo $this->lang->line('admission_no'); ?>: </b><?php echo $student['admission_no'] ?><br/>
                                                                <b><?php echo $this->lang->line('date_of_birth'); ?>:
            <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob'])); ?><br>
                                                                    <b><?php echo $this->lang->line('gender'); ?>:&nbsp;</b><?php echo $student['gender'] ?><br>
                                                                    </address>
                                                                    </div>
                                                                    <div class="col-xs-6 col-md-6">
                                                                        <b><?php echo $this->lang->line('local_identification_no'); ?>:&nbsp;</b><?php echo $student['samagra_id'] ?><br>
                                                                        <b><?php echo $this->lang->line('guardian_name'); ?>:&nbsp;</b><?php echo $student['guardian_name'] ?><br>
                                                                        <b><?php echo $this->lang->line('guardian_phone'); ?>: </b> <abbr title="Phone"><i class="fa fa-phone-square"></i>&nbsp;</abbr> <?php echo $student['guardian_phone'] ?><br>
                                                                        <b><?php echo $this->lang->line('current_address'); ?>:&nbsp;</b><?php echo $student['current_address'] ?> <?php echo $student['city'] ?><br>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    <div class="slide-footer">
                                                                        <span class="pull-right buttons">
                                                                            <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('show'); ?>" >
                                                                                <i class="fa fa-reorder"></i>
                                                                            </a>
                                                                            <?php
                                                                            if ($this->rbac->hasPrivilege('student', 'can_edit')) {
                                                                                ?>
                                                                                <a href="<?php echo base_url(); ?>student/edit/<?php echo $student['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                                                    <i class="fa fa-pencil"></i>
                                                                                </a>
                                                                                <?php
                                                                            }
                                                                            if ($this->rbac->hasPrivilege('collect_fees', 'can_add')) {
                                                                                ?>
                                                                                <a href="<?php echo base_url(); ?>studentfee/addfee/<?php echo $student['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('add_fees'); ?>">    
                                                                                <?php echo $currency_symbol; ?>
                                                                                </a>
            <?php } ?>
                                                                        </span>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                $count++;
                                                            }
                                                            ?>
                                                            </div>                                                          
                                                            </div>                                                         
                                                            </div>
                                                          </div><!--./box box-primary -->   
                                                            <?php
                                                        }
                                                        ?>
                                                        </div>  
                                                        </div> 
                                                        </section>
                                                        </div>
                                                        <script type="text/javascript">

                                                           
                                                            function getSectionByClass(class_id, section_id) {
                                                                if (class_id != "" && section_id != "") {
                                                                    $('#section_id').html("");
                                                                    var base_url = '<?php echo base_url() ?>';
                                                                    var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                                                                    $.ajax({
                                                                        type: "GET",
                                                                        url: base_url + "sections/getByClass",
                                                                        data: {'class_id': class_id},
                                                                        dataType: "json",
                                                                        success: function (data) {
                                                                            $.each(data, function (i, obj)
                                                                            {
                                                                                var sel = "";
                                                                                if (section_id == obj.section_id) {
                                                                                    sel = "selected";
                                                                                }
                                                                                div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                                                                            });
                                                                            $('#section_id').append(div_data);
                                                                        }
                                                                    });
                                                                }
                                                            }
                                                            $(document).ready(function () {
                                                                var class_id = $('#class_id').val();
                                                                var section_id = '<?php echo set_value('section_id') ?>';
                                                                getSectionByClass(class_id, section_id);
                                                                $(document).on('change', '#class_id', function (e) {
                                                                    $('#section_id').html("");
                                                                    var class_id = $(this).val();
                                                                    var base_url = '<?php echo base_url() ?>';
                                                                    var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                                                                    $.ajax({
                                                                        type: "GET",
                                                                        url: base_url + "sections/getByClass",
                                                                        data: {'class_id': class_id},
                                                                        dataType: "json",
                                                                        success: function (data) {
                                                                            $.each(data, function (i, obj)
                                                                            {
                                                                                div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                                                                            });
                                                                            $('#section_id').append(div_data);
                                                                        }
                                                                    });
                                                                });
                                                            });
                                                        </script>