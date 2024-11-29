@extends('layouts.backend.app')
@section('title')
   Edit Property - {{ $property->address }}
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card mt-5">
                    <div class="card-header">
                      <h3 class="card-title float-left"><strong>Edit Property</strong></h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    @include('partial.errors')

                    <form action="{{ route('admin.property.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <input type="text" name="id" value="{{ $property->id }}" hidden>

                            <div class="form-group">
                                <label for="name">Owner's Name: </label>
                                <input type="text" class="form-control" placeholder="Owner's Name" id="name" name="name" value="{{ old('name', $property->name) }}" required>
                              </div>

                              <div class="form-group">
                                <label for="contact">Owner's Contact: </label>
                                <input type="tel" class="form-control" placeholder="Owner's Contact" id="contact" name="contact" value="{{ old('contact', $property->contact) }}" required>
                              </div>

                            <div class="form-group">
                                <label for="region">Region(Mkoa) </label>
                                <select name="region" class="form-control" id="region" required>
                                    <option value="">select an region</option>
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}"  {{ old('region') == $region->id ? 'selected' : '' }}
                                                @isset($property)
                                                    {{ $property->region_id == $region->id ? 'selected' : '' }}
                                                @endisset
                                            >
                                        {{ $region->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">District(Wilaya) </label>
                                <select name="district" class="form-control" id="district" required>
                                    <option value="">select an district</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}"  {{ old('district') == $district->id ? 'selected' : '' }}
                                                @isset($property)
                                                    {{ $property->district_id == $district->id ? 'selected' : '' }}
                                                @endisset
                                            >
                                        {{ $district->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="area_id">Area(Kata) </label>
                                    @foreach ($areas as $area)

                                    @if($area->id == $property->area_id)

                                    <input type="text" class="form-control" placeholder="Type area(Andika Kata)"
                                    name="area_search" value="{{ $area->name }}" required>

                                    @endif
                                    @endforeach
                                </select>
                            </div>


					        <div class="form-group">
					          <label for="address">Address: </label>
					          <input type="text" class="form-control" placeholder="Enter address" id="address" name="address" value="{{ old('address', $property->address) }}" required>
                            </div>

                              <div class="form-group">
                                <label for="agent_id">House Availability </label>
                                <select name="status" class="form-control" id="status" required>
                                    @if ($property->status == 1)
                                    <option value="{{ $property->status }}">
                                    Available
                                </option>
                                    @else
                                    <option value="{{ $property->status }}">
                                    Not Available
                                </option>
                                @endif
                                <option value="1">For Sale</option>
                                <option value="0">Not Available</option>
                                </select>
                              </div>

                              <div class="form-group">
                                <label for="property_type">Property Type </label>
                                <select name="property_type" class="form-control" id="property_type" required>
                                    <option value="{{ $property->property_type }}">{{ $property->property_type }}</option>
                                    <option value="Nyumba">Nyumba</option>
                                    <option value="Kiwanja">Kiwanja</option>
                                    <option value="Shamba">Shamba</option>
                                    <option value="Godown">Godown</option>
                                </select>
                              </div>


                              <div class="form-group">
                                <label for="agent_id">Deed(Hati) </label>
                                <select name="deed" class="form-control" id="status" required>
                                    @if ($property->deed == 1)
                                    <option value="{{ $property->deed }}">
                                    Yes
                                </option>
                                    @else
                                    <option value="{{ $property->deed }}">
                                    No
                                </option>
                                @endif
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                                </select>
                              </div>

                              <div class="form-group">
                                <label for="price">Property Area Sqm: </label>
                                <input type="number" class="form-control" placeholder="sqm" id="sqm" name="sqm" value="{{ $property->sqm }}">
                            </div>

                            <div class="form-group">
                                <label for="number_o f_room">Description: </label>
                                <textarea type="text" class="form-control" placeholder="description" id="description" name="description" value="{{ old('description') }}">{{$property->description}}
                                </textarea>
                            </div>


                            <div class="form-group">
                                <label for="price">Price: </label>
                                <input type="number" class="form-control" placeholder="price" id="price" name="price" value="{{ $property->price }}" required>
                            </div>


                            <div class="row gallery">
                            <label for="featured_image">Featured Image Presents</label>
                            <a href="{{ $property->getFirstMediaUrl('featured_image', 'thumb') }}">
                                <img  src="{{ $property->getFirstMediaUrl('featured_image', 'thumb') }}" class="img-fluid m-2" style="height: 200px;width: 100%; ">
                            </a>

                       </div>

                            <div class="row gallery">
                            <label for="images">Other Images Present</label>

                            @foreach ($propertyImages as $image)
                                       <div class="col-md-3">
                                           <a href="{{ $image->getUrl() }}">
                                                       <img  src="{{ $image->getUrl() }}" class="img-fluid m-2" style="width: 100%; ">
                                           </a>
                                       </div>
                            @endforeach
                       </div>

                            <div class="form-group">
                                <label for="featured_image">Featured Image</label>
                                <input type="file" name="featured_image" class="form-control" id="featured_image">
                            </div>

                            <div class="form-group">
                                <label for="images">House Images</label>
                                <input type="file" name="images[]" class="form-control" multiple>
                            </div>


                            <div class="form-group">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <a href="{{ URL::previous() }}" class="btn btn-danger wave-effect" >Back</a>
                            </div>
                  </form>


                    </div>

                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container -->

    <script type="text/javascript">

        function searchSel() {
            var input = document.getElementById('realtxt').value;
            var list = document.getElementById('area_id');
            var listItems = list.options;

            if (input === '') {
                listItems[0].selected = true;
                return;
            }

            for (var i = 0; i < list.length; i++) {
                var val = list[i].value.toLowerCase();
                if (val.indexOf(input) == 0) {
                    list.selectedIndex = i;
                    return;
                }
            }
        }

        window.onload = function() {
            if (typeof jQuery === 'undefined') {
                // jQuery is NOT available
                console.log('not loaded');
            } else {

                $(document).ready(function() {

                    // $('.select2-options').select2();

                    $('#region').on('change', function(e) {
                        console.log(e);
                        var region_id = e.target.value;
                        // console.log(region_id);
                        //ajax
                        $.get('https://nyumbafasta.co.tz/landlord/ajax/district?region_id=' + region_id,
                            function(data) {
                                //success data
                                var district = $('#district').empty();
                                // console.log(district);
                                $('#district').append(
                                    '<option value="">Select District</option>');
                                $.each(data, function(create, districtObj) {
                                    var option = $('<option/>', {
                                        id: create,
                                        value: districtObj
                                    });
                                    district.append('<option value ="' + create + '">' +
                                        districtObj + '</option>');
                                });
                            });
                    });
                });

                $(document).ready(function() {
                    $('#district').on('change', function(e) {
                        console.log(e);
                        var district_id = e.target.value;
                        console.log(district_id);
                        //ajax
                        $.get('https://nyumbafasta.co.tz/landlord/ajax/area?area_id=' + district_id,
                            function(data) {
                                //success data
                                //    console.log(district_id);
                                var area = $('#area_id').empty();
                                $('#area_id').append('<option value="">Select Area</option>');
                                $.each(data, function(create, areaObj) {
                                    var option = $('<option/>', {
                                        id: create,
                                        value: areaObj
                                    });
                                    area.append('<option value ="' + areaObj + '">' +
                                        areaObj + '</option>');
                                });
                            });
                    });
                });


            }
        }
    </script>


 @endsection
