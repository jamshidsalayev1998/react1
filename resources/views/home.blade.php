@extends('layouts.app')

@section('content')
    <style>
        .shadow {
            -webkit-box-shadow: 12px 0px 38px 0px rgba(0, 0, 0, 0.79);
            box-shadow: 12px 0px 38px 0px rgba(0, 0, 0, 0.79);
        }

        .hover-shadow:hover {
            -webkit-box-shadow: 0px 0px 14px 0px #000000;
            box-shadow: 0px 0px 14px 0px #000000;
        }

        .clicked-shadow {
            -webkit-box-shadow: 0px 0px 14px 0px #000000;
            box-shadow: 0px 0px 14px 0px #000000;
            background-color: #28b3ff;
            color: white;
            font-weight: bold;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center" id="example">
        </div>
    </div>
@endsection
