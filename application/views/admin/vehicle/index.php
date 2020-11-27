<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>
<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-bus"></i> <?php echo $this->lang->line('transport'); ?></h1>
    </section>
    <section class="content">
        <div class="row">
            <?php if ($this->rbac->hasPrivilege('vehicle', 'can_add')) { ?>
                <div class="col-md-4">
                    <div class="box box-primary" >
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('add_vehicle'); ?></h3>
                        </div>
                        <form id="form1" action="<?php echo site_url('admin/vehicle/index') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">

                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>      
                                <?php echo $this->customlib->getCSRF(); ?>                     
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('vehicle_no'); ?></label><small class="req"> *</small>
                                    <input autofocus="" id="vehicle_no" name="vehicle_no" placeholder="" type="text" class="form-control"  value="<?php echo set_value('vehicle_no'); ?>" />
                                    <span class="text-danger"><?php echo form_error('vehicle_no'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('vehicle_model'); ?></label>
                                    <input id="vehicle_model" name="vehicle_model" placeholder="" type="text" class="form-control"  value="<?php echo set_value('vehicle_model'); ?>" />
                                    <span class="text-danger"><?php echo form_error('vehicle_model'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('year_made'); ?> </label>
                                    <input id="manufacture_year" name="manufacture_year" placeholder="" type="text" class="form-control"  value="<?php echo set_value('manufacture_year'); ?>" />
                                    <span class="text-danger"><?php echo form_error('manufacture_year'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('driver_name'); ?></label>
                                    <input id="driver_name" name="driver_name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('driver_name'); ?>" />
                                    <span class="text-danger"><?php echo form_error('driver_name'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('driver_license'); ?></label>
                                    <input id=" driver_licence" name="driver_licence" placeholder="" type="text" class="form-control"  value="<?php echo set_value('driver_licence'); ?>" />
                                    <span class="text-danger"><?php echo form_error('driver_licence'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('driver_contact'); ?></label>
                                    <input id="driver_contact" name="driver_contact" placeholder="" type="text" class="form-control"  value="<?php echo set_value('intake'); ?>" />
                                    <span class="text-danger"><?php echo form_error('driver_contact'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('note'); ?></label>
                                    <textarea class="form-control" id="note" name="note" placeholder="" rows="3" placeholder="Enter ..."><?php echo set_value('note'); ?></textarea>
                                    <span class="text-danger"><?php echo form_error('note'); ?></span>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>     
            <?php } ?>    
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('vehicle', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <div class="box box-primary" id="vehicle">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('vehicle_list'); ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="mailbox-controls">                         
                            <div class="pull-right">
                            </div>
                        </div>
                        <div class="mailbox-messages table-responsive">
                            <div class="download_label"><?php echo $this->lang->line('vehicle_list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('vehicle_no'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('vehicle_model'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('year_made'); ?></th>
                                        <th><?php echo $this->lang->line('driver_name'); ?></th>
                                        <th><?php echo $this->lang->line('driver_license'); ?></th>
                                        <th><?php echo $this->lang->line('driver_contact'); ?></th>
                                        <th class="text-right no-print"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($listVehicle)) {
                                        ?>

                                        <?php
                                    } else {
                                        $count = 1;
                                        foreach ($listVehicle as $data) {
                                            ?>
                                            <tr>
                                                <td class="mailbox-name">
                                                    <a href="#" data-toggle="popover" class="detail_popover" ><?php echo $data['vehicle_no'] ?></a>

                                                    <div class="vehicle_detail_popover" style="display: none">
                                                        <?php
                                                        if ($data['note'] == "") {
                                                            ?>
                                                            <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <p class="text text-info"><?php echo $data['note']; ?></p>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </td>
                                                <td class="mailbox-name"> <?php echo $data['vehicle_model'] ?></td>
                                                <td class="mailbox-name"> <?php echo $data['manufacture_year'] ?></td>      <td class="mailbox-name"> <?php echo $data['driver_name'] ?></td>
                                                <td class="mailbox-name"> <?php echo $data['driver_licence'] ?></td>
                                                <td class="mailbox-name"> <?php echo $data['driver_contact'] ?></td>

                                                <td class="mailbox-date pull-right no-print">
        <?php if ($this->rbac->hasPrivilege('vehicle', 'can_edit')) { ?>
                                                        <a data-placement="left" href="<?php echo base_url(); ?>admin/vehicle/edit/<?php echo $data['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
        <?php }if ($this->rbac->hasPrivilege('vehicle', 'can_delete')) { ?>
                                                        <a data-placement="left" href="<?php echo base_url(); ?>admin/vehicle/delete/<?php echo $data['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                            <i class="fa fa-remove"></i>
                                                        </a>
                                            <?php } ?>
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
                </div>
            </div>  

        </div>
        <div class="row">           
            <div class="col-md-12">
            </div>
        </div> 
    </section>
</div>
<script type="text/javascript">

    $(document).ready(function () {
        $('#postdate').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });
        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });
    });

    var base_url = '<?php echo base_url() ?>';
    function printDiv(elem) {
        Popup(jQuery(elem).html());
    }

    function Popup(data)
    {

        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({"position": "absolute", "top": "-1000000px"});
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');


        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write(data);
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);


        return true;
    }



    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.vehicle_detail_popover').html();
            }
        });
    });



</script>