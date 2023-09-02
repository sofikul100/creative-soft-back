


@extends('backend.master')
@section('title')
     Project
@endsection
@section('main_content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Manage Project</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-header">
                             @if (Auth::user()->can('add.project'))
                             <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-project">Add New Project</button>
                             @endif   
                            
                            </div>

                                <div class="card-body">
                                    <div class="example-container">
                                        <div class="example-content">
                                            <div class="table-responsive">
                                            <table id="project-table" class="display nowrap" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Project Image</th>
                                                        <th>Project Title</th>
                                                        <th>Project Description</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach ($projects as $key => $project)
                                                    <tr>
                                                        <td>{{$key + 1}}</td>
                                                        <td><img src="{{asset('backend/project_images')}}/{{$project->project_image}}" alt=""></td>
                                                        <td>{{$project->project_title}}</td> 
                                                        <td>{{$project->project_description}}</td>
                                                        <td>Action</td>
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

    <!------add role modal start ----->
    <div class="modal fade" id="add-project" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="project_form" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="project_title" class="form-label">Project Title</label>
                        <input type="text"  class="form-control" name="project_title"  id="project_title" placeholder="Enter project Title...">
                        
                        <div id="project_title_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="project_title" class="form-label">Project Description</label>
                        <textarea name="project_description" class="form-control"  id="project_description" rows="4">

                        </textarea>
                        
                        <div id="project_description_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="project_image" class="form-label">Project Image</label>
                        <input type="file"  class="form-control" name="project_image"  id="project_image" >
                        
                        <div id="project_image_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-6 mt-2">
                         <img src="" alt=""  id="project_new_preview" style="display: none;width:150px;height:auto">
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

    {{-- edit logo form --}}

    <div class="modal fade" id="edit-project" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="project_update_form" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <input type="hidden" name="project_id" id="project_id">
                    <div class="col-md-12 mb-4">
                        <img src="" class="previous_project_image" alt="" id="previous_project_image" style="width:200px;height:140px">
                    </div>
                    <div class="col-md-12">
                        <label for="project_update_title" class="form-label">Project Title</label>
                        <input type="text"  class="form-control" name="project_update_title"  id="project_update_title" placeholder="Enter project Title...">
                        
                        <div id="project_title_update_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="project_update_description" class="form-label">Project Description</label>
                        <textarea name="project_update_description" class="form-control" placeholder="Describe yourself here..." id="project_update_description" rows="4">

                        </textarea>
                        
                        <div id="project_description_update_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="project_update_image" class="form-label">Project Image</label>
                        <input type="file"  class="form-control" name="project_update_image"  id="project_update_image" >
                        
                        <div id="project_image_update_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-6 mt-2">
                         <img src="" alt=""  id="project_update_preview" style="display: none;width:150px;height:auto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i class="material-icons m-auto text-center">close</i>Close</button>
                    <button type="submit" class="btn btn-primary"> <i class="material-icons m-auto text-center">add</i>Update Now</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    {{-- end edit logo form --}}

</div>
<!------- jquery-------->
<script src="{{asset('backend/assets/plugins/jquery/jquery-3.5.1.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
     // for yajra datatable ========//
     $(function project(){
          table = $("#project-table").DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{route('project.index')}}",
            columns:[
            {data:'DT_RowIndex',name:'DT_RowIndex'},
            {data:'project_image',name:'project_image'},
            {data:'project_title',name:'project_title'},
            {data:'project_description',name:'project_description'},
            {data:'action',name:'action',orderable:true,searchable:true}
            ]
          });
     });


     //======= add new service=======//
     $("#project_form").submit(function(e){
        e.preventDefault();
        let formData = new FormData(this)
        
        $.ajax({
            type:"POST",
            url:'{{route('add.project')}}',
            data:formData,
            contentType: false,
            processData: false,
            success:function(response){
                if(response.success==true){
                    $('.modal').modal('hide');
                    toastr.success(response.message);
                     
                    $('#project-table').DataTable().ajax.reload();
                    $("#project_new_preview").css('display','none');
                    $("#project_form")[0].reset();
                    $("#project_title_error").find('p:first').remove();
                    $("#project_description_error").find('p:first').remove();
                    $("#project_image_error").find('p:first').remove();
                }
            },
            error:function (error){
                $("#project_title_error").html(`<p class="text-danger">${error.responseJSON.errors.project_title ? error.responseJSON.errors.project_title :''}</p>`);
                $("#project_description_error").html(`<p class="text-danger">${error.responseJSON.errors.project_description ? error.responseJSON.errors.project_description :''}</p>`);
                $("#project_image_error").html(`<p class="text-danger">${error.responseJSON.errors.project_image ? error.responseJSON.errors.project_image :'' }</p>`);
            }
        })
     });


     //for edit service==========//
     $('body').on("click",".edit_project",function(){
        var id = $(this).data("id");
           $.ajax({
              type:"GET",
              url:'{{route("edit.project")}}',
              data:{id:id},
              success: function (response){
                  $("#previous_project_image").attr('src',`{{asset('backend/project_images/${response[0].project_image}')}}`);
                  $("#project_update_title").val(response[0].project_title)
                  $("#project_update_description").val(response[0].project_description)
                  $("#project_id").val(response[0].id);
                },
              error:function (error) {
                 console.log(error)
              }
           });
     });

     //======= update new service=======//
     $("#project_update_form").submit(function(e){
        e.preventDefault();
        let formData = new FormData(this)
        
        $.ajax({
            type:"POST",
            url:'{{route('update.project')}}',
            data:formData,
            contentType: false,
            processData: false,
            success:function(response){
                if(response.success==true){
                    $('.modal').modal('hide');
                    toastr.success(response.message);
                     
                    $('#project-table').DataTable().ajax.reload();
                    $("#project_update_preview").css('display','none');
                    $("#project_update_form")[0].reset();
                    $("#project_title_update_error").find('p:first').remove();
                    $("#project_description_update_error").find('p:first').remove();
                    $("#project_image_update_error").find('p:first').remove();
                }
            },
            error:function (error){
                $("#project_title_update_error").html(`<p class="text-danger">${error.responseJSON.errors.project_update_title ? error.responseJSON.errors.project_update_title :''}</p>`);
                $("#project_description_update_error").html(`<p class="text-danger">${error.responseJSON.errors.project_update_description ? error.responseJSON.errors.project_update_description :''}</p>`);
            }
        })
     });





     //for delete single row====//
     function  deleteProject (id){
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
                        url:"{{route('delete.project')}}",
                        data:{id:id},
                        type:"post",
                        success:function(response){
                            if(response.success == true){
                                toastr.success(response.message); 
                                $('#project-table').DataTable().ajax.reload();
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





     };






     //===== image preview for add service=========//
     $("#project_image").change(function (){
           let reader = new FileReader();

           reader.onload = (e) =>{
              $("#project_new_preview").css('display','block');
              $("#project_new_preview").attr('src',e.target.result)
           } 

           reader.readAsDataURL(this.files[0]);
       });

       //===== image preview for update logo=========//
     $("#project_update_image").change(function (){
           let reader = new FileReader();

           reader.onload = (e) =>{
              $("#project_update_preview").css('display','block');
              $("#project_update_preview").attr('src',e.target.result)
           } 

           reader.readAsDataURL(this.files[0]);
       });
</script>
@endsection
