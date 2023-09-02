


@extends('backend.master')
@section('title')
    Edit-Role-Permission
@endsection
@section('main_content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Edit Role In Permission</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    <div class="example-container">
                                        <div class="example-content">

                                            <form action="{{route('update.role.permission',$role->id)}}" method="POST">
                                                @csrf
                                                <div class="col-md-6">
                                                    <label for="role_id" class="form-label">Role  Name</label>
                                                    <h4 class="bg-primary text-white p-2 ml-4">{{$role->name}}</h4>
                                                </div>

                                                <div class="mt-4 col-md-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="permission_all">
                                                        <label class="form-check-label" for="permission_all" style="font-weight: bold">
                                                            Permission All
                                                        </label>
                                                    </div>
                                                </div>
                                                <hr>
                                                <!-----  show all group_name from permission table-------->
                                                @foreach ($permission_groups as $permission_group)
                                                <div class="row">
                                                     <div class="col-md-3 mt-4">
                                                        @php
                                                        $permissions = App\Models\User::getPermissionByGroupName($permission_group->group_name);
                                                        @endphp
                                                          <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="group_name"  id="flexCheckDefault" 
                                                            {{App\Models\User::roleHasPermissions($role,$permissions) ? 'checked':''}}
                                                            >
                                                            <label class="form-check-label text-capitalize" for="flexCheckDefault" style="font-weight: bold">
                                                                {{$permission_group->group_name}}
                                                            </label>
                                                        </div>
                                                         
                                                     </div>
                                                     <div class="col-md-9  mt-4">        
                                                        @foreach ($permissions as $item)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="permissions[]" {{$role->hasPermissionTo($item->name) ? 'checked' : ''}} value="{{$item->id}}" id="flexCheckDefault{{$item->id}}">
                                                                <label class="form-check-label text-capitalize" for="flexCheckDefault{{$item->id}}">
                                                                    {{$item->name}}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                        
                                                     </div>
                                                </div>
                                                <hr>
                                                @endforeach

                                                <div class="col-md-6 mt-4">
                                                   <a href=""><button class="btn btn-primary"><i class="material-icons m-auto text-center">add</i>Add Now</button></a>
                                                </div>

                                        </form>


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
     $("#permission_all").click(function () { 
          if($(this).is(':checked')){
             $('input[type=checkbox]').prop('checked',true)
          }else{
             $('input[type=checkbox]').prop('checked',false)
          }
      });
</script>
@endsection
