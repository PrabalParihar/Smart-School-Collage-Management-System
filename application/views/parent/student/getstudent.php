<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('student1'); ?></small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?php
                        if (!empty($student['image'])) {
                            echo base_url() . $student['image'];
                        } else {
                            echo base_url() . "uploads/student_images/no_image.png";
                        }
                        ?>" alt="User profile picture">
                        <h3 class="profile-username text-center"><?php echo $student['firstname'] . " " . $student['lastname']; ?></h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('admission_no'); ?></b> <a class="pull-right text-aqua"><?php echo $student['admission_no']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('roll_no'); ?></b> <a class="pull-right text-aqua"><?php echo $student['roll_no']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('class'); ?></b> <a class="pull-right text-aqua"><?php echo $student['class']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('section'); ?></b> <a class="pull-right text-aqua"><?php echo $student['section']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('rte'); ?></b> <a class="pull-right text-aqua"><?php echo $student['rte']; ?></a>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="nav-tabs-custom theme-shadow">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('profile'); ?></a></li>
                        <?php if ($this->parentmodule_lib->hasActive('fees')) { ?>
                            <li class=""><a href="#fee" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('fees'); ?></a></li>
                            <li class=""><a href="#exam" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('exam'); ?></a></li>
                        <?php } ?>
                        <li class=""><a href="#timelineh" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('timeline'); ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="activity">  
                            <div class="tshadow mb25 bozero">
                                <div class="table-responsive around10 pt0">
                                    <table class="table table-striped table-hover tmb0">
                                        <tbody> 
                                            <tr>
                                                <td class="col-md-4"><?php echo $this->lang->line('admission_date'); ?></td>
                                                <td class="col-md-5">                                         
                                                    <?php
                                                    if ($student['admission_date'] != '') {
                                                        echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['admission_date']));
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('date_of_birth'); ?></td>
                                                <td><?php
                                                    if ($student['dob'] != '') {
                                                        echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob']));
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('category'); ?></td>
                                                <td>
                                                    <?php
                                                    foreach ($category_list as $value) {
                                                        if ($student['category_id'] == $value['id']) {
                                                            echo $value['category'];
                                                        }
                                                    }
                                                    ?>    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('mobile_no'); ?></td>
                                                <td><?php echo $student['mobileno']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('cast'); ?></td>
                                                <td><?php echo $student['cast']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('religion'); ?></td>
                                                <td><?php echo $student['religion']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('email'); ?></td>
                                                <td><?php echo $student['email']; ?></td>
                                            </tr>
                                            <?php
                                            $cutom_fields_data = get_custom_table_values($student['id'], 'students');
                                            if (!empty($cutom_fields_data)) {
                                                foreach ($cutom_fields_data as $field_key => $field_value) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $field_value->name; ?></td>
                                                        <td>
                                                            <?php
                                                            if (is_string($field_value->field_value) && is_array(json_decode($field_value->field_value, true)) && (json_last_error() == JSON_ERROR_NONE)) {
                                                                $field_array = json_decode($field_value->field_value);
                                                                echo "<ul class='student_custom_field'>";
                                                                foreach ($field_array as $each_key => $each_value) {
                                                                    echo "<li>" . $each_value . "</li>";
                                                                }
                                                                echo "</ul>";
                                                            } else {
                                                                $display_field = $field_value->field_value;

                                                                if ($field_value->type == "link") {
                                                                    $display_field = "<a href=" . $field_value->field_value . " target='_blank'>" . $field_value->field_value . "</a>";
                                                                }
                                                                echo $display_field;
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tshadow mb25 bozero">
                                <h3 class="pagetitleh2"><?php echo $this->lang->line('address'); ?> <?php echo $this->lang->line('detail'); ?></h3>
                                <div class="table-responsive around10 pt0">
                                    <table class="table table-hover table-striped tmb0"><tbody>
                                            <tr>
                                                <td><?php echo $this->lang->line('current_address'); ?></td>
                                                <td><?php echo $student['current_address']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('permanent_address'); ?></td>
                                                <td><?php echo $student['permanent_address']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div></div>
                            <div class="tshadow mb25 bozero"> 
                                <h3 class="pagetitleh2"><?php echo $this->lang->line('parent'); ?> / <?php echo $this->lang->line('guardian_details'); ?> </h3>
                                <div class="table-responsive around10 pt10">
                                    <table class="table table-hover table-striped tmb0">
                                        <tr>
                                            <td  class="col-md-4"><?php echo $this->lang->line('father_name'); ?></td>
                                            <td  class="col-md-5"><?php echo $student['father_name']; ?></td>
                                            <td rowspan="3"><img class="profile-user-img img-responsive img-circle" src="<?php
                                                if (!empty($student["father_pic"])) {
                                                    echo base_url() . $student["father_pic"];
                                                } else {
                                                    echo base_url() . "uploads/student_images/no_image.png";
                                                }
                                                ?>" ></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('father_phone'); ?></td>
                                            <td><?php echo $student['father_phone']; ?></td>

                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('father_occupation'); ?></td>
                                            <td><?php echo $student['father_occupation']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('mother_name'); ?></td>
                                            <td><?php echo $student['mother_name']; ?></td>
                                            <td rowspan="3"><img class="profile-user-img img-responsive img-circle" src="<?php
                                                if (!empty($student["mother_pic"])) {
                                                    echo base_url() . $student["mother_pic"];
                                                } else {
                                                    echo base_url() . "uploads/student_images/no_image.png";
                                                }
                                                ?>" ></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('mother_phone'); ?></td>
                                            <td><?php echo $student['mother_phone']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('mother_occupation'); ?></td>
                                            <td><?php echo $student['mother_occupation']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('guardian_name'); ?></td>
                                            <td><?php echo $student['guardian_name']; ?></td>
                                            <td rowspan="3"><img class="profile-user-img img-responsive img-circle" src="<?php
                                                if (!empty($student["guardian_pic"])) {
                                                    echo base_url() . $student["guardian_pic"];
                                                } else {
                                                    echo base_url() . "uploads/student_images/no_image.png";
                                                }
                                                ?>" ></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('guardian_email'); ?></td>
                                            <td><?php echo $student['guardian_email']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('guardian_relation'); ?></td>
                                            <td><?php echo $student['guardian_relation']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('guardian_phone'); ?></td>
                                            <td><?php echo $student['guardian_phone']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('guardian_occupation'); ?></td>
                                            <td><?php echo $student['guardian_occupation']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('guardian_address'); ?></td>
                                            <td><?php echo $student['guardian_address']; ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div></div>
                            <div class="tshadow mb25 bozero">
                                <h3 class="pagetitleh2"><?php echo $this->lang->line('miscellaneous_details'); ?></h3>
                                <div class="table-responsive around10 pt0">
                                    <table class="table table-hover table-striped tmb0">
                                        <tbody>
                                            <tr>
                                                <td  class="col-md-4"><?php echo $this->lang->line('blood_group'); ?></td>
                                                <td  class="col-md-5"><?php echo $student['blood_group']; ?></td>
                                            </tr>
                                            <tr>
                                                <td  class="col-md-4"><?php echo $this->lang->line('house'); ?></td>
                                                <td  class="col-md-5"><?php echo $student['house_name']; ?></td>
                                            </tr>
                                            <tr>
                                                <td  class="col-md-4"><?php echo $this->lang->line('height'); ?></td>
                                                <td  class="col-md-5"><?php echo $student['height']; ?></td>
                                            </tr>
                                            <tr>
                                                <td  class="col-md-4"><?php echo $this->lang->line('weight'); ?></td>
                                                <td  class="col-md-5"><?php echo $student['weight']; ?></td>
                                            </tr>
                                            <tr>
                                                <td  class="col-md-4"><?php echo $this->lang->line('measurement_date'); ?></td>
                                                <td  class="col-md-5"><?php
                                                    if (!empty($student['measurement_date'])) {
                                                        echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['measurement_date']));
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <td  class="col-md-4"><?php echo $this->lang->line('previous_school_details'); ?></td>
                                                <td  class="col-md-5"><?php echo $student['previous_school']; ?></td>
                                            </tr>
                                            <tr>
                                                <td  class="col-md-4"><?php echo $this->lang->line('national_identification_no'); ?></td>
                                                <td  class="col-md-5"><?php echo $student['adhar_no']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('local_identification_no'); ?></td>
                                                <td><?php echo $student['samagra_id']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('bank_account_no'); ?></td>
                                                <td><?php echo $student['bank_account_no']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('bank_name'); ?></td>
                                                <td><?php echo $student['bank_name']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('ifsc_code'); ?></td>
                                                <td><?php echo $student['ifsc_code']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div></div>
                        </div>
                        <div class="tab-pane" id="fee">

                            <?php
                            if (empty($student_due_fee) && empty($student_discount_fee)) {
                                ?>
                                <div class="alert alert-danger">
                                    <?php echo $this->lang->line('no_record_found'); ?>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="download_label"><?php echo "Fee Details" ?></div>
                                <div class="table-responsive"> 
                                    <table class="table table-hover table-striped display" id="feetable">

                                        <thead>
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
                                                        <td class="text text-center">

                                                            <?php
                                                            if ($fee_value->due_date == "0000-00-00") {
                                                                
                                                            } else {

                                                                echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($fee_value->due_date));
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="text text-left">
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

                                                        <td ></td>
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
                                                                <td class="text text-center"><?php echo $fee_deposits_value->payment_mode; ?></td>
                                                                <td class="text text-center">

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
                                                                    if ($discount_value['student_fees_discount_description'] == "") {
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
                                                <td ></td>
                                                <td ></td>
                                                <td ></td>
                                                <td class="text text-right" ><?php echo $this->lang->line('grand_total'); ?></td>
                                                <td class="text text-right"><?php
                                                    echo ($currency_symbol . number_format($total_amount, 2, '.', ''));
                                                    ?></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>


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
                                <?php
                            }
                            ?>

                        </div>     
                        <div class="tab-pane" id="timelineh">

                            <div class="timeline-header no-border">

                                <div id="timeline_list">

                                    <?php
                                    if (empty($timeline_list)) {
                                        ?>

                                        <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div>
                                    <?php } else {
                                        ?>

                                        <ul class="timeline timeline-inverse">

                                            <?php
                                            foreach ($timeline_list as $key => $value) {
                                                ?>      
                                                <li class="time-label">
                                                    <span class="bg-blue">    <?php
                                                        echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($value['timeline_date']));
                                                        ?></span>
                                                </li> 
                                                <li>
                                                    <i class="fa fa-list-alt bg-blue"></i>
                                                    <div class="timeline-item">

                                                        <?php if (!empty($value["document"])) { ?>
                                                            <span class="time"><a class="defaults-c text-right" data-toggle="tooltip" title="" href="<?php echo base_url() . "parent/parents/timeline_download/" . $value["id"] . "/" . $value["document"] ?>" data-original-title="Download"><i class="fa fa-download"></i></a></span>
                                                        <?php } ?>
                                                        <h3 class="timeline-header text-aqua"> <?php echo $value['title']; ?> </h3>
                                                        <div class="timeline-body">
                                                            <?php echo $value['description']; ?> 

                                                        </div>

                                                    </div>
                                                </li>
                                            <?php } ?>   
                                            <li><i class="fa fa-clock-o bg-gray"></i></li> 
                                        <?php } ?>
                                    </ul>
                                </div>

 
 <!-- <h2 class="page-header"><?php //echo $this->lang->line('documents');               ?> <?php //echo $this->lang->line('list');               ?></h2> -->

                            </div>

                        </div>                    
                        <div class="tab-pane" id="exam">
                            <div class="dt-buttons btn-group pull-right miusDM40">  
                             <a class="btn btn-default btn-xs dt-button" id="print" onclick="printDiv()" ><i class="fa fa-print"></i></a> 
                            </div> 
                            <?php
                            if (!empty($exam_result)) {
                                foreach ($exam_result as $exam_key => $exam_value) {
                                    ?>
                                    <div class="tshadow mb25">
                                        <h4 class="pagetitleh"> 
                                            <?php
                                            echo $exam_value->exam;
                                            ?>
                                        </h4>   
                                        <?php
                                        if (!empty($exam_value->exam_result)) {
                                            if ($exam_value->exam_result['exam_connection'] == 0) {
                                                if (!empty($exam_value->exam_result['result'])) {
                                                    $exam_quality_points = 0;
                                                    $exam_total_points = 0;
                                                    $exam_credit_hour = 0;
                                                    $exam_grand_total = 0;
                                                    $exam_get_total = 0;
                                                    $exam_pass_status = 1;
                                                    $exam_absent_status = 0;
                                                    $total_exams = 0;
                                                    ?>

                                                    <table class="table table-striped table-hover  ptt10" id="headerTable">
                                                        <thead>
                                                        <th><?php echo $this->lang->line('subject'); ?></th>


                                                        <?php
                                                        if ($exam_value->exam_type == "gpa") {
                                                            ?>
                                                            <th><?php echo $this->lang->line('grade') . " " . $this->lang->line('point'); ?></th>
                                                            <th><?php echo $this->lang->line('credit') . " " . $this->lang->line('hours'); ?></th>
                                                            <th><?php echo $this->lang->line('quality') . " " . $this->lang->line('points') ?></th>
                                                            <?php
                                                        }
                                                        ?>



                                                        <?php
                                                        if ($exam_value->exam_type != "gpa") {
                                                            ?>
                                                            <th><?php echo $this->lang->line('max') . " " . $this->lang->line('marks'); ?></th>
                                                            <th><?php echo $this->lang->line('min') . " " . $this->lang->line('marks') ?></th>
                                                            <th><?php echo $this->lang->line('marks') . " " . $this->lang->line('obtained'); ?></th>
                                                            <?php
                                                        }
                                                        ?>


                                                        <?php
                                                        if ($exam_value->exam_type == "coll_grade_system" || $exam_value->exam_type == "school_grade_system") {
                                                            ?>
                                                            <th><?php echo $this->lang->line('grade'); ?> </th>

                                                            <?php
                                                        }

                                                        if ($exam_value->exam_type == "basic_system") {
                                                            ?>
                                                            <th>
                                                                <?php echo $this->lang->line('result'); ?>
                                                            </th>

                                                            <?php
                                                        }
                                                        ?>
                                                        <th><?php echo $this->lang->line('note'); ?></th>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if (!empty($exam_value->exam_result['result'])) {
                                                                $total_exams = 1;
                                                                foreach ($exam_value->exam_result['result'] as $exam_result_key => $exam_result_value) {
                                                                    $exam_grand_total = $exam_grand_total + $exam_result_value->max_marks;
                                                                    $exam_get_total = $exam_get_total + $exam_result_value->get_marks;
                                                                    $percentage_grade = ($exam_result_value->get_marks * 100) / $exam_result_value->max_marks;
                                                                    if ($exam_result_value->get_marks < $exam_result_value->min_marks) {
                                                                        $exam_pass_status = 0;
                                                                    }
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo ($exam_result_value->name); ?></td>

                                                                        <?php
                                                                        if ($exam_value->exam_type != "gpa") {
                                                                            ?>
                                                                            <td><?php echo ($exam_result_value->max_marks); ?></td>
                                                                            <td><?php echo ($exam_result_value->min_marks); ?></td>
                                                                            <td>
                                                                                <?php
                                                                                echo $exam_result_value->get_marks;

                                                                                if ($exam_result_value->attendence == "absent") {
                                                                                    $exam_absent_status = 1;
                                                                                    echo "&nbsp;" . $this->lang->line('abs');
                                                                                }
                                                                                ?></td>

                                                                            <?php
                                                                        } elseif ($exam_value->exam_type == "gpa") {
                                                                            ?>
                                                                            <td>
                                                                                <?php
                                                                                $percentage_grade = ($exam_result_value->get_marks * 100) / $exam_result_value->max_marks;
                                                                                $point = findGradePoints($exam_grade, $exam_value->exam_type, $percentage_grade);
                                                                                $exam_total_points = $exam_total_points + $point;
                                                                                echo number_format($point, 2, '.', '');
                                                                                ?>

                                                                            </td>
                                                                            <td> <?php
                                                                                echo $exam_result_value->credit_hours;
                                                                                $exam_credit_hour = $exam_credit_hour + $exam_result_value->credit_hours;
                                                                                ?></td>
                                                                            <td><?php
                                                                                echo number_format($exam_result_value->credit_hours * $point, 2, '.', '');
                                                                                $exam_quality_points = $exam_quality_points + ($exam_result_value->credit_hours * $point);
                                                                                ?></td>

                                                                            <?php
                                                                        }
                                                                        ?>

                                                                        <?php
                                                                        if ($exam_value->exam_type == "coll_grade_system" || $exam_value->exam_type == "school_grade_system") {
                                                                            ?>

                                                                            <td><?php echo findExamGrade($exam_grade, $exam_value->exam_type, $percentage_grade); ?></td>

                                                                            <?php
                                                                        }
                                                                        if ($exam_value->exam_type == "basic_system") {
                                                                            ?>
                                                                            <td>
                                                                                <?php
                                                                                if ($exam_result_value->get_marks < $exam_result_value->min_marks) {
                                                                                    ?>
                                                                                    <label class="label label-danger"><?php echo $this->lang->line('fail') ?></label>

                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                    <label class="label label-success"><?php echo $this->lang->line('pass') ?></label>

                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </td>

                                                                            <?php
                                                                        }
                                                                        ?>

                                                                        <td><?php echo ($exam_result_value->note); ?></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>


                                                        </tbody>
                                                    </table>

                                                    <?php
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="bgtgray">   

                                                                <?php
                                                                if ($exam_value->exam_type != "gpa") {
                                                                    ?>
                                                                    <div class="col-sm-3 col-lg-3 col-md-3 pull"> 
                                                                        <div class="description-block">       
                                                                            <h5 class="description-header"><?php echo $this->lang->line('percentage') ?> :  <span class="description-text"><?php
                                                                                    $exam_percentage = ($exam_get_total * 100) / $exam_grand_total;
                                                                                    echo number_format($exam_percentage, 2, '.', '');
                                                                                    ?></span></h5>
                                                                        </div>  
                                                                    </div>
                                                                    <div class="col-sm-4 col-lg-4 col-md-4 border-right">    
                                                                        <div class="description-block">
                                                                            <h5 class="description-header"><?php echo $this->lang->line('result') ?> :<span class="description-text"> 
                                                                                    <?php
                                                                                    if ($total_exams) {
                                                                                        if ($exam_absent_status) {
                                                                                           ?>   <label class="label label-danger"><?php echo $this->lang->line('fail') ?></label>
                                                                                               <?php
                                                                                        } else {

                                                                                            if ($exam_pass_status) {
                                                                                                ?>
                                                                                                <span class='label bg-green' style="margin-right: 5px;">

                                                                                                    <?php
                                                                                                    echo $this->lang->line('pass');
                                                                                                    ?>
                                                                                                </span> <?php
                                                                                            } else {
                                                                                                ?>
                                                                                                <span class='label label-danger'>

                                                                                                    <?php
                                                                                                    echo $this->lang->line('fail');
                                                                                                    ?>
                                                                                                </span> 
                                                                                            </span><?php
                                                                                        }

                                                                                        if ($exam_pass_status) {

                                                                                            echo $this->lang->line('division');
                                                                                            if ($exam_percentage >= 60) {
                                                                                                echo " :" . $this->lang->line('first');
                                                                                            } elseif ($exam_percentage >= 50 && $exam_percentage < 60) {
                                                                                                echo " :" . $this->lang->line('second');
                                                                                            } elseif ($exam_percentage >= 0 && $exam_percentage < 50) {
                                                                                                echo " :" . $this->lang->line('third');
                                                                                            } else {
                                                                                                
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>


                                                                            </h5>  
                                                                        </div>  
                                                                    </div>    
                                                                    <div class="col-sm-2 col-lg-2 col-md-2 border-right ">
                                                                        <div class="description-block">
                                                                            <h5 class="description-header"><?php echo $this->lang->line('grand') . " " . $this->lang->line('total') ?> : <span class="description-text"><?php echo $exam_grand_total; ?></span></h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3 border-right ">
                                                                        <div class="description-block"><h5 class="description-header"><?php echo $this->lang->line('total') . " " . $this->lang->line('obtain') . " " . $this->lang->line('marks') ?> :  <span class="description-text"><?php echo $exam_get_total; ?></span></h5>
                                                                        </div>
                                                                    </div>



                                                                    <?php
                                                                } elseif ($exam_value->exam_type == "gpa") {
                                                                    ?>
                                                                    <div class="col-sm-2 pull ">   
                                                                        <div class="description-block">  
                                                                            <h5 class="description-header"><?php echo $this->lang->line('credit') . " " . $this->lang->line('hours'); ?> :  <span class="description-text"><?php echo $exam_credit_hour; ?></span></h5></div></div>  
                                                                    <div class="col-sm-3 pull "><div class="description-block"><h5 class="description-header"><?php echo $this->lang->line('quality') . " " . $this->lang->line('points') ?> :  <span class="description-text"><?php echo $exam_quality_points . "/" . $exam_credit_hour . '=' . number_format($exam_quality_points / $exam_credit_hour, 2, '.', ''); ?>  
                                                                                </span></h5></div>
                                                                    </div> 


                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        } elseif ($exam_value->exam_result['exam_connection'] == 1) {

                                            // print_r($exam_value->exam_result['exams']);

                                            $exam_connected_exam = ($exam_value->exam_result['exam_result']['exam_result_' . $exam_value->exam_group_class_batch_exam_id]);

                                            if (!empty($exam_connected_exam)) {
                                                $exam_quality_points = 0;
                                                $exam_total_points = 0;
                                                $exam_credit_hour = 0;
                                                $exam_grand_total = 0;
                                                $exam_get_total = 0;
                                                $exam_pass_status = 1;
                                                $exam_absent_status = 0;
                                                $total_exams = 0;
                                                ?>


                                                <table class="table table-striped ">
                                                    <thead>
                                                    <th><?php echo $this->lang->line('subject') ?></th>


                                                    <?php
                                                    if ($exam_value->exam_type == "gpa") {
                                                        ?>
                                                        <th><?php echo $this->lang->line('grade') . " " . $this->lang->line('point') ?> </th>
                                                        <th><?php echo $this->lang->line('credit') . " " . $this->lang->line('hours') ?></th>
                                                        <th><?php echo $this->lang->line('quality') . " " . $this->lang->line('points'); ?></th>
                                                        <?php
                                                    }
                                                    ?>



                                                    <?php
                                                    if ($exam_value->exam_type != "gpa") {
                                                        ?>
                                                        <th><?php echo $this->lang->line('max') . " " . $this->lang->line('marks') ?></th>
                                                        <th><?php echo $this->lang->line('min') . " " . $this->lang->line('marks') ?></th>
                                                        <th><?php echo $this->lang->line('marks') . " " . $this->lang->line('obtained') ?> </th>
                                                        <?php
                                                    }
                                                    ?>


                                                    <?php
                                                    if ($exam_value->exam_type == "coll_grade_system" || $exam_value->exam_type == "school_grade_system") {
                                                        ?>
                                                        <th><?php echo $this->lang->line('grade'); ?></th>

                                                        <?php
                                                    }

                                                    if ($exam_value->exam_type == "basic_system") {
                                                        ?>
                                                        <th>
                                                            <?php echo $this->lang->line('result'); ?>
                                                        </th>

                                                        <?php
                                                    }
                                                    ?>
                                                    <th><?php echo $this->lang->line('remark') ?></th>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (!empty($exam_connected_exam)) {
                                                            $total_exams = 1;
                                                            foreach ($exam_connected_exam as $exam_result_key => $exam_result_value) {
                                                                $exam_grand_total = $exam_grand_total + $exam_result_value->max_marks;
                                                                $exam_get_total = $exam_get_total + $exam_result_value->get_marks;
                                                                $percentage_grade = ($exam_result_value->get_marks * 100) / $exam_result_value->max_marks;
                                                                if ($exam_result_value->get_marks < $exam_result_value->min_marks) {
                                                                    $exam_pass_status = 0;
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo ($exam_result_value->name); ?></td>

                                                                    <?php
                                                                    if ($exam_value->exam_type != "gpa") {
                                                                        ?>
                                                                        <td><?php echo ($exam_result_value->max_marks); ?></td>
                                                                        <td><?php echo ($exam_result_value->min_marks); ?></td>
                                                                        <td>
                                                                            <?php
                                                                            echo $exam_result_value->get_marks;

                                                                            if ($exam_result_value->attendence == "absent") {
                                                                                $exam_absent_status = 1;
                                                                                echo "&nbsp; " . $this->lang->line('abs');
                                                                            }
                                                                            ?></td>

                                                                        <?php
                                                                    } elseif ($exam_value->exam_type == "gpa") {
                                                                        ?>
                                                                        <td style="border:1px solid #000;">
                                                                            <?php
                                                                            $percentage_grade = ($exam_result_value->get_marks * 100) / $exam_result_value->max_marks;
                                                                            $point = findGradePoints($exam_grade, $exam_value->exam_type, $percentage_grade);
                                                                            $exam_total_points = $exam_total_points + $point;
                                                                            echo number_format($point, 2, '.', '');
                                                                            ?>

                                                                        </td>
                                                                        <td> <?php
                                                                            echo $exam_result_value->credit_hours;
                                                                            $exam_credit_hour = $exam_credit_hour + $exam_result_value->credit_hours;
                                                                            ?></td>
                                                                        <td><?php
                                                                            echo number_format($exam_result_value->credit_hours * $point, 2, '.', '');
                                                                            $exam_quality_points = $exam_quality_points + ($exam_result_value->credit_hours * $point);
                                                                            ?></td>

                                                                        <?php
                                                                    }
                                                                    ?>

                                                                    <?php
                                                                    if ($exam_value->exam_type == "coll_grade_system" || $exam_value->exam_type == "school_grade_system") {
                                                                        ?>
                                                                        <td><?php echo findExamGrade($exam_grade, $exam_value->exam_type, $percentage_grade); ?></td>

                                                                        <?php
                                                                    }
                                                                    if ($exam_value->exam_type == "basic_system") {
                                                                        ?>
                                                                        <td>
                                                                            <?php
                                                                            if ($exam_result_value->get_marks < $exam_result_value->min_marks) {
                                                                                ?>
                                                                                <label class="label label-success"><?php echo $this->lang->line('fail') ?><label>

                                                                                        <?php
                                                                                    } else {
                                                                                        ?>
                                                                                        <label class="label label-success"><?php echo $this->lang->line('pass') ?></label>

                                                                                                <?php
                                                                                            }
                                                                                            ?>
                                                                                            </td>

                                                                                            <?php
                                                                                        }
                                                                                        ?>

                                                                                        <td><?php echo ($exam_result_value->note); ?></td>
                                                                                        </tr>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                                ?>


                                                                                </tbody>
                                                                                </table>
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="bgtgray"> 
                                                                                            <?php
                                                                                            if ($exam_value->exam_type != "gpa") {
                                                                                                ?>
                                                                                                <div class="col-sm-3 pull "> 
                                                                                                    <div class="description-block">       
                                                                                                        <h5 class="description-header"> <?php echo $this->lang->line('percentage') ?> :  <span class="description-text">

                                                                                                                <?php
                                                                                                                $exam_percentage = ($exam_get_total * 100) / $exam_grand_total;
                                                                                                                echo number_format($exam_percentage, 2, '.', '');
                                                                                                                ?>
                                                                                                            </span></h5>
                                                                                                    </div>  
                                                                                                </div>
                                                                                                <div class="col-sm-3 border-right ">    
                                                                                                    <div class="description-block">
                                                                                                        <h5 class="description-header"><?php echo $this->lang->line('result'); ?> :<span class="description-text"> 
                                                                                                                <?php
                                                                                                                if ($total_exams) {
                                                                                                                    if ($exam_absent_status) {
                                                                                                                        ?>
                                                                                                                        <span class='label label-danger' style="margin-right: 5px;">

                                                                                                                            <?php
                                                                                                                            echo $this->lang->line('fail');
                                                                                                                            ?>
                                                                                                                        </span>
                                                                                                                        <?php
                                                                                                                    } else {

                                                                                                                        if ($exam_pass_status) {
                                                                                                                            ?>
                                                                                                                            <span class='label label-success' style="margin-right: 5px;">

                                                                                                                                <?php
                                                                                                                                echo $this->lang->line('pass');
                                                                                                                                ?>
                                                                                                                            </span>
                                                                                                                            <?php
                                                                                                                        } else {
                                                                                                                            ?>
                                                                                                                            <span class='label label-danger' style="margin-right: 5px;">

                                                                                                                                <?php
                                                                                                                                echo $this->lang->line('fail');
                                                                                                                                ?>
                                                                                                                            </span>
                                                                                                                            <?php
                                                                                                                        }
                                                                                                                    }
                                                                                                                }
                                                                                                                ?>   

                                                                                                                <?php
                                                                                                                if ($total_exams) {




                                                                                                                    if ($exam_pass_status) {
                                                                                                                        echo $this->lang->line('division');
                                                                                                                        if ($exam_percentage >= 60) {
                                                                                                                            echo " : " . $this->lang->line('first');
                                                                                                                        } elseif ($exam_percentage >= 50 && $exam_percentage < 60) {

                                                                                                                            echo " : " . $this->lang->line('second');
                                                                                                                        } elseif ($exam_percentage >= 0 && $exam_percentage < 50) {

                                                                                                                            echo " : " . $this->lang->line('third');
                                                                                                                        } else {
                                                                                                                            
                                                                                                                        }
                                                                                                                    }
                                                                                                                }
                                                                                                                ?> 

                                                                                                            </span></h5>  
                                                                                                    </div>  
                                                                                                </div>

                                                                                                <div class="col-sm-3 border-right ">
                                                                                                    <div class="description-block">
                                                                                                        <h5 class="description-header"><?php echo $this->lang->line('grand') . " " . $this->lang->line('total'); ?> : <span class="description-text"><?php echo $exam_grand_total; ?></span></h5>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="col-sm-3 border-right ">
                                                                                                    <div class="description-block"><h5 class="description-header"><?php echo $this->lang->line('total') . " " . $this->lang->line('obtain') . " " . $this->lang->line('marks'); ?> :  <span class="description-text"><?php echo $exam_get_total; ?></span></h5>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <?php
                                                                                            } elseif ($exam_value->exam_type == "gpa") {
                                                                                                ?>
                                                                                                <div class="col-sm-2 pull ">   
                                                                                                    <div class="description-block">  
                                                                                                        <h5 class="description-header">
                                                                                                            <?php echo $this->lang->line('credit') . " " . $this->lang->line('hours'); ?> :
                                                                                                            <span class="description-text"><?php echo $exam_credit_hour; ?>
                                                                                                            </span>
                                                                                                        </h5>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-sm-3 pull ">
                                                                                                    <div class="description-block">
                                                                                                        <h5 class="description-header">
                                                                                                            <?php echo $this->lang->line('quality') . " " . $this->lang->line('points'); ?> :<span class="description-text"><?php echo $exam_quality_points . "/" . $exam_credit_hour . '=' . number_format($exam_quality_points / $exam_credit_hour, 2, '.', ''); ?> 
                                                                                                            </span>
                                                                                                        </h5>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <?php
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            </div>
                                                                            <div class="tshadow mb25">
                                                                                <h4 class="pagetitleh"> 
                                                                                    <?php echo $this->lang->line('consolidated') . " " . $this->lang->line('marksheet'); ?>
                                                                                </h4>
                                                                                <?php
                                                                                $consolidate_exam_result = false;
                                                                                $consolidate_exam_result_percentage = false;
                                                                                if ($exam_value->exam_type == "coll_grade_system" || $exam_value->exam_type == "school_grade_system") {
                                                                                    ?>

                                                                                    <table class="table table-striped ">
                                                                                        <thead>
                                                                                        <th><?php echo $this->lang->line('exam') ?></th>
                                                                                        <?php
                                                                                        foreach ($exam_value->exam_result['exams'] as $each_exam_key => $each_exam_value) {
                                                                                            ?>
                                                                                            <th>
                                                                                                <?php echo $each_exam_value->exam; ?>
                                                                                            </th>
                                                                                            <?php
                                                                                        }
                                                                                        ?>
                                                                                        <th><?php echo $this->lang->line('consolidate') ?></th>
                                                                                        </thead>
                                                                                        <tbody>

                                                                                            <tr>
                                                                                                <td><?php echo $this->lang->line('marks') . " " . $this->lang->line('obtained'); ?></td>
                                                                                                <?php
                                                                                                $consolidate_get_total = 0;
                                                                                                $consolidate_max_total = 0;
                                                                                                if (!empty($exam_value->exam_result['exams'])) {
                                                                                                    $consolidate_exam_result = "pass";
                                                                                                    foreach ($exam_value->exam_result['exams'] as $each_exam_key => $each_exam_value) {
                                                                                                        ?>
                                                                                                        <td>
                                                                                                            <?php
                                                                                                            $consolidate_each = getCalculatedExam($exam_value->exam_result['exam_result'], $each_exam_value->id);
                                                                                                            $consolidate_get_percentage_mark = getConsolidateRatio($exam_value->exam_result['exam_connection_list'], $each_exam_value->id, $consolidate_each->get_marks);
                                                                                                            if ($consolidate_each->exam_status == "fail") {
                                                                                                                $consolidate_exam_result = "fail";
                                                                                                            }

                                                                                                            echo $consolidate_get_percentage_mark;
                                                                                                            $consolidate_get_total = $consolidate_get_total + ($consolidate_get_percentage_mark);
                                                                                                            $consolidate_max_total = $consolidate_max_total + ($consolidate_each->max_marks);
                                                                                                            ?>
                                                                                                        </td>
                                                                                                        <?php
                                                                                                    }
                                                                                                }
                                                                                                ?>
                                                                                                <td>
                                                                                                    <?php
                                                                                                    $consolidate_percentage_grade = ($consolidate_get_total * 100) / $consolidate_max_total;
                                                                                                    echo $consolidate_get_total . "/" . $consolidate_max_total . " [" . findExamGrade($exam_grade, $exam_value->exam_type, $consolidate_percentage_grade) . "]";
                                                                                                    $consolidate_exam_result_percentage = $consolidate_percentage_grade;
                                                                                                    ?></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>

                                                                                    <?php
                                                                                } elseif ($exam_value->exam_type == "basic_system") {
                                                                                    ?>

                                                                                    <table class="table table-striped ">
                                                                                        <thead>
                                                                                        <th><?php echo $this->lang->line('exam'); ?></th>
                                                                                        <?php
                                                                                        foreach ($exam_value->exam_result['exams'] as $each_exam_key => $each_exam_value) {
                                                                                            ?>
                                                                                            <th>
                                                                                                <?php echo $each_exam_value->exam; ?>
                                                                                            </th>
                                                                                            <?php
                                                                                        }
                                                                                        ?>
                                                                                        <th><?php echo $this->lang->line('consolidate'); ?></th>
                                                                                        </thead>
                                                                                        <tbody>

                                                                                            <tr>
                                                                                                <td><?php echo $this->lang->line('marks') . " " . $this->lang->line('obtained') ?></td>
                                                                                                <?php
                                                                                                $consolidate_get_total = 0;
                                                                                                $consolidate_max_total = 0;
                                                                                                if (!empty($exam_value->exam_result['exams'])) {
                                                                                                    $consolidate_exam_result = "pass";
                                                                                                    foreach ($exam_value->exam_result['exams'] as $each_exam_key => $each_exam_value) {
//                                                                                                    print_r($each_exam_value->id);
                                                                                                        ?>
                                                                                                        <td>
                                                                                                            <?php
                                                                                                            $consolidate_each = getCalculatedExam($exam_value->exam_result['exam_result'], $each_exam_value->id);
                                                                                                            $consolidate_get_percentage_mark = getConsolidateRatio($exam_value->exam_result['exam_connection_list'], $each_exam_value->id, $consolidate_each->get_marks);
                                                                                                            if ($consolidate_each->exam_status == "fail") {
                                                                                                                $consolidate_exam_result = "fail";
                                                                                                            }
                                                                                                            echo $consolidate_get_percentage_mark;
                                                                                                            $consolidate_get_total = $consolidate_get_total + ($consolidate_get_percentage_mark);
                                                                                                            $consolidate_max_total = $consolidate_max_total + ($consolidate_each->max_marks);
                                                                                                            ?>
                                                                                                        </td>
                                                                                                        <?php
                                                                                                    }
                                                                                                }
                                                                                                ?>
                                                                                                <td><?php
                                                                                                    $consolidate_percentage_grade = ($consolidate_get_total * 100) / $consolidate_max_total;
                                                                                                    echo $consolidate_get_total . "/" . $consolidate_max_total . " [" . findExamGrade($exam_grade, $exam_value->exam_type, $consolidate_percentage_grade) . "]";
                                                                                                    $consolidate_exam_result_percentage = $consolidate_percentage_grade;
                                                                                                    ?></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <?php
                                                                                } elseif ($exam_value->exam_type == "gpa") {
                                                                                    ?>

                                                                                    <table class="table table-striped ">
                                                                                        <thead>
                                                                                        <th><?php echo $this->lang->line('exam') ?></th>
                                                                                        <?php
                                                                                        foreach ($exam_value->exam_result['exams'] as $each_exam_key => $each_exam_value) {
                                                                                            ?>
                                                                                            <th>
                                                                                                <?php echo $each_exam_value->exam; ?>
                                                                                            </th>
                                                                                            <?php
                                                                                        }
                                                                                        ?>
                                                                                        <th><?php echo $this->lang->line('consolidate'); ?></th>
                                                                                        </thead>
                                                                                        <tbody>

                                                                                            <tr>
                                                                                                <td><?php echo $this->lang->line('marks') . " " . $this->lang->line('obtained') ?></td>
                                                                                                <?php
                                                                                                $consolidate_get_total = 0;
                                                                                                $consolidate_subjects_total = 0;

                                                                                                foreach ($exam_value->exam_result['exams'] as $each_exam_key => $each_exam_value) {
//                                                                                                    print_r($each_exam_value->id);
                                                                                                    ?>
                                                                                                    <td>
                                                                                                        <?php
                                                                                                        $consolidate_each = getCalculatedExamGradePoints($exam_value->exam_result['exam_result'], $each_exam_value->id, $exam_grade, $exam_value->exam_type);
                                                                                                        $consolidate_exam_result = ($consolidate_each->total_points / $consolidate_each->total_exams);
                                                                                                        echo $consolidate_each->total_points . "/" . $consolidate_each->total_exams . "=" . number_format($consolidate_exam_result, 2, '.', '');

                                                                                                        $consolidate_get_percentage_mark = getConsolidateRatio($exam_value->exam_result['exam_connection_list'], $each_exam_value->id, $consolidate_exam_result);
                                                                                                        $consolidate_get_total = $consolidate_get_total + ($consolidate_get_percentage_mark);
                                                                                                        $consolidate_subjects_total = $consolidate_subjects_total + $consolidate_each->total_exams;
                                                                                                        ?>
                                                                                                    </td>
                                                                                                    <?php
                                                                                                }
                                                                                                ?>
                                                                                                <td>
                                                                                                    <?php
                                                                                                    $consolidate_percentage_grade = ($consolidate_get_total * 100) / $consolidate_subjects_total;

                                                                                                    echo $consolidate_get_total . "/" . $consolidate_subjects_total . " [" . findExamGrade($exam_grade, $exam_value->exam_type, $consolidate_percentage_grade) . "]";
                                                                                                    ?>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>

                                                                                    <?php
                                                                                }

                                                                                if ($consolidate_exam_result) {
                                                                                    ?>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12">
                                                                                            <div class="bgtgray">   

                                                                                                <div class="col-sm-3 pull "> 
                                                                                                    <div class="description-block">       
                                                                                                        <h5 class="description-header"><?php echo $this->lang->line('result') ?> :
                                                                                                            <span class="description-text">
                                                                                                                <?php echo $consolidate_exam_result; ?>
                                                                                                                
                                                                                                                <?php
                                                                                                                      if ($consolidate_exam_result == "pass") {
                                                                                                                            ?>
                                                                                                                            <span class='label label-success' style="margin-right: 5px;">

                                                                                                                                <?php
                                                                                                                                echo $this->lang->line('pass');
                                                                                                                                ?>
                                                                                                                            </span>
                                                                                                                            <?php
                                                                                                                        } else {
                                                                                                                            ?>
                                                                                                                            <span class='label label-danger' style="margin-right: 5px;">

                                                                                                                                <?php
                                                                                                                                echo $this->lang->line('fail');
                                                                                                                                ?>
                                                                                                                            </span>
                                                                                                                            <?php
                                                                                                                        }
                                                                                                                ?>
                                                                                                            </span>
                                                                                                        </h5>
                                                                                                    </div>  
                                                                                                </div>
                                                                                                <?php
                                                                                                if ($consolidate_exam_result_percentage) {
                                                                                                    ?>
                                                                                                    <div class="col-sm-3 border-right ">    
                                                                                                        <div class="description-block">
                                                                                                            <h5 class="description-header"><?php echo $this->lang->line('division'); ?> :<span class="description-text"> 

                                                                                                                    <?php
                                                                                                                    if ($consolidate_exam_result_percentage >= 60) {
                                                                                                                        echo $this->lang->line('first');
                                                                                                                    } elseif ($consolidate_exam_result_percentage >= 50 && $consolidate_exam_result_percentage < 60) {

                                                                                                                        echo $this->lang->line('second');
                                                                                                                    } elseif ($consolidate_exam_result_percentage >= 0 && $consolidate_exam_result_percentage < 50) {

                                                                                                                        echo $this->lang->line('third');
                                                                                                                    } else {
                                                                                                                        
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                </span></h5>  
                                                                                                        </div>  
                                                                                                    </div>
                                                                                                    <?php
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                            } else {
                                                                ?>

                                                                <?php
                                                            }

//print_r($exam_result);
                                                            ?>
                                                            </div>                    
                                                            </div></div>



                                                            </div>
                                                            </div>
                                                            </div>
                                                            </section>  


                                                            </div>


                                                            <script type="text/javascript">
                                                                $(".myTransportFeeBtn").click(function () {
                                                                    $("span[id$='_error']").html("");
                                                                    $('#transport_amount').val("");
                                                                    $('#transport_amount_discount').val("0");
                                                                    $('#transport_amount_fine').val("0");
                                                                    var student_session_id = $(this).data("student-session-id");
                                                                    $('.transport_fees_title').html("<b>Upload Document</b>");
                                                                    $('#transport_student_session_id').val(student_session_id);
                                                                    $('#myTransportFeesModal').modal({
                                                                        backdrop: 'static',
                                                                        keyboard: false,
                                                                        show: true
                                                                    });
                                                                });
                                                            </script>

                                                            <div class="modal fade" id="myTransportFeesModal" role="dialog">
                                                                <div class="modal-dialog">       
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                            <h4 class="modal-title title text-center transport_fees_title"></h4>
                                                                        </div>
                                                                        <div class="">
                                                                            <div class="form-horizontal">
                                                                                <div class="">
                                                                                    <input  type="hidden" class="form-control" id="transport_student_session_id"  value="0" readonly="readonly"/>
                                                                                    <form id="form1" action="<?php echo site_url('teacher/student/create_doc') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                                                                        <div id='upload_documents_hide_show'>
                                                                                            <?php echo $this->customlib->getCSRF(); ?>
                                                                                            <input type="hidden" name="student_id" value="<?php echo $student_doc_id; ?>" id="student_id">
                                                                                            <h4><?php echo $this->lang->line('upload_documents1'); ?></h4>
                                                                                            <div class="col-md-12">
                                                                                                <div class="">
                                                                                                    <div class="col-md-6">
                                                                                                        <div class="form-group">
                                                                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('title'); ?></label>
                                                                                                            <input id="first_title" name="first_title" placeholder="" type="text" class="form-control"  value="<?php echo set_value('first_title'); ?>" />
                                                                                                            <span class="text-danger"><?php echo form_error('first_title'); ?></span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-6">
                                                                                                        <div class="form-group">
                                                                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('Documents'); ?></label>
                                                                                                            <input id="first_doc_id" name="first_doc" placeholder="" type="file" class="form-control"  value="<?php echo set_value('first_doc'); ?>" />
                                                                                                            <span class="text-danger"><?php echo form_error('first_doc'); ?></span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div></div>
                                                                                        </div>
                                                                                        <div class="modal-footer" style="clear:both">
                                                                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                                                                                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>                   
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <script type="text/javascript">
                                                                $(document).ready(function () {
                                                                    $.extend($.fn.dataTable.defaults, {
                                                                        searching: false,
                                                                        ordering: false,
                                                                        paging: false,
                                                                        bSort: false,
                                                                        info: false
                                                                    });
                                                                    $("#feetable").DataTable({

                                                                        searching: false,
                                                                        ordering: false,
                                                                        paging: false,
                                                                        bSort: false,
                                                                        info: false,
                                                                        dom: "Bfrtip",
                                                                        buttons: [

                                                                            {
                                                                                extend: 'copyHtml5',
                                                                                text: '<i class="fa fa-files-o"></i>',
                                                                                titleAttr: 'Copy',
                                                                                title: $('.download_label').html(),
                                                                                exportOptions: {
                                                                                    columns: ':visible'
                                                                                }
                                                                            },

                                                                            {
                                                                                extend: 'excelHtml5',
                                                                                text: '<i class="fa fa-file-excel-o"></i>',
                                                                                titleAttr: 'Excel',

                                                                                title: $('.download_label').html(),
                                                                                exportOptions: {
                                                                                    columns: ':visible'
                                                                                }
                                                                            },

                                                                            {
                                                                                extend: 'csvHtml5',
                                                                                text: '<i class="fa fa-file-text-o"></i>',
                                                                                titleAttr: 'CSV',
                                                                                title: $('.download_label').html(),
                                                                                exportOptions: {
                                                                                    columns: ':visible'
                                                                                }
                                                                            },

                                                                            {
                                                                                extend: 'pdfHtml5',
                                                                                text: '<i class="fa fa-file-pdf-o"></i>',
                                                                                titleAttr: 'PDF',
                                                                                title: $('.download_label').html(),
                                                                                exportOptions: {
                                                                                    columns: ':visible'

                                                                                }
                                                                            },

                                                                            {
                                                                                extend: 'print',
                                                                                text: '<i class="fa fa-print"></i>',
                                                                                titleAttr: 'Print',
                                                                                title: $('.download_label').html(),
                                                                                customize: function (win) {
                                                                                    $(win.document.body)
                                                                                            .css('font-size', '10pt');

                                                                                    $(win.document.body).find('table')
                                                                                            .addClass('compact')
                                                                                            .css('font-size', 'inherit');
                                                                                },
                                                                                exportOptions: {
                                                                                    columns: ':visible'
                                                                                }
                                                                            },

                                                                            {
                                                                                extend: 'colvis',
                                                                                text: '<i class="fa fa-columns"></i>',
                                                                                titleAttr: 'Columns',
                                                                                title: $('.download_label').html(),
                                                                                postfixButtons: ['colvisRestore']
                                                                            },
                                                                        ]
                                                                    });
                                                                });

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
                                                                });
                                                            </script>


                                                            <?php

                                                            function findGradePoints($exam_grade, $exam_type, $percentage) {

                                                                foreach ($exam_grade as $exam_grade_key => $exam_grade_value) {
                                                                    if ($exam_grade_value['exam_key'] == $exam_type) {

                                                                        if (!empty($exam_grade_value['exam_grade_values'])) {
                                                                            foreach ($exam_grade_value['exam_grade_values'] as $grade_key => $grade_value) {
                                                                                if ($grade_value->mark_from >= $percentage && $grade_value->mark_upto <= $percentage) {
                                                                                    return $grade_value->point;
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                return 0;
                                                            }

                                                            function findExamGrade($exam_grade, $exam_type, $percentage) {

                                                                foreach ($exam_grade as $exam_grade_key => $exam_grade_value) {
                                                                    if ($exam_grade_value['exam_key'] == $exam_type) {

                                                                        if (!empty($exam_grade_value['exam_grade_values'])) {
                                                                            foreach ($exam_grade_value['exam_grade_values'] as $grade_key => $grade_value) {
                                                                                if ($grade_value->mark_from >= $percentage && $grade_value->mark_upto <= $percentage) {
                                                                                    return $grade_value->name;
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                return "-";
                                                            }

                                                            function getConsolidateRatio($exam_connection_list, $examid, $get_marks) {

                                                                if (!empty($exam_connection_list)) {
                                                                    foreach ($exam_connection_list as $exam_connection_key => $exam_connection_value) {

                                                                        if ($exam_connection_value->exam_group_class_batch_exams_id == $examid) {
                                                                            return ($get_marks * $exam_connection_value->exam_weightage) / 100;
                                                                        }
                                                                    }
                                                                }
                                                                return 0;
                                                            }

                                                            function getCalculatedExamGradePoints($array, $exam_id, $exam_grade, $exam_type) {

                                                                $object = new stdClass();
                                                                $return_total_points = 0;
                                                                $return_total_exams = 0;
                                                                if (!empty($array)) {

                                                                    // print_r($array['exam_result_' . $exam_id]);
                                                                    if (!empty($array['exam_result_' . $exam_id])) {
                                                                        foreach ($array['exam_result_' . $exam_id] as $exam_key => $exam_value) {
                                                                            $return_total_exams++;
                                                                            $percentage_grade = ($exam_value->get_marks * 100) / $exam_value->max_marks;
                                                                            $point = findGradePoints($exam_grade, $exam_type, $percentage_grade);
                                                                            $return_total_points = $return_total_points + $point;
                                                                        }
                                                                    }
                                                                }

                                                                $object->total_points = $return_total_points;
                                                                $object->total_exams = $return_total_exams;

                                                                return $object;
                                                            }

                                                            function getCalculatedExam($array, $exam_id) {
                                                                // echo "<pre/>";
//                                                                                                    print_r($array);
                                                                $object = new stdClass();
                                                                $return_max_marks = 0;
                                                                $return_get_marks = 0;
                                                                $return_credit_hours = 0;
                                                                $return_exam_status = false;
                                                                if (!empty($array)) {
                                                                    $return_exam_status = 'pass';
                                                                    // print_r($array['exam_result_' . $exam_id]);
                                                                    if (!empty($array['exam_result_' . $exam_id])) {
                                                                        foreach ($array['exam_result_' . $exam_id] as $exam_key => $exam_value) {


                                                                            if ($exam_value->get_marks < $exam_value->min_marks || $exam_value->attendence != "present") {
                                                                                $return_exam_status = "fail";
                                                                            }

                                                                            $return_max_marks = $return_max_marks + ($exam_value->max_marks);
                                                                            $return_get_marks = $return_get_marks + ($exam_value->get_marks);
                                                                            $return_credit_hours = $return_credit_hours + ($exam_value->credit_hours);
                                                                        }
                                                                    }
                                                                }
                                                                $object->credit_hours = $return_credit_hours;
                                                                $object->get_marks = $return_get_marks;
                                                                $object->max_marks = $return_max_marks;
                                                                $object->exam_status = $return_exam_status;
                                                                return $object;
                                                            }
                                                            ?>
                                                             <script>  document.getElementById("print").style.display = "block";
 

        function printDiv() { 
            document.getElementById("print").style.display = "none";
            
              $('.bg-green').removeClass('label');
             $('.label-danger').removeClass('label');
             $('.label-success').removeClass('label');
            var divElements = document.getElementById('exam').innerHTML;
            var oldPage = document.body.innerHTML;
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";
            window.print();
            document.body.innerHTML = oldPage;

            location.reload(true);
        }
    
 






    </script>