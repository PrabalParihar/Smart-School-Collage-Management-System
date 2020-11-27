<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<style type="text/css">
    /*REQUIRED*/
    .carousel-row {
        margin-bottom: 10px;
    }
    .slide-row {
        padding: 0;
        background-color: #ffffff;
        min-height: 150px;
        border: 1px solid #e7e7e7;
        overflow: hidden;
        height: auto;
        position: relative;
    }
    .slide-carousel {
        width: 20%;
        float: left;
        display: inline-block;
    }
    .slide-carousel .carousel-indicators {
        margin-bottom: 0;
        bottom: 0;
        background: rgba(0, 0, 0, .5);
    }
    .slide-carousel .carousel-indicators li {
        border-radius: 0;
        width: 20px;
        height: 6px;
    }
    .slide-carousel .carousel-indicators .active {
        margin: 1px;
    }
    .slide-content {
        position: absolute;
        top: 0;
        left: 20%;
        display: block;
        float: left;
        width: 80%;
        max-height: 76%;
        padding: 1.5% 2% 2% 2%;
        overflow-y: auto;
    }
    .slide-content h4 {
        margin-bottom: 3px;
        margin-top: 0;
    }
    .slide-footer {
        position: absolute;
        bottom: 0;
        left: 20%;
        width: 78%;
        height: 20%;
        margin: 1%;
    }
    /* Scrollbars */
    .slide-content::-webkit-scrollbar {
        width: 5px;
    }
    .slide-content::-webkit-scrollbar-thumb:vertical {
        margin: 5px;
        background-color: #999;
        -webkit-border-radius: 5px;
    }
    .slide-content::-webkit-scrollbar-button:start:decrement,
    .slide-content::-webkit-scrollbar-button:end:increment {
        height: 5px;
        display: block;
    }
</style>

<div class="content-wrapper" style="min-height: 946px;">

    <section class="content-header">
        <h1>
            <i class="fa fa-bus"></i> <?php echo $this->lang->line('transport'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>

                    <form role="form" action="<?php echo site_url('admin/route/studenttransportdetails') ?>" method="post" class="">
                        <div class="box-body row">

                            <?php echo $this->customlib->getCSRF(); ?>

                            <div class="col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('class'); ?><small class="req"> *</small></label>
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
                            <div class="col-sm-3 col-md-3">
                                <div class="form-group">  
                                    <label><?php echo $this->lang->line('section'); ?><small class="req"> *</small></label>
                                    <select  id="section_id" name="section_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                </div>  
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="form-group"> 
                                    <label><?php echo $this->lang->line('route_title'); ?></label>
                                    <select name="route_title" class="form-control">
                                        <option value=""><?php echo $this->lang->line('select') ?></option>

                                        <?php foreach ($listroute as $rkey => $rvalue) {
                                            ?>
                                            <option value="<?php echo $rvalue["route_title"] ?>"><?php echo $rvalue["route_title"] ?></option>
                                        <?php }
                                        ?>       
                                    </select>
                                </div>  
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="form-group"> 
                                    <label><?php echo $this->lang->line('vehicle_no'); ?></label>
                                    <select name="vehicle_no" class="form-control">
                                        <option value=""><?php echo $this->lang->line('select') ?></option>

                                        <?php foreach ($listvehicle as $vehkey => $vehvalue) {
                                            ?>
                                            <option value="<?php echo $vehvalue["vehicle_no"] ?>"><?php echo $vehvalue["vehicle_no"] ?></option>
                                        <?php }
                                        ?>       
                                    </select>
                                </div>  
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
               

            <div class="">
                <div class="box-header ptbnull"></div>
                <div class="box-header ptbnull">
                    <h3 class="box-title titlefix"><i class="fa fa-users"></i> <?php echo form_error('student'); ?> <?php echo $this->lang->line('student_transport_report'); ?></h3>
                </div>
                <div class="box-body table-responsive">
                    <div class="download_label"><?php echo $this->lang->line('student_transport_report')."<br>";$this->customlib->get_postmessage(); ?></div>
                    <table class="table table-striped table-bordered table-hover example">
                        <thead>
                            <tr>
                                <th><?php echo $this->lang->line('class') . " - " . $this->lang->line('section'); ?></th>
                                <th><?php echo $this->lang->line('admission_no'); ?></th>
                                <th><?php echo $this->lang->line('student_name'); ?></th>
                                <th><?php echo $this->lang->line('mobile_no'); ?></th>
                                <th><?php echo $this->lang->line('father_name'); ?></th>
                                <th><?php echo $this->lang->line('father_phone'); ?></th>
                                <th><?php echo $this->lang->line('mother_name'); ?></th>
                                <th><?php echo $this->lang->line('mother_phone'); ?></th>
                                <th><?php echo $this->lang->line('route_title'); ?></th>
                                <th><?php echo $this->lang->line('vehicle_no'); ?></th>
                                <th><?php echo $this->lang->line('driver_name'); ?></th>
                                <th><?php echo $this->lang->line('driver_contact'); ?></th>
                                <th class="text-right"><?php echo $this->lang->line('fare') . " (" . $currency_symbol . ")"; ?></th>


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
                                        <td><?php echo $student['class'] . " - " . $student["section"]; ?></td>
                                        <td><?php echo $student['admission_no']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id']; ?>"><?php echo $student['firstname'] . " " . $student['lastname']; ?>
                                            </a>
                                        </td>
                                        <td><?php echo $student['mobileno']; ?></td>
                                        <td><?php echo $student['father_name']; ?></td>
                                        <td><?php echo $student['father_phone']; ?></td>
                                        <td><?php echo $student['mother_name']; ?></td>
                                        <td><?php echo $student['mother_phone']; ?></td>
                                        <td><?php echo $student['route_title']; ?></td>
                                        <td><?php echo $student['vehicle_no']; ?></td>
                                        <td><?php echo $student['driver_name']; ?></td>
                                        <td><?php echo $student['driver_contact']; ?></td>
                                        <td class="text-right"><?php echo $student['fare']; ?></td>

                                    </tr>
                                    <?php
                                    $count++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
          </div><!--./box box-primary-->
        </div><!--./col-md-12--> 
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