<h6 class="navbar-heading text-muted">Gestionar Datos</h6>
<!-- Navigation -->

<ul class="navbar-nav">
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
    <li class="nav-item">
    <a class="nav-link" href="" onclick="event.preventDefault(); document.getElementById('formLogout').submit();" >
        <i class="ni ni-key-25 text-orange"></i> Cerrar Sesion
    </a>
    <form action="{{ route('logout')}}" method="POST" style="display: none;" id="formLogout">
    @csrf

    </form>

</ul>
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
