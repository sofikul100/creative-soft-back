


@extends('backend.master')
@section('title')
     Project Details
@endsection
@section('main_content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Manage Project Details</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-header">
                             @if (Auth::user()->can('add.project_d_section'))
                             <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-slider">Add New Project Detail Section</button>
                             @endif   
                             
                            </div>

                                <div class="card-body">
                                    <div class="example-container">
                                        <div class="example-content">
                                            <div class="table-responsive">
                                            <table id="project_details_table" class="display nowrap" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Project Detail Feature Image</th>
                                                        <th>Project Name</th>
                                                        <th>Project Detail Feature Content</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach ($project_details as $key => $pdetail)
                                                    <tr>
                                                        <td>{{$key + 1}}</td>
                                                        <td>{{$pdetail->project_detail_feature_image}}</td>
                                                        <td>{{$pdetail->project_id}}</td>
                                                        <td>{{$pdetail->project_detail_feature_content}}</td>
                                                        <td>{{$pdetail->status}}</td>
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

    <!------add project detail section start ----->
    <div class="modal fade" id="add-slider" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Project Detail Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="project_detail_section_form" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <div class="col-md-12 mt-4">
                        <label for="project_id" class="form-label">Select Project Name<span class="text-danger">*</span></label>
                        
                        <select name="project_id" id="project_id" class="form-select">
                             <option value="" selected disabled>Select Project Name</option>
                             @foreach ($projects as $project)
                             <option value="{{$project->id}}">{{$project->project_title}}</option>
                             @endforeach
                             
                        </select>
                        
                        <div id="project_id_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="project_detail_feature_content" class="form-label">Project Detail Features<span class="text-danger">*</span></label>
                        
                        <textarea name="project_detail_feature_content"  class="form-control"   id="project_detail_feature_content" rows="4">

                        </textarea>
                        
                        <div id="project_detail_feature_content_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="project_detail_feature_image" class="form-label">Project Detail Feature Image<span class="text-danger">*</span></label>
                        <input type="file"  class="form-control"  name="project_detail_feature_image"  id="project_detail_feature_image" >
                        
                        <div id="project_detail_feature_image_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-6 mt-2">
                         <img src="" alt=""  id="project_detail_feature_image_preview" style="display: none;width:200px;height:auto">
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
    <!------end project detail section modal  ----->
</div>
<!------- jquery-------->
<script src="{{asset('backend/assets/plugins/jquery/jquery-3.5.1.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
     // for yajra datatable ========//
     $(function project_details(){
          table = $("#project_details_table").DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{route('project_details.index')}}",
            columns:[
            {data:'DT_RowIndex',name:'DT_RowIndex'},
            {data:'project_detail_feature_image',name:'project_detail_feature_image'},
            {data:'project_title',name:'project_id'},
            {data:'project_detail_feature_content',name:'project_detail_feature_content'},
            {data:'status',name:'status'},
            {data:'action',name:'action',orderable:true,searchable:true}
            ]
          });
     });


     //======= add new project detail section=======//
     $("#project_detail_section_form").submit(function(e){
        e.preventDefault();
        let formData = new FormData(this)
        
        $.ajax({
            type:"POST",
            url:'{{route('add.project_detail_section')}}',
            data:formData,
            contentType: false,
            processData: false,
            success:function(response){
                if(response.success==true){
                    $('.modal').modal('hide');
                    toastr.success(response.message);
                     
                    $('#project_details_table').DataTable().ajax.reload();
                    $("#project_detail_feature_image_preview").css('display','none');
                    $("#project_detail_section_form")[0].reset();
                    $("#project_id").find('p:first').remove();
                    $("#project_detail_feature_content_error").find('p:first').remove();
                    $("#project_detail_feature_image_error").find('p:first').remove();
                }
            },
            error:function (error){
                $("#project_id_error").html(`<p class="text-danger">${error.responseJSON.errors.project_id ? error.responseJSON.errors.project_id :''}</p>`);
                $("#project_detail_feature_content_error").html(`<p class="text-danger">${error.responseJSON.errors.project_detail_feature_content ? error.responseJSON.errors.project_detail_feature_content :''}</p>`);
                $("#project_detail_feature_image_error").html(`<p class="text-danger">${error.responseJSON.errors.project_detail_feature_image ? error.responseJSON.errors.project_detail_feature_image :'' }</p>`);
            }
        })
     });




     //for delete single row====//
     function  deleteProjectDetailSection (id){
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
                        url:"{{route('delete.project_detail_section')}}",
                        data:{id:id},
                        type:"post",
                        success:function(response){
                            if(response.success == true){
                                toastr.success(response.message); 
                                $('#project_details_table').DataTable().ajax.reload();
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



     //======active and inactive status=============//
     $('body').on('change','.toggle-class',function (){
        var status = $(".toggle-class").prop('checked') == true ? 'active' : 'inactive';
        var project_detail_section_id = $(this).data('id');  
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{route("change.project.detail.section.status")}}',
            data: {'status': status, 'project_detail_section_id': project_detail_section_id},
            success: function(response){
                if(response.success == true){
                   $('#project_details_table').DataTable().ajax.reload();
                }
            },
            error:function(error){
                console.log(error)
            }
        });
     })


     //===== image preview for add service=========//
     $("#project_detail_feature_image").change(function (){
           let reader = new FileReader();

           reader.onload = (e) =>{
              $("#project_detail_feature_image_preview").css('display','block');
              $("#project_detail_feature_image_preview").attr('src',e.target.result)
           } 

           reader.readAsDataURL(this.files[0]);
       });

       //===== image preview for update logo=========//
     $("#slider_update_image").change(function (){
           let reader = new FileReader();

           reader.onload = (e) =>{
              $("#slider_update_image_preview").css('display','block');
              $("#slider_update_image_preview").attr('src',e.target.result)
           } 

           reader.readAsDataURL(this.files[0]);
       });
</script>
@endsection
