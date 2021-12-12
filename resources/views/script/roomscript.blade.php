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



$(document).on('click', '.deleteRoom', e => {
    e.preventDefault();
    let room_id = $('.deleteRoom').attr('id');
    $('.deleteRoomForm').attr('id', room_id);
    $('#deleteRoomModal').modal('show');



});

    $(document).on('click', '.confirmDeleteRoom', e=>{
        e.preventDefault();
        let room_id = $('.deleteRoomForm').attr('id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            method: "DELETE",
            url: "{{url('/rooms')}}",
            data: {
                "room_id" :room_id},
            success: (res) => {

                window.location.href = "/rooms";
            },
            error: (err) =>{
                console.log(err);
            }
        })
    })



});
</script>
