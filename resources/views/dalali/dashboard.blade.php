@extends('layouts.backend.app')
@section('title')
    Landlord Dashboard
@endsection
<style>
    .welcome{
        padding: 10px;
    }
    .icon{
        color: rgb(0, 0, 0) !important;
        font-size:55px !important;
        padding-bottom: 20px;
    }


    .col-md-3{
        background-color: #eb8000;
        transition: 1s;
        height: 200px;
        padding: 20px;
        margin: 20px 33px; 
        border-radius: 50px 20px;
        
    }
    .number{
        color:#032626;
    }
    .boxs{
        margin-top: 30px;
        
    }

    .col-md-3:hover{
        background: rgb(177, 81, 1)
    }
 </style> 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 welcome text-center my-4">
            <h1 class="name">Welcome to Dalali Panel - <span style="padding: 5px;color:black;background:#eb8000;border-radius: 20px 20px 20px 20px ;font: size 2px;vw;"> {{ Auth::user()->name }}</span></h1>  
        </div>
    </div>
    <div class="row text-center boxs">
        <div class="col-md-3">
            <i class="fa fa-map-marker icon" aria-hidden="true"></i>
                <h3 class="number">Areas</h3>
                <h3 class="number"><span class="counter">{{ $areas->count() }}</span></h3>
        </div>
        <div class="col-md-3">
            <i class="fa fa-home icon" aria-hidden="true"></i>
            <h3 class="number">Your Houses</h3>
            <h3 class="number"><span class="counter">{{ $houses->count() }}</span></h3>
        </div>
        <div class="col-md-3">
            <i class="fas fa-users-cog icon"></i>
            <h3 class="number">Renters</h3>
            <h3 class="number"><span class="counter">{{ $renters->count() }}</span></h3>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="{{ asset('backend/js/jquery.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.counterup.min.js') }}"></script>
<script>
    $('.counter').counterUp({
        delay: 100,
        time: 2000
    });
</script>
    
@endsection
