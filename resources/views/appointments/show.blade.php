@extends('layouts.panel')


@section('content')

<div class="card shadow">
<div class="card-header border-0">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="mb-0">Cita #{{ $appointment->id}} </h3>
    </div>
  </div>
</div>
    <div class="card-body">
        <ul>
            <li>
                <strong>Fecha: </strong>{{ $appointment->schedule_date}}
            </li>
            <li>
                <strong>Hora: </strong>{{ $appointment->schedule_time_12}}
            </li>
            <li>
                <strong>Doctor: </strong>{{ $appointment->doctor->name}}
            </li>
            <li>
                <strong>Especialidad </strong>{{ $appointment->specialty->name}}
            </li>
            <li>
                <strong>Tipo: </strong>{{ $appointment->type}}
            </li>
            <li>
                <strong>Estdo: </strong>
            @if ($appointment->status == 'Cancelada')
                <span class="badge badge-danger">Cancelada</span>
            @else
                <span class="badge badge-success">{{$appointment->status}}</span>
            @endif
            </li>
        </ul>

        <div class="alert alert-warning">
            <p>Acerca de la cancelacion:</p>
            <ul>
                @if($appointment->cancellation)
                    <li>
                        <strong> Motivo de la cancelacion: </strong>
                        {{$appointment->cancellation->justification}}
                    </li>
                    <li>
                        <strong> Fecha de la cancelacion: </strong>
                        {{$appointment->cancellation->created_at}}
                    </li>
                    <li>
                        <strong>  Quien canceloo la cita?  </strong>
                        {{$appointment->cancellation->cancelled_by->name}}
                    </li>
                @else
                    <li> Esta cita fue cancelada antes de su confirmacion</li>
                @endif
            </ul>
    </div>
    <a class="btn btn-instagram" href="{{ url('/appointments')}}">Volver</a>
    </div>
</div>

@endsection
