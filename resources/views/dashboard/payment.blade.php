@extends('layouts.app')

@section('content')



<div class="expenses-payments-header d-flex justify-content-center">
        <h1 class="text-center main-header m-4">Expenses & Payments</h1>
        <div class="tab-nav d-flex flex-column align-items-center justify-content-around">
            <button class="btn btn-primary" onClick="location.href = '/expenses'">Expenses</button>
            <button class="btn btn-primary" onClick="location.href = '/payment/'">Payments</button>
        </div>
</div>

<!--- Report Modal (where actual report pops up) --->
<div class="modal fade" id="payment-report-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title payment-report-header"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="payment-table table mt-5">
                    <div class="table-header d-flex flex-column justify-content-center text-center">
                        <h1 class="text-center ">Payments Table</h1>
                    </div>
                    <thead>
                    <tr class="report-table-header">
                        <th scope="col" class="text-center">Transaction ID</th>
                        <th scope="col" class="text-center">Surname</th>
                        <th scope="col" class="text-center">First Name</th>
                        <th scope="col" class="text-center">Middle Name</th>
                        <th scope="col" class="text-center">Date Paid</th>
                        <th scope="col" class="text-center">Amount Paid</th>
                    </tr>
                    </thead>
                    <tbody class="report-payment-table-body">
                    <!--- result will be extracted here --->
                    </tbody>
                </table>
                <div class="table-footer d-flex justify-content-between">
                    <h2>Total Payments:</h2>
                    <h2>P <span class="total-payments"></span></h2>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<!-- Monthly Report Modal -->
<div class="modal fade" id="monthly-payments-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Monthly Payments Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id = "monthly-payment-report-form">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <label for="month-report-input">Select Month:</label>
                    <input type="month" id="month-report-input-payment" name="month-report-input-payment" value="<?php echo date('Y-m');?>" max="<?php echo date('Y-m-d');?>" class="mt-3">
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary getPaymentReportMonthly">Get Report</button>
            </div>
        </div>
    </div>
</div>

<!--- Annual report modal --->
<div class="modal fade" id="annual-payments-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Annual Payments Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id = "annual-report-payment-form">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <label for="annual-report-input-payments">Enter Year:</label>
                    <input type="number" value="<?php echo date('Y'); ?>" step=1 class="annual-report-input-payments mt-3" id="annual-report-input-payments" min="1999" name="annual-report-input-payments" max="2100" class="mt-3">
                </div>

                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary getAnnualPayment">Get Report</button>
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
        <div class="d-inline-block">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#monthly-payments-modal">Monthly Report</button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#annual-payments-modal">Annual Report</button>
        </div>
    </div>
    <thead>
    <tr class="payment-table-header">
        <th scope="col" class="text-center">Transaction ID</th>
        <th scope="col" class="text-center">Surname</th>
        <th scope="col" class="text-center">First Name</th>
        <th scope="col" class="text-center">Middle Name</th>
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
        <td class="text-center">{{$pay->tenant->surname}}</td>
        <td class="text-center">{{$pay->tenant->firstname}}</td>
        <td class="text-center">{{$pay->tenant->middle_name}}</td>
        <td class="text-center">{{$pay->amount_paid}}</td>
        <td class="text-center">{{$pay->transaction_date}}</td>
        <td class ="d-flex flex-column align-items-center">
            <button type="button" class="btn btn-primary fs-4" id="{{$pay->transaction_id}}">Edit</button>
            <button type="button" class="btn btn-primary mt-2 fs-4 " id="{{$pay->transaction_id}}">Delete</button>
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
