@extends('layouts.panel')


@section('content')

<div class="card shadow">
<div class="card-header border-0">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="mb-0">Nueva Medico</h3>
    </div>
    <div class="col text-right">
    <a href="{{ url('/doctors')}}" class="btn btn-sm btn-warning">
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
    <form action="{{ url('doctors')}}" method="POST">
        @csrf
        <div class="form-group">
               <label for="name">👤 Nombre del medico</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" required>
        </div>

           <div class="form-group">
               <label for="email">📧 Email</label>
               <input type="text" name="email" id="name" value="{{ old('email') }}" class="form-control" >
           </div>
           <div class="form-group">
                <label for="cedula">📝 Cedula</label>
                <input type="text" name="cedula" id="name" value="{{ old('cedula') }}" class="form-control" >
            </div>
            <div class="form-group">
                    <label for="address">🗺 Direccion</label>
                    <input type="text" name="address" id="name" value="{{ old('address') }}" class="form-control" >
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
