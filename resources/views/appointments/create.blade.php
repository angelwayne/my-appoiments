@extends('layouts.panel')


@section('content')

<div class="card shadow">
<div class="card-header border-0">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="mb-0">Nueva Cita</h3>
    </div>
    <div class="col text-right">
    <a href="{{ url('/patients')}}" class="btn btn-sm btn-warning">
          Cancelar y volver
      </a>
    </div>
  </div>
</div>
<div class="table-responsive">
  <!-- Projects table -->
 <div class="card-body">
     @if ($errors->any())

            @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                 {{ $error }}
            </div>
            @endforeach

     @endif
    <form action="{{ url('appointments')}}" method="POST">
        @csrf

       <div class="form-group">
           <label for="description">📝 Descripcion</label>
           <input class="form-control"  placeholder="Describe brevemente el motivo de la consulta"
            type="text" name="description" id="description">
       </div>
       <div class="form-row">
        <div class="form-group col-md-6">
               <label for="specilty">📑 Especialidad</label>
               <select name="specialty_id" id="specialty" class="form-control" required>
                <option value="">Seleccionar especialidad</option>
                @foreach ($specialties as $specialty)
               <option value="{{$specialty->id}}">{{$specialty->name}}</option>
                @endforeach
               </select>
        </div>
           <div class="form-group col-md-6">
               <label for="doctor">👨‍⚕️ Doctor</label>
               <select name="doctor_id" id="doctor" class="form-control">

            </select>
           </div>
        </div>
           <div class="form-group">
                <label for="fecha">📅 Fecha</label>
                <input type="text" name="fecha" class="form-control datepicker" value="{{ date('Y-m-d') }}"
                id="date"
                data-date-format="yyyy-mm-dd"
                data-date-start-date="{{ date('Y-m-d') }}"
                data-date-end-date="+30d" >
            </div>
            <div class="form-group">
                    <label for="hora">⌚ Hora de Atencion</label>
                    <div id="hours" >
                        <div class="alert alert-info" role="alert">
                            Selecciona un medico y fecha para ver sus horarios disponibles.
                        </div>
                    </div>
            </div>
            <div class="form-group">
                <label for="type">🀄 Tipo de Consulta</label>
                <br>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="type1" cheked name="type" class="custom-control-input">
                    <label class="custom-control-label" for="type1">Consulta</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="type2" name="type" class="custom-control-input">
                    <label class="custom-control-label" for="type2">Analisis Clinicos</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="type3" name="type" class="custom-control-input">
                    <label class="custom-control-label" for="type3">Cirugia</label>
                </div>
        </div>
            <div class="form-group">
                    <label for="phone">📱 Telefono</label>
                    <input type="text" name="phone" id="name" value="{{ old('phone') }}" class="form-control" >
            </div>

    <button type="submit" class="btn btn-primary">
        Guardar
    </button>
    </form>
 </div>
</div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('/js/appointments/create.js') }}"></Script>
@endsection
