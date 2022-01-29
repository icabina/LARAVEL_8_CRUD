

@extends('layouts.app')
@section('content')
<div class="fila formulario">
    <div class="cols">
        <div class="col col_2">
     
            <form action="{{url('/empleado/'.$empleado->id)}}" method="post" enctype="multipart/form-data">


            @csrf 
            <!--llave para que laravel sepa que el formulario viene del mismo sistema-->

            {{method_field('PATCH')}}
            @include('empleados.form', ['modo' => 'Editar'])
            </form>
        </div>
    </div>
</div>

@endsection
