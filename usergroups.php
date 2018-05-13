<div class="col-md-9 " data-sticky_column="">
    <div class="row right-section">
        <div class=" postright_admin">
            <div class=" col-md-12">
                <h2 class="main_head">MY GROUPS
                </h2>
                <a  class="new_post" href="<?php echo base_url(); ?>user/usernewgroup">New Group</a></div>
            <!--<a class="new_post" href="admin-newforum.html">New Forum</a>-->
            <!--</div>-->




            <div class="post_table table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="chk_lef">&nbsp;
                    <div class="dropdown">
                        <a href="#" dropdown-toggle="" data-toggle="dropdown" aria-expanded="false">
                            <i style="font-size: 16px; color: #373636;" class="fa fa-caret-down" aria-hidden="true"></i>
                        </a>
                        <!--  <button class="btn btn-primary " type="button" >Dropdown Example
                          <span class="caret"></span></button>-->
                        <ul class="dropdown-menu">
                            <li><a href="#" class="dash">Delete</a></li>

                        </ul>
                    </div>
                    </th>
                    <th></th><th>Title</th>
                    <!--<th></th>-->
                    <th></th>
                    <!--<th></th>-->
                    </tr>
                    </thead>
                    <tbody>
                        <?php // $contractors = unserialize($post->my_group); ?>
                        <?php
                        if ($user_groups) {
                            $i = 1;
                            foreach ($user_groups as $contractor) {
//                                var_dump($contractor);
                                ?>
                                <tr> <th><input class="chk_lef" type="checkbox" value="<?php echo $contractor->forum_id; ?>"></th> <td><?php echo $i++; ?></td>
                                    <td>  <?php echo $contractor->forum_title; ?></td>                                                    
                                    <td>
                                           <a href="#" data-toggle="modal" data-target="#myModal<?php echo $contractor->forum_id; ?>">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i></a> 
                                    <div id="myModal<?php echo $contractor->forum_id; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <!--<h4 class="modal-title"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</h4>-->
                                                    <h4> "Are you sure you want to leave this group.?"</h4>
                                        <a href="<?php echo base_url() . 'user/usergroupdelete?id=' . $contractor->forum_id; ?>" class="posteditm btn btn-info">Delete</a>
                                                    <a href="#" class="posteditm btn btn-default" data-dismiss="modal" class="close">Cancel</a>

                                                </div>

                                            </div> 

                                        </div></div>
                                        
                                    </td>
                                </tr>

                     <!--<input style="visibility: hidden;" value="" name="tags[]" class="forumid" type="text"><a href="javascript:void(0);" class="removeel">×</a></li>-->
                            <?php }
                        } ?>




                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
