<script type = "text/javascript">
    $('.clickable-row').on('click', (e) => {
        var tenant_data = {!! json_encode($tenant->toArray(), JSON_HEX_TAG) !!}
        console.log(e.target.id);
        
        tenant_data.forEach(dat => {
            if(e.target.id == dat.id)
            {
                console.log('extracting data');
                $('.ten-id').html(dat.id);
                $('.ten-name').html(dat.firstname);
                $('.ten-surname').html(dat.surname);
                $('.ten-email').html(dat.email);
                $('.ten-age').html(dat.age);
                $('.ten-num').html(dat.mobile);
                $('.ten-date').html(dat.rent_date);
                $('.ten-status').html(dat.rental_status);
                $('.ten-due').html(dat.balance_due);
            }
        })
    })



    // Adding Tenant
    $('#tenantRegistration').on('submit',(e) => {
        e.preventDefault();

        /*  $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
        });*/
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url: "{{url('/tenants')}}",
            method: 'post',
            data: $('#tenantRegistration').serializeArray(),
            success: (res) => {
                if (res.errors) {
                    console.log('error');
                } else {
                    console.log('not error');
                    window.location = "/tenants";
                }

            },
            error: (data) => {
                console.log(data);
            }
        })
    }); 
    
    
    // POST



 

// DELETE
    $('.deleteEntry').on('click', (e) => {
        var data = {!! json_encode($tenant->toArray(), JSON_HEX_TAG) !!}
        data.forEach((tenants) => {

            if (e.target.id == tenants.id) {

                $('.name-placeholder').html(tenants.surname + ',' + tenants.firstname + ' from your records?');
                $('.confirmDelete').attr("id", tenants.id);

            }
        })

    });


    $('.confirmDelete').on('click', (e) => {

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
                    console.log('not error');
                    window.location = "/tenants";


                }
            },
            error: (data) => {
                console.log(data);
            }
        })

    })


// PUT Tenant
$('.editEntry').on('click', (e) =>{

    var data = {!! json_encode($tenant->toArray(), JSON_HEX_TAG) !!}

    data.forEach(dat => {
        if(e.target.id == dat.id){
            console.log('no error in PUT TENANT');
            $('#tenantSurname').val(dat.surname);
            $('#tenantfirstname').val(dat.firstname);
            $('#email').val(dat.email);
            $('#agecounter').val(parseInt(dat.age));
            $('#mobile').val(dat.mobile);
            $('#rent-date').val(dat.rent_date);
            $('.editform').attr('id',dat.id);
            $('#rent_status').val(dat.rental_status);
        }
    })


})

$('.confirmEdit').on('click', (ev) => {
    ev.preventDefault();
    var id = $('.editform').attr('id');
    var surname = $('#tenantSurname').val();
    var firstname = $('#tenantfirstname').val();
    var email = $('#email').val();
    var age = $('#agecounter').val();
    var mobile = $('#mobile').val();
    var rent_date = $('#rent-date').val();
    var rent_stat = $('#rent_status').find(":selected").text();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $.ajax({
        url:  "{{url('/tenants')}}",
        method: "PUT",
        data:{"id" : id, "surname": surname, "firstname" : firstname,
            "email": email, "age": age, "mobileNum" : mobile,
            "rent_date": rent_date, "rental_status": rent_stat},
        success: (resp) => {
            if (resp.errors)
            {
                console.log('Error in confirmEdit');
            }

            else{
                window.location = "/tenants";
            }
        },
        errors: (data) =>{
            console.log(data);
        }
    })






})

</script>
