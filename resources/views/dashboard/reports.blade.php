@extends('layouts.app')

@section('content')


    <h1 class="text-center main-header m-4">Reports</h1>


    
    <!-- Monthly Payment Report Modal (input) -->
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

    <!--- Annual Payment report modal (input) --->
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





<!-- Monthly Expenses Modal --->
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


<!--- Annual report modal(input) --->
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

<!--- Annual Expense report modal --->
<div class="modal fade" id="expenseReportModal" tabindex="-1" class="d-inline-block">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="report-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-block mx-auto">
            <div id="print-area">
                <table class="table mt-5 report-expense-table">
                    <div class="table-header">
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
            </div>

            <div class="modal-footer">
                <button type ="button" class="btn btn-primary printExpenseReport">Print Report</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
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
                    <div id="print-area">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary printPaymentReport" data-bs-dismiss="modal">Print Report</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <!--- Button --->
<div class="report-containers d-flex flex-row justify-content-center align-items-center flex-wrap">
        <div class="box report-box">
            <a href="#" class="report-link" data-bs-toggle="modal" data-bs-target="#monthly-expense-modal"><p class="text-center fs-1">Landlord Expenses (Monthly)</p></a>
        </div>

        <div class="box report-box">
            <a href="#" class="report-link" id="annual-expenses" data-bs-toggle="modal" data-bs-target="#annual-expense-modal"><p class="text-center fs-1">Landlord Expenses (Annually)</p></a>
        </div>

        <div class="box report-box">
            <a href="#" class="report-link" data-bs-toggle="modal" data-bs-target="#monthly-payments-modal"><p class="text-center fs-1">Rent Payments (Monthly)</p></a>
        </div>

        <div class="box report-box">
            <a href="#" class="report-link" data-bs-toggle="modal" data-bs-target="#annual-payments-modal"><p class="text-center fs-1">Rent Payments (Annually)</p></a>
        </div>

    </div>

@include('script.reportscript')
    @endsection
