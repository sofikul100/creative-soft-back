


@extends('backend.master')
@section('title')
     All-Permission
@endsection
@section('main_content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>All Permission</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                     @if (Auth::user()->can('add.permission'))
                                     <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-permission-modal">Add Permission</button>
                                     @endif
                                      
                                </div>
                                <div class="card-body">
                                    <div class="example-container">
                                        <div class="example-content">
                                            <table id="datatable1" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Permission Name</th>
                                                        <th>Group Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach ($permissions as $key => $permission)
                                                    <tr>
                                                        <td>{{$key + 1 }}</td>
                                                        <td>{{$permission->name}}</td>
                                                        <td><span class="badge badge-primary ">{{$permission->group_name}}</span></td>
                                                        <td>
                                                            @if (Auth::user()->can('edit.permission'))
                                                            <a href="{{route('edit.permission',$permission->id)}}"> <button type="button" class="btn btn-info  btn-sm"><i class="material-icons m-auto text-center">edit</i>Edit</button></a>
                                                            @endif
                                                            
                                                            @if (Auth::user()->can('delete.permission'))
                                                            <button onclick="deletePermission({{$permission->id}})" type="button" class="btn btn-danger  btn-sm"> <i class="material-icons m-auto text-center">delete</i> Delete</button>
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

    <!------add permission modal start ----->
    <div class="modal fade" id="add-permission-modal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('add.permission')}}" method="POST">
                    @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="name" class="form-label">Permission Name<span class="text-danger">*</span></label>
                        <input type="text"  class="form-control @error('name') is-invalid @enderror" name="name"  id="name"  placeholder="example.menuname">
                        @error('name')
                          <p class="text-danger mt-2">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="group_name" class="form-label">Group Name<span class="text-danger">*</span></label>
                        <select class="form-select mt-4 @error('group_name') is-invalid @enderror" name="group_name" aria-label="Default select example">
                            <option selected disabled>Select Group Name</option>
                            <option value="permission">Permission</option>
                            <option value="role">Role</option>
                            <option value="role_in_permission">Role In Permission</option>
                            <option value="user">user</option>
                            <option value="logo">Logo</option>
                            <option value="service">Service</option>
                            <option value="team">Team</option>
                            <option value="client_say">Client Say</option>
                            <option value="slider">Slider</option>         
                            <option value="project">Project</option>
                            <option value="project_d_section">Project D Section</option>
                            <option value="project_price">Project Price</option>
                            <option value="contact_info">Contact Info</option>
                            <option value="order_info">Order Info</option>
                            <option value="why_choose_section">why Choose Section</option>
                        </select>
                        @error('group_name')
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
    <!------end add permission modal start ----->

</div>
<!------- jquery-------->
<script src="{{asset('backend/assets/plugins/jquery/jquery-3.5.1.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
     function  deletePermission (id){
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
                        url:"{{route('delete.permission')}}",
                        data:{id:id},
                        type:"post",
                        success:function(response){
                            if(response.success == true){
                                toastr.success(response.message); 
                                setInterval(() => {
                                    window.location.href='/all-permission';
                                }, 1000);
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
