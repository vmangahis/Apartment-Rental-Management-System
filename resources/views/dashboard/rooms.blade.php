@extends('layouts.app')

@section('content')

    <h1 class="text-center p-5">Rooms</h1>

    <p class ='fs-3 ms-3'>Sort Status by:</p>


  <div class = "room-settings ms-3 me-5">  
      <div class='form-container'>
        <div class="form-check form-check-inline fs-5">
          <input class="form-check-input" type="radio" name="roomstatus" id="flexRadioDefault1" checked>
          <label class="form-check-label" for="flexRadioDefault1">
          None
          </label>
      </div>
      <div class="form-check form-check-inline fs-5">
      <input class="form-check-input" type="radio" name="roomstatus" id="flexRadioDefault1">
      <label class="form-check-label" for="flexRadioDefault1">
      Occupied
      </label>
    </div>
    <div class="form-check form-check-inline fs-5">
    <input class="form-check-input" type="radio" name="roomstatus" id="flexRadioDefault1">
    <label class="form-check-label" for="flexRadioDefault1">
      Vacant
    </label>
  </div>
</div>

  <button type="button" class='btn btn-primary addroombutton'>Add Room</button>
</div>




    <table class="table">
  <thead>
    <tr>
      <th scope="col">Room ID</th>
      <th scope="col">Occupant ID</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @if(count($room)>0)
    @foreach($room as $rm)
    <tr id = "{{$rm->room_id}}">
      <th scope="row">{{$rm->room_id}}</th>
      <td>{{$rm->tenant_id}}</td>
      <td>{{$rm->status}}</td>
      <td class = "">
        <button class="btn btn-primary">Remove Room</button>
    </td>
    </tr>
    @endforeach

    @else
    <tr>
      <td colspan="42">
      <h1 class='text-center'>No Rooms</h1>     
      </td>
    </tr>
    @endif

   
   
  </tbody>
</table>
    @endsection
