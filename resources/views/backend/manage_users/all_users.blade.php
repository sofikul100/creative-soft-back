


@extends('backend.master')
@section('title')
     All-Users
@endsection
@section('main_content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>All Users</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    @if (Auth::user()->can('add.user'))
                                    <a href="{{route('add.user.form')}}"> <button class="btn btn-outline-primary btn-sm">Add User</button></a>
                                    @endif
                                     
                                </div>
                                <div class="card-body">
                                    <div class="example-container">
                                        <div class="example-content">
                                            <div class="table-responsive">
                                            <table id="datatable3" class="display nowrap" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Avatar</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Address</th>
                                                        <th>Role</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach ($users as $key => $user)
                                                    <tr>
                                                        <td>{{$key + 1 }}</td>
                                                        <td>
                                                            @if ($user->avatar == NULL)
                                                            <img src="{{asset('backend/assets/images/no-image.png')}}" alt="{{$user->name}}" style="width:60px;height:auto;border-radius:40px">
                                                            @else
                                                            <img src="{{asset('backend/profile_pictures')}}/{{$user->avatar}}" alt="{{$user->name}}" style="width:60px;height:auto;border-radius:40px">
                                                            @endif
                                                        </td>
                                                        <td>{{$user->name}}</td>
                                                        <td>{{$user->email}}</td>
                                                        <td>
                                                            @if ($user->phone == NULL)
                                                              Not Available
                                                            @else
                                                            {{$user->phone}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($user->address == NULL)
                                                              Not Available
                                                            @else
                                                            {{$user->address}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @foreach ($user->roles as $role)
                                                                <span class="badge badge-primary">{{$role->name}}</span>
                                                            @endforeach
                                                        </td>
                                                        <td>{{$user->status}}</td>
                                                        <td>
                                                            @if (Auth::user()->can('edit.user'))
                                                            <a href="{{route('edit.user',$user->id)}}"> <button type="button" class="btn btn-outline-info  btn-sm mt-2"><i class="material-icons m-auto text-center">edit</i>Edit</button></a>
                                                            @endif
                                                            @if (Auth::user()->can('delete.user'))
                                                             
                                                            @foreach ($user->roles as $role)
                                                             <button onclick="deleteUser({{$user->id}})" {{$role->name == "superadmin" ? 'disabled':''}} type="button" class="btn btn-outline-danger mt-2 btn-sm"> <i class="material-icons m-auto text-center">delete</i>Delete</button>
                                                            @endforeach
                                                            
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
</div>
<!------- jquery-------->
<script src="{{asset('backend/assets/plugins/jquery/jquery-3.5.1.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
     function  deleteUser (id){
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
                        url:"{{route('delete.user')}}",
                        data:{id:id},
                        type:"post",
                        success:function(response){
                            if(response.success == true){
                                toastr.success(response.message); 
                                setInterval(() => {
                                    window.location.href='/all-users';
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
