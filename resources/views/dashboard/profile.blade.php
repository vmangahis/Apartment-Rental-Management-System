@extends('layouts.app')

@section('content')

<!---- Main Info ---->
<h1 class="text-center p-5 main-header">Owner</h1>
        <div class ="d-flex justify-content-center">
        <div class = "profile-container d-flex flex-column align-items-center justify-content-center">


            <!--- Landlord Image ---->
            <img src='{{asset("/storage/landlord_image/{$landlord[0]->image}")}}' class="rounded mx-auto d-block landlord-photo mb-2">

            <!---- Landlord Name ----->
            <p class="landlord-name fs-1 text-center mt-2  border-dark border-bottom text-information">
                <span class="landlord-surname-info">{{$landlord[0]->surname}}</span>,
                <span class="landlord-firstname-info">{{$landlord[0]->firstname}}</span>
                <span class="landlord-middlename-info">{{$landlord[0]->middlename}}</span></p>
            <p class ="text-center fs-3">Name</p>

            <!---- Landlord Age ----->
            <p class="landlord-age fs-1 text-center mt-2  border-dark border-bottom text-information">
                {{$landlord[0]->age}}</p>
            <p class ="text-center fs-2">Age</p>



            <!---- Apartment Address ----->
            <div class="landlord-address fs-1 text-center mt-2 d-inline-block  ">
                <div class="border-dark border-bottom">
                <span class="landlord-address-1">{{$landlord[0]->address_1}}</span>,
                <span class="landlord-address-2">{{$landlord[0]->address_2}}</span>,
                </div>
                <div class="border-dark border-bottom w-auto d-inline-block">
                    <span class="landlord-address-city text-information fs-1 text-center mt-2">{{$landlord[0]->city}}</span>,
                <span class="landlord-address-state fs-1 text-center text-information">{{$landlord[0]->state}}</span>
                </div>
            </div>
            <p class ="text-center fs-2">Address</p>

        </div>
        </div>

<button type="button" class="rounded-pill p-2 ms-auto d-block edit-landlord text-dark border-dark" data-bs-toggle="modal" data-bs-target="#editlandlord">Edit Profile</button>

<!---- Edit Landlord Modal ---->
<div class="modal fade" id="editlandlord" tabindex="-1" role="dialog" aria-labelledby="editTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <!---- Modal Header ---->
            <div class="modal-header">
                <h5 class="modal-title fs-2" id="editTitle">Edit Profile</h5>
            </div>


            <ul class="nav nav-tabs ms-auto mx-auto" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" href="#edit-login-info" id="info-tab" data-bs-toggle="tab" data-bs-target="#edit-tab-landlord" type="button" role="tab" aria-controls="edit-form-landlord-tab" aria-selected="true">Profile Info</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" href="#edit-form-landlord-tab"   id="login-tab" data-bs-toggle="tab" data-bs-target="#edit-login-info" type="button" role="tab" aria-controls="edit-login-info-tab" aria-selected="false">Login</button>
                </li>
            </ul>




                <div class="tab-content">
                    <!-- Modal Body for login change --->
                <div class=" tab-pane fade" role="tabpanel" aria-labelledby="edit-login-info-tab" id="edit-login-info" >
                    <!-- Edit Username --->
                    <form class="d-flex justify-content-center flex-column align-items-center border-bottom" id="edit-username">
                        <div class="mb-3 text-center">
                            <label for="old-username-input" class="form-label">Old Username</label>
                            <input type="text" class="form-control" id="old-username-input" name= "old-username-input" placeholder="Input old username...">
                        </div>
                        <div class = "text-danger error old-username-input-error"></div>

                        <div class="mb-3 text-center">
                            <label for="new-username-input" class="form-label">New Username</label>
                            <input type="text" class="form-control" id="new-username-input" name="new-username-input" placeholder="Input new username...">
                        </div>
                        <div class = "text-danger error new-username-input-error"></div>

                        <div class="mb-3 text-center">
                            <label for="password-input" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password-input" name="password-input" placeholder="Input password...">
                        </div>
                        <div class = "text-danger error password-input-error"></div>

                        <div class="text-center pb-2">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-toggle="modal" data-bs-target="#editlandlord">Close</button>
                            <button type="button" class="btn btn-primary submit-username-change">Update Username</button>
                        </div>
                    </form>

                    <!--- Edit Password --->
                    <form class="d-flex justify-content-center flex-column align-items-center border-bottom" id="edit-password">

                        <div class="mb-3 text-center">
                            <label for="current-username-input" class="form-label">Username</label>
                            <input type="text" class="form-control" id="current-username-input" name="current-username-input" placeholder="Input username...">
                            <div class="text-danger current-username-input-error error"></div>
                        </div>

                        <div class="mb-3 text-center">
                            <label for="old-password-input" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="old-password-input" name="old-password-input" placeholder="Input old password...">
                        </div>
                        <div class="text-danger old-password-input-error error"></div>

                        <div class="mb-3 text-center">
                            <label for="new-password-input" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new-password-input" name="new-password-input" placeholder="Input new password...">
                        </div>
                        <div class="text-danger new-password-input-error error"></div>

                        <div class="mb-3 text-center">
                            <label for="confirm-password-input" class="form-label">Reenter Password</label>
                            <input type="password" class="form-control" id="confirm-password-input" name="confirm-password-input" placeholder="Confirm new password...">
                        </div>
                        <div class="text-danger confirm-password-input-error error"></div>

                        <div class="text-center pb-2">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-toggle="modal" data-bs-target="#editlandlord">Close</button>
                            <button type="button" class="btn btn-primary submit-password-change">Update Password</button>
                        </div>
                    </form>

                </div>


                    <!-- Modal Body for profile info change --->
                <div class="tab-pane fade show active" role="tabpanel" id="edit-tab-landlord" aria-labelledby="edit-form-landlord-tab">
                <form class="d-flex flex-column justify-content-center align-items-center edit-landlord-form" id="edit-form-landlord" enctype="multipart/form-data">
                    @csrf

                    <label class = "fs-3">Current Image</label>
                    <img src="{{asset('storage/landlord_image/'.$landlord[0]->image)}}" class="text-center landlord-photo mb-3">

                    <div class="mb-3 text-center w-50">
                        <label for="imageupload">Landlord Image:</label>
                        <input type="file" class="form-control" id="landlordImage" name="landlordImage">
                    </div>

                    <div class="mb-3 text-center">
                        <label for="inputsurname" class="form-label">Surname</label>
                        <input type="text" class="form-control" id="landlord-surname" name="landlordSurname">
                    </div>
                    <div class="text-danger landlordSurname-error error"></div>

                    <div class="mb-3 text-center">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="landlord-firstname" name="landlordFirstname">
                    </div>
                    <div class="text-danger landlordFirstname-error error"></div>

                    <div class="mb-3 text-center">
                        <label class="form-label" for="landlord-middlename">Middle Name</label>
                        <input type="text" class="form-control" id="landlord-middlename" name="landlordMiddlename">
                    </div>
                    <div class="text-danger landlordMiddlename-error error"></div>

                    <div class="mb-3 text-center">
                        <label class="form-label" for="landlord-age">Age</label>
                        <input type="number" class="form-control" id="landlord-age" name="landlordAge">
                    </div>
                    <div class="text-danger landlordAge-error error"></div>

                    <div class="mb-3 text-center">
                        <label class="form-label" for="landlord-address-1">Address 1</label>
                        <input type="text" class="form-control" id="landlordAddress-1" name="landlordAddress-1">
                    </div>
                    <div class="text-danger landlordAddress-1-error error"></div>

                    <div class="mb-3 text-center">
                        <label class="form-label" for="landlord-address-2">Address 2</label>
                        <input type="text" class="form-control" id="landlordAddress-2" name="landlordAddress-2">
                    </div>


                    <div class="mb-3 text-center">
                        <label class="form-label" for="landlord-city">City</label>
                        <input type="text" class="form-control" id="landlordCity" name="landlordCity">
                    </div>
                    <div class="text-danger landlordCity-error error"></div>

                    <div class="mb-3 text-center">
                        <label class="form-label" for="landlord-state">State</label>
                        <input type="text" class="form-control" id="landlordState" name="landlordState">
                    </div>
                    <div class="text-danger landlordState-error error"></div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-toggle="modal" data-bs-target="#editlandlord">Close</button>
                        <button type="button" class="btn btn-primary submit-edit-profile">Update Profile</button>
                    </div>
                </form>
                </div>


                 </div>



        </div>
    </div>
</div>



@include('script.profilescript')
@endsection
