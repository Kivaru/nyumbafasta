@extends('layouts.backend.app')
@section('title')
   Details - {{ $property->address }}
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card mt-5">
                    <div class="card-header">
                      <div class="d-flex justify-content-between">
                          <div>
                              <h3><strong>Property Details</strong></h3>
                          </div>
                          <div>
                              <a class="btn btn-danger" href="{{ route('admin.property.index') }}"> Back</a>
                          </div>
                      </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Featured Image</th>
                                    <td><img src="{{$property->getFirstMediaUrl('featured_image', 'thumb')}}" / width="120px"></td>
                                </tr>

                                <tr>
                                    <th>Address</th>
                                    <td>{{ $property->address }}</td>
                                </tr>
                                <tr>
                                    <th>Area</th>
                                    <td>{{ $property->area->name }}</td>
                                </tr>
                                <tr>
                                    <th>Owner</th>
                                    <td>{{ $property->owner }}</td>
                                </tr>
                                <tr>
                                    <th>Contact</th>
                                    <td>{{ $property->contact }}</td>
                                </tr>

                                <tr>
                                    <th>Description</th>
                                    <td>{{ $property->description }}</td>
                                </tr>

                                <tr>
                                    <th>Property Type</th>
                                    <td>{{ $property->property_type }}</td>
                                </tr>

                                <tr>
                                    <th>Property Area Sqm</th>
                                    <td>
                                        @if ($property->sqm)
                                            <span class="btn btn-success">{{$property->sqm}}</span>
                                        @else
                                            <span class="btn btn-danger">Not Specified</span>
                                        @endif
                                </td>
                                </tr>


                                <tr>
                                    <th>Price</th>
                                    <td>{{ number_format($property->price) }}</td>
                                </tr>

                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if ($property->status == 1)
                                            <span class="btn btn-success">For Sale</span>
                                        @else
                                            <span class="btn btn-danger">Sold</span>
                                        @endif
                                </td>
                                </tr>
                            </table>
                          </div>

                          <div class="row gallery">
                            @foreach ($propertyImages as $image)
                                       <div class="col-md-3">
                                           <a href="{{ $image->getUrl() }}">
                                                       <img  src="{{ $image->getUrl() }}" class="img-fluid m-2" style="height: 200px;width: 100%; ">
                                           </a>
                                       </div>
                            @endforeach
                       </div>
                    </div>

                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container -->
 @endsection


 @section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.js"></script>
<script>
   window.addEventListener('load', function() {
        baguetteBox.run('.gallery', {
            animation: 'fadeIn',
            noScrollbars: true
        });
   });
</script>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.css">
@endsection
