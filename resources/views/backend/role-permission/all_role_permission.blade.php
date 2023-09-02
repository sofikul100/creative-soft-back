


@extends('backend.master')
@section('title')
     All-Role-Permission
@endsection
@section('main_content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>All Role In Permission</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    <div class="example-container">
                                        <div class="example-content">
                                            <table id="datatable1" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Role Name</th>
                                                        <th>Permission Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach ($roles as $key => $role)
                                                    <tr>
                                                        <td>{{$key + 1 }}</td>
                                                        <td>{{$role->name}}</td>
                                                        <td>
                                                        @foreach ($role->permissions as $permission)
                                                            <span class="badge badge-primary">{{$permission->name}}</span>
                                                        @endforeach    
   
                                                        </td>
                                                        <td>
                                                            @if (Auth::user()->can('edit.role_in_permission'))
                                                            <a href="{{route('edit.role.permission',$role->id)}}"> <button type="button" class="btn btn-info  btn-sm mb-2"><i class="material-icons m-auto text-center">edit</i></button></a>
                                                            @endif
                                                            @if (Auth::user()->can('delete.role_in_permission'))
                                                            <button onclick="deleteRoleAndPermission({{$role->id}})"  type="button" class="btn btn-danger  btn-sm mb-2"> <i class="material-icons m-auto text-center">delete</i> </button>
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
</div>
<!------- jquery-------->
<script src="{{asset('backend/assets/plugins/jquery/jquery-3.5.1.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function  deleteRoleAndPermission (id){
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
                       url:"{{route('delete.role.permission')}}",
                       data:{id:id},
                       type:"post",
                       success:function(response){
                           if(response.success == true){
                               toastr.success(response.message); 
                               setInterval(() => {
                                   window.location.href='/all-role-permissions';
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
