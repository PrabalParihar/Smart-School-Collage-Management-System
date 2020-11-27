
<style type="text/css">
    @media(max-width:767px){
        .dhide{display:none !important}
    }
</style>
<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> Timetable --r</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">


                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('teacher')." ".$this->lang->line('time')." ".$this->lang->line('table');?></h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>

                    <div class="box-body">
                        <form action="<?php echo site_url('admin/timetable/getteachertimetable'); ?>" id="getTimetable" class="row">
                         <div class="col-lg-4 col-md-4 col-sm-4">   
                            <div class="form-group">
                                <label for="teacher"><?php echo $this->lang->line('teachers'); ?><small class="req"> *</small></label>
                                <select class="form-control" name="teacher" id="teacher">
                                    <option value=""><?php echo $this->lang->line('select')?></option>
                                    <?php
                                    if (!empty($staff_list)) {
                                        foreach ($staff_list as $staff_key => $staff_value) {
                                            ?>
                                            <option value="<?php echo $staff_value['id']; ?>"><?php echo $staff_value["name"] . " " . $staff_value["surname"]." (".$staff_value['employee_id'].")"; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>    
                        <div class="col-lg-4 col-md-4 col-sm-4"> 
                             <div class="form-group">
                                <label class="dhide" style="display: block; visibility:hidden;"><?php echo $this->lang->line('teacher') ?></label>
                                <button type="submit" class="btn btn-primary btn-sm" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please wait"><?php echo $this->lang->line('search')?></button>
                            </div>    
                         </div>   
                        </form>
                        <div class="timetable_data table-responsive clearboth">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    $("form#getTimetable").submit(function (e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.
        $this = $(this).find("button[type=submit]:focus");

        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            dataType: "json",
            beforeSend: function () {
                $this.button('loading');
            },
            success: function (data) {
                if (data.status == "0") {
                    var message = "";
                    $.each(data.error, function (index, value) {

                        message += value;
                    });
                    errorMsg(message);
                } else {
                    $('.timetable_data').html(data.message);
                }

                $this.button('reset');
            }, error: function (jqXHR, textStatus, errorThrown) {
                alert('An error occurred...');
                $this.button('reset');
            },
            complete: function () {
                $this.button('reset');
            }
        });


    });
</script>