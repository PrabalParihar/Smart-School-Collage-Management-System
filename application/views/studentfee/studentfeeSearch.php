<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">   
    <section class="content-header">
        <h1>
            <i class="fa fa-money"></i> <?php echo $this->lang->line('fees_collection'); ?> </h1>
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
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="row">
                                    <form role="form" action="<?php echo site_url('studentfee/search') ?>" method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('class'); ?></label><small class="req">  *</small>
                                                <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
                                                    foreach ($classlist as $class) {
                                                        ?>
                                                        <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) echo "selected=selected" ?>><?php echo $class['class'] ?></option>
                                                        <?php
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
                                                <button type="submit" name="search" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>  
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="row">
                                    <form role="form" action="<?php echo site_url('studentfee/search') ?>" method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('search_by_keyword'); ?></label>
                                                <input type="text" name="search_text" class="form-control" value="<?php echo set_value('search_text'); ?>" placeholder="<?php echo $this->lang->line('search_by_student_name'); ?>">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" name="search" value="search_full" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>  
                            </div>
                        </div>
                    </div>
                
                <?php
                if (isset($resultlist)) {
                    ?>
                    <div class="">
                       <div class="box-header ptbnull"></div> 
                        <div class="box-header ptbnull">
                            <h3 class="box-title titlefix"><i class="fa fa-users"></i> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('list'); ?>
                                <?php echo form_error('student'); ?></h3>
                            <div class="box-tools pull-right"></div>
                        </div>
                        <div class="box-body table-responsive">

                            <div class="download_label"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>

                                    <tr>
                                        <th><?php echo $this->lang->line('class'); ?></th>
                                        <th><?php echo $this->lang->line('section'); ?></th>
										
                                        <th><?php echo $this->lang->line('admission_no'); ?></th>
									
                                        <th><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('name'); ?></th>
										<?php if ($sch_setting->father_name) {  ?>
                                        <th><?php echo $this->lang->line('father_name'); ?></th>
										<?php } ?>
                                        <th><?php echo $this->lang->line('date_of_birth'); ?></th>
                                        <th><?php echo $this->lang->line('phone'); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>

                                    </tr>
                                </thead>            
                                <tbody>    
                                    <?php
                                    $count = 1;
                                    foreach ($resultlist as $student) {
                                        ?>
                                        <tr>
                                            <td><?php echo $student['class']; ?></td>
                                            <td><?php echo $student['section']; ?></td>
											
                                            <td><?php echo $student['admission_no']; ?></td>
											
                                            <td><?php echo $student['firstname'] . " " . $student['lastname']; ?></td>
											<?php if ($sch_setting->father_name) {  ?>
                                            <td><?php echo $student['father_name']; ?></td>
											<?php } ?>
                                            <td><?php
                                                if (!empty($student['dob'])) {
                                                    echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob']));
                                                }
                                                ?></td>
                                            <td><?php echo $student['guardian_phone']; ?></td>
                                            <td class="pull-right">
                                                    <?php if ($this->rbac->hasPrivilege('collect_fees', 'can_add')) { ?>
                                                       
                                                    <a  href="<?php echo base_url(); ?>studentfee/addfee/<?php echo $student['student_session_id'] ?>" class="btn btn-info btn-xs" data-toggle="tooltip" title="" data-original-title="">
                                                    <?php echo $currency_symbol; ?> <?php echo $this->lang->line('collect_fees'); ?>
                                                    </a>
        <?php } ?>
                                            </td>

                                        </tr>
                                        <?php
                                    }
                                    $count++;
                                    ?>
                                </tbody>
                            </table>
                        </div><!--./box-body-->
                    </div>
                  </div>  
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