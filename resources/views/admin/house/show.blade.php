@extends('layouts.backend.app')
@section('title')
Details - {{ $house->address }}
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
                            <a class="btn btn-danger" href="{{ route('admin.house.index') }}"> Houses</a>
                            <a class="btn btn-danger" href="{{ route('admin.house.show', $house->id - 1) }}"> Back</a>
                            <a class="btn btn-danger" href="{{ route('admin.house.show', $house->id + 1) }}"> Next</a>
                        </div>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Verification Status</th>
                                <td>
                                    @if ($house->user->verified == 1)
                                    <span class="btn btn-success">Verified</span>
                                    @else
                                    <a href="{{ route('admin.landlord.verify', $house->user->id) }}"
                                        class="btn btn-danger">Verify</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Agent</th>
                                @foreach($agents as $agent)
                                @if($agent->id == $house->agent_id)
                                <td>{{ $agent->name }}</td>
                                @endif
                                @endforeach
                            </tr>
                            <tr>
                                <th>Added At</th>
                                <td>{{ $house->created_at->toFormattedDateString() }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $house->address }}</td>
                            </tr>

                            <tr>
                                <th>Area</th>
                                <td>{{ $house->area->name }}</td>
                            </tr>
                            <tr>
                                <th>Owner</th>
                                <td>{{ $house->user->name }}</td>
                            </tr>
                            <tr>
                                <th>Contact</th>
                                <td>{{ $house->contact }}</td>
                            </tr>
                            <tr>
                                <th>Number of rooms</th>
                                <td>{{ $house->number_of_room }}</td>
                            </tr>

                            <tr>
                                <th>House Type</th>
                                <td>{{ $house->house_type }}</td>
                            </tr>

                            <tr>
                                <th>Tiles</th>
                                <td>{{ $house->tiles }}</td>
                            </tr>

                            <tr>
                                <th>Gypsum</th>
                                <td>{{ $house->gypsum }}</td>
                            </tr>

                            <tr>
                                <th>Aluminium Windows</th>
                                <td>{{ $house->aluminium }}</td>
                            </tr>

                            <tr>
                                <th>Kitchen</th>
                                <td>{{ $house->kitchen }}</td>
                            </tr>

                            <tr>
                                <th>Fence</th>
                                <td>{{ $house->fence }}</td>
                            </tr>

                            <tr>
                                <th>Air Conditioner</th>
                                <td>{{ $house->ac }}</td>
                            </tr>

                            <tr>
                                <th>Luku</th>
                                <td>{{ $house->luku }}</td>
                            </tr>

                            <tr>
                                <th>Rent</th>
                                <td>{{ number_format($house->rent) }}</td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td>
                                    @if ($house->status == 1)
                                    <a href="{{ route('admin.house.status0', $house->id) }}"><span
                                            class="btn btn-success">Available</span></a>

                                    @else
                                    <a href="{{ route('admin.house.status1', $house->id) }}"><span
                                            class="btn btn-success">Not Available</span></a>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>


                  //  <p>Featured Image</p>
                   // <tr>
                       // <td><img src="{{$houseDB->getFirstMediaUrl('featured_image', 'thumb')}}" / width="500px"></td>
                   // </tr>

                   // <br>
                    <p>Images</p>
                    <div class="row gallery">
                        @foreach ($houseDB->media as $image)
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
