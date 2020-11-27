<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-money"></i> <?php echo $this->lang->line('fees_collection'); ?> <small><?php echo $this->lang->line('student1'); ?></small>  </h1>
    </section>


    <!-- Main content -->
    <section class="content">
         <?php $this->load->view('reports/_finance'); ?>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <div class="box removeboxmius">
                    <div class="box-header ptbnull"></div>
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <form action="<?php echo site_url('studentfee/reportbyname') ?>"  method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                                        <select  id="section_id" name="section_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('student'); ?></label><small class="req"> *</small>
                                        <select  id="student_id" name="student_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('student_id'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                  <div class="form-group">  
                                    <button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                  </div>  
                                </div>
                            </div>
                        </div>

                    </form>
                 
                


                <?php
                if (isset($student_due_fee)) {
                    ?>

                    <div class="">
                       <div class="box-header ptbnull"></div>    
                        <div class="box-header">
                            <h3 class="box-title">

                                <i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('fees_statement'); ?>
                            </h3>
                        </div>
                        <div class="box-body" style="padding-top:0;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="sfborder">  
                                        <div class="col-md-2">
                                            <img width="115" height="115" class="round5" src="<?php echo base_url() . $student['image'] ?>" alt="No Image">
                                        </div>

                                        <div class="col-md-10">
                                            <div class="row">
                                                <table class="table table-striped mb0 font13">
                                                    <tbody>
                                                        <tr>
                                                            <th class="bozero"><?php echo $this->lang->line('name'); ?></th>
                                                            <td class="bozero"><?php echo $student['firstname'] . " " . $student['lastname'] ?></td>

                                                            <th class="bozero"><?php echo $this->lang->line('class_section'); ?></th>
                                                            <td class="bozero"><?php echo $student['class'] . " (" . $student['section'] . ")" ?> </td>
                                                        </tr>
                                                        <tr>
                                                            <th><?php echo $this->lang->line('father_name'); ?></th>
                                                            <td><?php echo $student['father_name']; ?></td>
                                                            <th><?php echo $this->lang->line('admission_no'); ?></th>
                                                            <td><?php echo $student['admission_no']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th><?php echo $this->lang->line('mobile_no'); ?></th>
                                                            <td><?php echo $student['mobileno']; ?></td>
                                                            <th><?php echo $this->lang->line('roll_no'); ?></th>
                                                            <td> <?php echo $student['roll_no']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th><?php echo $this->lang->line('category'); ?></th>
                                                            <td>
                                                                <?php
                                                                foreach ($categorylist as $value) {
                                                                    if ($student['category_id'] == $value['id']) {
                                                                        echo $value['category'];
                                                                    }
                                                                }
                                                                ?>                                              
                                                            </td>
                                                            <th><?php echo $this->lang->line('rte'); ?></th>
                                                            <td><b class="text-danger"> <?php echo $student['rte']; ?> </b>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>   
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-md-12">
                                    <div style="background: #dadada; height: 1px; width: 100%; clear: both; margin-bottom: 10px;"></div>
                                    <p class="dates"><?php echo $this->lang->line('date'); ?>: <?php echo date($this->customlib->getSchoolDateFormat()); ?></p></div>
                            </div>    

                            <div class="table-responsive">
                                <div class="download_label"> <?php echo $this->lang->line('fees_statement')."<br>";
                                $this->customlib->get_postmessage();
                                 ?></div>
                                <table class="table table-striped table-bordered table-hover example table-fixed-header">

                                    <thead class="header">
                                        <tr>
                                            <th><?php echo $this->lang->line('fees_group'); ?></th>
                                            <th><?php echo $this->lang->line('fees_code'); ?></th>
                                            <th class="text text-left"><?php echo $this->lang->line('due_date'); ?></th>
                                            <th class="text text-left"><?php echo $this->lang->line('status'); ?></th>
                                            <th class="text text-right"><?php echo $this->lang->line('amount'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                            <th class="text text-left"><?php echo $this->lang->line('payment_id'); ?></th>
                                            <th class="text text-left"><?php echo $this->lang->line('mode'); ?></th>
                                            <th class="text text-left"><?php echo $this->lang->line('date'); ?></th>
                                            <th class="text text-right" ><?php echo $this->lang->line('discount'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>

                                            <th class="text text-right"><?php echo $this->lang->line('fine'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                            <th class="text text-right"><?php echo $this->lang->line('paid'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                            <th class="text text-right"><?php echo $this->lang->line('balance'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total_amount = "0";
                                        $total_deposite_amount = "0";
                                        $total_fine_amount = "0";
                                        $total_discount_amount = "0";
                                        $total_balance_amount = "0";
                                        $alot_fee_discount = 0;
                                        foreach ($student_due_fee as $key => $fee) {

                                            foreach ($fee->fees as $fee_key => $fee_value) {
                                                $fee_paid = 0;
                                                $fee_discount = 0;
                                                $fee_fine = 0;



                                                if (!empty($fee_value->amount_detail)) {
                                                    $fee_deposits = json_decode(($fee_value->amount_detail));

                                                    foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                                        $fee_paid = $fee_paid + $fee_deposits_value->amount;
                                                        $fee_discount = $fee_discount + $fee_deposits_value->amount_discount;
                                                        $fee_fine = $fee_fine + $fee_deposits_value->amount_fine;
                                                    }
                                                }
                                                $total_amount = $total_amount + $fee_value->amount;
                                                $total_discount_amount = $total_discount_amount + $fee_discount;
                                                $total_deposite_amount = $total_deposite_amount + $fee_paid;
                                                $total_fine_amount = $total_fine_amount + $fee_fine;
                                                $feetype_balance = $fee_value->amount - ($fee_paid + $fee_discount);
                                                $total_balance_amount = $total_balance_amount + $feetype_balance;
                                                ?>
                                                <?php
                                                if ($feetype_balance > 0 && strtotime($fee_value->due_date) < strtotime(date('Y-m-d'))) {
                                                    ?>
                                                    <tr class="danger">
                                                        <?php
                                                    } else {
                                                        ?>
                                                    <tr class="dark-gray">
                                                        <?php
                                                    }
                                                    ?>


                                                    <td><?php
                                                        echo $fee_value->name;
                                                        ?></td>
                                                    <td><?php echo $fee_value->code; ?></td>
                                                    <td class="text text-left">

                                                        <?php
                                                        if ($fee_value->due_date == "0000-00-00") {
                                                            
                                                        } else {

                                                            echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($fee_value->due_date));
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="text text-left width85">
                                                        <?php
                                                        if ($feetype_balance == 0) {
                                                            ?><span class="label label-success"><?php echo $this->lang->line('paid'); ?></span><?php
                                                        } else if (!empty($fee_value->amount_detail)) {
                                                            ?><span class="label label-warning"><?php echo $this->lang->line('partial'); ?></span><?php
                                                        } else {
                                                            ?><span class="label label-danger"><?php echo $this->lang->line('unpaid'); ?></span><?php
                                                            }
                                                            ?>

                                                    </td>
                                                    <td class="text text-right"><?php echo $fee_value->amount; ?></td>

                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text text-right"><?php
                                                        echo (number_format($fee_discount, 2, '.', ''));
                                                        ?></td>
                                                    <td class="text text-right"><?php
                                                        echo (number_format($fee_fine, 2, '.', ''));
                                                        ?></td>
                                                    <td class="text text-right"><?php
                                                        echo (number_format($fee_paid, 2, '.', ''));
                                                        ?></td>
                                                    <td class="text text-right"><?php
                                                        $display_none = "ss-none";
                                                        if ($feetype_balance > 0) {
                                                            $display_none = "";


                                                            echo (number_format($feetype_balance, 2, '.', ''));
                                                        }
                                                        ?>

                                                    </td>




                                                </tr>

                                                <?php
                                                if (!empty($fee_value->amount_detail)) {

                                                    $fee_deposits = json_decode(($fee_value->amount_detail));

                                                    foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                                        ?>
                                                        <tr class="white-td">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="text-right"><img src="<?php echo base_url(); ?>backend/images/table-arrow.png" alt="" /></td>
                                                            <td class="text text-left">


                                                                <a href="#" data-toggle="popover" class="detail_popover" > <?php echo $fee_value->student_fees_deposite_id . "/" . $fee_deposits_value->inv_no; ?></a>
                                                                <div class="fee_detail_popover" style="display: none">
                                                                    <?php
                                                                    if ($fee_deposits_value->description == "") {
                                                                        ?>
                                                                        <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <p class="text text-info"><?php echo $fee_deposits_value->description; ?></p>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>


                                                            </td>
                                                            <td class="text text-left"><?php echo $fee_deposits_value->payment_mode; ?></td>
                                                            <td class="text text-left">

                                                                <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($fee_deposits_value->date)); ?>
                                                            </td>
                                                            <td class="text text-right"><?php echo (number_format($fee_deposits_value->amount_discount, 2, '.', '')); ?></td>
                                                            <td class="text text-right"><?php echo (number_format($fee_deposits_value->amount_fine, 2, '.', '')); ?></td>
                                                            <td class="text text-right"><?php echo (number_format($fee_deposits_value->amount, 2, '.', '')); ?></td>
                                                            <td></td>



                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <?php
                                            }
                                        } 
                                        ?>
                                        <?php
                                        if (!empty($student_discount_fee)) {

                                            foreach ($student_discount_fee as $discount_key => $discount_value) {
                                                ?>
                                                <tr class="dark-light">
                                                    <td align="left"> <?php echo $this->lang->line('discount'); ?> </td>
                                                    <td align="left">
                                                        <?php echo $discount_value['code']; ?>
                                                    </td>
                                                    <td align="left"></td>
                                                    <td align="left" class="text text-left">
                                                        <?php
                                                        if ($discount_value['status'] == "applied") {
                                                            ?>
                                                            <a href="#" data-toggle="popover" class="detail_popover" >

                                                                <?php echo $this->lang->line('discount_of') . " " . $currency_symbol . $discount_value['amount'] . " " . $this->lang->line($discount_value['status']) . " : " . $discount_value['payment_id']; ?>

                                                            </a>
                                                            <div class="fee_detail_popover" style="display: none">
                                                                <?php
                                                                if ($fee_deposits_value->description == "") {
                                                                    ?>
                                                                    <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <p class="text text-danger"><?php echo $discount_value['student_fees_discount_description'] ?></p>
                                                                    <?php
                                                                }
                                                                ?>

                                                            </div>
                                                            <?php
                                                        } else {
                                                            echo '<p class="text text-danger">' . $this->lang->line('discount_of') . " " . $currency_symbol . $discount_value['amount'] . " " . $this->lang->line($discount_value['status']);
                                                        }
                                                        ?>

                                                    </td>
                                                    <td></td>
                                                    <td class="text text-left"></td>
                                                    <td class="text text-left"></td>
                                                    <td class="text text-left"></td>
                                                    <td  class="text text-right">
                                                        <?php
                                                        $alot_fee_discount = $alot_fee_discount;
                                                        ?>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td ></td>

                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>

                                        <tr class="box box-solid total-bg">
                                            <td align="left"></td>
                                            <td align="left"></td>
                                            <td align="left"></td>
                                            <td class="text text-left" ><?php echo $this->lang->line('grand_total'); ?></td>
                                            <td class="text text-right"><?php
                                                echo ($currency_symbol . number_format($total_amount, 2, '.', ''));
                                                ?></td>
                                            <td align="left"></td>
                                            <td align="left"></td>
                                            <td align="left"></td>
                                            <td class="text text-right"><?php
                                                echo ($currency_symbol . number_format($total_discount_amount + $alot_fee_discount, 2, '.', ''));
                                                ?></td>

                                            <td class="text text-right"><?php
                                                echo ($currency_symbol . number_format($total_fine_amount, 2, '.', ''));
                                                ?></td>
                                            <td class="text text-right"><?php
                                                echo ($currency_symbol . number_format($total_deposite_amount, 2, '.', ''));
                                                ?></td>
                                            <td class="text text-right"><?php
                                                echo ($currency_symbol . number_format($total_balance_amount - $alot_fee_discount, 2, '.', ''));
                                                ?></td> 

                                        </tr>
                                    </tbody>
                                </table>
                            </div> 
                        </div>

                    </div>
                  </div>  
                    <?php
                } else {
                    
                }
                ?>

            </div>
        </div>
        <!-- /.row -->
    </section>

    <!-- /.content -->
    <div class="clearfix"></div>
</div>


<script type="text/javascript">
    function getSectionByClass(class_id, section_id) {
        if (class_id !== "" && section_id !== "") {
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
                        if (section_id === obj.section_id) {
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
        $('.detail_popover').popover({
            placement: 'right',
            title: '',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });

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
        $(document).on('change', '#section_id', function (e) {

            getStudentsByClassAndSection();

        });
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id') ?>';
        getSectionByClass(class_id, section_id);
        if (class_id != "" || section_id != "") {
            postbackStudentsByClassAndSection(class_id, section_id);
        }
    });
    function getStudentsByClassAndSection() {

        $('#student_id').html("");
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        var student_id = '<?php echo set_value('student_id') ?>';
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "student/getByClassAndSection",
            data: {'class_id': class_id, 'section_id': section_id},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                    var sel = "";
                    if (section_id == obj.section_id) {
                        sel = "selected=selected";
                    }
                    div_data += "<option value=" + obj.id + ">" + obj.firstname + " " + obj.lastname +" ("+ obj.admission_no + ") </option>";
                });
                $('#student_id').append(div_data);
            }
        });
    }

    function postbackStudentsByClassAndSection(class_id, section_id) {
        $('#student_id').html("");
        var student_id = '<?php echo set_value('student_id') ?>';
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "student/getByClassAndSection",
            data: {'class_id': class_id, 'section_id': section_id},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                    var sel = "";
                    if (student_id == obj.id) {
                        sel = "selected=selected";
                    }
                    div_data += "<option value=" + obj.id + " " + sel + ">" + obj.firstname + " " + obj.lastname +" ("+ obj.admission_no + ") </option>";
                });
                $('#student_id').append(div_data);
            }
        });
    }
</script>

<script type="text/javascript">

    $(document).ready(function () {
        $('.table-fixed-header').fixedHeader();
    });

//  $(window).on('resize', function () {
//    $('.header-copy').width($('.table-fixed-header').width())
//});

    (function ($) {

        $.fn.fixedHeader = function (options) {
            var config = {
                topOffset: 50
                        //bgColor: 'white'
            };
            if (options) {
                $.extend(config, options);
            }

            return this.each(function () {
                var o = $(this);

                var $win = $(window);
                var $head = $('thead.header', o);
                var isFixed = 0;
                var headTop = $head.length && $head.offset().top - config.topOffset;

                function processScroll() {
                    if (!o.is(':visible')) {
                        return;
                    }
                    if ($('thead.header-copy').size()) {
                        $('thead.header-copy').width($('thead.header').width());
                    }
                    var i;
                    var scrollTop = $win.scrollTop();
                    var t = $head.length && $head.offset().top - config.topOffset;
                    if (!isFixed && headTop !== t) {
                        headTop = t;
                    }
                    if (scrollTop >= headTop && !isFixed) {
                        isFixed = 1;
                    } else if (scrollTop <= headTop && isFixed) {
                        isFixed = 0;
                    }
                    isFixed ? $('thead.header-copy', o).offset({
                        left: $head.offset().left
                    }).removeClass('hide') : $('thead.header-copy', o).addClass('hide');
                }
                $win.on('scroll', processScroll);

                // hack sad times - holdover until rewrite for 2.1
                $head.on('click', function () {
                    if (!isFixed) {
                        setTimeout(function () {
                            $win.scrollTop($win.scrollTop() - 47);
                        }, 10);
                    }
                });

                $head.clone().removeClass('header').addClass('header-copy header-fixed').appendTo(o);
                var header_width = $head.width();
                o.find('thead.header-copy').width(header_width);
                o.find('thead.header > tr:first > th').each(function (i, h) {
                    var w = $(h).width();
                    o.find('thead.header-copy> tr > th:eq(' + i + ')').width(w);
                });
                $head.css({
                    margin: '0 auto',
                    width: o.width(),
                    'background-color': config.bgColor
                });
                processScroll();
            });
        };

    })(jQuery);
    $(document).ready(function () {
        $.extend($.fn.dataTable.defaults, {
            ordering: false,
            paging: false,
            bSort: false,
            info: false
        });
    });
</script>
