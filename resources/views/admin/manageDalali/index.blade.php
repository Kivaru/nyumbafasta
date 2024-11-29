@extends('layouts.backend.app')
@section('title')
    Dalali List
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
               @include('partial.successMessage')  

                <div class="card my-5 mx-4 p-0">
                    <div class="card-header">
                      <h3 class="card-title float-left"><strong>All Dalalis ({{ $dalalis->count() }})</strong></h3>
                    </div>
                    <form style="margin-bottom: 20px; margin-top:20px;" action="{{ route('admin.search.landlord') }}" method="GET">
                      <input type="text" name="search" required/>
                      <button type="submit">Search</button>
                    </form>
                    <!-- /.card-header -->
                    @if ($dalalis->count() > 0)
                    <div class="">
                    <div class="table-responsive">
                      <table id="dataTableId" class="table table-bordered table-striped table-background">
                        <thead>
                        <tr>
                          <th>Name</th>
                          <th>Houses</th>
                          <th>Contact</th>
                          <th>Change Password</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($dalalis as $key=>$dalali)
                        <tr>
                          <td>{{ $dalali->name }}</td>
                          <td>{{ $dalali->houses->count() }}</td>
                          <td>{{ $dalali->contact }}</td>
                          <td>
                            <a href="{{ route('admin.landlord.profile.edit', $dalali->id) }}" class="btn btn-info float-right my-4" >Edit Profile</a>
                          </td>
                          <td>
                            <button class="btn btn-danger m-2" type="button" onclick="deleteDalali({{ $dalali->id }})">
                                Remove
                            </button>
                            @if(($dalali->verified == 0) && ($dalali->dialed == 0))
                            <a href="{{ route('admin.dalali.dialed', $dalali->id) }}"  class="btn btn-warning">Dialed</a>
                            <a href="{{ route('admin.dalali.verify', $dalali->id) }}"  class="btn btn-success">Verify</a>
                            @elseif(($dalali->verified == 1) && ($dalali->dialed == 0))
                            <a href="{{ route('admin.dalali.dialed', $dalali->id) }}"  class="btn btn-warning">Dialed</a>
                            <button class="btn btn-success m-2" type="button">
                                Already Verified
                            </button>
                            @elseif(($dalali->verified == 0) && ($dalali->dialed == 1))
                            <a href="{{ route('admin.dalali.verify', $dalali->id) }}"  class="btn btn-success">Verify</a>
                            <button class="btn btn-success m-2" type="button">
                                Already Dialed
                            </button>
                            @endif
            
                          <form id="delete-form-{{ $dalali->id }}" action="{{ route('admin.remove.dalali',$dalali->id) }}" method="POST" style="display: none;">
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
                  {{ $dalalis->links() }}
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
 function deleteDalali(id){
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