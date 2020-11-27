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
                      <div class="row">  
                        <?php if ($this->session->flashdata('msg')) {?> <div class="alert alert-success">  <?php echo $this->session->flashdata('msg') ?> </div> <?php }?>
                                    <form role="form" action="<?php echo site_url('student/bulkdelete') ?>" method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('class'); ?></label> <small class="req"> *</small>
                                                <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
foreach ($classlist as $class) {
    ?>
                                                        <option value="<?php echo $class['id'] ?>" <?php
if (set_value('class_id') == $class['id']) {
        echo "selected=selected";
    }
    ?>><?php echo $class['class'] ?></option>
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
                    </div>

                    <div class="box-body bordertop">
                        <div class="row">

                            <div class="col-md-12 col-sm-12">
                                <form action="<?php echo site_url('student/ajax_delete') ?>" method="POST" id="deletebulk">


                                    <?php
if (isset($resultlist)) {
    ?>                              <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    
                                                    <th><?php echo $this->lang->line('admission_no'); ?></th>
 
                                                    <th><?php echo $this->lang->line('student_name'); ?></th>
                                                    <th><?php echo $this->lang->line('class'); ?></th>

                                                    <th><?php echo $this->lang->line('date_of_birth'); ?></th>
                                                    <th><?php echo $this->lang->line('gender'); ?></th>
                                                    <?php if ($sch_setting->category) {?>
                                                        <th><?php echo $this->lang->line('category'); ?></th>
                                                    <?php } if ($sch_setting->mobile_no) {?>
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
                                                            <td>

                                                                <input type="checkbox" name="student[]" value="<?php echo $student['id']; ?>">
                                                            </td>
                                                            <td><?php echo $student['admission_no']; ?></td>
                                                             <td>
                                                                <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id']; ?>"><?php echo $student['firstname'] . " " . $student['lastname']; ?>
                                                                </a>
                                                            </td>
                                                           
                                                                
                                                                
                                                           
                                                            <td><?php echo $student['class'] . "(" .$student['section']. ")" ?></td>
                                                           
                                                            <td><?php
if ($student["dob"] != null) {
                echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob']));
            }
            ?></td>
                                                            <td><?php echo $student['gender']; ?></td>
                                                            <?php if ($sch_setting->category) {?>
                                                                <td><?php echo $student['category']; ?></td>
                                                            <?php }if ($sch_setting->mobile_no) {?>
                                                                <td><?php echo $student['mobileno']; ?></td>
                                                                <?php
}
            if (!empty($fields)) {

                foreach ($fields as $fields_key => $fields_value) {
                    $display_field = $student[$fields_value->name];
                    if ($fields_value->type == "link") {
                        $display_field = "<a href=" . $student[$fields_value->name] . " target='_blank'>" . $student[$fields_value->name] . "</a>";
                    }
                    ?>
                                                                    <td>
                    <?php echo $display_field; ?>

                                                                    </td>
                                                                    <?php
}
            }
            ?>


                                                        </tr>
                                                        <?php
$count++;
        }
    }
    ?>
                                            </tbody>
                                        </table>

                                        <?php
if (!empty($resultlist)) {
        ?>                              
                                            <button type="submit" class="btn btn-primary pull-right btn-sm mt10" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please wait..."> <?php echo $this->lang->line('delete')?></button>
                                            <?php
}
    ?>

                                        <?php
}
?>                               </div>           
                                </form>
                            </div>
                        </div>
                    </div>

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
<script type="text/javascript">
    $("#deletebulk").submit(function (e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
var checkCount = $("input[name='student[]']:checked").length;

if(checkCount == 0)
{
   alert("Atleast one student should be select.");
}else{
 if (confirm("<?php echo $this->lang->line('are_you_sure_delete_record'); ?>")) {

        var form = $(this);
        var url = form.attr('action');
        var submit_button = form.find(':submit');

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            dataType: "JSON", // serializes the form's elements.
            beforeSend: function () {

                submit_button.button('loading');
            },
            success: function (data)
            {

                var message = "";
                if (!data.status) {

                    $.each(data.error, function (index, value) {

                        message += value;
                    });
                    
                    errorMsg(message);

                } else {
                             successMsg(data.message);
                    location.reload();
                }
            },
            error: function (xhr) { // if error occured
                submit_button.button('reset');
                alert("Error occured.please try again");

            },
            complete: function () {
                submit_button.button('reset');
            }
        });
}
}

    });
</script>