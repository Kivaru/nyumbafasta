@extends('layouts.backend.app')
@section('title')
   Add House
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card mt-5">
                    <div class="card-header">
                      <h3 class="card-title float-left"><strong>Add New House</strong></h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    @include('partial.errors')

                    <form action="{{ route('dalali.house.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="region">Region(Mkoa) </label>
                            <select name="region" class="form-control" id="region" required>
                                <option value="">select a region</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}"
                                        {{ old('id') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="district">District(Wilaya) </label>
                            <select name="district" class="form-control" id="district" required>
                                <option value="">select an a district</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="area">Area(Kata) </label>
                            <input type="text" id="realtxt" onkeyup="searchSel()" class="form-control" placeholder="Type area(Andika Kata)"
                            name="area_search" value="{{ old('area') }}">
                            <select name="area_id" class="form-control select2-options" id="area_id">
                                <option value="">select an area</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}"
                                        {{ old('area_id') == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="address">Address(Mtaa): </label>
                            <input type="text" class="form-control" placeholder="Enter address" id="address"
                                name="address" value="{{ old('address') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="area">Agent </label>
                            <select name="agent_id" class="form-control" id="agent_id" required>
                                <option value="">select an agent</option>
                                <option value="1">Home Owner</option>
                                @foreach ($agents as $agent)
                                    <option value="{{ $agent->id }}"
                                        {{ old('agent_id') == $agent->id ? 'selected' : '' }}>{{ $agent->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="area">House Availability</label>
                            <select name="status" class="form-control" id="status" required>
                                <option value="1">Available</option>
                                <option value="0">Not Available</option>
                            </select>
                        </div>



                        <div class="form-group">
                            <label for="area">House Type </label>
                            <select name="house_type" class="form-control" id="agent_id" required>
                                <option value="">select house type</option>
                                <option value="Apartment">Apartment</option>
                                <option value="Standalone">Standalone</option>
                                <option value="Sitting Room With Master Bedroom">Sitting Room With Master Bedroom
                                </option>
                                <option value="Sitting Room With Bedroom">Sitting Room With Bedroom</option>
                                <option value="Single Room">Single Room</option>
                                <option value="Master Bedroom">Master Bedroom</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="number_of_room">Number of rooms: </label>
                            <input type="number" class="form-control" placeholder="number_of_room" id="number_of_room"
                                name="number_of_room" value="{{ old('number_of_room') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="number_o f_room">Description: </label>
                            <textarea type="text" class="form-control" placeholder="description" id="description" name="description"
                                value="{{ old('description') }}" required>
                            </textarea>
                        </div>


                        <div class="form-group">
                            <label for="tiles">Tiles: </label>
                            <div class="control">
                                <label class="radio">
                                    <input value="Yes" type="radio" name="tiles">
                                    Yes
                                </label>
                                <label class="radio">
                                    <input value="no" type="radio" name="tiles">
                                    No
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gypsum">Gypsum: </label>
                            <div class="control">
                                <label class="radio">
                                    <input value="Yes" type="radio" name="gypsum">
                                    Yes
                                </label>
                                <label class="radio">
                                    <input value="no" type="radio" name="gypsum">
                                    No
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="aluminium">Aluminium windows: </label>
                            <div class="control">
                                <label class="radio">
                                    <input value="Yes" type="radio" name="aluminium">
                                    Yes
                                </label>
                                <label class="radio">
                                    <input value="no" type="radio" name="aluminium">
                                    No
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="fence">Fence: </label>
                            <div class="control">
                                <label class="radio">
                                    <input value="Yes" type="radio" name="fence">
                                    Yes
                                </label>
                                <label class="radio">
                                    <input value="no" type="radio" name="fence">
                                    No
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kitchen">Kitchen: </label>
                            <div class="control">
                                <label class="radio">
                                    <input value="Yes" type="radio" name="kitchen">
                                    Yes
                                </label>
                                <label class="radio">
                                    <input value="no" type="radio" name="kitchen">
                                    No
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ac">AC: </label>
                            <div class="control">
                                <label class="radio">
                                    <input value="Yes" type="radio" name="ac">
                                    Yes
                                </label>
                                <label class="radio">
                                    <input value="no" type="radio" name="ac">
                                    No
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="luku">Luku(Umeme): </label>
                            <div class="control">
                                <label class="radio">
                                    <input value="Shared" type="radio" name="luku">
                                    Shared
                                </label>
                                <label class="radio">
                                    <input value="Alone" type="radio" name="luku">
                                    Alone
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="rent">Rent: </label>
                            <input type="number" class="form-control" placeholder="rent" id="rent"
                                name="rent" value="{{ old('rent') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="rent">When Rent Ends: </label>
                            <input type="date" class="form-control" placeholder="due date" id="duedate"
                                name="duedate" value="{{ old('duedate') }}">
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
                            <button type="submit" class="btn btn-success">Add</button>
                            <a href="{{ URL::previous() }}" class="btn btn-danger wave-effect">Back</a>
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
                    $.get('https://nyumbafasta.co.tz/dalali/ajax/district?region_id=' + region_id,
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
                    $.get('https://nyumbafasta.co.tz/dalali/ajax/area?area_id=' + district_id,
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
