<h6 class="navbar-heading text-muted">
 @if (auth()->user()->role=='admin')
    Gestionar Datos
@else
    Menu
@endif
</h6>
<!-- Navigation -->

<ul class="navbar-nav">
    @if (auth()->user()->role=='admin')
    <li class="nav-item">
    <a class="nav-link" href="/home">
        <i class="ni ni-tv-2 text-yellow"></i> Dashboard
    </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ url('/specialities')}}">
        <i class="ni ni-planet text-blue"></i> Epecialidades
    </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ url('/doctors')}}">
        <i class="ni ni-single-02 text-orange"></i> Medicos
    </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ url('/patients')}}">
        <i class="ni ni-satisfied text-info"></i> Pacientes
    </a>
    @elseif(auth()->user()->role=='doctor')
            <li class="nav-item">
            <a class="nav-link" href="/schedule">
                <i class="ni ni-calendar-grid-58 text-danger"></i> Gestionar Horario
            </a>
            </li>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ url('/specialities')}}">
                <i class="ni ni-time-alarm text-primary"></i> Mis citas
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ url('/patients')}}">
                <i class="ni ni-satisfied text-info"></i>Mis Pacientes
            </a>
            </li>
    @else {{--Patient--}}
    <li class="nav-item">
            <a class="nav-link" href="/home">
                <i class="ni ni-send text-danger"></i> Reservar cita
            </a>
            </li>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ url('/specialities')}}">
                <i class="ni ni-time-alarm text-primary"></i> Mis citas
            </a>
            </li>
    @endIf
    <li class="nav-item">
    <a class="nav-link" href="" onclick="event.preventDefault(); document.getElementById('formLogout').submit();" >
        <i class="ni ni-key-25 text-dark"></i> Cerrar Sesion
    </a>
    <form action="{{ route('logout')}}" method="POST" style="display: none;" id="formLogout">
    @csrf

    </form>

</ul>
@if (auth()->user()->role=='admin')
<!-- Divider -->
<hr class="my-3">
<!-- Heading -->
<h6 class="navbar-heading text-muted">Reportes</h6>
<!-- Navigation -->
<ul class="navbar-nav mb-md-3">
    <li class="nav-item">
    <a class="nav-link" href="#">
        <i class="ni ni-collection text-yellow"></i> Frecuencia de citas
    </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="#">
        <i class="ni ni-spaceship text-red"></i> Medicoas mas actvios
    </a>

</ul>
@endif
