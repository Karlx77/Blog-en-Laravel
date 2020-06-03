@extends('layouts.appCooper')

@section('content')
<div id ="pagina">
    <div class="row">
        <div class="col-md-6"><br><br><br><br>
            <img class="rounded mx-auto d-block" src="{{url('images/doctor.png')}}" style="height:400px;width:400px; ">
        </div>
        <div class="col-md-4" style="background-color: rgba(0, 0, 0, 0.5);color:white;"><br><br><br><br>
            <br><br>
            <h1>Hola, soy Cooper</h1><br>
            <h3>Mi trabajo es ayudar a identificar cualquier síntoma médico sobre el Covid-19 que puedas tener y mantenerte saludable.</h3>
        </div>
    </div>
</div>
@endsection
