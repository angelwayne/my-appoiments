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
       {{--
        @if (session('notifiaction'))
        <div class="alert alert-success" role="alert">
            {{ session('notifiaction') }}
         </div>
         @endif
         --}}
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
       <input class="form-control" value="{{ old('description')}}"  placeholder="Describe brevemente el motivo de la consulta"
            type="text" name="description" id="description" required>
       </div>
       <div class="form-row">
        <div class="form-group col-md-6">
               <label for="specilty">📑 Especialidad</label>
               <select name="specialty_id" id="specialty" class="form-control" required>
                <option value="">Seleccionar especialidad</option>
                @foreach ($specialties as $specialty)
               <option value="{{$specialty->id}}" @if (old('specialty_id')==$specialty->id)
                   seleted
               @endif>{{$specialty->name}}</option>
                @endforeach
               </select>
        </div>
           <div class="form-group col-md-6">
               <label for="doctor">👨‍⚕️ Doctor</label>
               <select name="doctor_id" id="doctor" class="form-control" required>
                @foreach ($doctors as $doctor)
               <option value="{{$doctor->id}}" @if (old('doctor_id')==$doctor->id)
                   seleted
               @endif>{{$doctor->name}}</option>
               @endforeach
            </select>
           </div>
        </div>
           <div class="form-group">
                <label for="fecha">📅 Fecha</label>
                <input type="text" name="schedule_date" class="form-control datepicker"
                value="{{ old('schedule_date',date('Y-m-d')) }}"
                id="date"
                data-date-format="yyyy-mm-dd"
                data-date-start-date="{{ date('Y-m-d') }}"
                data-date-end-date="+30d" >
            </div>
            <div class="form-group">
                    <label for="hora">⌚ Hora de Atencion</label>
                    <div id="hours" >
                        @if ($intervals)
                            @foreach ($intervals['morning'] as $key=> $interval)
                                <div class="custom-control custom-radio mb-3">
                                    <input type="radio" value="{{ $interval['start']}}" id="intervalMorning{{$key}}"
                                    name="schedule_time" class="custom-control-input" required>
                                    <label class="custom-control-label" for="intervalMorning{{$key}}">{{ $interval['start']}} - {{ $interval['end']}}</label>
                                </div>
                            @endforeach
                            @foreach ($intervals['afternoon'] as $key=> $interval)
                                <div class="custom-control custom-radio mb-3">
                                <input type="radio" value="{{ $interval['start']}}" id="intervalAfternoon{{$key}}"
                                     name="schedule_time" class="custom-control-input" required>
                                    <label class="custom-control-label" for="intervalAfternoon{{$key}}">{{ $interval['start']}} - {{ $interval['end']}}</label>
                                </div>
                            @endforeach
                           @else
                           <div class="alert alert-info" role="alert">
                                Selecciona un medico y fecha para ver sus horarios disponibles.
                            </div>
                        @endif

                    </div>
            </div>
            <div class="form-group">
                <label for="type">🀄 Tipo de Consulta</label>
                <br>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" value="Consulta" id="type1" checked name="type" class="custom-control-input"
                    @if ( old('type','Consulta')=='Consulta')
                        checked
                    @endif>
                    <label class="custom-control-label" for="type1">Consulta</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" value="Analisis Clinicos" id="type2" name="type" class="custom-control-input"
                    @if ( old('type')=='Analisis Clinicos')
                        checked
                    @endif>
                    <label class="custom-control-label" for="type2">Analisis Clinicos</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" value="Cirugias" id="type3" name="type" class="custom-control-input"
                    @if ( old('type')=='Cirugias')
                       checked
                    @endif>
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
