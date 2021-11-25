<script type = "text/javascript">
$(document).ready(() =>{

    $('.room-search-input').prop('disabled', true);

    $('#room-search-option').change((e) => {

        if($(e.target).val() === "none")
            $('.room-search-input').prop('disabled', true);

        else
            $('.room-search-input').prop('disabled', false);
    })

    $(document).on('click', '.addroombutton', e =>{
        e.preventDefault();
        var rooms = {!! json_encode($room, JSON_HEX_TAG) !!};
        console.log(rooms.length);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "{{url('/rooms')}}",
            success: (data) => {
                console.log(data);
                $('#room-body').html(data);
            },
            error: (err) =>{
                console.log(err);
            }
        })
    })

    $(document).on('click', '.remove-room', e => {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


    })



});
</script>