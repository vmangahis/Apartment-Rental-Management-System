<script type = "text/javascript">
$(document).ready(() =>{

    $('.addExpenseRecord').on('click', e =>{
        let formdata = new FormData(document.getElementById('expense-form'));

        $.ajaxSetup({
            headers:{
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        })

        $.ajax({
            method : "POST",
            url: "{{url('/payment')}}",
            processData: false,
            contentType: false,
            data: formdata,
            beforeSend: () =>{
                $('#expense-form').find('div.error').text('');
            },
            success: res => {
                if(res.code == 0)
                {
                    $.each(res.error, (cl, val) =>{
                        $('#expense-form').find('div.' + cl +'-error').text(val);
                    });
                }

                else
                {
                    $('#expenseModal').modal('hide');
                    $('.expense-table-body').html(res.update);
                }
            },

            error: err =>{
                console.log(err);
            }
        })
    })


$('.getMonthlyExpenseReport').on('click', e => {
    let data = new FormData(document.getElementById('monthly-expense-report'));

    $.ajaxSetup({
        headers:{
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        }
    })

    $.ajax({
        method: "GET",
        url: "{{url('/payment/monthly-report')}}",
        contentType: false,
        processData: false,
        success: res => {
            console.log(res);
        },
        error : err => {
            console.log(err);
        }
    })

});

$('.getAnnualReport').on('click', e => {
    let data = new FormData(document.getElementById('annual-report-expense-form'));

    $.ajaxSetup({
        headers:{
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        }
    })

    $.ajax({
        method: "GET",
        url: "{{url('/payment/annual-report')}}",
        contentType: false,
        processData:false,
        success: res => {
            console.log(res);
        },
        error: err => {
            console.log(err);
        }
    })
});





























})
</script>
