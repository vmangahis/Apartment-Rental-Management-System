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
            url: "{{url('/expenses')}}",
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


$(document).on('click', '.deleteExpenseButton', e => {
    console.log('delete');
    $('.deleteExpenseModal').attr('id', e.target.id);
    $('.deleteExpenseModal').modal('show');
});

$(document).on('click', '.confirmDeleteExpense', e => {
    e.preventDefault();

    $.ajaxSetup({
        headers:{
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        }
    })

    $.ajax({
        method: "DELETE",
        url: '/expenses/delete/'+ $('.deleteExpenseModal').attr('id'),
        contentType: false,
        dataType: false,
        success: res =>{
            window.location.href="/expenses";
        }

    })
})



$(document).on('click', '.printExpenseReport', e => {
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
