<style type="text/css">
    *{ margin:0; padding: 0;}

    table{ font-family: 'arial'; margin:0; padding: 0;font-size: 12px; color: #000;}
    .tc-container{width: 100%;position: relative; text-align: center;margin-bottom:60px;padding-bottom: 10px;}
    .tcmybg {
        background: top center;
        background-size: contain;
        position: absolute;
        left: 0;
        bottom: 10px;
        width: 160px;
        height: 160px;
        margin-left: auto;
        margin-right: auto;
        right: 0;
        opacity: 0.10;
    }
    /*begin students id card*/
    .studentmain{background: #efefef;width: 100%; margin-bottom: 30px;}
    .studenttop img{width:30px;vertical-align: top;}
    .studenttop{background: #453278;padding:2px;color: #fff;overflow: hidden;
                position: relative;z-index: 1;}
    .sttext1{font-size: 24px;font-weight: bold;line-height: 30px;}
    .stgray{background: #efefef;padding-top: 5px; padding-bottom: 10px;}
    .staddress{margin-bottom: 0; padding-top: 2px;}
    .stdivider{border-bottom: 2px solid #000;margin-top: 5px; margin-bottom: 5px;}
    .stlist{padding: 0; margin:0; list-style: none;}
    .stlist li{text-align: left;display: inline-block;width: 100%;padding: 0px 5px;}
    .stlist li span{width:65%;float: right;}
    .stimg{
        /*margin-top: 5px;*/
        width: 80px;
        height: auto;
        /*margin: 0 auto;*/
    }
    .stimg img{width: 100%;height: auto;border-radius: 2px;display: block;}
    .staround{padding:3px 10px 3px 0;position: relative;overflow: hidden;}
    .staround2{position: relative; z-index: 9;}
    .stbottom{background: #453278;height: 20px;width: 100%;clear: both;margin-bottom: 5px;}
    /*.stidcard{margin-top: 0px;
        color: #fff;font-size: 16px; line-height: 16px;
        padding: 2px 0 0; position: relative; z-index: 1;
        background: #453277;
        text-transform: uppercase;}*/
    .principal{margin-top: -40px;margin-right:10px; float:right;}
    .stred{color: #000;}
    .spanlr{padding-left: 5px; padding-right: 5px;}
    .cardleft{width: 20%;float: left;}
    .cardright{width: 77%;float: right; }
    /* .pt15{padding-top: 15px;}
     .p10tb{padding-bottom: 10px; padding-top: 10px;}*/
    .width32{width: 32.75%; padding: 3px; float: left;}
    /*END students id card*/
</style>

<?php
$school = $sch_setting[0];
$i = 0;
?>

<table cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <?php
        foreach ($students as $student) {
            $i++;
            ?>
            <td valign="top" class="width32">
                <table cellpadding="0" cellspacing="0" width="100%" class="tc-container" style="background: #efefef;">
                    <tr>
                        <td valign="top">
                            <img src="<?php echo base_url('uploads/student_id_card/background/' . $id_card[0]->background); ?>" class="tcmybg" /></td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <div class="studenttop" style="background: <?php echo $id_card[0]->header_color ?>">

                                <div class="sttext1"><img src="<?php echo base_url('uploads/student_id_card/logo/' . $id_card[0]->logo); ?>" width="30" height="30" />
                                    <?php echo $id_card[0]->school_name ?></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" align="center" style="padding: 1px 0; position: relative; z-index: 1">
                            <p>  <?php echo $id_card[0]->school_address ?></p>

                        </td>
                    </tr>

                    <tr>
                        <td valign="top" style="color: #fff;font-size: 16px; padding: 2px 0 0; position: relative; z-index: 1;background: <?php echo $id_card[0]->header_color ?>;text-transform: uppercase;"><?php echo $id_card[0]->title ?></td>
                    </tr>

                    <tr>
                        <td valign="top">
                            <div class="staround">
                                <div class="cardleft">

                                    <div class="stimg">
                                        <img src="<?php echo base_url($student->image); ?>" class="img-responsive" />
                                    </div>
                                </div><!--./cardleft-->
                                <div class="cardright">
                                    <ul class="stlist">


                                        <?php if ($id_card[0]->enable_student_name == 1) { ?><li>Student Name<span> <?php echo $student->firstname . " " . $student->lastname; ?></span></li><?php } ?>
                                        <?php if ($id_card[0]->enable_admission_no == 1) { ?><li>Admission No<span> <?php echo $student->admission_no; ?></span></li><?php } ?>
                                        <?php if ($id_card[0]->enable_class == 1) { ?><li>Class<span><?php echo $student->class . ' - ' . $student->section . " (" . $school['current_session']['session'] . ")"; ?></span></li><?php } ?>
                                        <?php if ($id_card[0]->enable_fathers_name == 1) { ?><li>Father's Name<span><?php echo $student->father_name; ?></span></li><?php } ?>
                                        <?php if ($id_card[0]->enable_address == 1) { ?><li>Address<span><?php echo $student->current_address; ?></span></li><?php } ?>
                                        <?php if ($id_card[0]->enable_phone == 1) { ?><li>Phone<span><?php echo $student->mobileno; ?></span></li><?php } ?>
                                        <?php
                                        if ($id_card[0]->enable_dob == 1) {
                                            ?>
                                            <li>D.O.B
                                                <span>


                                                    <?php
                                                    echo $dob = "";
                                                    if ($student->dob != "0000-00-00") {
                                                        $dob = date($this->customlib->getSchoolDateFormat(), $this->customlib->dateYYYYMMDDtoStrtotime($student->dob));
                                                    }


                                                    echo $dob;
                                                    ?>
                                                </span></li>
                                            <?php
                                        }
                                        ?>

                                        <?php if ($id_card[0]->enable_blood_group == 1) { ?><li class="stred">Blood Group<span><?php echo $student->blood_group; ?></span></li><?php } ?>
                                    </ul>
                                </div><!--./cardright-->
                            </div><!--./staround-->
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" align="right" class="principal"><img src="<?php echo base_url('uploads/student_id_card/signature/' . $id_card[0]->sign_image); ?>" width="66" height="40" /></td>
                    </tr>
                </table>
            </td>

            <?php
            if ($i == 3) {
                // three items in a row. Edit this to get more or less items on a row
                ?></tr><tr><?php
                $i = 0;
            }
        }
        ?>
    </tr>

</table>
