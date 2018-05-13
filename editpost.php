  <div class="col-md-9 " data-sticky_column="">
                            <div class="row right-section">
                                <div class="postright_admin new_blog_post">
                                    <h2 class="main_head">EDIT POST
                                    </h2>
                                     <form class="form-horizontaml" id="postsubmit" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/edit_post">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email"><div class="row">Post Title</div></label>
                    <div class="col-sm-10">
                        <div class="row"> 
                            <input type="text" class="form-control" name="title" id="email" value="<?php echo $postdata->title; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email"><div class="row">Add Image</div></label>
                    <div class="col-sm-10">
                        <div class="row"> <div class="input-group fileup">
                                <label class="input-group-btn">
                                    <span class="btn btn-default">
                                        Change Image <input id="my-file-selector" name="userfile" type="file" style="display:none;" onchange="readURL(this);">
                                    </span>
                                </label>
                                <!--<input id="my-file-selector" type="file" name="userfile" style="display:none;" onchange="readURL(this);">-->

                                <input type="text" value="" class="form-control" id="upload-file-info" readonly>
                            </div>
                            <!--Current Image-->
                            
                            <img id="blah"  class="cur_image" src="<?php if (isset($postpic->im_path)) {
    echo base_url();
   ?><?php echo $postpic->im_path;
                        }else{ echo base_url().'/assets/images/nothumb.png'; }
?>">

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email"><div class="row">Description</div></label>
                    <div class="col-sm-10">
                        <div class="row"> 
                            <textarea class="form-control" name="content"><?php echo $postdata->content; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email"><div class="row">Add Tags(Multiple tags seperated by comma)</div></label>
                    <div class="col-sm-10">
                        <div class="row"> 
                            <div class="input_fields_wrap">

                                <div class="textadd col-sm-12">
                                    <div class="row">
                                        <?php $contractors = unserialize($postdata->tags); ?>
                                        <?php if ($contractors) {
                                            $k="";
                                            foreach ($contractors as $contractor) {

                                                $k.= htmlspecialchars($contractor) . ',';
//                                                echo $k;                    ;
                                            } rtrim($k, ',');
                                        }
                                        ?>
                                        <input type="text" class="form-control" name="tags"
                                               value="<?php echo rtrim($k, ','); ?>">
<!--                                        <a class="add_field_button visastatbtn btn"><i class="fa fa-plus"></i>
                                        </a>-->
                                    </div>
                                </div>

                            </div>
                            <ul class="justList">
                                <?php
//                                if ($contractors) {
//                                    foreach ($contractors as $contractor) {
//                                        echo "<li>" . htmlspecialchars($contractor);
//                                        
                                ?>
                                <!--<input type='text' style='visibility: hidden;' value="<?php // echo htmlspecialchars($contractor);  ?>" name='tags[]'><a href='javascript:void(0);' class='remove'>×</a>-->
                                <!--</li>-->
<?php // }
//                                } 
?>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2 forleft" for="email"><div class="row">Add category</div></label>
                    <div class="col-sm-10">
                        <div class="row"> 
                            <select class="chosen-select" style="width: 80%;" name="category">
                                        <?php foreach ($result as $r): ?>


                                    <option <?php
                                        if ($r->cat_id == $postdata->category) {
                                            echo 'selected';
                                        }
                                        ?> value=" <?php echo $r->cat_id; ?>">
    <?php echo $r->cat_title; ?>
                                    </option>

<?php endforeach; ?>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label forleft col-sm-2" for="email"><div class="row">Forum Topics</div></label>
                    <div class="col-sm-10">
                        <div class="row"> 
                            <select class="chosen-select" style="width: 80%;" name="forum">
                                        <?php foreach ($topics as $r): ?>


                                    <option <?php
                                        if ($r->forum_id == $postdata->forum) {
                                            echo 'selected';
                                        }
                                        ?> value=" <?php echo $r->forum_id; ?>">
    <?php echo $r->forum_title; ?>
                                    </option>

<?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="post_id" value="<?php echo $postdata->post_id; ?>">
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10"><div class="row"> 
                            <button type="submit" class="btn btn-default blogsubmit">Submit</button></div>
                    </div>
                </div>
            </form> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>