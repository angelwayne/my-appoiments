<div class="table-responsive">
        <!-- Projects table -->
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
        <tr>
            <th scope="col">Especialidad</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Estado</th>
            <th scope="col">Opciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($oldAppointments as $appointment)
        <tr>

            <td scope="row">
            {{$appointment->specialty->name}}
            </td>
            <td>
            {{$appointment->schedule_date}}
            </td>
            <td>
            {{$appointment->schedule_time_12}}
            </td>
            <td>
            {{$appointment->status}}
            </td>
            <td>
            <a class="btn btn-dribbble btn-sm" href="{{ url('/appointments/'.$appointment->id) }}">📑 Ver</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="card-body">
        {{ $oldAppointments->links() }}
</div>
