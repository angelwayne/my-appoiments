@extends('layouts.panel')


@section('content')

<div class="card shadow">
<div class="card-header border-0">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="mb-0">Mis citas</h3>
    </div>
  </div>
</div>
<div class="card-body">

    @if (session('notification'))
    <div class="alert alert-success" role="alert">
        {{ session('notification') }}
     </div>
     @endif

     <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#confirmed-appointment" role="tab" aria-controls="home" aria-selected="true">Mis proximas ciatas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#pending-appointment" role="tab" aria-controls="profile" aria-selected="false">Citas por confirmar</a>
            </li>
            <li class="nav-item">
                 <a class="nav-link" data-toggle="tab" href="#old-appointment" role="tab" aria-controls="profile" aria-selected="false">Historial de citas atendidas</a>
            </li>

     </ul>
</div>

<div class="tab-content" id="myTabContent">

    <div class="tab-pane fade show active" id="confirmed-appointment" role="tabpanel" aria-labelledby="home-tab">
            @include('appointments.tables.confirmed')
    </div>

    <div class="tab-pane fade" id="pending-appointment" role="tabpanel" aria-labelledby="profile-tab">
        @include('appointments.tables.pending')
    </div>

    <div class="tab-pane fade" id="old-appointment" role="tabpanel" aria-labelledby="profile-tab">
            @include('appointments.tables.old')
    </div>
</div>





</div>

@endsection
