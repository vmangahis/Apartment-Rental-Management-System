<script type = "text/javascript">

$(document).ready( () => {


// Disable input in tenants at first open of Tenants Tab
    $('.search-input').prop('disabled', true);


//No spaces in search
    $('.search-input').on('keypress', e =>{
       if(e.which == 32)
       {
           return false;
       }
    })







//Dropdown list change
    $('#search-option').change((e) => {
        $('.search-input').val('');
        let que = null;
        if($('#search-option').val() === 'none')
        {
                $('.search-input').prop('disabled', true);

        }
        else{
            $('.search-input').prop('disabled', false);
        }
    });



//Text input change in Tenant Search
$(document).on('change input','.search-input',e => {
    $(this).unbind('blur');

    var params = "";


    if(window.location.pathname === "/tenants")
    {
        params = "ACTIVE"
    }
    else{
        params = "ARCHIVED";
    }

    console.log(params);

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    $.ajax({
            method: 'get',
            data: {"query" : $('.search-input').val(), "column": $('#search-option').val(), "path" : params},
            url: "{{url('/searchtenant')}}",

            success: (data) => {
                $('#table-body').html(data);

            },
            error: (data) => {
                console.log(data);
            }
        })


})


    $(document).on('click','.clickable-row', (e) => {
        var tenant_data = {!! json_encode($tenant->toArray(), JSON_HEX_TAG) !!}
        console.log(e.currentTarget.id);

        tenant_data.forEach(dat => {
            if(e.target.id == dat.id)
            {
                $('.ten-id').html(dat.id);
                $('.ten-name').html(dat.firstname);
                $('.ten-surname').html(dat.surname);
                $('.ten-email').html(dat.email);
                $('.ten-age').html(dat.age);
                $('.ten-num').html(dat.mobile);
                $('.ten-date').html(dat.rent_date);
                $('.ten-status').html(dat.rental_status);
                $('.ten-due').html(dat.balance_due);
                $('.tenant-photo').attr('src', '{{asset("storage/tenantimages")}}'+'/'+dat.image_name);
                $('.ten-room').html(dat.room_id);
                $('.monthly-due').html(dat.monthly);
            }
        })
    })



// Adding Tenant // POST Request
$(document).on('submit','#tenantRegistration',(e) => {
        e.preventDefault();


        console.log(new FormData(document.getElementById("tenantRegistration")));

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{url('/tenants')}}",
            method: 'post',
            data: new FormData(document.getElementById("tenantRegistration")),
            processData: false,
            contentType: false,
            beforeSend: () => {
                $('#tenantRegistration').find('div.error').text('');
            },
            success: (res) => {
                if (res.code == 0) {
                    $.each(res.error, (pre, val) => {
                        $('#tenantRegistration').find('div.'+pre+'-error').text(val[0]);
                    })

                }
                else {

                    $('#tenantRegistration')[0].reset();
                    window.location = window.location.pathname;
                }

            },
            error: (data) => {
               console.log(data);
            }
        })
    });


// Allow landlord to enter any room number if rental status is archived
$(document).on('change','#rental_status', e =>{
    e.preventDefault();
    var rooms = {!! json_encode($allroom->toArray(), JSON_HEX_TAG) !!};
    var vacantrooms = {!! json_encode($rooms->toArray(),JSON_HEX_TAG) !!};
    var html_tag = "";

    // If archived show all rooms
    if($('#rental_status').val() == "ARCHIVED"){
        rooms.forEach((item) => {
            console.log(item);
        })
    }
})

$(document).on('change','#rental_status_edit', e =>{
    e.preventDefault();
    var rooms = {!! json_encode($allroom->toArray(), JSON_HEX_TAG) !!}
    console.log(rooms.length);
})



// DELETE
$(document).on('click','.deleteEntry', (e) => {
        var data = {!! json_encode($tenant->    toArray(), JSON_HEX_TAG) !!}
        data.forEach((tenants) => {

            if (e.target.id == tenants.id) {

                $('.name-placeholder').html(tenants.surname + ',' + tenants.firstname + ' from your records?');
                $('.confirmDelete').attr("id", tenants.id);

            }
        })

    });


    $('.confirmDelete').on('click',(e) => {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $.ajax({
            url: "{{url('/tenants')}}",
            method: 'delete',
            data: {"id": e.target.id},
            success: (res) => {
                if (res.errors) {
                    console.log('error');
                } else {

                    window.location = window.location.pathname;


                }
            },
            error: (data) => {
                console.log(data);
            }
        })

    })


// PUT REQUEST
$(document).on('click','.editEntry' ,(e) =>{

    var data = {!! json_encode($tenant->toArray(), JSON_HEX_TAG) !!}
    console.log(e.currentTarget.id);
    data.forEach(dat => {
        if(e.target.id == dat.id){

            $('#tenantSurnameEdit').val(dat.surname);
            $('#tenantFirstnameEdit').val(dat.firstname);
            $('#tenantEmailEdit').val(dat.email);
            $('#tenantAgeEdit').val(parseInt(dat.age));
            $('#mobile').val(dat.mobile);
            $('#rent-date').val(dat.rent_date);
            $('.editform').attr('id',dat.id);
            $('#rental_status_edit').val(dat.rental_status);
            $('#tenantMiddlenameEdit').val(dat.middle_name);
            $('#monthly-edit').val(dat.monthly);

        }
    })
});




// Confirm Edit
$('.confirmEdit').on('click', (ev) => {
    ev.preventDefault();
    var id = $('.editform').attr('id');
    var surname = $('#tenantSurnameEdit').val();
    var firstname = $('#tenantFirstnameEdit').val();
    var email = $('#tenantEmailEdit').val();
    var age = $('#tenantAgeEdit').val();
    var mobile = $('#mobile').val();
    var rent_date = $('#rent-date').val();
    var rent_stat = $('#rental_status_edit option:selected').text();
    var middle = $('#tenantMiddlenameEdit').val();
    var monthly = $('#monthly-edit').val();




    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $.ajax({
        url:  "{{url('/edittenants')}}",
        method: "POST",
        data:{"id" : id, "surname": surname, "firstname" : firstname,
            "email": email, "age": age, "mobileNum" : mobile,
            "rent_date": rent_date, "rental_status": rent_stat, "middle_n" : middle, "monthly" : monthly},
        success: (resp) => {
            if (resp.errors)
            {
                console.log('Error in confirmEdit');
            }

            else{
                window.location = window.location.pathname;
            }
        },
        errors: (data) =>{
            console.log(data);
        }
    })
    })
})
</script>
