@extends('layouts.backend.app')
@section('title')
   Edit Profile
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card mt-5">
                    <div class="card-header">
                      <h3 class="card-title float-left"><strong>Edit Landlord Profile</strong></h3>
                  
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    @include('partial.errors')

                    <form action="{{ route('admin.landlord.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
					        <div class="form-group">
					          <label for="name">Name: </label>
					          <input type="text" class="form-control" placeholder="Name" id="name" name="name" value="{{ old('name', $profile->name) }}">
                            </div>

                            <div class="form-group">
                              <input hidden type="text" class="form-control" placeholder="landlord_id" id="landlord_id" name="landlord_id" value="{{$profile->id }}">
                          </div>

                            <div class="form-group">
                                <label for="contact">Contact: </label>
                                <input type="text" class="form-control" placeholder="contact" id="contact" name="contact" value="{{ old('contact', $profile->contact) }}">
                            </div>

                            <div class="form-group">
                              <label for="email">Email: </label>
                              <input type="email" class="form-control" placeholder="email" id="contact" name="email" value="{{ old('email', $profile->email) }}">
                          </div>

                          <div class="form-group">
                            <label for="password">Password: </label>
                            <input type="text" class="form-control" placeholder="Password" id="password" name="password" value="">
                          </div>

                            <div class="form-group">
                                <label for="image">Profile Picture</label>
                                <input type="file" name="image" class="form-control">
                            </div> 

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="{{ route('admin.profile.show') }}" class="btn btn-danger wave-effect" >Back</a>
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