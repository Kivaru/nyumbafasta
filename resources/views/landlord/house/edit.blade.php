@extends('layouts.backend.app')
@section('title')
   Edit House - {{ $houseDB->address }}
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card mt-5">
                    <div class="card-header">
                      <h3 class="card-title float-left"><strong>Edit House</strong></h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    @include('partial.errors')

                    <form action="{{ route('landlord.house.update', $houseDB->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="region">Region(Mkoa) </label>
                                <select name="region" class="form-control" id="region" required>
                                    <option value="">select an region</option>
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}"  {{ old('region') == $region->id ? 'selected' : '' }}
                                                @isset($houseDB)
                                                    {{ $houseDB->region_id == $region->id ? 'selected' : '' }}
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
                                                @isset($houseDB)
                                                    {{ $houseDB->district_id == $district->id ? 'selected' : '' }}
                                                @endisset
                                            >
                                        {{ $district->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">Area(Kata) </label>
                                <select name="area_id" class="form-control" id="area_id" required>
                                    <option value="">select an area</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}"  {{ old('area') == $area->id ? 'selected' : '' }}
                                                @isset($houseDB)
                                                    {{ $houseDB->area_id == $area->id ? 'selected' : '' }}
                                                @endisset
                                            >
                                        {{ $area->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>


					        <div class="form-group">
					          <label for="address">Address: </label>
					          <input type="text" class="form-control" placeholder="Enter address" id="address" name="address" value="{{ old('address', $houseDB->address) }}" required>
                            </div>

                              <div class="form-group">
                                <label for="agent_id">Agent </label>
                                <select name="agent_id" class="form-control" id="agent_id" required>
                                    @foreach ($agents as $agent)
                                        <option value="{{ $agent->id }}"  {{ old('agent_id') == $agent->id ? 'selected' : '' }}
                                                @isset($agent)
                                                    {{ $houseDB->agent_id == $agent->id ? 'selected' : '' }}
                                                @endisset
                                            >
                                        {{ $agent->name }}
                                    </option>
                                    @endforeach
                                </select>
                              </div>

                              <div class="form-group">
                                <label for="agent_id">House Availability </label>
                                <select name="status" class="form-control" id="status" required>
                                    @if ($houseDB->status == 1)
                                    <option value="{{ $houseDB->status }}">
                                    Available
                                </option>
                                    @else
                                    <option value="{{ $houseDB->status }}">
                                    Not Available
                                </option>
                                @endif
                                <option value="1">Available</option>
                                <option value="0">Not Available</option>
                                </select>
                              </div>

                              <div class="form-group">
                                <label for="house_type">House Type </label>
                                <select name="house_type" class="form-control" id="house_type" required>
                                    <option value="{{ $houseDB->house_type }}">{{ $houseDB->house_type }}</option>
                                    <option value="Apartment">Apartment</option>
                                    <option value="Standalone">Standalone</option>
                                    <option value="Sitting Room With Master Bedroom">Sitting Room With Master Bedroom</option>
                                    <option value="Sitting Room With Bedroom">Sitting Room With Bedroom</option>
                                    <option value="Single Room">Single Room</option>
                                    <option value="Master Bedroom">Master Bedroom</option>

                                </select>
                              </div>

                            <div class="form-group">
                                <label for="number_of_room">Number of  rooms: </label>
                                <input type="number" class="form-control" placeholder="number_of_room" id="number_of_room" name="number_of_room" value="{{ old('number_of_room',$houseDB->number_of_room) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="number_o f_room">Description: </label>
                                <textarea type="text" class="form-control" placeholder="description" id="description" name="description" value="{{ old('description') }}">{{$houseDB->description}}
                                </textarea>
                            </div>


                            <div class="form-group">
                                <label for="rent">Rent: </label>
                                <input type="number" class="form-control" placeholder="rent" id="rent" name="rent" value="{{ $houseDB->rent }}" required>
                            </div>

                            <div class="form-group">
                                <label for="rent">Contract Ends At: </label>
                                <input type="date" class="form-control" placeholder="due date" id="duedate" name="duedate" value="{{ old('duedate', $houseDB->duedate) }}">
                            </div>

                            <div class="form-group">
                                <label for="tiles">Tiles: </label>
                                @if($houseDB->tiles == "Yes")
                                <div class="control">
                                    <label class="radio">
                                        <input checked="checked" value="Yes" type="radio" name="tiles" required >
                                                    Yes
                                        </label>
                                    <label class="radio">
                                    <input value="no" type="radio" name="tiles" required>
                                                    No
                                    </label>
                                </div>
                                @else
                                <div class="control">
                                    <label class="radio">
                                        <input value="Yes" type="radio" name="tiles" required>
                                                    Yes
                                        </label>
                                    <label class="radio">
                                    <input checked="checked" value="no" type="radio" name="tiles" required>
                                                    No
                                    </label>
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="gypsum">Gypsum: </label>
                                @if($houseDB->gypsum == "Yes")
                                <div class="control">
                                    <label class="radio">
                                        <input checked="checked" value="Yes" type="radio" name="gypsum" required>
                                                    Yes
                                        </label>
                                    <label class="radio">
                                    <input value="no" type="radio" name="gypsum" required>
                                                    No
                                    </label>
                                </div>
                                @else
                                <div class="control">
                                    <label class="radio">
                                        <input value="Yes" type="radio" name="gypsum" required>
                                                    Yes
                                        </label>
                                    <label class="radio">
                                    <input checked="checked" value="no" type="radio" name="gypsum" required>
                                                    No
                                    </label>
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="aluminium">Aluminium windows: </label>
                                @if($houseDB->aluminium == "Yes")
                                <div class="control">
                                    <label class="radio">
                                        <input checked="checked" value="Yes" type="radio" name="aluminium" required>
                                                    Yes
                                        </label>
                                    <label class="radio">
                                    <input value="no" type="radio" name="aluminium" required>
                                                    No
                                    </label>
                                </div>
                                @else
                                <div class="control">
                                    <label class="radio">
                                        <input value="Yes" type="radio" name="aluminium" required>
                                                    Yes
                                        </label>
                                    <label class="radio">
                                    <input checked="checked" value="no" type="radio" name="aluminium" required>
                                                    No
                                    </label>
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="fence">Fence: </label>
                                @if($houseDB->fence == "Yes")
                                <div class="control">
                                    <label class="radio">
                                        <input checked="checked" value="Yes" type="radio" name="fence" required>
                                                    Yes
                                        </label>
                                    <label class="radio">
                                    <input value="no" type="radio" name="fence" required>
                                                    No
                                    </label>
                                </div>
                                @else
                                <div class="control">
                                    <label class="radio">
                                        <input value="Yes" type="radio" name="fence" required>
                                                    Yes
                                        </label>
                                    <label class="radio">
                                    <input checked="checked" value="no" type="radio" name="fence" required>
                                                    No
                                    </label>
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="kitchen">Kitchen: </label>
                                @if($houseDB->kitchen)
                                <div class="control">
                                    <label class="radio">
                                        <input checked="checked" value="Yes" type="radio" name="kitchen" required>
                                                    Yes
                                        </label>
                                    <label class="radio">
                                    <input value="no" type="radio" name="kitchen" required>
                                                    No
                                    </label>
                                </div>
                                @else
                                <div class="control">
                                    <label class="radio">
                                        <input value="Yes" type="radio" name="kitchen" required>
                                                    Yes
                                        </label>
                                    <label class="radio">
                                    <input checked="checked" value="no" type="radio" name="kitchen" required>
                                                    No
                                    </label>
                                </div>
                                @endif
                            </div>


                            <div class="form-group">
                                <label for="ac">AC: </label>
                                @if($houseDB->ac == "Yes")
                                <div class="control">
                                    <label class="radio">
                                        <input checked="checked" value="Yes" type="radio" name="ac" required>
                                                    Yes
                                        </label>
                                    <label class="radio">
                                    <input value="no" type="radio" name="ac" required>
                                                    No
                                    </label>
                                </div>
                                @else
                                <div class="control">
                                    <label class="radio">
                                        <input value="Yes" type="radio" name="ac" required>
                                                    Yes
                                        </label>
                                    <label class="radio">
                                    <input checked="checked" value="no" type="radio" name="ac" required>
                                                    No
                                    </label>
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="luku">Luku(Umeme): </label>
                                @if($houseDB->luku == "Shared")
                                <div class="control">
                                    <label class="radio">
                                        <input checked="checked" value="Shared" type="radio" name="luku" required>
                                                    Shared
                                        </label>
                                    <label class="radio">
                                    <input value="Alone" type="radio" name="luku" required>
                                                    Alone
                                    </label>
                                </div>
                                @else
                                <div class="control">
                                    <label class="radio">
                                        <input value="Shared" type="radio" name="luku" required>
                                                    Shared
                                        </label>
                                    <label class="radio">
                                    <input checked="checked" value="Alone" type="radio" name="luku" required>
                                                    Alone
                                    </label>
                                </div>
                                @endif
                            </div>
                            <br>

                            <div class="row gallery">
                            <label for="featured_image">Featured Image Presents</label>
                            <a href="{{ $houseDB->getFirstMediaUrl('featured_image', 'thumb') }}">
                                <img  src="{{ $houseDB->getFirstMediaUrl('featured_image', 'thumb') }}" class="img-fluid m-2" style="height: 200px;width: 100%; ">
                            </a>

                       </div>

                            <div class="row gallery">
                            <label for="images">House Images Present</label>

                            @foreach ($houseImages as $image)
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
