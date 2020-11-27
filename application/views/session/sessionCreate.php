<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-th"></i> <?php echo $this->lang->line('manage'); ?> <small><?php echo $this->lang->line('session'); ?></small>        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('add_session'); ?></h3>
                    </div>   
                    <form action="<?php echo site_url('sessions/create') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>     
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('session'); ?></label>
                                <input autofocus="" id="session" name="session" placeholder="" type="text" class="form-control"  value="<?php echo set_value('session'); ?>" />
                                <span class="text-danger"><?php echo form_error('session'); ?></span>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-default"><?php echo $this->lang->line('cancel'); ?></button>
                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </form>
                </div>  
            </div>
        </div> 
    </section>
</div>