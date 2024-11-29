@extends('layouts.backend.app')
@section('title')
    Add Property
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card mt-5">
                    <div class="card-header">
                        <h3 class="card-title float-left"><strong>Add New Property</strong></h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @include('partial.errors')

                        <form action="{{ route('admin.property.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="contact">Owner's Name </label>
                                <input type="text" class="form-control" placeholder="Owner's Name"
                                name="name" value="{{ old('name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="contact">Owner's Contact </label>
                                <input type="tel" class="form-control" placeholder="Owner's Contact"
                                name="contact" value="{{ old('contact') }}" required>
                            </div>


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
                                name="area_search" value="{{ old('area') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="address">Address(Mtaa): </label>
                                <input type="text" class="form-control" placeholder="Enter address" id="address"
                                    name="address" value="{{ old('address') }}" required>
                            </div>


                            <div class="form-group">
                                <label for="area">Property Availability</label>
                                <select name="status" class="form-control" id="status" required>
                                    <option value="1">For Sale</option>
                                    <option value="0">Sold</option>
                                </select>
                            </div>



                            <div class="form-group">
                                <label for="property_type">Property Type </label>
                                <select name="property_type" class="form-control" required>
                                    <option value="">select property type</option>
                                    <option value="Nyumba">Nyumba</option>
                                    <option value="Kiwanja">Kiwanja</option>
                                    <option value="Shamba">Shamba</option>
                                    <option value="Godown">Godown</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="property_type">Deed(Hati) </label>
                                <select name="deed" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="rent">Property Area Sqm: </label>
                                <input type="number" class="form-control" placeholder="sqm" id="sqm"
                                    name="sqm" value="{{ old('sqm') }}">
                            </div>

                            <div class="form-group">
                                <label for="number_o f_room">Description: </label>
                                <textarea type="text" class="form-control" placeholder="description" id="description" name="description"
                                    value="{{ old('description') }}" required>
                                </textarea>
                            </div>


                            <div class="form-group">
                                <label for="rent">Price: </label>
                                <input type="number" class="form-control" placeholder="price" id="price"
                                    name="price" value="{{ old('price') }}" required>
                            </div>



                            <div class="form-group">
                                <label for="featured_image">Featured Image</label>
                                <input type="file" name="featured_image" class="form-control" id="featured_image">
                            </div>

                            <div class="form-group">
                                <label for="images">Other Images</label>
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
                        $.get('https://nyumbafasta.co.tz/admin/ajax/district?region_id=' + region_id,
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
                        $.get('https://nyumbafasta.co.tz/admin/ajax/area?area_id=' + district_id,
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
