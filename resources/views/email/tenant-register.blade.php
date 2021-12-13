@component('mail::message')
# Hi <span class="tenant-firstname">{{$first}}</span>

This email serves as confirmation of your rent to <span class="owner-name">{{$landlordSurname}}</span> apartment dated <span class="rent-date">{{$date}}</span>.Your room number is <span class="room-number">{{$room_num}}</span>.
Your monthly payment is <span class="monthly">{{$monthly}}</span>. If you don't recognize this activity, please feel free to disregard this message.


Thanks,<br>
<span class="owner-surname">{{$landlordSurname}}</span>
@endcomponent
