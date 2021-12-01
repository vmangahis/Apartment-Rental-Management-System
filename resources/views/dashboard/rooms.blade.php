@extends('layouts.app')

@section('content')

<div class="rooms-header d-flex justify-content-center">
  <h1 class="text-center main-header m-4">Rooms</h1>
  <div class="tab-nav d-flex flex-column align-items-center justify-content-around">
      <button class="btn btn-primary" onClick="location.href = '/rooms'">Vacant</button>
      <button class="btn btn-primary" onClick="location.href = '/rooms/occupied'">Occupied</button>
  </div>
</div>

<!---- Search Room ------>
<div class="search-add">
  <div class="row g-3 ms-3">
      <h3>Search By:</h3>
      <div class="col-auto fs-4">
          <select name="search-option" id="room-search-option" @if(!$room->count())disabled value="none" @endif>
              <option value="none">None</option>
              <option value="room_id">Room ID</option>
              <option value="occupant_id">Occupant ID</option>
          </select>
      </div>


      <div class="col-auto">
      <input type="text" class="form-control room-search-input">
      </div>

  </div>



  <button type="button" class='btn btn-primary fs-5 addroombutton'>Add Room</button>
</div>


  <table class="table room-table">
  <thead>
    <tr class = "room-table-header">
      <th scope="col">Room ID</th>
      <th scope="col">Occupant ID</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody class = "room-body" id="room-body">
    @if(count($room)>0)
    @foreach($room as $rm)
    <tr id = "{{$rm->room_id}}">
      <th scope="row">{{$rm->room_id}}</th>


      <td>@if($rm->tenant_id != 0){{$rm->tenant_id}} @else No Occupant @endif</td>



      <td>{{$rm->status}}</td>
      <td class = "">
        <button class="btn btn-primary fs-4">Remove Room</button>
      </td>
    </tr>
    @endforeach

    @else
    <tr>
      <td colspan="42">
      @if(Route::is('room'))
      <h1 class='text-center'>No Vacant Rooms</h1>
      @else
      <h1 class='text-center'>No Occupied Rooms</h1>
      @endif
      </td>

    </tr>
    @endif

  </tbody>
</table>

@include('script.roomscript')
    @endsection
