@extends('layouts.app')

@section('content')



<div class="expenses-payments-header d-flex justify-content-center">
        <h1 class="text-center main-header m-4">Rent Payments</h1>
</div>



<!--- Delete Payment ---->
<div class="modal fade deletePaymentModal"  tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Delete this record?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary deletePaymentButton">Delete</button>
            </div>
        </div>
    </div>
</div>






<!--- Register Payment Input modal --->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">

            <form class="d-flex flex-column justify-content-center" id="payment-form">

                <div class="mb-3 form-inputs">
                    <label for="input-tenant-pay">Tenant Number:</label>
                    <select class="input-tenant-pay" name="input-tenant-pay" id="input-tenant-pay" @if($tenantCount == 0)disabled @endif>
                        <!--- Put active tenants in here ---->
                        @if($tenantCount > 0)
                            @foreach($tenant as $ten)
                                <option value="{{$ten->id}}">{{$ten->id}} - <span class="tenantLastName">
                                        {{$ten->surname}},</span>
                                <span class="tenantFirstName">
                                    {{$ten->firstname}}
                                </span>
                                    <span class="tenantMiddlename">
                                    {{$ten->middle_name}}
                                </span>
                                </option>
                            @endforeach

                            @else
                            <option>No Tenants</option>
                            @endif
                    </select>

                </div>

                <div class="mb-3 form-inputs"}>
                    <label for="expense-amount" class="form-label">Amount</label>
                    <input type="number" step="0.01" class="form-control" id="expense-amount" name="expense-amount" value="0.00" min="1">
                </div>

                <div class="mb-3 form-inputs">
                    <label for="payment-date" class="form-label">Transaction Date</label>
                    <input type="date" value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>" name="payment-date-input">
                </div>

            </form>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Close</button>
          <button type="button" class="btn btn-primary addPaymentRecord" @if($tenantCount == 0) disabled @endif>Add Record</button>
        </div>
      </div>
    </div>
  </div>


<!--- Table ---->
<button class = 'btn btn-primary paymentButton d-block ms-auto mt-5 fs-5' data-bs-toggle="modal" data-bs-target="#paymentModal">+New Payment</button>
<table class="payment-table table mt-5">
    <div class="table-header d-flex flex-column justify-content-center text-center">
    <h1 class="text-center">Payments Table</h1>
      
    </div>
    <thead>
    <tr class="payment-table-header">
        <th scope="col" class="text-center">Transaction ID</th>
        <th scope="col" class="text-center">Name</th>
        <th scope="col" class="text-center">Amount Paid</th>
        <th scope="col" class="text-center">Date Paid</th>
        <th scope="col" class="text-center">Actions</th>
    </tr>
    </thead>
    <tbody class="payment-table-body">
    @if(count($payments) > 0)
        @foreach($payments as $pay)
    <tr>
        <th scope="row" class="text-center">{{$pay->transaction_id}}</th>
        <td class="text-center">{{$pay->tenant->surname}}, {{$pay->tenant->firstname}} {{$pay->tenant->middle_name}}</td>
        <td class="text-center">{{$pay->amount_paid}}</td>
        <td class="text-center">{{$pay->transaction_date}}</td>
        <td class ="d-flex flex-column align-items-center">
            <button type="button" class="btn btn-primary mt-2 fs-4 deletePayment" id="{{$pay->transaction_id}}">Delete</button>
        </td>
    </tr>
        @endforeach

    @else
    <tr>
        <td colspan = "42"><h1 class="text-center">No Records</h1></td>
    </tr>
        @endif

    </tbody>
</table>

@include('script.paymentscript')
    @endsection
