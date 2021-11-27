<script type = "text/javascript">
$(document).ready(() => {



    $(document).on('click', '.edit-landlord', e =>{
        var arr = {!! json_encode($landlord, JSON_HEX_TAG) !!}
        $('#landlord-surname').val(arr[0].surname);
        $('#landlord-firstname').val(arr[0].firstname);
        $('#landlord-middlename').val(arr[0].middlename);
        $('#landlord-age').val(arr[0].age);
        $('#landlord-address-1').val(arr[0].address_1);
        $('#landlord-address-2').val(arr[0].address_2);
        $('#landlord-city').val(arr[0].city);
        $('#landlord-state').val(arr[0].state);

    })














})
</script>
