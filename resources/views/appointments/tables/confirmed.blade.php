<div class="table-responsive">
        <!-- Projects table -->
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
        <tr>
            <th scope="col">Description</th>
            <th scope="col">Especialidad</th>
            @if ($role == 'patient')
            <th scope="col">Doctor </th>
            @elseif ($role == 'doctor')
            <th scope="col">Paciente </th>
            @endif
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Tipo</th>
            <th scope="col">Opciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($confirmedAppointments as $appointment)
        <tr>
            <th scope="row">
            {{ $appointment->description}}
            </th>
            <td>
            {{$appointment->specialty->name}}
            </td>
            @if ($role == 'patinet')
            <td>
                {{$appointment->doctor->name}}
            </td>
            @elseif ($role == 'doctor')
            <td>
                {{$appointment->patient->name}}
            </td>
            @endif
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
            @if ($role == 'admin')
                <a  class="btn btn-sm btn-info" title="cancelar cita"
                href="{{ url('/appointments/'.$appointment->id) }}" >
                    📑 Ver
                </a>
            @endif
                <a  class="btn btn-sm btn-warning" title="cancelar cita"
                href="{{ url('/appointments/'.$appointment->id.'/cancel') }}" >
                    ❌ Cancelar
                </a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="card-body">
        {{ $confirmedAppointments->links() }}
</div>

