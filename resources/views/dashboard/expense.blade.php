@extends('layouts.app')

@section('content')


<div class="expenses-payments-header d-flex justify-content-center">
    <h1 class="text-center main-header m-4">Expenses & Payments</h1>
    <div class="tab-nav d-flex flex-column align-items-center justify-content-around">
        <button class="btn btn-primary" onClick="location.href = '/expenses'">Expenses</button>
        <button class="btn btn-primary" onClick="location.href = '/payment'">Payments</button>
    </div>
</div>



<button class = 'btn btn-primary expenseButton mt-5 ms-auto d-block fs-5' data-bs-toggle="modal" data-bs-target="#expenseModal">+New Expense</button>

<!--- Report Modal --->
<div class="modal fade" id="expenseReportModal" tabindex="-1" class="d-inline-block">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="report-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-block mx-auto">
                <table class="table mt-5 report-expense-table">
                    <div class="table-header ">
                        <h1 class="text-center">Expenses Table</h1>
                    </div>
                    <thead>
                    <tr class="report-table-header">
                        <th scope="col" class="text-center">Transaction ID</th>
                        <th scope="col" class="text-center">Description</th>
                        <th scope="col" class="text-center">Transaction Date</th>
                        <th scope="col" class="text-center">Amount</th>
                    </tr>
                    </thead>

                    <tbody class="report-table-body">
                    </tbody>


                </table>
                <div class="table-footer d-flex justify-content-between">
                <h2>Total Expenses:</h2>
                <h2>P <span class="total-expenses"></span></h2>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="expenseModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Expenses</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form class="d-flex flex-column justify-content-center" id="expense-form">
                <div class="mb-3 form-inputs">
                    <label for="description-input" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description-input" name="description-input">
                </div>
                <div class = "text-danger error description-input-error"></div>

                <div class="mb-3 form-inputs">
                    <label for="expense-amount" class="form-label">Amount</label>
                    <input type="number" step="0.01" class="form-control" id="expense-amount" name="expense-amount" value="0.00" min="1">
                </div>

                <div class="mb-3 form-inputs">
                    <label for="transaction-date" class="form-label">Transaction Date</label>
                    <input type="date" value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>" name="transaction-date-input">
                </div>

            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary addExpenseRecord">Add Record</button>
        </div>
      </div>
    </div>
  </div>

<!-- Monthly Report Modal -->
<div class="modal fade" id="monthly-expense-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Monthly Expenses Reports</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="monthly-expense-form" name="monthly-expense-form">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <label for="month-report-input">Enter Month:</label>
                    <input type="month" id="monthreport" name="monthreport" max="<?php echo date('Y-m');?>" class="mt-3" value="<?php echo date('Y-m'); ?>">
                </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary getMonthlyExpenseReport">Get Report</button>
            </div>

        </div>
    </div>
</div>

<!--- Annual report modal --->
<div class="modal fade" id="annual-expense-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Annual Expenses Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id = "annual-report-expense-form">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <label for="annual-report-input">Select Year</label>
                    <input type="number" value="<?php echo date('Y'); ?>" step=1 class="annual-report-input mt-3" id="annual-report-input" min="1999" name="year-report-input" max="2100" class="mt-3">
                </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary getAnnualReport">Get Report</button>
            </div>
        </div>
    </div>
</div>



<!---- Expenses Table ----->
<table class="table mt-5 expense-table">
        <div class="table-header d-flex flex-column justify-content-center text-center">
            <h1 class="text-center">Expenses Table</h1>
            <div class="d-inline-block">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#monthly-expense-modal">Monthly Report</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#annual-expense-modal">Annual Report</button>
            </div>
        </div>
        <thead>
        <tr class="expense-table-header">
            <th scope="col" class="text-center">Transaction ID</th>
            <th scope="col" class="text-center">Description</th>
            <th scope="col" class="text-center">Amount</th>
            <th scope="col" class="text-center">Transaction Date</th>
            <th scope="col" class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody class="expense-table-body">
        @if(count($expenses) > 0 )
            @foreach($expenses as $exp)
            <tr>
            <th scope="row" class="text-center">{{$exp->transaction_id}}</th>
            <td class="text-center">{{$exp->description}}</td>
            <td class="text-center">{{$exp->amount}}</td>
            <td class="text-center">{{$exp->transaction_date}}</td>
                <td class="d-flex flex-column justify-content-center align-items-center">
                    <button id="{{$exp->transaction_id}}" type="button" class="btn btn-primary fs-4">Edit</button>
                    <button id="{{$exp->transaction_id}}" type="button" class="btn btn-primary fs-4 mt-2">Delete</button>
                </td>
            </tr>
            @endforeach


        @else
            <tr>
                <td colspan="42">
                <h1 class="text-center">No Records</h1>
                </td>
            </tr>
            @endif
        </tbody>
    </table>
@include('script.expensescript')
@endsection
