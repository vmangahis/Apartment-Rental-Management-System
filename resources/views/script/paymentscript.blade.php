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
        let year = data.get('month-report-input-payment').split('-')[0];
        let month = data.get('month-report-input-payment').split('-')[1];

        $.ajaxSetup({
            headers:{
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "GET",
            url: "/payment/report/"+year+"/"+month,
            processData: false,
            contentType: false,
            success: response => {
                        $('#monthly-payments-modal').modal('hide');
                        $('.report-payment-table-body').html(response.html);
                        $('.payment-report-header').html('Monthly Payments Report');
                        $('.total-payments').html(response.total);
                        $('#payment-report-modal').modal('show');
            },
            error: err => {
                console.log(err);
            }
        })

    })

    $('.getAnnualPayment').on('click', e => {
        let data = new FormData(document.getElementById('annual-report-payment-form'));
        let year = data.get('annual-report-input-payments');


        $.ajaxSetup({
            headers:{
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "GET",
            url: "/payment/report/"+year,
            processData: false,
            contentType: false,
            success: response => {
                $('#annual-payments-modal').modal('hide');
                $('.report-payment-table-body').html(response.html);
                $('.payment-report-header').html('Annual Payments Report');
                $('.total-payments').html(response.total);
                $('#payment-report-modal').modal('show');
            },
            error: err => {
                console.log(err);
            }
        })

    })


})
</script>
