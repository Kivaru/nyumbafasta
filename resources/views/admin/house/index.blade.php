@extends('layouts.backend.app')
@section('title')
    All Houses
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('partial.successMessage')

                <div class="card my-5 mx-4">

                    <div class="card-header">
                        <h3 class="card-title float-left"><strong>All Houses ({{ $housecount }})</strong></h3>
                    </div>
                    <form style="margin-start:20px; margin-end:20px;margin-bottom:10px" action="{{ route('admin.filter') }}"
                        method="GET">
                        <div class="row">

                            <div class="form-group col-sm-3">
                                <label>{{ __('home.region') }}</label>

                                <div class="select-wrapper">
                                    <select style="border-radius: 12px;" id="region" name="region" class="form-control">
                                        <option value="">{{ __('home.select_region') }}</option>
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div><!-- /.select-wrapper -->
                            </div><!-- /.form-group -->

                            <div class="form-group col-sm-3">
                                <label>{{ __('home.select_district') }}</label>

                                <div class="select-wrapper">
                                    <select style="border-radius: 12px;" id="district" name="district"
                                        class="form-control">
                                        <option value="">{{ __('home.select_district') }}</option>
                                    </select>
                                </div><!-- /.select-wrapper -->
                            </div><!-- /.form-group -->

                            <div class="form-group col-sm-3">
                                <label>{{ __('home.area') }}</label>

                                <div class="select-wrapper">
                                    <select style="border-radius: 12px;" name="area" id="area" class="form-control">
                                        <option value="">{{ __('home.select_area') }}</option>
                                    </select>
                                </div><!-- /.select-wrapper -->
                            </div><!-- /.form-group -->

                            <div class="form-group col-sm-3">
                                <label>{{ __('home.property_type') }}</label>

                                <div class="select-wrapper">
                                    <select style="border-radius: 12px;" name="type" id="ptype" class="form-control">
                                        <option value="">{{ __('home.house_type') }}</option>
                                        <option value="Apartment">{{ __('home.apartment') }}</option>
                                        <option value="Standalone">{{ __('home.standalone') }}</option>
                                        <option value="Sitting Room With Master Bedroom">
                                            {{ __('home.sittingroom_with_masterbedroom') }}</option>
                                        <option value="Sitting Room With Bedroom">{{ __('home.sittingroom_with_bedroom') }}
                                        </option>
                                        <option value="Master Bedroom">{{ __('home.master_bedroom') }}</option>
                                        <option value="Single Room">{{ __('home.single_room') }}</option>
                                    </select>
                                </div><!-- /.select-wrapper -->
                            </div><!-- /.form-group -->

                            <div class="form-group col-sm-6">
                                <label>{{ __('home.price_from') }}</label>
                                <input style="border-radius: 8px;margin-left:-2px" name="minPrice" type="text"
                                    class="form-control" placeholder="{{ __('home.e.g.') }} 20000">
                            </div><!-- /.form-group -->

                            <div class="form-group col-sm-6">
                                <label>{{ __('home.price_to') }}</label>
                                <input style="border-radius: 8px;" name="maxPrice" type="text" class="form-control"
                                    placeholder="{{ __('home.e.g.') }} 50000">
                            </div><!-- /.form-group -->

                            <div class="form-group col-sm-6" style="padding-top:17px">

                                <input style="border-radius: 6px;" type="submit"
                                    class="btn btn-primary btn-primary btn-block"
                                    value="{{ __('home.filter_properties') }}">
                            </div><!-- /.form-group -->
                            <div class="form-group col-sm-6" style="padding-top:17px">

                                <input style="border-radius: 6px;" type="reset"
                                    class="btn btn-primary btn-primary btn-block" value="{{ __('home.clear_filter') }}">
                            </div>

                    </form>
                    <!-- /.card-header -->
                    @if ($houses->count() > 0)
                        <div class="table-responsive">
                            <table id="dataTableId" class="table table-bordered table-striped table-background">
                                <thead>
                                    <tr>
                                        <th>Address</th>
                                        <th>Added at</th>
                                        <th>Contact</th>
                                        <th>Number of Rooms </th>
                                        <th>Status</th>
                                        <th>Verification Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($houses as $key => $house)
                                        <tr>
                                            <td>{{ $house->address }}</td>
                                            <td>{{ $house->created_at->toFormattedDateString() }}</td>
                                            @if ($house->user)
                                                <td>{{ $house->user->contact }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td>{{ $house->number_of_room }}</td>
                                            <td>
                                                @if ($house->status == 1)
                                                    Available
                                                @else
                                                    Not Available
                                                @endif
                                            </td>
                                            <td>
                                                @if ($house->user)
                                                    @if ($house->user->verified == 1)
                                                        Verified
                                                    @else
                                                        Not Verified
                                                    @endif
                                                @else
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.house.show', $house->id) }}"
                                                    class="btn btn-success m-2">Details</a>
                                                <button class="btn btn-danger m-2" type="button"
                                                    onclick="deleteHouse({{ $house->id }})">
                                                    Delete
                                                </button>

                                                <form id="delete-form-{{ $house->id }}"
                                                    action="{{ route('admin.house.destroy', $house->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')

                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                </div> <!-- /.card-body -->
            @else
                <h2 class="text-center text-info font-weight-bold m-3">No House Found</h2>
                @endif

                <div class="pagination">
                    {{ $houses->links() }}
                </div>

            </div>
            <!-- /.card -->
        </div>
    </div>
    </div><!-- /.container -->
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#region').on('change', function(e) {
                console.log(e);
                var region_id = e.target.value;
                console.log(region_id);
                //ajax
                $.get('ajax/district?region_id=' + region_id, function(data) {
                    //success data
                    console.log(data);
                    var district = $('#district').empty();
                    console.log(district);
                    $('#district').append('<option value="">Select District</option>');
                    $.each(data, function(create, districtObj) {
                        var option = $('<option/>', {
                            id: create,
                            value: districtObj
                        });
                        district.append('<option value ="' + create + '">' + districtObj +
                            '</option>');
                    });
                });
            });
        });

        $(document).ready(function() {
            //Use this inside your document ready jQuery
            $(window).on('popstate', function() {
                location.reload(true);
            });
        });

        $(document).ready(function() {
            $('#district').on('change', function(e) {
                console.log(e);
                var district_id = e.target.value;
                console.log(district_id);
                //ajax
                $.get('ajax/area?area_id=' + district_id, function(data) {
                    //success data
                    console.log(district_id);
                    var area = $('#area').empty();
                    $('#area').append('<option value="">Select Area</option>');
                    $.each(data, function(create, areaObj) {
                        var option = $('<option/>', {
                            id: create,
                            value: areaObj
                        });
                        area.append('<option value ="' + areaObj + '">' + areaObj +
                            '</option>');
                    });
                });
            });
        });


        function deleteHouse(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure to remove this house?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {

                    event.preventDefault();
                    document.getElementById('delete-form-' + id).submit();

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                    )
                }
            })
        }
    </script>
@endsection
