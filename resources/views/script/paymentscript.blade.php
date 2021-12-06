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
                $('#paymentModal').modal('hide');
                $('#payment-form')[0].reset();
                $('.payment-table-body').html(res.html);
            },
            error: err => {
                console.log(err);
            }
        });

    });




    $('.getPaymentReportMonthly').on('click', e => {
        let data = new FormData(document.getElementById('monthly-payment-report-form'));



        $.ajaxSetup({
            headers:{
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "GET",
            url: "{{url('/payment/tenant/monthly-report')}}",
            processData: false,
            contentType: false,
            success: response => {
                console.log(response);
            },
            error: err => {
                console.log(err);
            }
        })

    })

    $('.getAnnualPayment').on('click', e => {
        let data = new FormData(document.getElementById('annual-report-payment-form'));



        $.ajaxSetup({
            headers:{
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "GET",
            url: "{{url('/payment/tenant/annual-report')}}",
            processData: false,
            contentType: false,
            success: response => {
                console.log(response);
            },
            error: err => {
                console.log(err);
            }
        })

    })


})
</script>
