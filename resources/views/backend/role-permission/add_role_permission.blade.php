


@extends('backend.master')
@section('title')
    Add-Role-Permission
@endsection
@section('main_content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Add Role In Permission</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    <div class="example-container">
                                        <div class="example-content">

                                            <form action="{{route('add.role.permission')}}" method="POST">
                                                @csrf
                                                <div class="col-md-6">
                                                    <label for="role_id" class="form-label">Role Name</label>
                                                    <select class="form-select  @error('role_id') is-invalid @enderror" name="role_id" id="role_id" aria-label="Default select example">
                                                           <option selected disabled>Select Role Name</option>
                                                        @foreach ($roles as $role)
                                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                                        @endforeach   
                                                           
                                                    </select>
                                                    @error('role_id')
                                                      <p class="text-danger mt-2">{{$message}}</p>
                                                    @enderror
                                                </div>

                                            <div id="all_input" class="all_input">

                                            
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
                                                         
                                                          <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="group_name"  id="flexCheckDefault">
                                                            <label class="form-check-label text-capitalize" for="flexCheckDefault" style="font-weight: bold">
                                                                {{$permission_group->group_name}}
                                                            </label>
                                                        </div>
                                                         
                                                     </div>
                                                     <div class="col-md-9  mt-4">
                                                @php
                                                     $permissions = App\Models\User::getPermissionByGroupName($permission_group->group_name);
                                                @endphp        
                                                        @foreach ($permissions as $item)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{$item->id}}" id="flexCheckDefault{{$item->id}}">
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

                                            </div>
                                            
                                            {{-- if role has permission then this div will show --}}
                                            <div id="instruction" class="mt-4" style="display: none;font-weight:bold">
                                               <p>This Role has Already some Permission.. If You Want to assign another permission then Go to Role Permission Edit Page <a href="{{route('all.role.permission')}}">Click Here</a></p>
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

      $('#role_id').change(function () {
          let role_id = $("#role_id").val();
          $.ajax({
             headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             url:'{{route("check.role.has.permission")}}',
             type:"post",
             data:{role_id:role_id},
             success:function (response){
                 if(response.success == false){
                    //======= there is no permission in this role id=========//
                    $("#all_input").css('display','block');
                 }else{
                    //===========has permission in this role id=========//
                    $("#all_input").css('display','none');
                    $("#instruction").css('display','block')
                 }
             },
             error:function (error){
                console.log(error)
             }
          })
      });
</script>
@endsection
