<?php
$user_id = $_SESSION['automation']['userId'];
$getUserSql = "SELECT * FROM `users` WHERE userId = $user_id";
$getUserList = $this->db->query($getUserSql)->result();
if(!empty($getUserList[0]->firstname)) {
	$fullName = $getUserList[0]->firstname.' '.$getUserList[0]->lastname;
} else {
	$fullName = $getUserList[0]->companyname;
}
$userEmail = $getUserList[0]->email;
if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)){
    $banner_img=base_url("uploads/banner/".$get_banner->image);
} else{
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
                        <h3>Payment Success</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block Pricing_Data">
        <div data-velocity="-.2" style="background: url('<?= base_url('assets/images/resource/parallax5.jpg')?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
					<?php
					use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\SMTP;
                    use PHPMailer\PHPMailer\Exception;
					require 'vendor/autoload.php';
					require_once APPPATH."third_party/stripe/init.php";
					\Stripe\Stripe::setApiKey('sk_test_835fqzvcLuirPvH0KqHeQz9K');
					$session = \Stripe\Checkout\Session::retrieve($s_id);
					$invoice_id = $session["invoice"];
                    $stripe = new \Stripe\StripeClient('sk_test_835fqzvcLuirPvH0KqHeQz9K');
                    $sub_data = $stripe->subscriptions->retrieve($session['subscription'],[]);
                    $invoice = $stripe->invoices->retrieve($session['invoice'],[]);
                    $expire_date = date('Y-m-d', $sub_data['current_period_end']);
                    $created_date = date('Y-m-d');
                    $futureDate = $expire_date;
                    $month = (int)abs((strtotime($created_date) - strtotime($futureDate))/(60*60*24*30));
                    $price = $session['amount_total']/100;
                    $subQuery = $this->db->query("SELECT * FROM subscription where subscription_amount = '".$price."'")->result_array();
                    if($session['status'] == 'complete') {
						$dataDB = array(
							'employer_id' =>$_SESSION['automation']['userId'],
							'subscription_id' => $subQuery[0]['id'],
							'name_of_card' => $subQuery[0]['subscription_name'],
							'email' => $session['customer_details']['email'],
							'amount' => $price,
							'transaction_id' => $session['subscription'],
							'payment_status' => $session['payment_status'],
							'payment_date' => date('Y-m-d H:i:s'),
                            'expiry_date' => $expire_date,
                            'invoice_url' => $invoice['hosted_invoice_url'],
                            'invoice_pdf' => $invoice['invoice_pdf'],
                            'duration' => $month,
							'created_date' => date('Y-m-d'),
						);
						$this->db->insert('employer_subscription', $dataDB);
						if($this->db->insert_id()) { ?>
							<div class="heading">
								<h4 class="card-title">Payment Successful.</h4>
								<p class="card-text">We received your payment on your purchase <b>#<?php echo $session['subscription']; ?></b>, check your email for more information.</p>
		                        <a href="<?php echo base_url('profile'); ?>" class="successBTN">Update Profile</a>
		                        <a href="<?php echo $invoice['hosted_invoice_url'];?>" target="_blank" class="successBTN">Generate Invoice</a>
		                    </div>
		                    <?php
		                    	$subject = "Subscription Payment Invoice";
                                $get_setting=$this->Crud_model->get_single('setting');
                                $imagePath = base_url().'uploads/logo/'.$get_setting->flogo;
                                $message = "<table border='0' align='center' cellpadding='0' cellspacing='0' width='100%'> <tbody> <tr> <td align='center'> <table class='col-600' width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='margin-left:20px; margin-right:20px; border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9; border-top:2px solid #232323'> <tbody> <tr> <td height='35'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'> <img src='".$imagePath."' style='width:100%'/> </td> </tr> <tr> <td height='35'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'>Dear ".ucwords($fullName).",</td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: 400;'>Congratulations! Your purchase on <strong style='font-weight:bold;'>Automation Engineering Services</strong> was successful. </td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: 400;'>Please click on the below link to view purchase invoice.</td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='text-align:center;padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: bold;'> <a href=".$invoice['hosted_invoice_url']." target='_blank' style='background:#232323;color:#fff;padding:10px;text-decoration:none;line-height:24px;'>Click Here</a> </td> </tr> <tr> <td height='30'></td> </tr> <tr> <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:16px; color:#232323; line-height:24px; font-weight: 700;'>Thank you!</td> </tr> <tr> <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'>Sincerely</td> </tr> <tr> <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'>Automation Engineering Services</td> </tr> </tbody> </table> </td> </tr> </tbody> </table>";
                                $mail = new PHPMailer(true);
                                try {
                                    //Server settings
                                    $mail->CharSet = 'UTF-8';
                                    $mail->SetFrom('no-reply@goigi.com', 'Automation Engineering Services');
                                    $mail->AddAddress($userEmail);
                                    $mail->IsHTML(true);
                                    $mail->Subject = $subject;
                                    $mail->Body = $message;
                                    //Send email via SMTP
                                    $mail->IsSMTP();
                                    $mail->SMTPAuth   = true;
                                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                    $mail->Host       = "smtp.gmail.com";
                                    $mail->Port       = 587; //587 465
                                    $mail->Username   = "no-reply@goigi.com";
                                    $mail->Password   = "wj8jeml3eu0z";
                                    $mail->send();
                                    // echo 'Message has been sent';
                                } catch (Exception $e) {
                                    //$this->session->set_flashdata('error_message', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
                                    $this->session->set_flashdata('message', "Your message could not be sent. Please, try again later.");
                                }?>
					<?php }	}?>
				</div>
			</div>
		</div>
	</div>
</section>
<style>
.successBTN {border: 2px solid #1B3EA7; border-radius: 35px; font-weight: 600; width: auto; padding: 10px 25px !important; padding: 0 0 30px 0; display: inline-block;}
</style>
