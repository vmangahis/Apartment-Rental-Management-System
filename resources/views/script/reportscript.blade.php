<script type="text/javascript">
$(document).ready(() => {




$('.getMonthlyExpenseReport').on('click',e => {
    e.preventDefault();

    let formdata = new FormData(document.getElementById('monthly-expense-form'));
    let year = formdata.get('monthreport').split('-')[0];
    let month = formdata.get('monthreport').split('-')[1];
    console.log(year);
    console.log(month);
    $.ajaxSetup({
        headers:{
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "GET",
        url: "/expenses/monthly/report/"+year+"/"+month,
        contentType: false,
        processData: false,
        success: res =>{
            $('#monthly-expense-modal').modal('hide');
            $('.report-table-body').html(res.response);
            $('.total-expenses').html(res.amount);
            $('#expenseReportModal').modal('show');
            $('.report-title').html('Monthly Expenses Report');
            console.log(res);
        },

        error: err => {
            console.log(err);
        }

    });

});

$('.getAnnualReport').on('click', e => {
    let data = new FormData(document.getElementById('annual-report-expense-form'));
    let year = data.get('year-report-input');

    $.ajaxSetup({
        headers:{
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        }
    })

    $.ajax({
        method: "GET",
        url: "/expenses/annual/report/"+year,
        contentType: false,
        processData:false,
        success: res => {

            $('#annual-expense-modal').modal('hide');
            $('.report-table-body').html(res.html);
            $('.total-expenses').html(res.total);
            $('#expenseReportModal').modal('show');
            $('.report-title').html('Annual Expenses Report');

        },
        error: err => {
            console.log(err);
        }
    })
});






$(document).on('click', '.printExpenseReport', e => {
   let printArea = document.getElementById('print-area');
   let windowArea = window.open("", "", "width=900, height=700");

   windowArea.document.write(printArea.outerHTML);
   windowArea.document.close();
   windowArea.focus();
    windowArea.print();
    windowArea.close();
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





    $(document).on('click', '.printPaymentReport', e => {
        let printArea = document.getElementById('print-area');
        let windowArea = window.open("", "", "width=900, height=700");

        windowArea.document.write(printArea.outerHTML);
        windowArea.document.close();
        windowArea.focus();
        windowArea.print();
        windowArea.close();
    });














})

</script>