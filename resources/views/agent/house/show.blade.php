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
                      {{-- <h4 class="card-title float-left"><strong>All Houses ({{ $housecount }})</strong></h4> --}}
                      {{-- <h4 class="card-title float-left"><strong>-Distinct Houses ({{ $housecountDistinct }})</strong></h4> --}}
                      <h4 class="card-title float-left"><strong>-Verified Landlords ({{ $verifiedCount }})</strong></h4>
                      <h4 class="card-title float-left"><strong>-Unverified Landlords ({{ $unverifiedCount }})</strong></h4>

                    <form action="{{ route('admin.agent.filter') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <button type="submit" class="btn btn-success btn-md float-right c-white">Filter</button>
                    <input class="card-title float-right" type="date" id="enddatequery" name="enddatequery">
                    <input class="card-title float-right" type="date" id="datequery" name="datequery">
                    <input value="{{$agent->id}}" hidden id="agent-id" name="agent_id">
                    </form>

                    </div>
                    <!-- /.card-header -->
                    @if ($houses->count() > 0)
                    <div class="">
                    <div class="table-responsive">
                      <table id="dataTableId" class="table table-bordered table-striped table-background">
                        <thead>
                        <tr>
                          <th>Address</th>
                          <th>Added at</th>
                          <th>Name</th>
                          <th>Contact</th>
                          {{-- <th>Number of Rooms </th> --}}
                          <th>Status</th>
                          <th>Verification Status</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($houses as $key=>$house)
                        <tr>
                          <td>{{ $house->address }}</td>
                          <td>{{ $house->created_at->toFormattedDateString() }}</td>
                          @if ($house->user)
                          <td>{{ $house->user->name }}</td>
                          @else
                          <td></td>
                          @endif
                          @if ($house->user)
                          <td>{{ $house->user->contact }}</td>
                          @else
                          <td></td>
                          @endif
                          {{-- <td>{{ $house->number_of_room }}</td> --}}
                          <td>
                            @if ($house->status == 1)
                                Available
                            @else
                                Not Available
                            @endif
                          </td>
                          <td>
                            @if($house->user)
                            @if ($house->user->verified == 1)
                                Verified
                            @else
                                Not Verified
                            @endif
                            @else
                            @endif
                          </td>
                          <td>
                            <a href="{{ route('admin.house.show', $house->id) }}"  class="btn btn-success m-2">Details</a>
                            <button class="btn btn-danger m-2" type="button" onclick="deleteHouse({{ $house->id }})">
                                Delete
                            </button>

                          <form id="delete-form-{{ $house->id }}" action="{{ route('admin.house.destroy',$house->id) }}" method="POST" style="display: none;">
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
                  {{-- {{ $houses->links() }} --}}
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
 function deleteHouse(id){
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
              document.getElementById('delete-form-'+id).submit();

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
