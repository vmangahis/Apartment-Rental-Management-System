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
<!---<div class="search-add">
  <div class="row g-3 ms-3">
      <h3>Search By:</h3>
      <div class="col-auto fs-4">
          <select name="search-option" id="room-search-option" @if(!$room->count())disabled value="none" @endif>
              <option value="none">None</option>
              <option value="room_id">Room ID</option>
              @if(Route::is('rooms/occupied'))
              <option value="occupant_id">Occupant ID</option>
                  @endif
          </select>
      </div>


      <div class="col-auto">
      <input type="text" class="form-control room-search-input">
      </div>
  </div> --->

@if(Route::is('room'))
<div class="search-add">
  <button type="button" class='btn btn-primary fs-5 addroombutton d-block mx-auto mr-2'>Add Room</button>
</div>
@endif

<!---- Delete Room --->
<div class="modal fade" id="deleteRoomModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRoom">Delete Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to remove this room?
            </div>
            <div class="modal-footer">
                <form class="deleteRoomForm">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary confirmDeleteRoom">Remove Room</button>
                </form>
            </div>
        </div>
    </div>
</div>


  <table class="table room-table">
  <thead>
    <tr class = "room-table-header">
      <th scope="col">Room ID</th>
      <th scope="col">Occupant ID</th>
      <th scope="col">Occupant Surname</th>
        <th scope="col">Occupant First Name</th>
      <th scope="col">Status</th>
        @if(Route::is('room'))
      <th scope="col">Actions</th>
            @endif
    </tr>
  </thead>
  <tbody class = "room-body" id="room-body">
    @if(count($room)>0)
    @foreach($room as $rm)
    <tr id = "{{$rm->room_number}}">
      <th scope="row">{{$rm->room_number}}</th>


      <td>@if($rm->tenant_id != 0){{$rm->tenant_id}}@else No Occupant @endif</td>
        <td>@if($rm->tenant_id != 0){{$rm->tenant->surname}} @else - @endif</td>
        <td>@if($rm->tenant_id != 0){{$rm->tenant->firstname}} @else - @endif</td>


      <td>{{$rm->status}}</td>
        @if($rm->room_number == $allRoom && Route::is('room'))
      <td>
        <button class="btn btn-primary fs-4 deleteRoom" id="{{$rm->room_id}}">Remove Room</button>
      </td>

        @else
            <td></td>
            @endif
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
