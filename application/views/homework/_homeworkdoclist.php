
                                    <?php foreach($docs as $value){ ?>

 <tr>
                                            <td><?php echo $value["firstname"]." ".$value['lastname']." (".$value["admission_no"].")"; ?></td>
                                             <td><?php echo $value["message"]; ?></td>
                                            <td class="mailbox-date pull-right">
                                                 <a class="btn btn-default btn-xs" href="<?php echo base_url();?>homework/assigmnetDownload/<?php ?>/<?php echo $value['docs'];?>" title="" data-original-title="Evaluation">
                                                        <i class="fa fa-download"></i></a>
                                                    </td>
                                            <?php }
                                    ?>



                           