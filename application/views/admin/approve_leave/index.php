<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-flask"></i> <?php echo $this->lang->line('approve')." ".$this->lang->line('leave'); ?>
        </h1> 
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>

            </div>
            <form  class="assign_teacher_form" action="<?php echo base_url(); ?>admin/approve_leave" method="post" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>
                            <?php echo $this->customlib->getCSRF(); ?>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-6">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                <select autofocus="" id="searchclassid" name="class_id" onchange="getSectionByClass(this.value)"  class="form-control" >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                    foreach ($classlist as $class) {
                                        ?>
                                        <option <?php
                                        if ($class_id == $class["id"]) {
                                            echo "selected";
                                        }
                                        ?> value="<?php echo $class['id'] ?>"><?php echo $class['class'] ?></option>
                                            <?php
                                        }
                                        ?>
                                </select>
                                <span class="class_id_error text-danger"><?php echo form_error('class_id'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-6">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                                <select  id="secid" name="section_id" class="form-control" >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                </select>
                               <span class="class_id_error text-danger"><?php echo form_error('section_id'); ?></span>
                            </div>
                        </div>
                       
                    </div>
                    <button type="submit" id="search_filter" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                </div>
            </form>
        <div class="row">
            <div class="col-md-12">
               
                   
                         <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('approve')." ".$this->lang->line('leave')." ".$this->lang->line('list'); ?></h3>

                            <div class="box-tools pull-right">
                                <button type="button" onclick="add_leave()" class="btn btn-sm btn-primary " data-toggle="tooltip" data-placement="left" ><i class="fa fa-plus"></i> <?php echo $this->lang->line('add'); ?></button>
                            </div>

           </div>
                   

                    <div class="box-body table-responsive">
                        <div class="download_label"> <?php echo $this->lang->line('approve')." ".$this->lang->line('leave')." ".$this->lang->line('list'); ?> </div>
                        <div >
                            <table class="table table-hover table-striped table-bordered example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('student_name')?></th>
                                        <th><?php echo $this->lang->line('class'); ?></th>
                                        <th><?php echo $this->lang->line('section'); ?></th>
                                         <th><?php echo $this->lang->line('apply')." ".$this->lang->line('date'); ?></th>
                                        <th><?php echo $this->lang->line('from')." ".$this->lang->line('date'); ?></th>
                                        <th><?php echo $this->lang->line('to')." ".$this->lang->line('date'); ?></th>
                                       
                                        <th><?php echo $this->lang->line('status'); ?></th>
                                        <th><?php echo $this->lang->line('approve')." ".$this->lang->line('by');?></th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                 
                                    foreach($results as $value){ ?>
                                        <tr>
                                            <td><?php echo $value['firstname']." ".$value['lastname'];  ?></td>
                                            <td><?php echo $value['class'];?></td>
                                            <td><?php echo $value['section'];?></td>
                                            <td><?php echo date($this->customlib->getSchoolDateFormat(),strtotime($value['apply_date'])); ?></td>
                                            <td><?php echo date($this->customlib->getSchoolDateFormat(),strtotime($value['from_date'])); ?></td>
                                             <td><?php echo date($this->customlib->getSchoolDateFormat(),strtotime($value['to_date'])); ?></td>
                                              
                                               
                                        <td ><?php if($value['status']==0){ echo $this->lang->line('pending'); }else{ echo  $this->lang->line('approve'); }?>
                                               </td>
                                               <td><?php echo $value['staff_name']." ".$value['surname'];?></td>
                                                <td class="text-right">
                                                    <?php 
                                                    if($value['status']==1){
                                                        ?>
                                                        <a data-placement="left" href="<?php echo base_url();?>admin/approve_leave/status/<?php echo $value['id'] ?>/0"  class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('disapprove')?>"> <i class="fa fa-times"  aria-hidden="true"></i></a>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <a data-placement="left" href="<?php echo base_url();?>admin/approve_leave/status/<?php echo $value['id'] ?>/1" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('approve')?>"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                        <?php
                                                    }
                                                    ?>
                                                     <?php 

                                                    if($value['docs']!=''){
                                                        ?>
                                                          <a data-placement="left" href="<?php echo base_url();?>admin/approve_leave/download/<?php echo $value['docs']?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('download'); ?>">
                                                                    <i class="fa fa-download"></i>
                                                                </a>
                                                        <?php
                                                    }
                                                    ?>
                                                   
                                                        <a data-placement="left" onclick="get('<?php echo $value['id'];?>')" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('edit')?>"><i class="fa fa-pencil"></i> </a>
														
                                                        <a data-placement="left" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');" href="<?php echo base_url(); ?>admin/approve_leave/remove_leave/<?php echo $value['id'];?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('delete')?>" class="btn btn-default btn-xs"><i class="fa fa-trash" ></i> </a>
														
														
                                                       
                                                </td>
                                        </tr>
                                        <?php
                                                }
                                    ?>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
    </div></section>
</div>


<div class="modal fade" id="homework_docs" tabindex="-1" role="dialog" aria-labelledby="evaluation" style="padding-left: 0 !important">
    <div class="modal-dialog " role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title" id="title"></h4>
            </div>
            <form role="form" id="addleave_form" method="post" enctype="multipart/form-data" action="">

            <div class="modal-body pb0">
                 <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <input type="hidden" id="homework_id"  name="homework_id">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('class'); ?></label>
                                        <select type="text" onchange="get_section(this.value)" name="class" id="class" class="form-control ">
                                        	<option value="" ><?php echo $this->lang->line('select');?></option>
                                        	<?php foreach($classlist as $value){
                                        		?>
                                        		<option value="<?php echo $value['id'];?>"><?php echo $value['class'];?></option>
                                        		<?php
                                        	} ?>
                                        	
                                        	

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('section'); ?></label>
                                <select type="text" name="section" id="section_id" onchange="get_student(this.value)" class="form-control ">
                                        	
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('student'); ?></label><small class="req"> *</small>
                                        <select type="text" name="student" id="student" class="form-control ">
                                        	<option value=""><?php echo $this->lang->line('select');?></option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('apply')." ".$this->lang->line('date'); ?></label><small class="req"> *</small>
                                        <input type="text" name="apply_date" id="apply_date" class="form-control date">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('from')." ".$this->lang->line('date'); ?></label><small class="req"> *</small>
                                        <input type="text" name="from_date" id="from_date" class="form-control date">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('to')." ".$this->lang->line('date'); ?></label><small class="req"> *</small>
                                        <input type="text" name="to_date" id="to_date"  class="form-control date">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('reason'); ?></label>
                                        <input type="hidden" name="leave_id" id="leave_id">
                                        <textarea type="text" id="message" name="message" class="form-control "></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('attach_document'); ?></label>
                                        <input type="file" id="file" name="userfile" class="filestyle form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            <div class="box-footer">

                <div class="pull-right paddA10">
<button class="btn btn-info pull-right"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please wait" value=""><?php echo $this->lang->line('save');?></button>

                </div>
</form>
            </div>
        </div>
    </div>
</div>
<!-- -->
<script type="text/javascript">
   
 
    $(document).ready(function (e) {

        getSectionByClass("<?php echo $class_id ?>","<?php echo $section_id; ?>");
       
        

    });

    function getSectionByClass(class_id,section_id) {
        if (class_id != "") {
            $('#secid').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                beforeSend: function () {
                    $('#secid').addClass('dropdownloading');
                },
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (section_id == obj.section_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                    });
                    $('#secid').append(div_data);
                },
                complete: function () {
                    $('#secid').removeClass('dropdownloading');
                }
            });
        }
        if(section_id !=""){

            $('#secid').val(section_id);

        }
    }
 function get_section(class_id,section_id=null) {
    if (class_id != "") {
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

    function get(id){

        $.ajax({
                url: "<?php echo site_url("admin/approve_leave/get_details") ?>/"+id,
                type: "POST",
            
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                
                success: function (res)
                {
                $('#apply_date').val(res.apply_date);
                $('#from_date').val(res.from_date);
                $('#to_date').val(res.to_date);
                $('#message').html(res.reason);
                $('#leave_id').val(res.id);
                $('#class').val(res.class_id);
                $('#title').html('<?php echo $this->lang->line('edit')." ".$this->lang->line('leave'); ?>');
                get_section(res.class_id,res.section_id);
                get_student(res.section_id,res.stud_id);
                $('#homework_docs').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
                });
                }
            });

    }

    function get_student(id,student_id=null,section_id=null){

    	$('#student').html("");
        var class_id=$('#class').val();

        $.ajax({
        url: "<?php echo site_url("admin/approve_leave/searchByClassSection") ?>/"+class_id+"/"+student_id,
        type: "POST",
        data:{section_id:id},
        //contentType: false,
        //cache: false,
        //processData: true,
        success: function (res)
        {
			
        $('#student').html(res);  
        }
        });
    }

    function add_leave(){
        $('#title').html('<?php echo $this->lang->line('add')." ".$this->lang->line('leave'); ?>');
  $('#homework_docs').modal({
             backdrop: 'static',
             keyboard: false,
              show: true
         });
        
    }

$(document).ready(function () {
            $('#myModal').modal({
             backdrop: 'static',
             keyboard: false,
              show: false
         });
         });

      $("#addleave_form").on('submit', (function (e) {
            e.preventDefault();

             var $this= $(this).find("button[type=submit]:focus");

            $.ajax({
                url: "<?php echo site_url("admin/approve_leave/add") ?>",
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                 beforeSend: function() {
   $this.button('loading');

    },
   success: function (res)
                {

                    if (res.status == "fail") {

                        var message = "";
                        $.each(res.error, function (index, value) {

                            message += value;
                        });
                        errorMsg(message);

                    } else {

                        successMsg(res.message);

                        window.location.reload(true);
                    }
                },
    error: function(xhr) { // if error occured
        alert("Error occured.please try again");
 $this.button('reset');
    },
    complete: function() {
 $this.button('reset');
    }

            });
        }));

</script>