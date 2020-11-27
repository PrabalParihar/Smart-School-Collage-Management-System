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
        <?php $this->load->view('reports/_online_examinations');?>
        <div class="row">
            <div class="col-md-12">
                <div class="box removeboxmius">
                    <div class="box-header ptbnull"></div>
                      <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>

                     <form role="form" action="<?php echo site_url('report/onlineexamattend') ?>" method="post" class="">
                        <div class="box-body row">

                            <?php echo $this->customlib->getCSRF(); ?>

                             <div class="col-sm-6 col-md-6 col-lg-6">
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
                               
                            <div id='date_result'>
                                
                            </div>

                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('date') . " " . $this->lang->line('type'); ?></label>
                                    <select class="form-control" name="date_type" >
                                       
                                        <?php foreach ($date_type as $key => $search) {
                                            ?>
                                            <option value="<?php echo $key ?>" <?php
                                            if ((isset($date_typeid)) && ($date_typeid == $key)) {
                                                echo "selected";
                                                }
                                            ?>><?php echo $search ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('search_type'); ?></span>
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
                    <h3 class="box-title titlefix"><i class="fa fa-money"></i> <?php echo $this->lang->line('online')." ".$this->lang->line('exam')." ".$this->lang->line('attempt')." ".$this->lang->line('report'); ?></h3>
                </div>
                <div class="box-body table-responsive" id="subject_list">
                 <div class="download_label"> <?php echo $this->lang->line('online')." ".$this->lang->line('exam')." ".$this->lang->line('attempt')." ".$this->lang->line('report')."<br>";$this->customlib->get_postmessage(); ?></div>
                 <a class="btn btn-default btn-xs pull-right" id="print" onclick="printDiv()" ><i class="fa fa-print"></i></a> <a class="btn btn-default btn-xs pull-right" id="btnExport" onclick="fnExcelReport();"> <i class="fa fa-file-excel-o"></i> </a>
                     <table class="table table-striped table-bordered table-hover " id="headerTable">
                                <thead>
                                    <tr>

                                        <th><?php echo $this->lang->line('student'); ?></th>
                                        <th><?php echo $this->lang->line('admission_no')?></th>
                                        <th><?php echo $this->lang->line('class')?></th>
                                        <th><?php echo $this->lang->line('section')?></th>
                                        <th><?php echo $this->lang->line('exam') ?></th>
                                        <th><?php echo $this->lang->line('exam')." ".$this->lang->line('from')?></th>
                                        <th><?php  echo $this->lang->line('exam')." ".$this->lang->line('to')?></th>
                                        <th><?php echo $this->lang->line('duration')?></th>
                                        <th class="text text-center"><?php  echo $this->lang->line('exam')." ".$this->lang->line('publish')?></th>
                                        <th class="text text-center"><?php echo $this->lang->line('result')." ".$this->lang->line('publish') ?></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
$count = 1;
foreach ($resultlist as $student_key => $student_value) {
 $exams=explode(',',$student_value['exams']);
 $exam_name='';
 $exam_from='';
 $exam_to='';
 $exam_duration='';
 $exam_publish="";
 $exam_resultpublish="";
 $exam_publishprint="";
$exam_resultpublishprint="";
    foreach($exams as $exams_key=>$exams_value){
        $exam_details=explode('@',$exams_value);
       $exam_name.=$exam_details[1];
       $exam_from.=date($this->customlib->getSchoolDateFormat(), $this->customlib->dateYYYYMMDDtoStrtotime($exam_details[3]));
       $exam_to.=date($this->customlib->getSchoolDateFormat(), $this->customlib->dateYYYYMMDDtoStrtotime($exam_details[4]));
       $exam_duration.=$exam_details[5];
       $exam_publish.=($exam_details[7]== 1) ? "<i class='fa fa-check-square-o'></i>" : "<i class='fa fa-exclamation-circle'></i>";
       $exam_resultpublish.=($exam_details[8]== 1) ? "<i class='fa fa-check-square-o'></i>" : "<i class='fa fa-exclamation-circle'></i>";;
       $exam_publishprint.=($exam_details[7]== 1) ? "<span style='display:none'>Yes</span>" : "<span style='display:none'>No</span>";
       $exam_resultpublishprint.=($exam_details[8]== 1) ? "<span style='display:none'>Yes</span>" : "<span style='display:none'>No</span>";
$exam_name.='<br>';
$exam_from.="<br>";
$exam_to.="<br>";
$exam_duration.="<br>";
$exam_publish.="<br>";
$exam_resultpublish.="<br>";
$exam_publishprint.="<br>";
$exam_resultpublishprint.="<br>";
    }
    //$exam_name.='<br>';
     
    ?>
                                        <tr>
                                            <td class="mailbox-name"> <?php echo $student_value['name']; ?></td>
                                            <td class="mailbox-name"> <?php echo $student_value['admission_no']; ?></td>
                                            <td class="mailbox-name"> <?php echo $student_value['class']; ?> </td>

                                            <td class="mailbox-name"><?php echo $student_value['section']; ?> </td>

                                            <td class="mailbox-name"><?php echo $exam_name;?></td>

                                      <td ><?php echo $exam_from;?></td>
                                      <td><?php echo $exam_to;?></td>
                                      <td><?php echo $exam_duration;?></td>
                                            <td class="text text-center"><?php echo $exam_publish.$exam_publishprint; ?></td>
                                            <td class="text text-center"><?php echo $exam_resultpublish.$exam_resultpublishprint; ?></td>
                                        </tr>
                                        <?php
}
$count++;
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
   
document.getElementById("print").style.display = "block";
  document.getElementById("btnExport").style.display = "block";

        function printDiv() { 
            document.getElementById("print").style.display = "none";
             document.getElementById("btnExport").style.display = "none";
            var divElements = document.getElementById('subject_list').innerHTML;
            var oldPage = document.body.innerHTML;
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";
            window.print();
            document.body.innerHTML = oldPage;

            location.reload(true);
        }
    
 function fnExcelReport()
{
    var tab_text="<table border='2px'><tr >";
    var textRange; var j=0;
    tab = document.getElementById('headerTable'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }  
    else                 //other browser not tested on IE 11
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

    return (sa);
}
    </script>