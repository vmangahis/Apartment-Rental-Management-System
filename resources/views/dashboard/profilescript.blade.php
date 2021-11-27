<script type = "text/javascript">
$(document).ready(() => {



    $(document).on('click', '.edit-landlord', e =>{
        var arr = {!! json_encode($landlord, JSON_HEX_TAG) !!}
        $('#landlord-surname').val(arr[0].surname);
        $('#landlord-firstname').val(arr[0].firstname);
        $('#landlord-middlename').val(arr[0].middlename);
        $('#landlord-age').val(arr[0].age);
        $('#landlordAddress-1').val(arr[0].address_1);
        $('#landlordAddress-2').val(arr[0].address_2);
        $('#landlordCity').val(arr[0].city);
        $('#landlordState').val(arr[0].state);

    })

    $(document).on('click', '.submit-edit-profile', e =>{
        console.log('submit edit form');
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
            success: (res) =>{
                if(res.code == 1)
                {
                    console.log(res);
                    $.each(res.error, (prefix, value) =>{
                        $('#edit-form-landlord').find('div.'+prefix+'-error').text(value[0]);
                    })
                }

            else
            {
                console.log(res.value[4]);
                console.log(res.value[5]);
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
            }
            ,
            error: (err) =>{
                console.log(err);
            }
        })
    })














})
</script>
