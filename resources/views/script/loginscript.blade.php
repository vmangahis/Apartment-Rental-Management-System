<script type="text/javascript">
$(document).ready(() => {

$('.loginbutton').on('click', e => {
    let login = new FormData(document.getElementById('login'));

    $.ajaxSetup({
        headers:{
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: "POST",
        url: "/login/check",
        contentType: false,
        processData: false,
        data: login,
        beforeSend: () =>{
            $('#login').find('div.error').text('');
        },
        success: res => {
            if(res.code == 1 || res.code == 2 || res.code == 3 || res.code == 4)
            {
                    $.each(res.error, (index, val) => {
                        $('#login').find('div.'+index+'-error').text(val);
                    });
            }
            else{
                window.location.href="/";
            }
        },
        error: err =>{
            console.log(err);
        }
    })

})

})
</script>
