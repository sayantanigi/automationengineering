<section class="overlape">

            <div class="block no-padding">

               <div data-velocity="-.1" style="background: url('<?= base_url('assets/images/resource/mslider1.jpg')?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>

               <!-- PARALLAX BACKGROUND IMAGE -->

               <div class="container fluid">

                  <div class="row">

                     <div class="col-lg-12">

                        <div class="inner-header" style="padding-top: 90px;">

                        </div>

                     </div>

                  </div>

               </div>

            </div>

         </section>

<section class="dashboardhak">

          <div class="container-fluid">

             <div class="row align-items-center">

                <div class="col-md-12 col-12">

                   <h2 class="breadcrumb-title">Calender</h2>

                   <!-- <nav aria-label="breadcrumb" class="page-breadcrumb">

                      <ol class="breadcrumb">

                         <li class="breadcrumb-item"><a href="#">Home</a></li>

                         <li class="breadcrumb-item active" aria-current="page">Dashboard</li>

                      </ol>

                   </nav> -->

                </div>

             </div>

          </div>

       </section>



<section class="dashboard-gig User_Sidemenu">

            <div class="container-fluid display-table">

               <div class="row display-table-row">

               <?php $this->load->view('sidebar');?>

                  <div class="col-md-12 col-md-12 col-sm-12 display-table-cell v-align">

                     <div class="user-dashboard">

                        <div class="row row-sm">

                           <div class="col-xl-12 col-lg-12 col-md-12">

                              <div class="cardak">

                                 <div class="row">

                                    <div class="col-lg-12 col-md-12">

                                       <div id="calendar"></div>

                                    </div>

                                 </div>

                              </div>

                           </div>

                        </div>

                     </div>

                  </div>

               </div>

            </div>



         </section>



         <!-- calendar modal -->

       <div id="modal-view-event" class="modal modal-top fade calendar-modal">

               <div class="modal-dialog modal-dialog-centered">

                   <div class="modal-content">

                       <div class="modal-body">

                           <h4 class="modal-title"><span class="event-icon"></span><span class="event-title"></span></h4>

                           <div class="event-body"></div>

                       </div>

                       <div class="modal-footer">

                           <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                       </div>

                   </div>

               </div>

           </div>



           <div id="modal-view-event-add" class="modal modal-top fade calendar-modal">

              <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">

                  <form id="add-event" method="post" action="<?php echo base_url('user/Dashboard/save_event')?>">

                    <div class="modal-body">

                    <h4>Add Appointment Detail</h4>

                      <div class="form-group">

                        <label>Appointment name</label>

                        <input type="text" class="form-control" name="event_name" id="ename" placeholder="Enter Appointment Name" value="" required>

                      </div>

                      <div class="form-group">

                        <label>Appointment Date</label>

                        <input type='text' class="form-control" name="event_date" id="edate" value="" readonly>

                      </div>

                       <div class="form-group">

                        <label>Start Time</label>

                  <input type="text" name="start_time" id="start_time" class="form-control" value="">

                      </div>

                      <div class="form-group">

                        <label>End Time</label>

                      <input type="text" name="end_time" id="end_time" class="form-control" value="">

                      </div>

                      <div class="form-group">

                        <label>Appointment Description</label>

                        <textarea class="form-control" name="description" id="edesc"></textarea>

                      </div>

                      <div class="form-group">

                        <label>Appointment Color</label>

                        <select class="form-control" name="event_color" id="ecolor" style="height:40px;">

                          <option value="fc-bg-default" selected>fc-bg-default</option>

                          <option value="fc-bg-blue">fc-bg-blue</option>

                          <option value="fc-bg-lightgreen">fc-bg-lightgreen</option>

                          <option value="fc-bg-pinkred">fc-bg-pinkred</option>

                          <option value="fc-bg-deepskyblue">fc-bg-deepskyblue</option>

                        </select>

                      </div>

                      <div class="form-group">

                        <label>Appointment Icon</label>

                        <select class="form-control" name="event_icon" id="eicon" style="height:40px;">

                          <option value="circle">circle</option>

                          <option value="cog">cog</option>

                          <option value="group">group</option>

                          <option value="suitcase">suitcase</option>

                          <option value="calendar">calendar</option>

                        </select>

                      </div>

                  </div>

                    <div class="modal-footer">

                    <button type="submit" class="btn btn-primary" >Save</button>

                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                  </div>

                  </form>

                </div>

              </div>

            </div>





            <!--footer-->





<?php

$get_setting=$this->Crud_model->get_single('setting');

if(!empty($_SESSION['gigwork']['userId']))

{

  $userid=$_SESSION['gigwork']['userId'];

  $get_video=$this->Crud_model->GetData('friends_video','',"subscription_id='".$userid."' and status='0'",'','(video_id)desc','','1');



}

?>

<footer>

                <div class="blocknwe">

                    <div class="container">

                        <div class="row">

                            <div class="col-lg-3 column">

                                <div class="widget">

                                    <div class="about_widget">

                                        <div class="logo">

                                            <a href="javascript:void(0)" title=""><img src="<?=base_url(); ?>assets/images/gig-work01-w.png" alt="" /></a>

                                        </div>

                                        <span>

                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.

                                        </span>

                                    </div>

                                    <!-- About Widget -->

                                </div>

                            </div>

                            <div class="col-lg-3 column">

                                <div class="widget">

                                    <h3 class="footer-title">Quick Links</h3>

                                    <div class="link_widgets">

                                        <div class="row">

                                            <div class="col-lg-6">

                                                <!--<a href="javascript:void(0)" title="">Our Services</a>-->

                                                <a href="<?= base_url('employer-list')?>" title="Employer">Vendors</a>

                                               <!--  <a href="javascript:void(0)" title="Employees">Employees</a> -->

                                                <a href="<?= base_url('workers-list')?>" title="workers">Experts</a>

                                                <a href="<?= base_url('pricing')?>" title="">Pricing</a>

                                            </div>

                                            <!-- <div class="col-lg-6">

                                                <a href="javascript:void(0)" title="">Residential</a>

                                                <a href="javascript:void(0)" title="">Commercial</a>

                                                <a href="javascript:void(0)" title="">Virtual</a>

                                                <a href="javascript:void(0)" title="">Services</a>

                                                <a href="<?= base_url('pricing')?>" title="">Pricing</a>

                                            </div> -->

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-lg-3 column">

                                <div class="widget">

                                    <h3 class="footer-title">Support Link</h3>

                                    <div class="link_widgets">

                                        <div class="row">

                                            <div class="col-lg-12">

                                                <a href="<?= base_url('about-us')?>" title="About us">About Us</a>

                                                <a href="<?= base_url('contact-us')?>" title="Contact us">Contact Us</a>

                                                <a href="<?= base_url('privacy-policy')?>" title="privacy policy">Privacy Policy</a>

                                                <a href="<?= base_url('term-and-conditions')?>" title="Term & condition">Terms & Conditions </a>

                                               <!--  <a href="javascript:void(0)" title="">Our Safty</a> -->

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-lg-3 column">

                                <div class="about_widget">

                                    <h3 class="footer-title">Contact Us</h3>

                                    <span><?= $get_setting->address?></span>

                                    <span><?= $get_setting->phone ?></span>

                                    <span><?= $get_setting->email ?></span>

                                    <div class="social">

                                        <a href="javascript:void(0)" title=""><i class="fa fa-facebook"></i></a>

                                        <a href="javascript:void(0)" title=""><i class="fa fa-twitter"></i></a>

                                        <a href="javascript:void(0)" title=""><i class="fa fa-linkedin"></i></a>

                                        <a href="javascript:void(0)" title=""><i class="fa fa-pinterest"></i></a>

                                        <a href="javascript:void(0)" title=""><i class="fa fa-behance"></i></a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="bottom-line">

                    <span>Copyright © 2021 GIGWORK.PRO. All rights reserved.</span>

                    <a href="#scrollup" class="scrollup" title=""><i class="la la-arrow-up"></i></a>

                </div>

            </footer>

        </div>



        <input type="hidden" name="base_url" id="base_url" value="<?= base_url()?>">



        <!--  start modal -->

     <?php if(!empty($_SESSION['gigwork']['userId'])){

      $date=date('Y-m-d',strtotime(@$get_video->created_date));

      if(@$_SESSION['gigwork']['userId']==@$get_video->subscription_id && $date==date('Y-m-d') && @$get_video->status=='0'){

      ?>

      <div id="video_modal" class="modal modal-top fade calendar-modal">

            <div class="modal-dialog modal-dialog-centered">

              <div class="modal-content">



                  <div class="modal-body" >

                  <h4>Receive video calling </h4>



                </div>

                  <div class="modal-footer">

                  <button type="button" class="btn btn-primary"  onclick="receiveVideoCallWindow(<?= @$get_video->publisher_id?>);" >video call</button>

                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                </div>



              </div>

            </div>

          </div>

        <?php } }?>

    <!--  end modal -->



           <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script> -->



          <script src="<?= base_url('assets/js/jquery_min.js')?>" type="text/javascript"></script>

       <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js" type="text/javascript"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js" type="text/javascript"></script>  -->

        <script src="<?= base_url('assets/js/moment.js')?>" type="text/javascript"></script>

        <script src="<?= base_url('assets/js/full_calender.js')?>" type="text/javascript"></script>

         <!--<script src="<?= base_url('assets/js/jquery.min.js')?>" type="text/javascript"></script> -->

       <script src="<?= base_url('assets/js/modernizr.js')?>" type="text/javascript"></script>

        <script src="<?= base_url('assets/js/script.js')?>" type="text/javascript"></script>

        <script src="<?= base_url('assets/js/bootstrap.min.js')?>" type="text/javascript"></script>

        <script src="<?= base_url('assets/js/wow.min.js')?>" type="text/javascript"></script>

        <script src="<?= base_url('assets/js/slick.min.js')?>" type="text/javascript"></script>

        <script src="<?= base_url('assets/js/parallax.js')?>" type="text/javascript"></script>

        <script src="<?= base_url('assets/js/select-chosen.js')?>" type="text/javascript"></script>

        <script src="<?= base_url('assets/js/jquery.scrollbar.min.js')?>" type="text/javascript"></script>

        <script src="<?= base_url('assets/js/maps2.js')?>" type="text/javascript"></script>

        <script src="<?= base_url('assets/js/bootstrap-datepicker.js')?>" type="text/javascript"></script>







         <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtg6oeRPEkRL9_CE-us3QdvXjupbgG14A&libraries=places&callback=initMap"

  async defer></script>

      <script type="text/javascript" src="<?= base_url('assets/custom_js/validation.js')?>"></script>





  <script src="<?= base_url();?>dist/assets/notify/notify.min.js"></script>

  <script type="text/javascript">



          $(document).ready(function(){

        var sessionMessage = '<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>';

        if(sessionMessage==null || sessionMessage=="" ){ return false;}

        $.notify(sessionMessage,{ position:"top right",className: 'success' });//session msg

          });





      </script>

      <script type="text/javascript">

     setInterval(function () {

  $('#video_modal').modal('show');

}, 5000);



      function receiveVideoCallWindow(fid)

      {

          $('#video_modal').css('display','none');

       var callPath = "<?php echo base_url('livevideo/video/');?>"+fid;

     window.open(callPath, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=250,left=20,width=600,height=450");

      }

   </script>

     </body>

  </html>







            <!--end footer-->







            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>



            <!-- timepicker -->



 <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" />-->





<!--        https://cdnjs.com/libraries/moment.js/-->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>



<!--        https://cdnjs.com/libraries/bootstrap-datetimepicker-->

        <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>



<!-- end timepicker -->

<script type="text/javascript">

   $('#edate').datepicker({

         autoclose: true,

        todayHighlight: true,

        startDate: new Date()

    });

</script>

  <script type="text/javascript">

       $("#start_time").datetimepicker({

                    format : "HH:mm"

                });

  </script>

   <script type="text/javascript">

       $("#end_time").datetimepicker({

                    format : "HH:mm"

                });

  </script>



     <script>

           $(document).ready(function(){

              $('[data-toggle="offcanvas"]').click(function(){

                  $("#navigation").toggleClass("hidden-xs");

              });

           });

        </script>

   <script type="text/javascript">

            jQuery(document).ready(function(){

    // jQuery('.datetimepicker').datepicker({

    //     timepicker: true,

    //     language: 'en',

    //     range: true,

    //     multipleDates: true,

    //         multipleDatesSeparator: " - "

    //   });

    jQuery("#add-event").submit(function(){

      //  alert("Submitted");

        var values = {};

        $.each($('#add-event').serializeArray(), function(i, field) {

            values[field.name] = field.value;

        });

        console.log(

          values

        );

    });

  });



  (function () {

      'use strict';

      // ------------------------------------------------------- //

      // Calendar

      // ------------------------------------------------------ //

      jQuery(function() {

          // page is ready

          jQuery('#calendar').fullCalendar({

              themeSystem: 'bootstrap4',

              // emphasizes business hours

              businessHours: false,

              defaultView: 'month',

              // event dragging & resizing

              editable: true,

              // header

              header: {

                  left: 'title',

                  center: 'month',

                  //center: 'month,agendaWeek,agendaDay',

                  right: 'today prev,next'

              },

              events:'<?= base_url('user/dashboard/get_events') ?>',

              eventRender: function(event, element) {



                  if(event.icon){

                      element.find(".fc-title").prepend("<i class='fa fa-"+event.icon+"'></i>");



                  }

                },

              dayClick: function(date,jsEvent, view) {

                  //alert(date.format()); return false;

                //  var datetime=date.format();

                //  var fetchdatetime=datetime.slice(0, 10)+' '+datetime.slice(11);



                 // var time= moment(date.start).format('h:mm:ss a');

                   var fetchDate = $(this).data("date");

                 //  var fetchdatetime = fetchDate+' '+time;

                  jQuery('#modal-view-event-add').modal();

                  $('#edate').val(fetchDate);

              },

              eventClick: function(event, jsEvent, view) {



                      jQuery('.event-icon').html("<i class='fa fa-"+event.icon+"'></i>");

                      jQuery('.event-title').html(event.title);

                      jQuery('.event-body').html(event.description);

                      jQuery('.eventUrl').attr('href',event.url);

                      jQuery('#modal-view-event').modal();

              },

          })



      });



  })(jQuery);

        </script>
