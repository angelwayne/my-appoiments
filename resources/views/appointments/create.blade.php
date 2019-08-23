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
    <form action="{{ url('patients')}}" method="POST">
        @csrf
        <div class="form-group">
               <label for="specilty">📑 Especialidad</label>
               <select name="specialty_id" id="specialty" class="form-control" required>
                <option value="">Seleccionar especia</option>
                @foreach ($specialties as $specialty)
               <option value="{{$specialty->id}}">{{$specialty->name}}</option>
                @endforeach
               </select>
        </div>

           <div class="form-group">
               <label for="doctor">🤵 Doctor</label>
               <select name="doctor_id" id="doctor" class="form-control">

            </select>
           </div>
           <div class="form-group">
                <label for="fecha">📅 Fecha</label>
                <input type="text" name="fecha" class="form-control datepicker"
                 value="{{ date('Y-m-d') }}" data-date-format="yyyy-mm-dd" 
                 data-date-start-date="{{ date('Y-m-d') }}" data-date-end-date="+30d" >
            </div>
            <div class="form-group">
                    <label for="hora">⌚ Hora de Atencion</label>
                    <input type="text" name="hora" id="name"
            class="form-control" >
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
<Script>
    let $doctor;
    $(function () {
        const $specialty =  $('#specialty');
        $doctor=$('#doctor');

       $specialty.change(() =>{
        const specialtyId = $specialty.val()
        const url = `/specialties/${specialtyId}/doctors`;
        $.getJSON(url, onDoctorsLoaded);
    });
});

    function onDoctorsLoaded(doctors) {
        let htmlOption='';
           doctors.forEach(doctor => {
               htmlOption += `<option value="${doctor.id}">${doctor.name}</option>`;
           });
    $doctor.html(htmlOption)
    }
</Script>
@endsection
