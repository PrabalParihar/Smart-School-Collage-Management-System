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
        <?php $this->load->view('reports/_human_resource');?>
        <div class="row">
            <div class="col-md-12">
                <div class="box removeboxmius">
                    <div class="box-header ptbnull"></div>
                      <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>

                     <form role="form" action="<?php echo site_url('report/staff_report') ?>" method="post" class="">
                        <div class="box-body row">

                            <?php echo $this->customlib->getCSRF(); ?>

                             <div class="col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('search') . " " . $this->lang->line('type'); ?></label>
                                    <select class="form-control" name="search_type" onchange="showdate(this.value)">
                                       
                                        <?php foreach ($searchlist as $key => $search) {
                                            ?>
                                            <option value="<?php echo $key ?>" <?php
                                            if ((isset($search_type)) && ($search_type == $key)) {

                                                echo "selected";

                                                }
                                            ?>><?php echo $search ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('search_type'); ?></span>
                                </div>
                            </div>
                               <div class="col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('status') ?></label>
                                    <select class="form-control" name="staff_status">
                                       
                                        <?php

                                         foreach ($status as $status_key => $status_value) {

                                            ?>
                                            <option value="<?php echo $status_key ?>" <?php
                                            if ((isset($status_val)) && ($status_val==$status_key)){

                                                echo "selected";

                                                }
                                            ?>><?php echo $status_value ?></option>
                                        <?php } ?>
                                    </select>
                                    
                                </div>
                            </div>
                             <div class="col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('role'); ?></label>
                                    <select class="form-control" name="role" >
                                       <option value=""><?php echo $this->lang->line('select')?></option>
                                        <?php foreach ($roles as  $value) {
                                            ?>
                                            <option value="<?php echo $value['id'] ?>" <?php
                                            if ((isset($role_val)) && ($role_val == $value['id'])) {

                                                echo "selected";

                                                }
                                            ?>><?php echo $value['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                   
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('designation'); ?></label>
                                    <select class="form-control" name="designation">
                                       <option value=""><?php echo $this->lang->line('select');?></option>
                                        <?php foreach ($designation as  $value) {
                                            ?>
                                            <option value="<?php echo $value['id'] ?>" <?php
                                            if ((isset($designation_val)) && ($designation_val == $value['id'])) {

                                                echo "selected";

                                                }
                                            ?>><?php echo $value['designation'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('search_type'); ?></span>
                                </div>
                            </div>
                            <div id='date_result'>
                                
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
                    <h3 class="box-title titlefix"><i class="fa fa-money"></i> <?php echo $this->lang->line('staff')." ".$this->lang->line('report'); ?></h3>
                </div>
                <div class="box-body table-responsive">
                 <div class="download_label"><?php echo $this->lang->line('staff')." ".$this->lang->line('report')."<br>";$this->customlib->get_postmessage(); ?></div>
                   <table class="table table-striped table-bordered table-hover example ">
                       <thead>
                                        <tr>
<th><?php echo $this->lang->line('staff_id'); ?></th>
<th><?php echo $this->lang->line('role'); ?></th>
<th><?php echo $this->lang->line('designation'); ?></th>
<th><?php echo $this->lang->line('department'); ?></th>
<th><?php echo $this->lang->line('name');?></th>
<th><?php echo $this->lang->line('father_name'); ?></th>
<th><?php echo $this->lang->line('mother_name'); ?></th>
<th><?php echo $this->lang->line('email'); ?></th>
<th><?php echo $this->lang->line('gender'); ?></th>
<th><?php echo $this->lang->line('date_of_birth'); ?></th>
<th><?php echo $this->lang->line('date_of_joining'); ?></th>
<th><?php echo $this->lang->line('phone'); ?></th>
<th><?php echo $this->lang->line('emergency_contact_number'); ?></th>
<th><?php echo $this->lang->line('marital_status'); ?></th>
<th><?php echo $this->lang->line('current'); ?> <?php echo $this->lang->line('address'); ?></th>
<th><?php echo $this->lang->line('permanent_address'); ?></th>                                      
<th><?php echo $this->lang->line('qualification'); ?></th>
<th><?php echo $this->lang->line('work_experience'); ?></th>
<th><?php echo $this->lang->line('note'); ?></th>
<th><?php echo $this->lang->line('epf_no'); ?></th>
<th><?php echo $this->lang->line('basic_salary'); ?></th>
<th><?php echo $this->lang->line('contract_type'); ?></th>
<th><?php echo $this->lang->line('work_shift'); ?></th>
<th><?php echo $this->lang->line('work_location'); ?></th>
<th><?php echo $this->lang->line('leaves'); ?></th>
<th><?php echo $this->lang->line('account_title'); ?></th>
<th><?php echo $this->lang->line('bank_account_no'); ?></th>
<th><?php echo $this->lang->line('bank_name'); ?></th>
<th><?php echo $this->lang->line('ifsc_code'); ?></th>
<th><?php echo $this->lang->line('bank_branch_name'); ?></th>
<th><?php echo $this->lang->line('social_media'); ?></th>
                                             <?php
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
                                            foreach ($resultlist as $staff) {
                                                ?>
                                                <tr>
                                               <td><?php echo $staff['employee_id'];?></td>
    <td><?php echo $staff['user_type'];?></td>
    <td><?php echo $staff['designation'];?></td>
    <td><?php echo $staff['department'];?></td>
    <td><?php echo $staff['name']." ".$staff['surname'];?></td>
    <td><?php echo $staff['father_name']?></td>
    <td><?php echo $staff['mother_name']?></td>
    <td><?php echo $staff['email']?></td>
    <td><?php echo $staff['gender']; ?></td>
    <td><?php echo date($this->customlib->getSchoolDateFormat(),strtotime($staff['dob'])); ?></td>
    <td><?php echo date($this->customlib->getSchoolDateFormat(),strtotime($staff['date_of_joining']));?></td>
    <td><?php echo $staff['contact_no']; ?></td>
    <td><?php echo $staff['emergency_contact_no'];?></td>
    <td><?php echo $staff['marital_status'];?></td>
    <td><?php echo $staff['local_address'];?></td>
    <td><?php echo $staff['permanent_address'];?></td>
                                                  <td><?php echo $staff['qualification'];?></td>
                                                  <td><?php echo $staff['work_exp']?></td>
                                                  <td><?php echo $staff['note']?></td>
                                                  <td><?php echo $staff['epf_no'];?></td>
                                                  <td><?php echo $staff['basic_salary'];?></td>
                                                  <td><?php echo $staff['contract_type'];?></td>
                                                  <td><?php echo $staff['shift']?></td>
                                                  <td><?php echo $staff['location']?></td>
                                                  <td><?php 
                                                 // print_r($leave_type);die;
                                                  if(!empty($staff['leaves'])){
                                                    $leave=explode(',',$staff['leaves']);
                                                
                                                  foreach($leave as $val){
                                                    $leave_allot=explode('@',$val);
                                                    if(array_key_exists($leave_allot[0],$leave_type)){
                                                         echo $leave_type[$leave_allot[0]]." : ".$leave_allot[1]."<br>";
                                                    }
                                                
                                                  }
                                                  }

                                                
                                                  ?></td>
                                               
                                                  <td><?php echo $staff['account_title'];?></td>
                                                  <td><?php echo $staff['bank_account_no']; ?></td>
                                                  <td><?php echo $staff['bank_name']; ?></td>
                                                  <td><?php echo $staff['ifsc_code'];?></td>
                                                  <td><?php echo $staff['bank_branch'];?></td>
                                                  <td><a href="<?php echo $staff['facebook']; ?>" target="_blank"><?php echo $staff['facebook']; ?></a><a href="<?php echo $staff['twitter']; ?>" target="_blank"><?php echo $staff['twitter']; ?></a><a href="<?php echo $staff['linkedin']; ?>" target="_blank"><?php echo $staff['linkedin']; ?></a><a href="<?php echo $staff['instagram']; ?>" target="_blank"><?php echo $staff['instagram']; ?></a></td>
                                                 
                                                

   <?php
                                                    if (!empty($fields)) {

                                                        foreach ($fields as $fields_key => $fields_value) {
                                                            $display_field=$staff[$fields_value->name];
                                                      if($fields_value->type == "link"){
  $display_field= "<a href=".$staff[$fields_value->name]." target='_blank'>".$staff[$fields_value->name]."</a>";

  }
                                                            ?>
                                                            <td>

                                                                <?php echo $display_field; ?></td>
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
                </div>
            </div>
        </div>
      </div>
    </div>   
</div>  
</section>
</div>
<script>
    <?php 
    if($search_type=='period'){
        ?>

          $(document).ready(function () {
            showdate('period');
          });

        <?php
    }
    ?>
   
    </script>