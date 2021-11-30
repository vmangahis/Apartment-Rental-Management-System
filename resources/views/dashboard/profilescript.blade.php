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
            var old_data = {!! json_encode($landlord, JSON_HEX_TAG) !!};
            console.log(old_data);
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
                    if (res.code == 1) {
                        $.each(res.error, (prefix, value) => {
                            $('#edit-form-landlord').find('div.' + prefix + '-error').text(value[0]);
                        });
                    } else {

                        $('#editlandlord').modal('toggle');
                        $('.landlord-surname-info').html(res.value[0]);
                        $('.landlord-firstname-info').html(res.value[1]);
                        $('.landlord-middlename-info').html(res.value[2]);
                        $('.landlord-age').html(res.value[3]);

                        $('.landlord-address-1').html(res.value[4]);
                        $('.landlord-address-2').html(res.value[5]);
                        $('.landlord-address-city').html(res.value[6]);
                        $('.landlord-address-state').html(res.value[7]);



                    }
                },

                error: (err) => {
                    console.log(err);
                }
            });
        });


});
</script>
