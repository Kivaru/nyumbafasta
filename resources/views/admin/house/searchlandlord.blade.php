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
                      <h3 class="card-title float-left"><strong>Search Results</strong></h3>
                      
                    </div>
                    <!-- /.card-header -->
                    <div class="">
                    <div class="table-responsive">
                      <table id="dataTableId" class="table table-bordered table-striped table-background">
                        <thead>
                        <tr>
                          <th>Name</th>
                          {{-- <th>Added at</th> --}}
                          <th>Contact</th>
                          <th>Verification Status</th>
                          <th>Edit User</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($results->isNotEmpty())
                           @foreach ($results as $result)
                        <tr>
                          <td>{{ $result->name }}</td>
                          {{-- <td>{{ $result->created_at->toFormattedDateString() }}</td> --}}
                          <td>{{ $result->contact }}</td>
                          <td>
                            @if ($result->verified == 1)
                                Verified
                            @else
                                Not Verified
                            @endif
                          </td>
                          <td>
                            <a href="{{ route('admin.landlord.profile.edit', $result->id) }}" class="btn btn-info float-right my-4" >Edit Profile</a>
                          </td>
                          <td>

                            @if(($result->verified == 0) && ($result->dialed == 0))
                            <a href="{{ route('admin.landlord.dialed', $result->id) }}"  class="btn btn-warning">Dialed</a>
                            <a href="{{ route('admin.landlord.verify', $result->id) }}"  class="btn btn-success">Verify</a>
                            @elseif(($result->verified == 1) && ($result->dialed == 0))
                            <a href="{{ route('admin.landlord.dialed', $result->id) }}"  class="btn btn-warning">Dialed</a>
                            <button class="btn btn-success m-2" type="button">
                                Already Verified
                            </button>
                            @elseif(($result->verified == 0) && ($result->dialed == 1))
                            <a href="{{ route('admin.landlord.verify', $result->id) }}"  class="btn btn-success">Verify</a>
                            <button class="btn btn-success m-2" type="button">
                                Already Dialed
                            </button>
                            @endif
                            
                            <button class="btn btn-danger m-2" type="button" onclick="deleteHouse({{ $result->id }})">
                                Remove
                            </button>
            
                          <form id="delete-form-{{ $result->id }}" action="{{ route('admin.remove.landlord',$result->id) }}" method="POST" style="display: none;">
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
                 <h2 class="text-center text-info font-weight-bold m-3">No Record Found</h2>
              @endif
                   
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