@extends('layouts.appCooper')

@section('content')
<div id ="pagina">
    <div class="row">
        <div class="col-md-6"><br><br><br><br>
            <img class="rounded mx-auto d-block" src="{{url('images/doctor.png')}}" style="height:400px;width:400px; ">
        </div>
        <div class="col-md-4" style="background-color: rgba(0, 0, 0, 0.5);color:white;"><br><br><br><br>
            <br><br>
            <h3>¿Aun no me conoces?</h3><br>
            <h5>Me llamo Cooper, y soy un chatbot dotado con inteligencia artificial.
               Mis instructoras me han enseñado a identificar todos los sintomas relacionados con el Covid-19.
               Si necesitas respuestas, ¡no dudes en preguntarme!.
            </h5>
        </div>
    </div>

</div>
@endsection
