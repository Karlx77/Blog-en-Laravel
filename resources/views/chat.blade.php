@extends('layouts.appCooper')

@section('content')
    <div id ="pagina">
        <div class="row">
            <div class="col-md-7"><br><br><br><br>
                <img class="rounded mx-auto d-block" src="{{url('images/doctor.png')}}" style="height:400px;width:400px; ">
            </div>
            <div class="col-md-3" style="background-color: rgba(0, 0, 0, 0.5);color:white;"><br>
                <iframe
                    allow="microphone;"
                    width="350"
                    height="430"
                    src="https://console.dialogflow.com/api-client/demo/embedded/243c2e94-6247-4d90-9339-32119605f8f1">
                </iframe>
            </div>
        </div>

    </div>
@endsection

