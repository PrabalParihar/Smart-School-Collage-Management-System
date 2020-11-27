<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-language"></i> <?php echo $this->lang->line('subjects'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">          
            <div class="col-md-4">               
            </div>
            <div class="col-md-12">              
                <div class="box box-primary"><div class="box-header ptbnull">
                        <h3 class="box-title titlefix"> <?php echo $this->lang->line('online')." ".$this->lang->line('exam'); ?></h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"> <?php echo $this->lang->line('online')." ".$this->lang->line('exam'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('exam');?></th>
                                        <th><?php echo $this->lang->line('date')." ".$this->lang->line('from')?></th>
                                        <th><?php echo $this->lang->line('date')." ".$this->lang->line('to');?></th>
                                        <th><?php echo $this->lang->line('duration');?></th>
                                        <th><?php echo $this->lang->line('total')." ".$this->lang->line('attempt');?></th>
                                        <th><?php echo $this->lang->line('attempted');?></th>
                                        <th><?php echo $this->lang->line('status'); ?></th>
                                        <th class="pull-right"><?php echo $this->lang->line('action'); ?></th>
                                      
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($onlineexam)) {
                                        
                                        $count = 1;

                                        foreach ($onlineexam as $exam) {
                                                                               
                                            ?>
                                            <tr>
                                                <td class="mailbox-name"><?php echo $exam->exam;?></td>
                                       <td class="mailbox-name"> <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($exam->exam_from)); ?> </td>

                                            <td class="mailbox-name"> <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($exam->exam_to)); ?> </td>
                                                <td class="mailbox-name"><?php echo $exam->duration;?></td>
                                                <td class="mailbox-name"><?php echo $exam->attempt;?></td>
                                                <td class="mailbox-name"><?php echo $exam->counter;?></td>

                                                  <td class="mailbox-name">
                                                    <?php if($exam->publish_result){
echo $this->lang->line('result')." ".$this->lang->line('published');
                                                    }else{

echo $this->lang->line('available');
                                                    }
                                                    ?>
                                                        
                                                    </td>
                                                <td class="mailbox-name pull-right">
                                                    <a data-placement="left" href="<?php echo site_url('user/onlineexam/view/'.$exam->id); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('view');?>">
                                                            <i class="fa fa-eye"></i>
                                                        </a>

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
                </div>
            </div>
        </div>
    </section>
</div>