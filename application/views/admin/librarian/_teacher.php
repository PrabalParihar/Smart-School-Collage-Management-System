

<div class="box box-primary">
    <div class="box-body box-profile">
        <?php
        $image = $memberList->image;
        if (!empty($image)) {

            $file = $memberList->image;
            ;
        } else {

            $file = "no_image.png";
        }
        ?>
        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() . "uploads/staff_images/" . $file ?>" alt="User profile picture">
        <h3 class="profile-username text-center"><?php echo $memberList->name ?></h3>
        <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
                <b><?php echo $this->lang->line('member_id'); ?></b> <a class="pull-right text-aqua"><?php echo $memberList->lib_member_id ?></a>
            </li>
            <li class="list-group-item">
                <b><?php echo $this->lang->line('library_card_no'); ?></b> <a class="pull-right text-aqua"><?php echo $memberList->library_card_no ?></a>
            </li>
            <li class="list-group-item">
                <b><?php echo $this->lang->line('email'); ?></b> <a class="pull-right text-aqua"><?php echo $memberList->email ?></a>
            </li>
            <li class="list-group-item">
                <b><?php echo $this->lang->line('member_type'); ?></b> <a class="pull-right text-aqua"><?php echo $this->lang->line($memberList->member_type); ?></a>
            </li>
            <li class="list-group-item">
                <b><?php echo $this->lang->line('gender'); ?></b> <a class="pull-right text-aqua"><?php echo $memberList->gender ?></a>
            </li>
            <li class="list-group-item">
                <b><?php echo $this->lang->line('phone'); ?></b> <a class="pull-right text-aqua"><?php echo $memberList->contact_no ?></a>
            </li>

        </ul>
    </div>
</div>
