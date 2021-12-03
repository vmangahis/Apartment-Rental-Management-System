<script type="text/javascript">
$(document).ready(() => {

    $(document).on('click', '.addPaymentRecord', e =>{
        e.preventDefault();
        console.log('added payment');
        let data = new FormData(document.getElementById('payment-form'));

        $.ajaxSetup({
            headers:{
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{url('/payment/tenant')}}",
            method: "POST",
            contentType: false,
            processData: false,
            data: data,
            success: res =>{
                console.log(res);
            }
        })

    });









})
</script>
