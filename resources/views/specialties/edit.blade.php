@extends('layouts.panel')


@section('content')

<div class="card shadow">
<div class="card-header border-0">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="mb-0">Editar Especialidad</h3>
    </div>
    <div class="col text-right">
    <a href="{{ url('/specialities')}}" class="btn btn-sm btn-warning">
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
    <form action="{{ url('specialities/'.$specialty->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
               <label for="">Nombre de la Especialidad</label>
        <input type="text" name="name" id="name" value="{{ old('name', $specialty->name) }}" class="form-control" required>
        </div>

           <div class="form-group">
               <label for="">Descripcion</label>
               <input type="text" name="description" id="name" value="{{ old('description',$specialty->description) }}" class="form-control" >
           </div>
    <button type="submit" class="btn btn-primary">
        Guardar
    </button>
    </form>
 </div>
</div>
</div>

@endsection
