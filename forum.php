<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId=871419199695028&autoLogAppEvents=1';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<div class="col-md-10" data-sticky_column="">
    <div class="row   right-section frml">
        <!--<img src="<?php // echo base_url();                ?>assets/images/banner.png" class="img-responsive banner_image_top" alt=""/>-->
        <div class="postlist_wrap"  data-sticky_parent="">
            <div class="post_list_left" data-sticky_column="">
                <?php
                $i = 1;
                foreach ($bloglist as $r):
                    $i = 0;
                    ?>  
                    <div class="collg_custom8 post_lists">
                        <div class="rown">
                            <div class="user_top">
                                <div class="user_sec">
                                    <img class="img-circle userimg img-responsive" src="<?php
                                    if ($this->main->userpic($r->post_author) != NULL) {
                                        echo base_url();
                                        ?><?php
                                        echo $this->main->userpic($r->post_author);
                                    } else {
                                        echo base_url() . '/assets/images/noimage.png';
                                    }
                                    ?>">
                                    <!--<img src="<?php // echo base_url();                   ?>assets/images/noimage.png" alt=""/>--> 
                                </div>
                                <div class="user_sec_right">
                                    <h2 class="uname"><?php echo $this->main->userfullname($r->post_author); ?></h2>
                                    <span class="time_post"><?php echo $this->main->time_elapsed_string($r->Date); ?></span>
                                </div>
                            </div>
                            <?php // if ($r->thumbnail) {  ?>
                                <!--<a href="<?php echo base_url(); ?>post/forum/<?php // echo $r->post_id;               ?>" class="post_link">--> 
                                    <!--<img src="<?php // echo base_url();               ?><?php // echo $this->main->get_pi($r->thumbnail);               ?>" class="img-responsive postthumb" alt=""/>-->
                            <!--</a>-->
                            <?php // }  ?>
                            <div class="post_contnt">
                                <div class="postinner">
                                    <a href="<?php echo base_url(); ?>post/forum/<?php echo $r->post_id; ?>" class="post_link">   <h2 class="post_title"> <?php echo $r->title; ?></h2>
                                    </a>    <span class="tags">
                                        <?php
                                        $tags = unserialize($r->tags);
                                        if (!empty($tags)) {
                                            foreach ($tags as $tag) {
                                                ?>
                                                <a href="<?php echo base_url(); ?>home/search?srch-term=<?php echo $tag; ?>&type=forum"><?php echo $tag; ?></a>
                                            <?php
                                            }
                                        }
                                        ?>

                                    </span>  
                                    <a href="<?php echo base_url(); ?>post/forum/<?php echo $r->post_id; ?>" class="post_link">   <p class="post_exce minimize">

    <?php echo $r->content; ?>                                                            </p>
                                        <!--<a href="#" class="viewmore">View more</a>-->
                                    </a>   </div>

                                <div class="post_share"><?php if ($this->main->get_user_id() !== NULL) { ?>
                                        <a href="#" class="fbshare forum_like <?php if (!empty($r->liked)) echo 'bluelike'; ?>" data-id="<?php if ($this->main->get_user_id() !== NULL) echo $this->main->get_user_id(); ?>">
                                            <i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a> 
                                        <input type="hidden" value="<?php echo $r->post_id; ?>" class="postid">
    <?php }else { ?>
                                        <a href="#"  data-toggle="modal" data-target="#loginpop" class="fbshare mede">

                                            <i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a> 
                                        <?php } ?>
                                    <a class="likec" href="#" data-toggle="modal" data-target="#myModal<?php echo $r->post_id; ?>">
    <?php echo $this->main->forum_like_count($r->post_id); ?> Likes</a> 
                                    <div id="myModal<?php echo $r->post_id; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!--Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> LIKES</h4>
                                                </div>
                                                <ul class="likelist">
                                                    <?php
                                                    $forumlikes = $this->main->post_like_list($r->post_id);
//                                                    var_dump($subcomments);
//                                                    var_dump($forumlikes);
//                                                    exit();
                                                    foreach ($forumlikes as $forumlike) {
                                                        ?>
                                                        <li>
                                                            <img src="<?php
                                                            if (!empty($forumlike['user_pic'])) {
                                                                if ($forumlike['user_id'] != NULL) {
                                                                    echo base_url();
                                                                    ?><?php
                                                                    echo $forumlike['im_path'];
                                                                } else {
                                                                    echo base_url() . '/assets/images/sub.png';
                                                                }
                                                            } else {
                                                                echo base_url() . '/assets/images/sub.png';
                                                            }
                                                            ?>"class="img-responsivek roundsmall img-circle" alt=""/>
        <?php // echo $forumlike['user_id'];     ?>
                                                            <span class="umane">  <?php echo $forumlike['name']; ?></span>
                                                        </li>
    <?php } ?>


                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                        <?php if ($this->main->get_user_id() == NULL) { ?>
                                        <a href="#" data-toggle="modal" data-target="#loginpop"><i class="fa fa-comment-o" aria-hidden="true"></i>&nbsp;
                                        <?php echo $this->main->get_comments_count($r->post_id, 1); ?>  Comments</a>
                                    <?php } else {
                                        ?>
                                        <a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i>&nbsp;
                                        <?php echo $this->main->get_comments_count($r->post_id, 1); ?>  Comments</a>    
    <?php } ?>


    <!--                                    <a href="http://www.facebook.com/sharer.php?u=<?php echo base_url(); ?>post/forum/<?php echo $r->post_id; ?>" target="_blank"><i class="fa fa-share-square-o" aria-hidden="true"></i>&nbsp;
                                            Share</a>-->
                                    <a href="#" data-toggle="modal" data-target="#sharepop"><i class="fa fa-share-square-o" aria-hidden="true"></i>&nbsp;
                                        Share</a>
                                    <div id="sharepop" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title"><i class="fa fa-share-square-o" aria-hidden="true"></i> Share</h4>
                                                </div>
                                                <div class="modal-body" style="min-height: 70px;">
                                                    <!--                                            <ul>
                                                                                                    <li>
                                                                                                        <div class="fb-share-button" data-href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url(); ?>post/index/<?php echo $postt->post_id; ?>" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url(); ?>post/index/<?php echo $postt->post_id; ?>&src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
                                                                                                    </li>
                                                                                                    <li>
                                                                                                        <script src="https://apis.google.com/js/platform.js" async defer></script>
                                                                                                    <g:plus action="share"></g:plus>
                                                                                                    </li>
                                                                                                </ul>-->
                                                    <div class="google_plus_share" style="width:100px;float: left;clear:left;height: 20px;display: inline-block;">
                                                        <!-- Place this tag in your head or just before your close body tag. -->
                                                        <script src="https://apis.google.com/js/platform.js" async defer></script>
                                                        <!-- Place this tag where you want the share button to render. -->
                                                        <div class="g-plus" data-action="share" data-href="<?php echo base_url(); ?>post/forum/<?php echo $r->post_id; ?>"></div>
                                                    </div>
                                                    <div class="fb-share-button" style="display:block;width:100px;float: left;height: 50px;" data-href="<?php echo base_url(); ?>post/forum/<?php echo $r->post_id; ?>" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url(); ?>post/forum/<?php echo $r->post_id; ?>" class="fb-xfbml-parse-ignore">Share</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($this->main->get_user_id() !== NULL) { ?>
                                        <a href="#" class="fbshare med_report <?php
                                        if ($this->main->forum_report_count($r->post_id)) {
                                            echo 'red_color';
                                        }
                                        ?>" data-id="<?php
                                           if ($this->main->get_user_id() !== NULL) {
                                               echo $this->main->get_user_id();
                                           }
                                           ?>">
                                            <i class="fa fa-flag-o" aria-hidden="true"></i></a> 
                                        <input type="hidden" value="<?php echo $r->post_id; ?>" class="postid">
    <?php } else { ?>
                                        <a href="#"  data-toggle="modal" data-target="#loginpop" class="fbshare mede">

                                            <i class="fa fa-flag-o" aria-hidden="true"></i></a> 
                                        <?php } ?>
                                    <a class="likecrp" href="#">
                                    <?php echo $this->main->forum_report_count($r->post_id); ?> Report</a> 
    <?php if ($r->thumbnail) { ?>   
                                        <a href="#"  data-toggle="modal" data-target="#loginpopup<?php echo $r->post_id; ?>" class="fbshare mede">
                                            <i class="fa fa-image" aria-hidden="true"></i> Images</a> 
                                        <a class="likecrpim" href="#"> 

                                        </a> 
    <?php } ?> 
                                    <div id="loginpopup<?php echo $r->post_id; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            Modal content
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> LIKES</h4>
                                                </div>
    <?php if ($r->thumbnail) { ?>
                                                    <a href="<?php echo base_url(); ?>post/forum/<?php echo $r->post_id; ?>" class="post_link"> 
                                                        <img src="<?php echo base_url(); ?><?php echo $this->main->get_pi($r->thumbnail); ?>" class="img-responsive postthumb" alt=""/>
                                                    </a>
    <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div class="comment_list_sec">
                                <div class="main_comment_post">
                                    <div class="comment_author">
                                        <img class="img-circle userimg" src="<?php
                                        if ($this->main->get_user_id() !== NULL) {
                                            if ($this->main->userpic($this->main->get_user_id()) != NULL) {
                                                echo base_url();
                                                ?><?php
                                                echo $this->main->userpic($this->main->get_user_id());
                                            } else {
                                                echo base_url() . '/assets/images/noimage.png';
                                            }
                                        } else {
                                            echo base_url() . '/assets/images/noimage.png';
                                        }
                                        ?>">
                                       <!--<img src="<?php // echo base_url();                 ?>assets/images/user.png" class="img-responsive" alt=""/>-->
                                    </div>
    <?php if ($this->main->get_user_id() !== NULL) { ?>
                                        <div class="comment_area">
                                            <form>
                                                <input type="text" class="form-control commentholder" placeholder="Write a Comment...">
                                                <button class="btn btnsend forum_comment" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> </button>
                                                <input type="hidden" value=" <?php echo $r->post_id; ?>" class="postid">
                                                <input type="hidden" value="<?php if ($this->main->get_user_id() !== NULL) echo $this->main->get_user_id(); ?>" class="user_id">
                                                <input type="hidden" value="1" class="comment_type">

                                            </form>    </div>
                                        <?php
                                    }else {
                                        echo '<div class="comment_area">  <input type="text" disabled class="form-control commentholderb" placeholder="Please login to comment on this forum post">
</div>';
                                    }
                                    ?>
                                </div>
                                <ul class="cmnt_lists">
                                    <?php
                                    $comments = $this->main->get_comments($r->post_id, 1);
                                    $comments_count = count($comments);
                                    //var_dump($comments);
                                    foreach ($comments as $comment) {
                                        ?>
                                        <li>

                                            <div class="main_comment">
                                                <div class="comment_author">
                                                    <img src="<?php
                                                    if ($this->main->userpic($comment['user_id']) != NULL) {
                                                        echo base_url();
                                                        ?><?php
                                                        echo $this->main->userpic($comment['user_id']);
                                                    } else {
                                                        echo base_url() . '/assets/images/noimage.png';
                                                    }
                                                    ?>" alt="" class="img-responsive userimg"/>
                                                </div>
                                                <div class="comment_area">
                                                    <div class="wrapper maincomment">
                                                        <p><span class="comment_username"><?php echo $this->main->userfullname($comment['user_id']); ?> </span>
        <?php echo $comment['comment_content']; ?>
                                                        </p>

                                                    </div>
                                                    <div class="reply_sec">  <a href="#" class="reply_cmnt"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;Reply</a></div>
                                                    <?php
                                                    $subcomments = $this->main->get_subcomments($comment['comment_id'], 1);
                                                    //var_dump($subcomments);
                                                    foreach ($subcomments as $subcomment) {
                                                        ?>
                                                        <div class="wrapper subcomment subcomment_show" style="display: none;">
                                                            <div class="comment_author">
                                                                <img src=" <?php
                                                                if ($subcomment['user_id'] != NULL) {
                                                                    echo base_url();
                                                                    ?><?php
                                                                    echo $this->main->userpic($subcomment['user_id']);
                                                                } else {
                                                                    echo base_url() . '/assets/images/sub.png';
                                                                }
                                                                ?>"class="img-responsivek roundsmall" alt=""/>
                                                             <!--<img src="<?php // echo base_url();               ?>assets/images/sub.png" class="img-responsive" alt=""/>-->
                                                            </div>
                                                            <p> <span class="comment_username"><?php echo $this->main->userfullname($subcomment['user_id']); ?> </span>
                                                        <?php echo $subcomment['comment_content']; ?> </p>
                                                        </div>
        <?php } ?>
                                                    <div class="wrapper subcomment subcomment_new" style="display: none;">
                                                    </div>
                                                    <div class="wrapper subcomment subcomment_show" style="display: none;">
                                                        <div class="comment_author">

                                                            <img src=" <?php
                                                            if ($this->main->get_user_id() != NULL) {
                                                                echo base_url();
                                                                ?><?php
                                                                echo $this->main->userpic($this->main->get_user_id());
                                                            } else {
                                                                echo base_url() . '/assets/images/noimage.png';
                                                            }
                                                            ?>"class="img-responsive roundsmall" alt=""/>
                                                        </div>
                                                        <div class="comment_area">
        <?php if ($this->main->get_user_id() !== NULL) { ?>
                                                                <form>
                                                                    <input type="text" class="form-control commentholder" placeholder="Write a Reply...">
                                                                    <button class="btn btnsend forum_comment_sub" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> </button>
                                                                    <input type="hidden" value=" <?php echo $r->post_id; ?>" class="postid">                   <input type="hidden" value="1" class="comment_type">
                                                                    <input type="hidden" value=" <?php echo $comment['comment_id']; ?>" class="parent_id">
                                                                    <input type="hidden" value="<?php if ($this->main->get_user_id() !== NULL) echo $this->main->get_user_id(); ?>" class="user_id">
                                                                </form>
                                                                <?php
                                                            }else {
                                                                echo '<input type="text" class="form-control commentholderm" disabled placeholder="Login to continue..">';
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                <?php } ?>
                                </ul>
                                <?php if ($comments_count > 1) { ?>
                                    <a href="#" class="viewmore_cmnt">View more comments</a>
    <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
<?php if ($i == 1) { ?>
                    <div class="collg_custom8 post_lists">
                        <span>NO POST FOUND !</span>
                        <p></p>
                        <p>Do you want to write a post related to your query?</p>
                        <p></p>
                        <?php if (empty($post)) { ?>
                            <p><a href="#" class="write_post_empty" data-toggle="modal" data-target="#loginpop">Write Post</a></p>
                        <?php } else { ?>
                            <p><a href="<?php echo base_url(); ?>user/newpost" class="write_post_empty">Write Post</a></p>
                        <?php } ?>
                    </div>
<?php } ?>

            </div>
            <div class="post_list_right" id="sidebar" data-sticky_column="">

                <div class="trending_topic">
                    <h2 class="right_hd_forum">Trending topics </h2>
                    <ul class="tagslist">  <?php foreach ($topics as $r): ?>
                            <li> <a class="labeltags" href="<?php echo base_url(); ?>post/forum_topics/<?php echo $r->forum_id; ?>"><?php echo $r->forum_title; ?></a></li>
<?php endforeach; ?>

                    </ul> 
                </div>
                <div class="right_box">
                    <h2 class="right_hd_forum">subscribe to our newsletter</h2>
                    <div class="subscrptionsec">
                        <img src="<?php echo base_url(); ?>assets/images/subs.png" alt=""/>
                        <p>Enter your email address to receive all news from
                            our awesome website</p>
                    </div>
                    <div class="newsletter">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Your Email Address Please">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button">SUBSCRIBE</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="right_box community_sec">
                    <h2 class="right_hd_forum">About Our Community</h2>
                    <div class="subscrptionsec">
                        <img src="<?php echo base_url(); ?>assets/images/commu.png" alt=""/>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make  </p>
                    </div>

                </div>
                <div class="right_box send_query">
                    <h2 class="right_hd_forum">Send your query</h2>
                    <?php
                    echo $this->session->flashdata('email_sent1');
                    ?>  
                    <form  class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>home/send_forum" method="post">  

                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" placeholder="Name" required="" name="name">
                            </div>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="email" placeholder="Email" required="" name="email">
                            </div>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="contact" placeholder="Contact" required="" name="phone">
                            </div>
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="3" placeholder="Message" required="" name="nsg"></textarea>
                            </div>
                            <input type="submit" class="btn btn-info btn_submit"  value="SEND">
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<div id="loginpop" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> NOT LOGGED IN?</h4>
                <span>Please login to continue</span>
                <div class="log-signd">
                    <a href="<?php echo base_url(); ?>home/login">LOGIN</a>
                    <a href="<?php echo base_url(); ?>home/register">REGISTER</a>
                </div>
            </div>

        </div>

    </div>
</div>