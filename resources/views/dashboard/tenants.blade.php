@extends('layouts.app')

@section('content')


<div class="tenants-header d-flex justify-content-center">
        <h1 class="text-center main-header m-4">Tenants</h1>
        <div class="tab-nav d-flex flex-column align-items-center justify-content-around">
            <button class="btn btn-primary" onClick="location.href='/tenants'">Active</button>
            <button class="btn btn-primary" onClick="location.href='/tenants/archived'">Archived</button>
        </div>
    </div>

<!--- Search and Add Tenant --->
<div class="search-add">
            <div class="row g-3 ms-3">
                <h3>Search By:</h3>
                <div class="col-auto fs-4">
                    <select name="search-option" id="search-option" @if(!$tenant->count())disabled value="none" @endif>
                        <option value="none">None</option>
                        <option value="id">ID</option>
                        <option value="surname">Surname</option>
                        <option value="fname">First Name</option>
                        <option value="mname">Middle Name</option>
                        <option value="age">Age</option>
                        <option value="email">Email Address</option>
                    </select>
                </div>


                <div class="col-auto">
                <input type="text" class="form-control search-input">
                </div>

            </div>

            <button type="button" class="btn btn-primary fs-5 add-tenant" data-bs-toggle="modal" data-bs-target="#tenantForm">Add Tenant</button>
        </div>



<!--- Tenant Table -->
<table class="table tenant-table text-center">
            <thead>
                <tr class="tenant-table-header">
                    <th scope="col">Tenant ID</th>
                    <th scope="col">Surname</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Middle Name</th>
                    <th scope="col">Email Address</th>
                    <th scope="col">Age</th>
                    <th scope="col">Mobile Number</th>
                    <th scope="col">Initial Rent Date</th>
                    <th scope="col">Rent Status</th>
                    <th scope="col">Balance Due</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody id="table-body">

               @if($tenant->count())
                    @foreach($tenant as $ten)

                        <tr class="clickable-row" id="{{$ten->id}}" href="#info-modal" data-bs-target="#info-modal" data-bs-toggle="modal" >
                           <th scope="row" id="{{$ten->id}}">{{$ten->id}}</th>
                            <td id="{{$ten->id}}">{{$ten->surname}}</td>
                            <td id="{{$ten->id}}">{{$ten->firstname}}</td>
                            <td id="{{$ten->id}}">{{$ten->middle_name}}</td>
                            <td id="{{$ten->id}}">{{$ten->email}}</td>
                            <td id="{{$ten->id}}">{{$ten->age}}</td>
                            <td id="{{$ten->id}}">{{$ten->mobile}}</td>
                            <td id="{{$ten->id}}">{{$ten->rent_date}}</td>
                            <td id="{{$ten->id}}">{{$ten->rental_status}}</td>
                            <td id="{{$ten->id}}">{{$ten->balance_due}}</td>
                            <td class = "d-flex flex-column align-items-center" id="{{$ten->id}}">
                                <button type="button" class="btn btn-primary editEntry fs-4 mb-3" data-bs-target="#editModal" data-bs-toggle="modal" id="{{$ten->id}}">Edit</button>
                                <button type="button" class="btn btn-primary deleteEntry fs-4" id="{{$ten->id}}" data-bs-target="#deleteModal" data-bs-toggle="modal">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                @else

                    <tr>
                        <td colspan="42">
                            @if(Route::is('tenants'))
                            <h1 class='text-center no-tenant'>No Active Tenants</h1>

                            @else
                            <h1 class='text-center no-tenant'>No Archived Tenants</h1>
                            @endif
                        </td>
                    </tr>
                @endif


                </tbody>
            </table>


<!--- view info modal ---->
<div class="modal fade" id="info-modal" tabindex="-1" aria-labelledby="info-label" aria-hidden="true" id="1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="">Tenant Info</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <img class ="rounded mx-auto d-block tenant-photo">
            <h5 class="mt-4">Tenant ID: <span class="ten-id"></span></h5>
            <h5 class="mt-4">Full Name: <span class="ten-surname"></span>, <span class="ten-name"></span></h5>
            <h5 class="mt-4">Email Address: <span class="ten-email"></span></h5>
            <h5 class="mt-4">Age: <span class="ten-age"></span></h5>
            <h5 class="mt-4">Mobile Number: <span class="ten-num"></span></h5>
            <h5 class="mt-4">Rent Date: <span class="ten-date"></span></h5>
            <h5 class="mt-4">Status: <span class="ten-status"></span></h5>
            <h5 class="mt-4">Balance Due: P<span class="ten-due"></span></h5>
            <h5 class="mt-4">Monthly: P<span class="monthly-due"></span></h5>
            <h5 class="mt-4">Room Assigned: <span class="ten-room"></span></h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


<!---- Register Dialog---->
<div class="modal fade" id="tenantForm" tabindex="-1" aria-labelledby="tenantReglabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tenantReglabel">Register Tenant</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form class="d-flex flex-column align-items-center justify-content-center mt-5" id="tenantRegistration" method="POST" enctype="multipart/form-data">
                        @csrf

                            <!---- Image Upload ----->
                            <div class="mb-3 text-center w-50">
                                <label for="imageupload">Tenant Image:</label>
                                <input type="file" class="form-control" id="tenantImage" name="tenantImage">
                              </div>
                              <div class='text-danger align-self-center mb-2 tenantImage-error error'></div>

                            <!--- Surname Input ---->
                            <div class="mb-3 text-center">
                                <label for="inputTenant" class="form-label mr-3 text-center">Tenant Surname: </label>
                                <input type="text"
                                       class="form-control ml-5"
                                         aria-describedby="emailHelp" name="tenantSurname"
                                       value="{{old('tenantSurname')}}" id="tenantSurname">
                            </div>
                            <div class='text-danger align-self-center mb-2 error tenantSurname-error'></div>

                            <!--- Firstname Input --->
                            <div class="mb-3 text-center">
                                <label for="" class="mr-3 text-center">Tenant First Name: </label>
                                <input type="text"
                                       class="form-control"
                                       id="tenant-firstname" name="tenantFirstname" value="{{old('tenantFirstname')}}">
                            </div>
                            <div class='text-danger align-self-center mb-2 error tenantFirstname-error'></div>

                            <!--- Middle Name Input --->
                            <div class="mb-3 text-center">
                                <label for="" class="mr-3 text-center">Tenant Middle Name:</label>
                                <input type="text" class="form-control"
                                       id="tenant-middlename" name="tenantMiddlename" value="{{old('tenantMiddlename')}}">
                            </div>
                            <div class='text-danger align-self-center mb-2 error tenantMiddlename-error'></div>

                            <!---- Email Input ----->
                            <div class="mb-3 text-center">
                                <label for="email" class="">Email Address:</label>
                                <input type="email"
                                       class="ml-3 form-control align-self-center"
                                       id="age" name="tenantEmail" value="{{old('tenantEmail')}}">
                            </div>
                            <div class='text-danger align-self-center mb-2 error tenantEmail-error'></div>


                            <!---- Age input ---->
                            <div class="mb-3 text-center">
                                <label for="age" class="">Age: </label>
                                <input type="number"
                                       class="ml-3 form-control align-self-center"
                                       id="age" name="tenantAge" value="{{old('tenantAge')}}">
                            </div>
                            <div class='text-danger align-self-center mb-2 error tenantAge-error'></div>

                            <!--- mobile input ---->
                            <div class="mb-3 text-center">
                                <label for="mobile" class="">Mobile Number: </label>
                                <input type="text" class="ml-3 form-control align-self-center" id="" name="tenantMobile"
                                       value="{{old('tenantMobile')}}">
                            </div>

                            <!--- Monthly input ---->
                            <div class="mb-3 text-center">
                                <label for="monthly" class="">Monthly: </label>
                                <input type="number"
                                       class="ml-3 form-control align-self-center"
                                       id="monthly" name="monthly" step="0.01" min="1" value="0.00">
                            </div>

                            <!--- Room Assignment ---->
                            <div class="mb-3 text-center d-flex flex-row align-items-center">
                                <label for="mobile" class="">Room Assignment: </label>
                                <select for='room' class="ms-4 w-35" name="room_number" @if($roomCount == 0) disabled @endif>
                                    @if(count($rooms) > 0)

                                    @foreach($rooms as $roomnum)
                                    <option value="{{$roomnum->room_id}}">{{$roomnum->room_id}}</option>
                                    @endforeach

                                    @else

                                    <option value='none'>No Rooms Available</option>
                                        @endif
                                </select>
                            </div>

                            <!---- Rent Status ----->
                            <div class="mb-3 text-center d-flex flex-row align-items-center">
                                <label for="rental_status" class="">Rent Status:</label>
                                <select id="rental_status" name="rent_status" class="ms-4">
                                    <option value="ACTIVE">ACTIVE</option>
                                    <option value="ARCHIVED">ARCHIVED</option>
                                  </select>
                            </div>

                            <!---- Rent Date ----->
                            <div class="mb-3 text-center">
                                <label for="age" class="">Rent Date:</label>
                                <input type="date" class="ml-3 form-control align-self-center" id=""
                                       name="tenantRentdate" value="{{now()->toDateString('Y-m-d')}}"
                                       max="{{now()->toDateString('Y-m-d')}}">
                            </div>

                            <!---- Register --->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" @if($roomCount == 0) disabled @endif>Register</button>
                            </div>

                        </form>
                    </div>
                </div>
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
                </div>


                <!--- Edit info form tab ---->
                <div class="modal-body">
                    <form class="d-flex flex-column align-items-center mt-5 editform"  method="POST">
                        @csrf
                        <div class="mb-3 text-center">
                            <label for="tenant-photo">Current Tenant Image: </label>
                            <img class =" mx-auto d-block tenant-photo" src="">
                            </div>

                            <div class="mb-3 text-center">
                            <label for="inputTenant" class="form-label mr-3 text-center">Tenant Surname: </label>
                            <!--- Surname Input --->
                            <input type="text"
                                   class="form-control ml-5 @error('tenantSurname')border border-danger @enderror "
                                   aria-describedby="emailHelp" name="tenantSurnameEdit" id="tenantSurnameEdit">
                             </div>


                        <!--- Firstname Input --->
                        <div class="mb-3 text-center">
                            <label for="" class="mr-3 text-center">Tenant First Name: </label>
                            <input type="text"
                                   class="form-control @error('tenantFirstname')border border-danger @enderror"  id="tenantFirstnameEdit" name="tenantFirstnameEdit">
                        </div>

                        <div class="mb-3 text-center">
                            <label for="" class="mr-3 text-center">Tenant Middle Name: </label>
                            <!--- Firstname Input --->
                            <input type="text"
                                   class="form-control @error('tenantMiddlename')border border-danger @enderror"  id="tenantMiddlenameEdit" name="tenantMiddlenameEdit">
                        </div>


                        <div class='text-danger align-self-center mb-2 error-firstname'></div>

                        <div class="mb-3 text-center">
                            <label for="email" class="">Email Address</label>

                            <!--- Email Input --->
                            <input type="email"
                                   class="ml-3 form-control align-self-center  @error('tenantEmail')border border-danger @enderror"
                                   id="tenantEmailEdit" name="tenantEmailEdit" value="{{old('tenantEmail')}}">

                        </div>
                        @error('tenantEmail')
                        <div class='text-danger align-self-center mb-2 error-email'>{{$message}}</div>
                        @enderror
                        <div class="mb-3 text-center">
                            <label for="age" class="">Age: </label>

                        <!--- Age Input Edit--->
                            <input type="number"
                                   class="ml-3 form-control align-self-center @error('tenantAge')border border-danger @enderror"
                                   id="tenantAgeEdit" name="tenantAgeEdit">
                        </div>
                        @error('tenantAge')
                        <div class='text-danger align-self-center mb-2 error-age'>{{$message}}</div>
                        @enderror
                        <div class="mb-3 text-center">
                            <label for="mobile" class="">Mobile Number: </label>
                            <input type="text" class="ml-3 form-control align-self-center" id="mobile" name="tenantMobile"
                                   value="{{old('tenantMobile')}}">
                        </div>

                        <!--- Monthly Edit ---->
                        <div class="mb-3 text-center">
                            <label for="monthly" class="">Monthly: </label>
                            <input type="number"
                                   class="ml-3 form-control align-self-center"
                                   id="monthly-edit" name="monthly-edit" step="0.01" min="1" value="0.00">
                        </div>

                         <!--- Room Assignment Edit---->
                         <div class="mb-3 text-center d-flex flex-row align-items-center">
                            <label for="room" class="">Room Assignment:</label>
                             <select for='room' class="ms-4 w-35" name="room_number" class="" @if($roomCount == 0) disabled @endif>
                                @if(count($rooms) > 0)

                                @foreach($rooms as $roomnum)

                                <option value="{{$roomnum->room_id}}">{{$roomnum->room_id}}</option>
                                @endforeach

                                @else
                                <option value='none' selected="selected">No Other Rooms Available</option>
                                    @endif

                                 </select>
                         </div>


                         <!---- Rent Status Edit ----->
                         <div class="mb-3 text-center d-flex align-items-center justify-content-center">
                            <label for="mobile" class="">Rent Status:</label>
                            <select id="rental_status_edit" name="rent_status" class="ms-4">
                                <option value="ACTIVE">ACTIVE</option>
                                <option value="ARCHIVED">ARCHIVED</option>
                              </select>
                        </div>

                        <!---- Rent Date Edit ---->
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






    @include('script.tenantscript')


@endsection



