@extends('layouts.backend.appagent')
@section('title')
    $agent->name - All Houses
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
               @include('partial.successMessage')

                <div class="card my-5 mx-4">
                    <div class="card-header">
                        <h3 class="card-title float-left"><strong>{{$agent->name}} Houses ({{ $houses->count() }})</strong></h3>
                        <form action="{{ route('agent.houses.filter') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <button type="submit" class="btn btn-success btn-md float-right c-white">Filter</button>
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
                          <th>ID</th>
                          <th>Image</th>
                          <th>Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($houses as $key=>$house)
                        <tr>
                          <td>{{ $house->id }}</td>
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
                  {{ $houses->appends(request()->query())->links() }}
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
