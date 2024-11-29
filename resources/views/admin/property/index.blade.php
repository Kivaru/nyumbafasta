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
                      <h3 class="card-title float-left"><strong>Properties For Sale ({{ $propertiesCount }})</strong></h3>

                    <a href="{{route('admin.property.create')}}" class="btn btn-success btn-md float-right c-white">Add new <i class="fa fa-plus"></i></a>
                    </div>
                    <!-- /.card-header -->
                    @if ($properties->count() > 0)
                    <div class="">
                    <div class="table-responsive">
                      <table id="dataTableId" class="table table-bordered table-striped table-background">
                        <thead>
                        <tr>
                          <th>Image</th>
                          <th>Owner's name</th>
                          <th>Owner's number</th>
                          <th>Address</th>
                          <th>Property Type</th>
                          <th>Property Sqm</th>
                          <th>Price </th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($properties as $key=>$property)
                        <tr>
                          <td><img src="{{$property->getFirstMediaUrl('featured_image', 'thumb')}}" / width="120px"></td></td>
                          <td>{{ $property->name }}</td>
                          <td>{{ $property->contact }}</td>
                          <td>{{ $property->address }}</td>
                          <td>{{ $property->property_type }}</td>
                          <td>
                            @if ($property->sqm)
                            {{$property->sqm}}
                            @else
                                Not Specified
                            @endif
                          </td>
                          <td>{{ number_format($property->price) }}</td>
                          <td>
                            @if ($property->status == 1)
                                For Sale
                            @else
                                Sold
                            @endif
                          </td>
                          <td>

                            {{-- <a href="{{ route('admin.property.status', $property->id) }}"  class="btn btn-warning btn-sm ">Switch Status</a> --}}
                            <a href="{{ route('admin.property.show', $property->id) }}"  class="btn btn-success btn-sm">Details</a>
                            <a href="{{ route('admin.property.edit', $property->id) }}"  class="btn btn-info btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm" type="button" onclick="deleteHouse({{ $property->id }})">
                                Delete
                            </button>

                          <form id="delete-form-{{ $property->id }}" action="{{ route('admin.property.destroy',$property->id) }}" method="POST" style="display: none;">
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
                 <h2 class="text-center text-info font-weight-bold m-3">No Property Found</h2>
              @endif

               <div class="pagination">
                  {{ $properties->links() }}
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
