<div class="table-responsive">
        <!-- Projects table -->
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
        <tr>
            <th scope="col">Description</th>
            <th scope="col">Especialidad</th>
            <th scope="col">Doctor </th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Tipo</th>
            <th scope="col">Opciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($pendingAppointments as $appointment)
        <tr>
            <th scope="row">
            {{ $appointment->description}}
            </th>
            <td>
            {{$appointment->specialty->name}}
            </td>
            <td>
            {{$appointment->doctor->name}}
            </td>
            <td>
            {{$appointment->schedule_date}}
            </td>
            <td>
            {{$appointment->schedule_time_12}}
            </td>
            <td>
            {{$appointment->type}}
            </td>


            <td>
            <form action="{{ url('/appointments/'.$appointment->id.'/cancel')}}"
                 method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger" title="cancelar_cita">
                    ❌ Cancelar
                </button>
            </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="card-body">
        {{ $pendingAppointments->links() }}
</div>

