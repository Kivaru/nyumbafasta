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
                            <h3><strong>House Info Payment</strong></h3>
                        </div>
                        <div>
                            <a class="btn btn-danger" href="{{ route('renter.allHouses') }}"> Back</a>
                        </div>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Tigo Pesa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Airtel Money</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">M-Pesa & Card Payment</a>
                        </li>
                    </ul><!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="card-body">
                                <form method="POST" action="{{ route('renter.payment.house') }}">
                                    @csrf
                                    <p>Pay Tsh.5,000/= for getting house {{$house->name}} information located at {{$house->address }}, {{ $house->area->name }} </p>
                                    <div class="form-group row">
                                        <label for="phonenumber" class="col-md-4 col-form-label text-md-right">Tigo
                                            Number</label>
                                        <div class="col-md-6">
                                            <input id="phonenumber" type="text" class="form-control" name="phonenumber"
                                                value="{{ old('phonenumber') }}" required autocomplete="phonenumber"
                                                autofocus>
                                            <input id="user_id" type="hidden" class="form-control" name="user_id" value="{{ $renter->id }}">
                                            <input id="user_name" type="hidden" class="form-control" name="user_name" value="{{ $renter->name }}">
                                            <input id="user_email" type="hidden" class="form-control" name="user_email" value="{{ $renter->email }}">
                                            <input id="user_contact" type="hidden" class="form-control" name="user_contact" value="{{ $renter->contact }}">
                                            <input id="amount" type="hidden" class="form-control" name="amount" value="5000">
                                            <input id="house_id" type="hidden" class="form-control" name="house_id" value="{{ $house->id }}">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Pay</button>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="card-body">
                            <form method="POST" action="{{ route('renter.payment.house') }}">
                                    @csrf
                                    <p>Pay Tsh.5,000/= for getting house {{$house->name}} information located at {{$house->address }}, {{ $house->area->name }} </p>
                                    <div class="form-group row">
                                        <label for="phonenumber" class="col-md-4 col-form-label text-md-right">Airtel
                                            Number</label>
                                        <div class="col-md-6">
                                            <input id="phonenumber" type="text" class="form-control" name="phonenumber"
                                                value="{{ old('phonenumber') }}" required autocomplete="phonenumber"
                                                autofocus>
                                            <input id="user_id" type="hidden" class="form-control" name="user_id" value="{{ $renter->id }}">
                                            <input id="user_name" type="hidden" class="form-control" name="user_name" value="{{ $renter->name }}">
                                            <input id="user_email" type="hidden" class="form-control" name="user_email" value="{{ $renter->email }}">
                                            <input id="user_contact" type="hidden" class="form-control" name="user_contact" value="{{ $renter->contact }}">
                                            <input id="amount" type="hidden" class="form-control" name="amount" value="5000">
                                            <input id="house_id" type="hidden" class="form-control" name="house_id" value="{{ $house->id }}">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Pay</button>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                        <div class="card-body">
                            <form method="POST" action="{{ route('renter.payment.house') }}">
                                    @csrf
                                    <p>Pay Tsh.5,000/= for getting house {{$house->name}} information located at {{$house->address }}, {{ $house->area->name }} </p>
                                    <div class="form-group row">
                                        <label for="phonenumber" class="col-md-4 col-form-label text-md-right">Airtel
                                            Number</label>
                                        <div class="col-md-6">
                                            <input id="phonenumber" type="text" class="form-control" name="phonenumber"
                                                value="{{ old('phonenumber') }}" required autocomplete="phonenumber"
                                                autofocus>
                                            <input id="user_id" type="hidden" class="form-control" name="user_id" value="{{ $renter->id }}">
                                            <input id="user_name" type="hidden" class="form-control" name="user_name" value="{{ $renter->name }}">
                                            <input id="user_email" type="hidden" class="form-control" name="user_email" value="{{ $renter->email }}">
                                            <input id="user_contact" type="hidden" class="form-control" name="user_contact" value="{{ $renter->contact }}">
                                            <input id="amount" type="hidden" class="form-control" name="amount" value="5000">
                                            <input id="house_id" type="hidden" class="form-control" name="house_id" value="{{ $house->id }}">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Pay</button>
                                </form>
                            </div>
                        </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    window.addEventListener('load', function () {
        baguetteBox.run('.gallery', {
            animation: 'fadeIn',
            noScrollbars: true
        });
    });

    function renterBooking(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure to booking this house?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('booking-form-' + id).submit();

            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Not Now!',

                )
            }
        })
    }

</script>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.css">
@endsection
