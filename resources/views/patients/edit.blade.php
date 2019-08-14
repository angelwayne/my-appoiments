@extends('layouts.panel')


@section('content')

<div class="card shadow">
<div class="card-header border-0">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="mb-0">Editar Paciente</h3>
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
    <form action="{{ url('patients/'.$patient->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
               <label for="name">👤 Nombre del Paciente</label>
        <input type="text" name="name" id="name" value="{{ old('name',$patient->name) }}" class="form-control" required>
        </div>

           <div class="form-group">
               <label for="email">📧 Email</label>
               <input type="text" name="email" id="name" value="{{ old('email',$patient->email) }}" class="form-control" >
           </div>
           <div class="form-group">
                <label for="cedula">📝 Cedula</label>
                <input type="text" name="cedula" id="name" value="{{ old('cedula',$patient->cedula) }}" class="form-control" >
            </div>
            <div class="form-group">
                    <label for="address">🗺 Direccion</label>
                    <input type="text" name="address" id="name" value="{{ old('address',$patient->address) }}" class="form-control" >
            </div>
            <div class="form-group">
                    <label for="phone">📱 Telefono</label>
                    <input type="text" name="phone" id="name" value="{{ old('phone',$patient->phone) }}" class="form-control" >
            </div>
            <div class="form-group">
                <label for="password">🔑 Contraseña</label>
                <input type="text" name="password" id="password" value="" class="form-control" >
                <p>Ingrese un valor solo si desea modificar la contraseña</p> 
            </div>
    <button type="submit" class="btn btn-primary">
        Guardar
    </button>
    </form>
 </div>
</div>
</div>

@endsection
