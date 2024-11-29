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
                        <h3 class="card-title float-left"><strong>All Pending Transactionsssssssssssssss
                                ({{ $pendingTransactions->count() }})</strong></h3>

                    </div>

                    <!-- /.card-header -->
                    @if ($pendingTransactions->count() > 0)
                        <div class="">
                            <div class="table-responsive">
                                <table id="dataTableId" class="table table-bordered table-striped table-background">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Transaction ID</th>
                                            <th>Renter Name</th>
                                            <th>Renter Number</th>
                                            <th>House ID</th>
                                            <th>Landlord Number</th>
                                            <th>Payment Status</th>
                                            <th>Created At</th>
                                            <th>Message Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pendingTransactions as $key => $transaction)
                                            <tr>
                                                <td>{{ $transaction->id }}</td>
                                                <td>{{ $transaction->transid }}</td>
                                                <td>{{ $transaction->user ? $transaction->user->name : 'no user' }}</td>
                                                <td>{{ $transaction->user ? $transaction->user->contact : 'no user' }}</td>
                                                <td><a
                                                        href="{{ route('admin.house.show', $transaction->house->id) }}">{{ $transaction->user ? $transaction->house->id : 'no user' }}</a>
                                                </td>
                                                <td>{{ $transaction->user == null ? $transaction->house->contact == null : 'no user' }}</td>
                                                <td>{{ $transaction->payment_status == null ? 'NOT COMPLETED' : 'NOT COMPLETED' }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d/m/Y H:i:s') }}
                                                </td>
                                                @if ($transaction->message_status == 0)
                                                    <td>
                                                        <button class="btn btn-warning" type="button" data-toggle="modal"
                                                        data-target="#campaignModal_{{ $transaction->id }}">Send SMS</button>
                                                    </td>
                                                @else
                                                <td>
                                                <button class="btn btn-success" type="button" data-toggle="modal"
                                                data-target="#campaignModal_{{ $transaction->id }}">Send SMS Again</button>
                                            </td>
                                                @endif



                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div> <!-- /.card-body -->
                    @else
                        <h2 class="text-center text-info font-weight-bold m-3">No Records Found</h2>
                    @endif

                    <div class="pagination">
                        {{-- {{ $pendingTransactions->links() }} --}}
                    </div>

                </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container -->

    <!-- The Modal -->
    @foreach ($pendingTransactions as $transaction)
    <div class="modal fade" id="campaignModal_{{ $transaction->id }}" tabindex="-1" role="dialog"
        aria-labelledby="campaignModalLabel_{{ $transaction->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-align-top-left" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Send Campaign</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('admin.renter.sms')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12 parent-inner">
                                <label for="Name">Send Message</label>
                                <textarea class="form-control textarea-counter" rows="8" id="message" name="message"
                                    placeholder="Type here..."></textarea>
                            </div>
                            <div class="form-group col-md-5">
                                <input type="hidden" class="form-control" id="phone" name="phone"
                                    value="{{ $transaction->user ? $transaction->user->contact : null }}">
                            </div>

                            <div class="form-group col-md-5">
                                <input type="hidden" class="form-control" id="renter_id" name="renter_id"
                                    value="{{ $transaction->user ? $transaction->user->contact : null }}">
                            </div>

                            <div class="form-group col-md-5">
                                <input type="hidden" class="form-control" id="transaction_id" name="transaction_id"
                                    value="{{ $transaction->id }}">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-warning">Send SMS</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach



@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script type="text/javascript">
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

        // Get the modal
var modal = document.getElementById("smsModal");

// Get the button that opens the modal
var btn = document.getElementById("openSMSModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

    </script>
@endsection
