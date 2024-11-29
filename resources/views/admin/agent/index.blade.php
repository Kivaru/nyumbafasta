@extends('layouts.backend.app')
@section('title')
    All Agents
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">

               @include('partial.successMessage')

                <div class="card mt-5">
                    <div class="card-header">
                      <h3 class="card-title float-left"><strong >Our All Agents ({{ $agentcount }})</strong></h3>

                    <a href="{{route('admin.agent.create')}}" class="btn btn-success btn-md float-right c-white">Add new Agent <i class="fa fa-plus"></i></a>
                    </div>
                    <!-- /.card-header -->
                    @if ($agents->count() > 0)
                    <div class="">
                    <div class="table-responsive">
                      <table id="dataTableId" class="table table-bordered table-striped table-background">
                        <thead>
                        <tr>
                          <th>Name</th>
                          <th>Phone Number</th>
                          <th>Email </th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($agents as $key=>$agent)
                        <tr>
                          <td><a href="{{ route('admin.agent.houses', $agent->id) }}"  class="btn btn-success m-2">{{ $agent->name }}</a></td>
                          <td>{{ $agent->phonenumber }}</td>
                          <td>{{ $agent->email }}</td>
                          <td>
                            @if ($agent->user_id == Auth::id())
                              <a href="{{ route('admin.agent.edit', $agent->id) }}"  class="btn btn-info">Edit</a>
                            @endif

                            <button class="btn btn-danger" type="button" onclick="deleteArea({{ $agent->id }})">
                                Delete
                            </button>


                          <form id="delete-form-{{ $agent->id }}" action="{{ route('admin.agent.destroy',$agent->id) }}" method="POST" style="display: none;">
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
                 <h2 class="text-center text-info font-weight-bold m-3">No Agent Found</h2>
              @endif

               <div class="pagination">
                  {{-- {{ $agents->links() }} --}}
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
 function deleteArea(id){
     const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
          title: 'Are you sure to delete this area?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
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
