@extends('layouts.backend.appagent')
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
                        <h3 class="card-title float-left"><strong>Houses ({{ $agentHouses->count() }})</strong></h3>
                      </div>
                    <!-- /.card-header -->
                    @if ($agentHouses->count() > 0)
                    <div class="">
                    <div class="table-responsive">
                      <table id="dataTableId" class="table table-bordered table-striped table-background">
                        <thead>
                        <tr>
                          {{-- <th>ID</th> --}}
                          <th>Image</th>
                          <th>Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($agentHouses as $key=>$house)
                        <tr>
                          {{-- <td>{{ $house->id }}</td> --}}
                          <td><img src="{{$house->getFirstMediaUrl('featured_image', 'thumb')}}" / width="120px"></td>
                          <td>{{ $house->address }}</td>
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
                  {{ $agentHouses->appends(request()->query())->links() }}
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
