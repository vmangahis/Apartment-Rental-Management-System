<script type = "text/javascript">
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

    }); // POST


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
            $('#rent-date').val(dat.rent_date)
        }
    })


})

$('.confirmEdit').on('click', (ev) => {
    alert('edit?');
})

</script>
