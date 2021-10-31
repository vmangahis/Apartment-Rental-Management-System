@extends('layouts.app')

@section('content')


    <div class="mt-5">
        <h1 class="text-center">Tenant List</h1>
        <table class="table tenant-table text-center">
            <!----- Modal Form Start ---->
            <button type="button" class="btn btn-primary add-tenant mb-5" data-bs-toggle="modal"
                    data-bs-target="#tenantForm">Add Tenant
            </button>


            <!---- Modal Dialog ---->
            <div class="modal fade" id="tenantForm" tabindex="-1" aria-labelledby="tenantReglabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tenantReglabel">Register Tenant</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                        <form class="d-flex flex-column align-items-center mt-5" id="tenantRegistration" method="POST">
                        @csrf

                            <div class="mb-3 text-center">
                                <label for="inputTenant" class="form-label mr-3 text-center">Tenant Surname: </label>

                                <!--- Surname Input --->

                                <input type="text"
                                       class="form-control ml-5 @error('tenantSurname')border border-danger @enderror "
                                       id="tenant-surname" aria-describedby="emailHelp" name="tenantSurname"
                                       value="{{old('tenantSurname')}}" id="tenantSurname">
                            </div>
                            @error('tenantSurname')
                            <div class='text-danger align-self-center mb-2 error-surname'>{{$message}}</div>
                            @enderror
                            <div class="mb-3 text-center">
                                <label for="" class="mr-3 text-center">Tenant First Name: </label>
                                <!--- Firstname Input --->
                                <input type="text"
                                       class="form-control @error('tenantFirstname')border border-danger @enderror"
                                       id="tenant-firstname" name="tenantFirstname" value="{{old('tenantFirstname')}}">
                            </div>


                            <div class='text-danger align-self-center mb-2 error-firstname'></div>

                            <div class="mb-3 text-center">
                                <label for="email" class="">Email Address</label>

                                <!--- Email Input --->
                                <input type="email"
                                       class="ml-3 form-control align-self-center @error('tenantEmail')border border-danger @enderror"
                                       id="age" name="tenantEmail" value="{{old('tenantEmail')}}">

                            </div>
                            @error('tenantEmail')
                            <div class='text-danger align-self-center mb-2 error-email'>{{$message}}</div>
                            @enderror
                            <div class="mb-3 text-center">
                                <label for="age" class="">Age: </label>

                                <!--- Age Input --->
                                <input type="number"
                                       class="ml-3 form-control align-self-center @error('tenantAge')border border-danger @enderror"
                                       id="age" name="tenantAge" value="{{old('tenantAge')}}">
                            </div>
                            @error('tenantAge')
                            <div class='text-danger align-self-center mb-2 error-age'>{{$message}}</div>
                            @enderror
                            <div class="mb-3 text-center">
                                <label for="mobile" class="">Mobile Number: </label>
                                <input type="text" class="ml-3 form-control align-self-center" id="" name="tenantMobile"
                                       value="{{old('tenantMobile')}}">
                            </div>
                            <div class="mb-3 text-center">
                                <label for="age" class="">Rent Date: </label>
                                <input type="date" class="ml-3 form-control align-self-center" id=""
                                       name="tenantRentdate" value="{{now()->toDateString('Y-m-d')}}"
                                       max="{{now()->toDateString('Y-m-d')}}">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!---- Modal Form End -->

            <!---- Table Column Start -->
            <thead>
            <tr class="tenant-table-header">
                <th scope="col">Tenant ID</th>
                <th scope="col">Surname</th>
                <th scope="col">First Name</th>
                <th scope="col">Email Address</th>
                <th scope="col">Age</th>
                <th scope="col">Mobile Number</th>
                <th scope="col">Initial Rent Date</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if($tenant->count())
                @foreach($tenant as $ten)
                    <tr>
                        <th scope="row">{{$ten->id}}</th>
                        <td>{{$ten->surname}}</td>
                        <td>{{$ten->firstname}}</td>
                        <td>{{$ten->email}}</td>
                        <td>{{$ten->age}}</td>
                        <td>{{$ten->mobile}}</td>
                        <td>{{$ten->rent_date}}</td>
                        <td>
                            <button type="button" class="btn btn-primary editEntry" data-bs-target="#editModal" data-bs-toggle="modal" id="{{$ten->id}}">Edit</button>
                            <button type="button" class="btn btn-danger deleteEntry" id="{{$ten->id}}"
                                    data-bs-target="#deleteModal" data-bs-toggle="modal">Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="42">
                        <h1 class='text-center no-tenant'>No Tenants</h1>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

    <!--- Modal Dialog for Deletion -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteTenantLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Tenant?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <span class="name-placeholder"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelDelete">Cancel</button>


                    <button type="button" class="btn btn-primary confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!--- Edit Modal --->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editTenantLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTenant">Edit Tenant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form class="d-flex flex-column align-items-center mt-5" id="tenantRegistration" method="POST">
                        @csrf

                        <div class="mb-3 text-center">
                            <label for="inputTenant" class="form-label mr-3 text-center">Tenant Surname: </label>
                            <!--- Surname Input --->
                            <input type="text"
                                   class="form-control ml-5 @error('tenantSurname')border border-danger @enderror "
                                   aria-describedby="emailHelp" name="tenantSurname"
                                    id="tenantSurname" value="">
                        </div>


                        @error('tenantSurname')
                        <div class='text-danger align-self-center mb-2 error-surname'>{{$message}}</div>
                        @enderror


                        <div class="mb-3 text-center">
                            <label for="" class="mr-3 text-center">Tenant First Name: </label>
                            <!--- Firstname Input --->
                            <input type="text"
                                   class="form-control @error('tenantFirstname')border border-danger @enderror"  id="tenantfirstname" name="tenantFirstname">
                        </div>


                        <div class='text-danger align-self-center mb-2 error-firstname'></div>

                        <div class="mb-3 text-center">
                            <label for="email" class="">Email Address</label>

                            <!--- Email Input --->
                            <input type="email"
                                   class="ml-3 form-control align-self-center  @error('tenantEmail')border border-danger @enderror"
                                   id="email" name="tenantEmail" value="{{old('tenantEmail')}}">

                        </div>
                        @error('tenantEmail')
                        <div class='text-danger align-self-center mb-2 error-email'>{{$message}}</div>
                        @enderror
                        <div class="mb-3 text-center">
                            <label for="age" class="">Age: </label>

                            <!--- Age Input --->
                            <input type="number"
                                   class="ml-3 form-control align-self-center @error('tenantAge')border border-danger @enderror"
                                   id="agecounter" name="tenantAge">
                        </div>
                        @error('tenantAge')
                        <div class='text-danger align-self-center mb-2 error-age'>{{$message}}</div>
                        @enderror
                        <div class="mb-3 text-center">
                            <label for="mobile" class="">Mobile Number: </label>
                            <input type="text" class="ml-3 form-control align-self-center" id="mobile" name="tenantMobile"
                                   value="{{old('tenantMobile')}}">
                        </div>
                        <div class="mb-3 text-center">
                            <label for="rent-date" class="">Rent Date: </label>
                            <input type="date" class="ml-3 form-control align-self-center" id="rent-date"
                                   name="tenantRentdate" value="{{now()->toDateString('Y-m-d')}}"
                                   max="{{now()->toDateString('Y-m-d')}}">
                        </div>
                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelDelete">Cancel</button>


                    <button type="button" class="btn btn-primary confirmEdit">Update</button>
                </div>
            </div>
        </div>
    </div>


    @include('dashboard.script')




@endsection



