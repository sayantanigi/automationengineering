<input type="hidden" name="base_url" id="base_url" value="<?= base_url() ?>">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/js/modernizr.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/script.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js" type="text/javascript"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/datepicker.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/i18n/datepicker.en.js" type="text/javascript"></script> -->
<script src="<?= base_url('assets/js/wow.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/slick.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/parallax.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/select-chosen.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/jquery.scrollbar.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/maps2.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/bootstrap-datepicker.js') ?>" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('[data-toggle="offcanvas"]').click(function() {
            $("#navigation").toggleClass("hidden-xs");
        });
    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        // jQuery('.datetimepicker').datepicker({
        //     timepicker: true,
        //     language: 'en',
        //     range: true,
        //     multipleDates: true,
        //         multipleDatesSeparator: " - "
        //   });
        jQuery("#add-event").submit(function() {
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

    (function() {
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
                events: '<?= base_url('user/dashboard/get_events') ?>',
                eventRender: function(event, element) {

                    if (event.icon) {
                        element.find(".fc-title").prepend("<i class='fa fa-" + event.icon + "'></i>");

                    }
                },
                dayClick: function(date, jsEvent, view) {
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

                    jQuery('.event-icon').html("<i class='fa fa-" + event.icon + "'></i>");
                    jQuery('.event-title').html(event.title);
                    jQuery('.event-body').html(event.description);
                    jQuery('.eventUrl').attr('href', event.url);
                    jQuery('#modal-view-event').modal();
                },
            })

        });

    })(jQuery);
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtg6oeRPEkRL9_CE-us3QdvXjupbgG14A&libraries=places&callback=initMap" async defer></script>
<script type="text/javascript" src="<?= base_url('assets/custom_js/validation.js') ?>"></script>


<script src="<?= base_url(); ?>dist/assets/notify/notify.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var sessionMessage = '<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>';
        if (sessionMessage == null || sessionMessage == "") {
            return false;
        }
        $.notify(sessionMessage, {
            position: "top right",
            className: 'success'
        }); //session msg
    });
</script>
</body>

</html>