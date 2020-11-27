<style type="text/css">
    .checked{
        color:orange;
    }
</style>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-secret"></i> <?php echo $this->lang->line('teachers'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary" id="tachelist">
                    <div class="box-body">
                         <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"> <?php echo $this->lang->line('teachers'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('teachers'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('teacher_name'); ?></th>
                                        <th><?php  echo $this->lang->line('subject');?></th>
                                        <th><?php  echo $this->lang->line('time');?></th>
                                         <th><?php  echo $this->lang->line('room_no'); ?></th>
                                        <th><?php echo $this->lang->line('email'); ?></th>
                                        <th><?php echo $this->lang->line('phone'); ?></th>
                                        <th class="text-center"><?php echo $this->lang->line('rating'); ?></th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($teacherlist)) {
                                        ?>
                                        
                                        <?php
                                    } else {
                                        $count = 1;
                                        foreach ($teacherlist as $teacher) {
                                             $class_teacher='';
                                             $teacher1=array();
                                             foreach ($teacher as $key => $value) {
                                              $teacher1[$value->subject_id]=$value;
                                          }

                                          if($teacher[0]->class_teacher==$teacher[0]->staff_id){
                                            $class_teacher='<span class="label label-success">Class Teacher</span>';
                                          }
                                            ?>
                                            <tr>
                                                <td class="mailbox-name"><?php echo $teacher[0]->name . " " . $teacher[0]->surname." (".$teacher[0]->employee_id.") ".$class_teacher ?></td>
                                                <td><?php 
                                                foreach($teacher1 as $value){
                                                     if($value->day!=''){
                                                    echo $value->subject_name." ".$value->type." (".$value->code.") <br>";
                                                }

                                                }
                                                ?></td>
                                                 <td><?php 
                                                foreach($teacher1 as $value){
                                                    if($value->day!=''){
                                                         echo $value->day." (".$value->time_from." ".$this->lang->line('to')." ".$value->time_to.") <br>";
                                                    }
                                                   

                                                }
                                                ?></td>
                                                  <td>
                                                    <?php 
                  
                                                foreach($teacher1 as $room_no){
                                                     if($room_no->day!=''){
                                                    echo $room_no->room_no."<br>";
                                                }

                                                }
                                                ?>
                                                    
                                                </td>
                                               <td><?php  echo $teacher[0]->email?></td>
                                               <td><?php  echo $teacher[0]->contact_no?></td>
                                              <td>
                                              <center>
                                                <h5><?php 
                                               if(isset($avg_rate[$teacher[0]->staff_id]) && $rate_canview=='1'){
                                               $stage=(int) ($avg_rate[$teacher[0]->staff_id]);
                                                $stagehalf="";
                                                 $half=fmod($avg_rate[$teacher[0]->staff_id],1);
                                                if($half!=0){
                                                $stagehalf=$stage+1;
                                                }

                                                for($i=1;$i<=5;$i++){ ?>
                                                <span class="fa fa-star<?php if($i==$stagehalf && ($half>0 && $half<1)){  echo '-half-o checked'; }
                                                 ?> " <?php if($stage>=$i){ ?> style="color:orange;"<?php }?>></span>
                                                <?php  
                                                }        
                                                ?></h5></center>
                                                <center><h5><?php echo substr($avg_rate[$teacher[0]->staff_id],0,3); ?> average based on <?php echo $reviews[$teacher[0]->staff_id];?> reviews.</h5></center>
                                                                                             <?php  } ?>
                                                </td> 
                                              
                                            </tr>
                                            <?php
                                        }
                                        $count++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="mailbox-controls"> 
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </section>
</div>
<div id="myModal" class="modal fade in" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><?php echo $this->lang->line('rate'); ?></h4>
            </div>
            <div class="modal-body">
                <form id="sendform" action="<?php echo base_url() ?>emailconfig/test_mail" name="employeeform" class="" method="post" accept-charset="utf-8"> 
                               <div class="row">         
                                    <div class="col-md-12">
                                        <div class="form-group">
                                         <label for="pwd"><?php echo $this->lang->line('rating');?><small class="req"> *</small> </label>
                                        <span onclick="rate('1')" id='rate1' class="fa fa-star"></span>
                                        <span onclick="rate('2')" id='rate2' class="fa fa-star"></span>
                                        <span onclick="rate('3')" id='rate3' class="fa fa-star"></span>
                                        <span onclick="rate('4')" id='rate4' class="fa fa-star"></span>
                                        <span onclick="rate('5')" id='rate5' class="fa fa-star"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="pwd"><?php echo $this->lang->line('comment');?><small class="req"> *</small>  </label>
                                            <input type="text"  autocomplete="off" class="form-control" value="" name="comment">
                                            <input type="hidden"  autocomplete="off" class="form-control" id="rate" name="rate">
                                            <input type="hidden"  autocomplete="off" class="form-control" value="<?php echo $role; ?>" name="role" >
                                            <input type="hidden"  autocomplete="off" class="form-control" value="<?php echo $user_id; ?>" name="user_id" >
                                            <input type="hidden"  autocomplete="off" class="form-control" id="staff_id" name="staff_id" >
                                        </div>
                                    </div>

                             <div class="col-md-12">
                                <div class="form-group">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save');?></button>
                                 </div> 
                               </div>  
                           </div><!--./row--> 
                       </form>                           
                    </div><!--./modal-body-->
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
            
        $('#rate1').hover(
    function () {
         $("#rate1").attr("style", "color:#f1b624f0;");
    }
);
          $('#rate2').hover(
    function () {
         $("#rate2").attr("style", "color:#f1b624f0;");
    }
);
            $('#rate3').hover(
    function () {
         $("#rate3").attr("style", "color:#f1b624f0;");
    }
);
              $('#rate4').hover(
    function () {
         $("#rate4").attr("style", "color:#f1b624f0;");
    }
);
                $('#rate5').hover(
    function () {
         $("#rate5").attr("style", "color:#f1b624f0;");
    }
);
     
        
    
        function rating(id){
            for (i = 1; i <= 5; i++) {            
         $("#rate"+i).attr("style", "color:none;");
        }
        $('#myModal').modal('show');
        $('#staff_id').val(id);
    }

    function rate(val){

        $('#rate').val(val);

         for (i = 1; i <= 5; i++) {            
         $("#rate"+i).attr("style", "color:none;");
        }

        for (i = 1; i <= val; i++) {
         $("#rate"+i).attr("style", "color:#f1b624f0;");
        }

      }

$(document).ready(function (e) {
    $("#sendform").on('submit', (function (e) {
    e.preventDefault();
    $.ajax({
    url: '<?php echo base_url() ?>parent/teacher/rating',
    type: "POST",
    data: new FormData(this),
    dataType: 'json',
    contentType: false,
    cache: false,
    processData: false,
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
    },
    error: function () {

    }
    });
}));
});
</script>