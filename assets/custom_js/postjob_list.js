function getsubcategory(val) {
    var base_url = $("#base_url").val();
    var id = val;
    $.ajax({
        type:"post",
        cache:false,
        url:base_url+"Welcome/subcategory_data",
        data:{
            id:id
        },
        beforeSend:function(){},
        success:function(returndata) {
            // console.log(returndata); return false;
            $('.sub_cat').show();
            //$('#subcategory_list').html(returndata);
            $('#subcategory_id').html(returndata);
        }
    });
}

function getState(val) {
    var base_url = $("#base_url").val();
    var id = val;
    $.ajax({
        type:"post",
        cache:false,
        url:base_url+"Welcome/states_by_country",
        data:{
            country_name:id
        },
        beforeSend:function(){},
        success:function(returndata) {
            //console.log(returndata); return false;
            $('.state_field').show();
            $('#state').html(returndata);
            //$('#state_id_chosen .chosen-results').html(returndata);
            $('#city').html('<option value="">Select State First</option>');
        }
    });
}

function getCity(val) {
    var base_url = $("#base_url").val();
    var id = val;
    $.ajax({
        type:"post",
        cache:false,
        url:base_url+"Welcome/cities_by_state",
        data:{
            state_name:id
        },
        beforeSend:function(){},
        success:function(returndata) {
            //console.log(returndata); return false;
            $('.city_field').show();
            $('#city').html(returndata);
            //$('#city_id_chosen .chosen-results').html(returndata);
        }
    });
}
