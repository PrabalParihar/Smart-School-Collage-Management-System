<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

   

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('student')." ".$this->lang->line('list')?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <div class="mailbox-messages">
                           <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                          
                                            <th><?php echo $this->lang->line('student_name'); ?></th>
                                            <th><?php echo $this->lang->line('class'); ?></th>
                                            <th><?php echo $this->lang->line('father_name'); ?></th>
                                            <th><?php echo $this->lang->line('date_of_birth'); ?></th>
                                            <th><?php echo $this->lang->line('gender'); ?></th>
                                            <th><?php echo $this->lang->line('category'); ?></th>
                                            <th><?php echo $this->lang->line('mobile_no'); ?></th>
                                            <th><?php echo $this->lang->line('enrolled'); ?></th>
                                           

                                            <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    <?php
                              
                                        foreach ($studentlist as $student) {
                                            
                                            ?>
                                            <tr>
                                            
                                                    <td>
                      
                                                      <?php 
                                                      if($student['is_enroll']){
                                                        echo $student['firstname']." ".$student['lastname']; 
                                                      }else{
                                                        echo $student['firstname']." ".$student['lastname']; 
                                                      }
                                                      ?>  
                                                    </td>
                                                    <td><?php echo $student['class'] . "(" . $student['section'] . ")" ?></td>
                                                    <td><?php echo $student['father_name']; ?></td>
                                                    <td><?php
                                                        if ($student["dob"] != null) {
                                                            echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob']));
                                                        }
                                                        ?></td>
                                                    <td><?php echo $student['gender']; ?></td>
                                                    <td><?php echo $student['category']; ?></td>
                                                    <td><?php echo $student['mobileno']; ?></td>
                                                    <td><?php echo ($student['is_enroll'])? "<i class='fa fa-check'></i><span style='display:none'>Yes</span>":"<i class='fa fa-minus-circle'></i><span style='display:none'>No</span>"; ?></td>


                                                <td class="mailbox-date pull-right">
                                                    <?php 
if($student['document'] != ""){
?>
<a data-placement="left" href="<?php echo base_url(); ?>admin/onlinestudent/download/<?php echo $student['document'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('download'); ?>">
                                                    <i class="fa fa-download"></i>
                                                </a>
<?php
}
                                                     ?>
                                                     

                                                    <?php
                                                      if($this->rbac->hasprivilege('online_admission','can_edit')){
                                                     if(!$student['is_enroll']){
?>
   <a data-placement="left" href="<?php echo site_url('admin/onlinestudent/edit/'.$student['id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
<?php 
                                                    } }
                                                    if($this->rbac->hasprivilege('online_admission','can_delete')){
                                                     ?>
                                                    
                                 <a data-placement="left" href="<?php echo site_url('admin/onlinestudent/delete/'.$student['id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                <?php } ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                              
                                    ?>

                                </tbody>
                            </table><!-- /.table -->



                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                  
                </div>
            </div><!--/.col (left) -->
            <!-- right column -->

        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
