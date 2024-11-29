@extends('layouts.backend.app')
@section('title')
   Details - {{ $houseDB->address }}
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card mt-5">
                    <div class="card-header">
                      <div class="d-flex justify-content-between">
                          <div>
                              <h3><strong>House Details</strong></h3>
                          </div>
                          <div>
                              <a class="btn btn-danger" href="{{ route('landlord.house.index') }}"> Back</a>
                          </div>
                      </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Featured Image</th>
                                    <td><img src="{{$houseDB->getFirstMediaUrl('featured_image', 'thumb')}}" / width="120px"></td>
                                </tr>

                                <tr>
                                    <th>Address</th>
                                    <td>{{ $houseDB->address }}</td>
                                </tr>
                                <tr>
                                    <th>Area</th>
                                    <td>{{ $houseDB->area->name }}</td>
                                </tr>
                                <tr>
                                    <th>Owner</th>
                                    <td>{{ $houseDB->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Contact</th>
                                    <td>{{ $houseDB->contact }}</td>
                                </tr>
                                <tr>
                                    <th>Number of rooms</th>
                                    <td>{{ $houseDB->number_of_room }}</td>
                                </tr>

                                <tr>
                                    <th>Description</th>
                                    <td>{{ $houseDB->description }}</td>
                                </tr>

                                <tr>
                                    <th>House Type</th>
                                    <td>{{ $houseDB->house_type }}</td>
                                </tr>

                                <tr>
                                    <th>Tiles</th>
                                    <td>{{ $houseDB->tiles }}</td>
                                </tr>

                                <tr>
                                    <th>Gypsum</th>
                                    <td>{{ $houseDB->gypsum }}</td>
                                </tr>

                                <tr>
                                    <th>Aluminium Windows</th>
                                    <td>{{ $houseDB->aluminium }}</td>
                                </tr>

                                <tr>
                                    <th>Kitchen</th>
                                    <td>{{ $houseDB->kitchen }}</td>
                                </tr>

                                <tr>
                                    <th>Air Conditioner</th>
                                    <td>{{ $houseDB->ac }}</td>
                                </tr>

                                <tr>
                                    <th>Luku</th>
                                    <td>{{ $houseDB->luku }}</td>
                                </tr>

                                <tr>
                                    <th>Rent</th>
                                    <td>{{ number_format($houseDB->rent) }}</td>
                                </tr>

                                <tr>
                                    <th>Contract Ends At</th>
                                    <td>{{ \Carbon\Carbon::parse($houseDB->duedate)->format('d/m/Y') }}</td>
                                </tr>

                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if ($houseDB->status == 1)
                                            <span class="btn btn-success">Available</span>
                                        @else
                                            <span class="btn btn-danger">Not Available</span>
                                        @endif
                                </td>
                                </tr>
                            </table>
                          </div>

                          <div class="row gallery">
                            @foreach ($houseImages as $image)
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
