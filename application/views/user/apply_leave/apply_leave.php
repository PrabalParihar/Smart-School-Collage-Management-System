<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-flask"></i> <?php echo $this->lang->line('apply_leave'); ?>
        </h1>
    </section>
    <section class="content">
       
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('leave')." ".$this->lang->line('list'); ?></h3>

                            <div class="box-tools pull-right">
                                <button type="button" onclick="add_leave()" class="btn btn-sm btn-primary " data-toggle="tooltip" data-placement="left" title="<?php echo $this->lang->line('add');?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add'); ?></button>
                            </div>
                    </div>

                    <div class="box-body table-responsive">
                          <div class="download_label"> <?php echo $this->lang->line('leave')." ".$this->lang->line('list'); ?></div>
                        <div >
                            <table class="table table-hover table-striped table-bordered example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('class');?></th>
                                        <th><?php echo $this->lang->line('section');?></th>
                                        <th><?php echo $this->lang->line('apply')." ".$this->lang->line('date'); ?></th>
                                        <th><?php echo "From ".$this->lang->line('date'); ?></th>
                                        <th><?php echo $this->lang->line('to')." ".$this->lang->line('date'); ?></th>
                                        
                                        <th><?php echo $this->lang->line('status'); ?></th>
                                        <th class="pull-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                 
                                    foreach($results as $value){ ?>
                                        <tr>
                                            <td><?php echo $value['class'];?></td>
                                            <td><?php echo $value['section'];?></td>
                                             <td><?php echo date($this->customlib->getSchoolDateFormat(),strtotime($value['apply_date'])); ?></td>
                                            <td><?php echo date($this->customlib->getSchoolDateFormat(),strtotime($value['from_date'])); ?></td>
                                             <td><?php echo date($this->customlib->getSchoolDateFormat(),strtotime($value['to_date'])); ?></td>
                                             
                                               
                                        <td><?php if($value['status']==0){ echo $this->lang->line('pending'); }else{ echo  $this->lang->line('approve'); }?>
                                               </td>
                                                <td class="pull-right">
                                                    <?php 

                                                    if($value['docs']!=''){
                                                        ?>
                                                          <a data-placement="left" href="<?php echo base_url();?>user/apply_leave/download/<?php echo $value['docs']?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('download'); ?>">
                                                                    <i class="fa fa-download"></i>
                                                                </a>
                                                        <?php
                                                    }
                                                    ?>
                                                  <?php 
                                                   if($value['status']==0){
                                                   ?>
                                                    <a data-placement="left" onclick="get('<?php echo $value['id'];?>')" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i> </a>
                                                    <a data-placement="left" onclick="return confirm('<?php echo $this->lang->line('are_you_sure_delete_record')?>');" href="<?php echo base_url();?>user/apply_leave/remove_leave/<?php echo $value['id']; ?>" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('delete'); ?>" class="btn btn-default btn-xs"><i class="fa fa-remove"></i> </a>
                                               <?php } ?>

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
    </section>
</div>

 
<div class="modal fade" id="homework_docs" tabindex="-1" role="dialog" aria-labelledby="evaluation" style="padding-left: 0 !important">
    <div class="modal-dialog " role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title" id="title"></h4>
            </div> 
            <form role="form" id="addleave_form" method="post" enctype="multipart/form-data" action="">

               <div class="modal-body pb0 ">
                 <div class="row">
                           
                                <input type="hidden" id="homework_id"  name="homework_id">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('apply')." ".$this->lang->line('date'); ?></label><small class="req"> *</small>
                                        <input type="text" name="apply_date" id="apply_date" class="form-control date">
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                        <select class="form-control" name="student_session_id" id="student_session_id">
                                            <option value=""><?php echo $this->lang->line('select');?></option>
                                            <?php 
                                            foreach ($studentclasses as $value) {
                                               ?>
                                               <option value="<?php echo $value->id; ?>"><?php echo $value->class; ?></option>
                                          <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                           
                           
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('from')." ".$this->lang->line('date'); ?></label><small class="req"> *</small>
                                        <input type="text" name="from_date" id="from_date" class="form-control date">
                                    </div>
                                </div>
                                <div class="col-sm-6">
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
            <div class="box-footer">
                <div class="col-md-12">
                   <button class="btn btn-info pull-right"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please wait" value=""><?php echo $this->lang->line('save');?></button>
                </div>

            </div>

          </form>
        </div>
    </div>
</div>
<!-- -->
<script type="text/javascript">
    $(document).ready(function () {

        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
        $('.date,#submit_date,#homeworkdate,#submitdate').datepicker({
            format: date_format,
            autoclose: true
        });

     

    });

    function get(id){
        $.ajax({
                url: "<?php echo site_url("user/apply_leave/get_details") ?>/"+id,
                type: "POST",
              //  data: new FormData(this),
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
                    $('#student_session_id').val(res.student_session_id);
                     $('#title').html('<?php echo $this->lang->line('edit')." ".$this->lang->line('leave'); ?>');
                    $('#homework_docs').modal({
             backdrop: 'static',
             keyboard: false,
              show: true
         });
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
                url: "<?php echo site_url("user/apply_leave/add") ?>",
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