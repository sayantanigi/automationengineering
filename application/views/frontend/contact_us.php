<?php
if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)){
    $banner_img=base_url("uploads/banner/".$get_banner->image);
} else {
    $banner_img=base_url("assets/images/resource/mslider1.jpg");
} ?>

<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= $banner_img ?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>Contact Us</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="max_height">
    <div class="block Contact_Us">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 column">
                    <div class="contact-form">
                        <h3>Keep In Touch</h3>
                        <span class="text-success-msg f-20">
                        <?php if($this->session->flashdata('message')) {
                            echo $this->session->flashdata('message');
                            unset($_SESSION['message']);
                        } ?>
                        </span>
                        <form method="post" action="<?= base_url('Home/save_contact')?>">
                            <div class="row">
                                <div class="col-lg-12">
                                    <span class="pf-title">Full Name</span>
                                    <div class="pf-field">
                                        <input type="text" placeholder="Full Name" name="name" id="name" required onkeypress="only_alphabets(event)" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <span class="pf-title">Email</span>
                                    <div class="pf-field">
                                        <input type="email" placeholder="Email" name="email" id="email" required />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <span class="pf-title">Subject</span>
                                    <div class="pf-field">
                                        <input type="text" placeholder="Subject" name="subject" id="subject" required />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <span class="pf-title">Message</span>
                                    <div class="pf-field">
                                        <textarea name="message" id="message" placeholder="Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 Send_Btn">
                                    <button type="submit" class="btn btn-info">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 column">
                    <div class="block remove-bottom">
                        <div class="Map_back"></div>
                        <?php $gmap = str_replace(",", "", str_replace(" ", "+", $get_data->address))?>
                        <iframe src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=<?php echo $gmap?>&z=14&output=embed" width="100%" height="420" style="border: 0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 column">
                    <div class="contact-textinfo style2">
                        <!-- <h3>JobHunt Office</h3> -->
                        <ul>
                            <li>
                                <i class="la la-map-marker"></i>
                                <span>
                                    <label>Location:</label>
                                    <?php if(!empty($get_data->address)){ echo $get_data->address;} ?>
                                </span>
                            </li>
                            <li>
                                <i class="la la-phone"></i>
                                <span>
                                    <label>Call Us:</label>
                                    <?php if(!empty($get_data->phone)){ echo $get_data->phone;}?>
                                </span>
                            </li>
                            <!-- <li>
                                <i class="la la-fax"></i>
                                <span>
                                    <label>Fax:</label>
                                    1-985-518-1388
                                </span>
                            </li> -->
                            <li>
                                <i class="la la-envelope-o"></i>
                                <span>
                                    <label>Email:</label>
                                    <?php if(!empty($get_data->email)){ echo $get_data->email;}?>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>

</section>
