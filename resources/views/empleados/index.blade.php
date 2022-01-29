@extends('layouts.app')
@section('content')


        <div class="fila">
    <div class="cols">
        <div class="col col_1">

            @if(Session::has('mensaje'))
            <div class="fila margen">
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{Session::get('mensaje')}}
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif

            <div class="fila margen">
            <a class="btn btn-primary mb-5" href="{{url('empleado/create')}}">Registrar nuevo empleado</a>         
            </div>  
            <table class="mb-5">
                <thead>
               <tr>
                   <th>#</th>
                   <th>Nombre</th>
                   <th>Apellido</th>
                   <th>Email</th>
                   <th>Foto</th>
                   <th>Acciones</th>
               </tr></thead>


               <tbody>
                   @foreach($empleados as $empleado)
                   <tr>
                      <td>{{ $empleado -> id }}</td>
                      <td><img src="{{asset('storage').'/'.$empleado->Foto }}" alt="" style="width: 200px;"></td>
                      <!-- para que funcione: php artisan storage:link-->
                      <td>{{ $empleado -> Nombre }}</td>
                      <td>{{ $empleado -> Apellido }}</td>
                      <td>{{ $empleado -> Email }}</td>
                      <td>
                          
                      <!--Editar-->
                      <a href="{{url('/empleado/'.$empleado->id.'/edit')}}" class="btn btn-warning">Edit</a>
                      
                      <!--Borrar-->
                        <form action="{{ url('/empleado/'.$empleado->id)}}" method="post" class="d-inline">
                        @csrf
                        {{ method_field('DELETE')}}
                            <input type="submit" class="btn btn-danger d-inline" onclick="return confirm('¿Quieres borrrar?')" value="Borrar">
                        </form>
                    </td>
                   </tr>
                   @endforeach
               </tbody>
            </table>

            {!! $empleados->links() !!}
        </div>
    </div>
</div>
@endsection