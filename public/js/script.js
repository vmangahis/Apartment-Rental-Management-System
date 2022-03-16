const { toArray } = require("lodash");

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
            console.log('change');
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
            let tenant_data =    <?php echo json_encode($tenant->toArray(), JSON_HEX_TAG); ?>;
            let room_data = {!! json_encode($allroom->toArray(), JSON_HEX_TAG) !!};
            console.log(room_data);
            console.log(tenant_data);
            tenant_data.forEach(dat => {
                if(e.target.id == dat.id)
                {
                    console.log('foreach');
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
                    room_data.forEach(rm =>{
                        if(rm.room_id == dat.room_id)
                        {
                            $('.ten-room').html(rm.room_number);
                        }
                    });
    
    
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
    
    
    // Clicking edit button
    $(document).on('click','.editEntry' ,(e) =>{
    
        let data = {!! json_encode($alltenant->toArray(), JSON_HEX_TAG) !!}
        let room ={!! json_encode($allroom->toArray(), JSON_HEX_TAG) !!}
            console.log(e.target.id);
        data.forEach(dat => {
            if(e.target.id == dat.id){
    
                $('#tenantSurnameEdit').val(dat.surname);
                $('#tenantFirstnameEdit').val(dat.firstname);
                $('#tenantEmailEdit').val(dat.email);
                $('#tenantAgeEdit').val(parseInt(dat.age));
                $('#mobile').val(dat.mobile);
                $('#rent-date').val(dat.rent_date);
                $('.confirmEdit').attr('id', e.target.id);
                $('#tenantMobile').val(dat.mobile);
                $('#rental_status_edit').val(dat.rental_status);
                $('#tenantMiddlenameEdit').val(dat.middle_name);
                $('#monthly-edit').val(dat.monthly);
    
                    room.forEach(rm =>{
                        console.log(rm);
                        if(dat.rental_status == "ACTIVE") {
                            console.log('editing active tenant');
                            if (dat.id == rm.tenant_id) {
    
                                $('.room-num').html(rm.room_number);
                                $('#room_number').append(`<option value = ${rm.room_number}>${rm.room_number}</option>`);
                                $('#room_number').val(rm.room_number);
                            }
                        }
    
                        else if(dat.rental_status == "ARCHIVED")
                        {
                            if(rm.room_number ==  dat.room_id)
                            {
                                $('.room-num').html(rm.room_number);
                                $('#room_number').val(rm.room_number);
                            }
                        }
    
                    });
    
    
    
    
    
    
            }
        })
    
    });
    
    
    
    
    // Confirm Edit
    $('.confirmEdit').on('click', (ev) => {
        ev.preventDefault();
        let form = new FormData(document.getElementById('tenantEditForm'));
        let id = $('.confirmEdit').attr('id');
        form.append('currentRoom', $('.room-num').text());
    
        console.log(form.get('currentRoom'));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
    
        $.ajax({
            url:  "/edittenants/"+id,
            method: "POST",
            contentType: false,
            processData: false,
            data: form,
            beforeSend: () => {
                $('#tenantEditForm').find('div.error').text('');
            },
            success: (resp) => {
    
                if(resp.code == 1)
                {
                    $.each(resp.error, (index, val) => {
                        $('#tenantEditForm').find('div.'+index+'-error').text(val);
                    })
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