


@extends('backend.master')
@section('title')
     All-Role
@endsection
@section('main_content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>All Role</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                      @if (Auth::user()->can('add.role'))
                                      <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-permission-modal">Add Role</button>
                                      @endif
                                      
                                </div>
                                <div class="card-body">
                                    <div class="example-container">
                                        <div class="example-content">
                                            <table id="datatable1" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Role Name</th>
                                                        <th>Created At</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach ($roles as $key => $role)
                                                    <tr>
                                                        <td>{{$key + 1 }}</td>
                                                        <td>{{$role->name}}</td>
                                                        <td>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $role->created_at)->format('d-m-Y')}}</td>
                                                        <td>
                                                            @if (Auth::user()->can('edit.role'))
                                                            <a href="{{route('edit.role',$role->id)}}"> <button type="button" class="btn btn-info  btn-sm"><i class="material-icons m-auto text-center">edit</i>Edit</button></a>
                                                            @endif
                                                            @if (Auth::user()->can('delete.role'))
                                                            <button onclick="deleteRole({{$role->id}})" type="button" class="btn btn-danger  btn-sm"> <i class="material-icons m-auto text-center">delete</i> Delete</button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                   @endforeach
                                                </tbody>
                                            </table>  
                                        </div>
                                    </div>
                                </div>
                            </div>  
                </div>
            </div>
           
        </div>
    </div>

    <!------add role modal start ----->
    <div class="modal fade" id="add-permission-modal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('add.role')}}" method="POST">
                    @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="name" class="form-label">Role Name</label>
                        <input type="text"  class="form-control @error('name') is-invalid @enderror" name="name"  id="name"  placeholder="Enter Role Name...">
                        @error('name')
                          <p class="text-danger mt-2">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i class="material-icons m-auto text-center">close</i>Close</button>
                    <button type="submit" class="btn btn-primary"> <i class="material-icons m-auto text-center">add</i>Add Now</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!------end add role modal start ----->

</div>
<!------- jquery-------->
<script src="{{asset('backend/assets/plugins/jquery/jquery-3.5.1.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
     function  deleteRole (id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed){
                        $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:"{{route('delete.role')}}",
                        data:{id:id},
                        type:"post",
                        success:function(response){
                            if(response.success == true){
                                toastr.success(response.message); 
                                setInterval(() => {
                                    window.location.href='/all-role';
                                }, 500);
                            }
                        },
                        error:function (error){
                            console.log(error)
                        }
                    });

                    }

                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    Swal.fire(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    );
                }
            });





     }
</script>
@endsection
