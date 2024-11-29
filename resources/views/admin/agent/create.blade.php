@extends('layouts.backend.app')
@section('title')
   Add Agent
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card mt-5">
                    <div class="card-header">
                      <h3 class="card-title float-left"><strong>Add Agent</strong></h3>
                  
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                  @include('partial.errors')
                    <form action="{{ route('admin.agent.post') }}" method="POST" >
					        @csrf
					        <div class="form-group">
					          <label for="name" style="color:#14455F;"> Agent's Name</label>
					          <input type="text" class="form-control" placeholder="Enter Agent name" id="name" name="name" value="{{ old('name') }}">
					        </div>

                  <div class="form-group">
					          <label for="phonenumber" style="color:#14455F;">Agent's Phone Number</label>
                    <input type="text" class="form-control" placeholder="Enter Agent phone number" id="phonenumber" name="phonenumber" value="{{ old('phonenumber') }}">
					        </div>

                  <div class="form-group">
					          <label for="email" style="color:#14455F;">Agent's Email</label>
                    <input type="text" class="form-control" placeholder="Enter Agent Email" id="name" name="email" value="{{ old('email') }}">
					        </div>
					      

                        <div class="form-group">
                                <button type="submit" class="btn btn-success">{{__('home.add')}} </button>
                                <a href="{{ route('admin.agent.index') }}" class="btn btn-danger wave-effect" >{{__('home.back')}}</a>
                        </div> 
                  </form>
                     
                      
                    </div>
                   
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container -->
 @endsection