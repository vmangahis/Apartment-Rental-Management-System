@extends('layouts.app')

@section('content')

<!---- Main Info ---->
<h1 class="text-center p-5 main-header">Owner</h1>
        <div class ="d-flex justify-content-center">
        <div class = "profile-container d-flex flex-column align-items-center justify-content-center">
            <!--- Landlord Image ---->
            <img src="{{asset('/storage/landlord_image/blankimage.png')}}" class="rounded mx-auto d-block landlord-photo mb-2">

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
                <span class="landlord-address-1">{{$landlord[0]->address_1}}, </span>
                <span class="landlord-address-2">{{$landlord[0]->address_2}}, </span>
                </div>
                <div class="border-dark border-bottom w-auto d-inline-block">
                    <span class="landlord-address-city text-information fs-1 text-center mt-2">{{$landlord[0]->city}}, </span>
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
                <h5 class="modal-title" id="editTitle">Edit Information</h5>
            </div>

            <!---- Modal Body ---->
            <div class="modal-body">

                <form class="d-flex flex-column justify-content-center align-items-center edit-landlord-form" id="edit-form-landlord">
                    @csrf
                    <label class = "fs-3">Current Image</label>
                    <img src="{{asset('storage/landlord_image/'.$landlord[0]->image)}}" class="text-center landlord-photo">

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
                </form>


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-toggle="modal" data-bs-target="#editlandlord">Close</button>
                <button type="button" class="btn btn-primary submit-edit-profile">Update Profile</button>
            </div>

        </div>
    </div>
</div>



@include('dashboard.profilescript')
@endsection
