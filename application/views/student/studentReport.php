    <div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-line-chart"></i> <?php echo $this->lang->line('reports'); ?> <small> <?php echo $this->lang->line('filter_by_name1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content" >
        <?php $this->load->view('reports/_studentinformation'); ?>
        <div class="row">
            <div class="col-md-12">

                <div class="box removeboxmius">
                    <div class="box-header ptbnull"></div>
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                 <div class="box-body">    
                    <form role="form" action="<?php echo site_url('student/studentreport') ?>" method="post" class="">
                        <div class="row">

                            <?php echo $this->customlib->getCSRF(); ?>

                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
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
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">  
                                    <label><?php echo $this->lang->line('section'); ?></label>
                                    <select  id="section_id" name="section_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                </div>  
                            </div>
							<?php if ($sch_setting->category) {  ?>
                            <div class="col-sm-3 col-md-2">
                                <div class="form-group"> 
                                    <label><?php echo $this->lang->line('category'); ?></label>
                                    <select  id="category_id" name="category_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($categorylist as $category) {
                                            ?>
                                            <option value="<?php echo $category['id'] ?>" <?php if (set_value('category_id') == $category['id']) echo "selected=selected"; ?>><?php echo $category['category'] ?></option>
                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                </div>  
                            </div>
							<?php } ?>
                            <div class="col-sm-3 col-md-2">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('gender'); ?></label>
                                    <select class="form-control" name="gender">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($genderList as $key => $value) {
                                            ?>
                                            <option value="<?php echo $key; ?>" <?php if (set_value('gender') == $key) echo "selected"; ?>><?php echo $value; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>  
                            </div>
							<?php  if ($sch_setting->rte) { ?>
                            <div class="col-sm-3 col-md-2">
                                <div class="form-group"> 
                                    <label><?php echo $this->lang->line('rte'); ?></label>
                                    <select  id="rte" name="rte" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($RTEstatusList as $k => $rte) {
                                            ?>
                                            <option value="<?php echo $k; ?>" <?php if (set_value('rte') == $k) echo "selected"; ?>><?php echo $rte; ?></option>

                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                </div>  
                            </div>
							<?php } ?>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                </div>
                            </div>
                       </div><!--./row-->     
                    </form>
                 </div><!--./box-body-->   
               
             
            <?php
            if (isset($resultlist)) {
                ?>
                <div class="">
                   <div class="box-header ptbnull"></div> 
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><i class="fa fa-users"></i> <?php echo form_error('student'); ?> <?php echo $this->lang->line('student') . " " . $this->lang->line('report'); ?></h3>
                    </div>
                    <div class="box-body table-responsive">
					<div class="download_label"><?php echo $this->lang->line('student') . " " . $this->lang->line('report')."<br>";$this->customlib->get_postmessage();
                        ?></div>
                        <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?php echo $this->lang->line('section'); ?></th>
									
                                    <th><?php echo $this->lang->line('admission_no'); ?></th>
									
                                    <th><?php echo $this->lang->line('student_name'); ?></th>
									<?php if ($sch_setting->father_name) {  ?>
                                    <th><?php echo $this->lang->line('father_name'); ?></th>
									<?php } ?>
                                    <th><?php echo $this->lang->line('date_of_birth'); ?></th>
                                    <th><?php echo $this->lang->line('gender'); ?></th>
									<?php if ($sch_setting->category) {  ?>
                                    <th><?php echo $this->lang->line('category'); ?></th>
									<?php } if ($sch_setting->mobile_no) {  ?>
                                    <th><?php echo $this->lang->line('mobile_no'); ?></th>
									<?php }
                                    if ($sch_setting->local_identification_no) { ?>
                                    <th><?php echo $this->lang->line('local_identification_no'); ?></th>
                                    <?php }  if ($sch_setting->national_identification_no) { ?>
                                    <th><?php echo $this->lang->line('national_identification_no'); ?></th>
									<?php } if ($sch_setting->rte) { ?>
                                    <th><?php echo $this->lang->line('rte'); ?></th>
									<?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($resultlist)) { ?>
                                <?php } else { $count = 1;
                                    foreach ($resultlist as $student) {        ?>
                                <tr>
                                    <td><?php echo $student['section']; ?></td>
									
                                    <td><?php echo $student['admission_no']; ?></td>
									
                                    <td>
                                        <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id']; ?>"><?php echo $student['firstname'] . " " . $student['lastname']; ?></a>
                                    </td>
									<?php if ($sch_setting->father_name) {  ?>
                                    <td><?php echo $student['father_name']; ?></td>
									<?php } ?>
                                    <td><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob'])); ?></td>
                                    <td><?php echo $student['gender']; ?></td>
									<?php if ($sch_setting->category) {  ?>
                                    <td><?php echo $student['category']; ?></td>
									<?php } if ($sch_setting->mobile_no) {  ?>
                                    <td><?php echo $student['mobileno']; ?></td>
									<?php } if ($sch_setting->national_identification_no) { ?>
                                    <td><?php echo $student['samagra_id']; ?></td>
									<?php } if ($sch_setting->local_identification_no) { ?>
                                    <td><?php echo $student['adhar_no']; ?></td>
									<?php } if ($sch_setting->rte) { ?>
                                    <td><?php echo $student['rte']; ?></td>
									<?php } ?>
                                </tr>
                                <?php   $count++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
               </div><!--./box box-primary -->
             
                <?php
            }
            ?>
           </div><!-- ./col-md-12 -->  
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