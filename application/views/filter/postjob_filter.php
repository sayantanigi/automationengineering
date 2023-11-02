                        <?php if(!empty($get_postjob)){
                                    foreach($get_postjob as $row)
                                    {
                                      ?>
                                        <div class="emply-resume-list">
                                            <?php
                                        if(!empty($row->profilePic)){
                                            if(!file_exists('uploads/users/'.$row->profilePic)){ ?>
                                            <div class="emply-resume-thumb">
                                                <img src="<?php echo base_url('uploads/users/user.png')?>" alt="" />
                                            </div>
                                        <?php } else{?>
                                            <div class="emply-resume-thumb">
                                                <img src="<?php echo base_url('uploads/users/'.$row->profilePic); ?>" alt="" />
                                            </div>
                                        <?php }} else{?>
                                                <div class="emply-resume-thumb">
                                                <img src="<?php echo base_url('uploads/users/user.png')?>" alt="" />
                                            </div>
                                        <?php }?>
                                            <div class="emply-resume-info">
                                                <h3><a href="#" title=""><?php echo $row->post_title ?></a></h3>
                                                <span><?= $row->category_name?></span>
                                                <span><?= $row->sub_category_name?> </span>
                                                <p><i class="la la-map-marker"></i><?= $row->complete_address; ?></p>
                                            </div>
                                            <div class="shortlists" style="width:50px;">
                                                <a href="#" title="">View Details <i class="la la-plus"></i></a>
                                            </div>
                                        </div>
                                        <!-- Emply List -->
                                      <?php } } else{?>
                                         <div class="emply-resume-list">
                                            <div class="emply-resume-thumb">
                                              <h2>No Data Found</h2>
                                            </div>
                                         </div>
                                      <?php } ?>
