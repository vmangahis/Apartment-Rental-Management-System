<script type="text/javascript">
    $(document).ready(() => {

        $(document).on('click', '.edit-landlord', e => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "GET",
                url: "{{url('/profile')}}",
                processData: false,
                contentType: false,
                success: (res) =>{

                    $('#landlord-surname').val(res.response[0].surname);
                    $('#landlord-firstname').val(res.response[0].firstname);
                    $('#landlord-middlename').val(res.response[0].middlename);
                    $('#landlord-age').val(res.response[0].age);
                    $('#landlordAddress-1').val(res.response[0].address_1);
                    $('#landlordAddress-2').val(res.response[0].address_2);
                    $('#landlordCity').val(res.response[0].city);
                    $('#landlordState').val(res.response[0].state);
                }
            })
        });

        $(document).on('click', '.submit-edit-profile', e => {


            var formdata = new FormData(document.getElementById('edit-form-landlord'));
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{url('/profile/update')}}',
                method: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                beforeSend: e => {
                    $('#edit-form-landlord').find('div.error').text('');
                },

                success: (res) => {

                    // missing field
                    if (res.code == 1) {
                        $.each(res.error, (prefix, value) => {
                            $('#edit-form-landlord').find('div.' + prefix + '-error').text(value[0]);
                        });
                    }

                    else {
                        console.log(res.value[8]);
                        $('#editlandlord').modal('toggle');
                        $('.landlord-surname-info').html(res.value[0]);
                        $('.landlord-firstname-info').html(res.value[1]);
                        $('.landlord-middlename-info').html(res.value[2]);
                        $('.landlord-age').html(res.value[3]);

                        $('.landlord-address-1').html(res.value[4]);
                        $('.landlord-address-2').html(res.value[5]);
                        $('.landlord-address-city').html(res.value[6]);
                        $('.landlord-address-state').html(res.value[7]);
                        $('.landlord-photo').attr('src', res.value[8]);


                    }
                },

                error: (err) => {
                    console.log(err);
                }
            });
        });

        $('.submit-password-change').on('click', e =>{
            e.preventDefault();
            var form = new FormData(document.getElementById('edit-password'))

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "{{url('/profile/password')}}",
                data: form,
                contentType: false,
                processData: false,
                beforeSend: () =>{
                    //Clear text after entering
                    $('#edit-password').find('div.error').text('');
                },
                success: res =>{
                    if(res.code == 5)
                    {
                        console.log(res);
                        $.each(res.error, (prefix, value) =>{
                           $('#edit-password').find('div.'+prefix+'-error').text(value[0]);
                        });
                    }

                    else if(res.code == 0)
                    {

                        $('#edit-password')[0].reset();
                        alert('Password changed');
                    }

                    else if(res.code == 6 || res.code == 7 || res.code == 8)
                    {

                        $.each(res.error, (ind, val) =>{
                            console.log(1);
                            $('#edit-password').find('div.'+ind+'-error').text(val);
                        })
                    }

                    else{
                        console.log(res);
                    }

                }
            })
        })


        $('.submit-username-change').on('click' , e => {
            e.preventDefault();
            var data = new FormData(document.getElementById('edit-username'));

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "{{url('profile/username')}}",
                data : data,
                processData: false,
                contentType: false,
                beforeSend : () =>{
                    // Clear red font errors before making request
                    $('#edit-username').find('div.error').text('');
                },
                success: (response) => {
                    if(response.code == 1)
                    {
                        console.log('code 1');
                        console.log(response.response);
                    }

                    else if (response.code == 5  || response.code == 8 || response.code == 6 || response.code == 10)
                    {
                        console.log('code ' + response.code);
                        $.each(response.error, (pre, val) => {
                            console.log(pre);
                            $('#edit-username').find('div.' + pre + '-error').text(val);
                        })
                    }

                    else{
                        console.log('Username successfully changed');
                        console.log(response);
                        $('#edit-username')[0].reset();
                        alert('Username changed');

                    }




                },
            })


        })

});
</script>
