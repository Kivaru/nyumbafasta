@extends('layouts.backend.app')
@section('title')
    Landlords List
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
               @include('partial.successMessage')  

                <div class="card my-5 mx-4 p-0">
                    <div class="card-header">
                      <h3 class="card-title float-left"><strong>Verified Landlords ({{ $landlords->count() }})</strong></h3>
                
                    </div>
                    <!-- /.card-header -->
                    @if ($landlords->count() > 0)
                    <div class="">
                    <div class="table-responsive">
                      <table id="dataTableId" class="table table-bordered table-striped table-background">
                        <thead>
                        <tr>
                          <th>Name</th>
                          <th>Houses</th>
                          <th>Contact</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($landlords as $key=>$landlord)
                        <tr>
                          <td>{{ $landlord->name }}</td>
                          <td>{{ $landlord->houses->count() }}</td>
                          <td>{{ $landlord->contact }}</td>
                          <td>
                            <button class="btn btn-danger m-2" type="button" onclick="deleteLandlord({{ $landlord->id }})">
                                Remove
                            </button>
                            @if(($landlord->verified == 0) && ($landlord->dialed == 0))
                            <a href="{{ route('admin.landlord.dialed', $landlord->id) }}"  class="btn btn-warning">Dialed</a>
                            <a href="{{ route('admin.landlord.verify', $landlord->id) }}"  class="btn btn-success">Verify</a>
                            @elseif(($landlord->verified == 1) && ($landlord->dialed == 0))
                            <a href="{{ route('admin.landlord.dialed', $landlord->id) }}"  class="btn btn-warning">Dialed</a>
                            <button class="btn btn-success m-2" type="button">
                                Already Verified
                            </button>
                            @elseif(($landlord->verified == 0) && ($landlord->dialed == 1))
                            <a href="{{ route('admin.landlord.verify', $landlord->id) }}"  class="btn btn-success">Verify</a>
                            <button class="btn btn-success m-2" type="button">
                                Already Dialed
                            </button>
                            @endif
            
                          <form id="delete-form-{{ $landlord->id }}" action="{{ route('admin.remove.landlord',$landlord->id) }}" method="POST" style="display: none;">
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
                  {{ $landlords->links() }}
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
 function deleteLandlord(id){
     const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
      })
      
      swalWithBootstrapButtons.fire({
          title: 'Are you sure to remove this user?',
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