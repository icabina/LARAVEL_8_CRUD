
@extends('layouts.app')
@section('content')
<div class="fila formulario">
    <div class="cols">
        <div class="col col_2">
    
            <form action="{{url('/empleado')}}" method="post" enctype="multipart/form-data" class="form-group">


            @csrf 
            <!--llave para que laravel sepa que el formulario viene del mismo sistema-->


       
            @include('empleados.form', ['modo' => 'Crear'])
            </form>
        </div>
    </div>
</div>

@endsection
