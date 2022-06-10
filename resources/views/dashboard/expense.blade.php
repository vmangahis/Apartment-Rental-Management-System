@extends('layouts.app')

@section('content')


<div class="expenses-payments-header d-flex justify-content-center">
    <h1 class="text-center main-header m-4">Landlord Expenses</h1>
</div>



<button class = 'btn btn-primary expenseButton mt-5 ms-auto d-block fs-5' data-bs-toggle="modal" data-bs-target="#expenseModal">+New Expense</button>






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


<!--- Delete Dialog ---->
<div class="modal fade deleteExpenseModal"  id="deleteExpenseModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form>
                    <p>Delete this record?</p>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary confirmDeleteExpense">Delete</button>
            </div>
        </div>
    </div>
</div>







<!---- Expenses Table ----->
<table class="table mt-5 expense-table">
        <div class="table-header d-flex flex-column justify-content-center text-center">
            <h1 class="text-center">Expenses Table</h1>
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
                    
                    <button id="{{$exp->transaction_id}}" type="button" class="btn btn-primary fs-4 mt-2 deleteExpenseButton">Delete</button>
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
