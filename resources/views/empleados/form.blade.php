
<h1>{{$modo}} empleado</h1>

@if(count($errors)>0)
  <div class="aler alert-primary" role="alert">
  <ul>
    
  @foreach( $errors->all() as $error)
   <li>{{$error}}</li>
  @endforeach
  </ul>
  </div>
@endif
    <!-- en CREATE los campos no existen, se pregunta con isset, se pone vacío en CREATE-->
        <!--<input class="form-control mb-2" type="text" name="Nombre" placeholder="Nombre" value="{{ isset($empleado->Nombre)?$empleado->Nombre:''}}" class="fila minimargen">-->

    <!-- OLD, para recuperar el texto cuando saca alertas o regresa pa tra-->
    <input class="form-control mb-2" type="text" name="Nombre" placeholder="Nombre" value="{{ isset($empleado->Nombre)?$empleado->Nombre:old('Nombre') }}" class="fila minimargen">


    <input class="form-control mb-2" type="text" name="Apellido" placeholder="Apellido" value="{{ isset($empleado->Apellido)?$empleado->Apellido:old('Apellido')}}" class="fila minimargen">

    <input class="form-control mb-2" type="text" name="Email" placeholder="Email" value="{{ isset($empleado->Email)?$empleado->Email:old('Email')}}" class="fila minimargen">

    <input class="form-control mb-2" type="file" name="Foto" placeholder="Foto" value="" class="fila minimargen">
    @if(isset($empleado -> Foto))
    {{ $empleado->Foto}}  
    <img src="storage/uploads/public/{{ $empleado->Foto}}" alt="">
   <img src="{{asset('storage').'/'.$empleado->Foto }}" alt="" style="width: 200px;">
    <!-- para que funcione: php artisan storage:link-->
    @endif


  <div class="fila">
      <div class="cols">
    <input type="submit" value="{{$modo}} datos" class="btn btn-primary">


    <a href="{{url('empleado')}}" class="btn btn-seondary">Regresar</a></div></div>