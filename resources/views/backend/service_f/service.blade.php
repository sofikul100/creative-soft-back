


@extends('backend.master')
@section('title')
     Service
@endsection
@section('main_content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Manage Service</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-header">
                             @if (Auth::user()->can('add.service'))
                               <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-service">Add New Service</button>
                             @endif   
                            
                            </div>

                                <div class="card-body">
                                    <div class="example-container">
                                        <div class="example-content">
                                            <table id="service-table" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Service Image</th>
                                                        <th>Service Title</th>
                                                        <th>Service Description</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach ($services as $key => $service)
                                                    <tr>
                                                        <td>{{$key + 1}}</td>
                                                        <td><img src="{{asset('backend/service_images')}}/{{$service->service_image}}" alt=""></td>
                                                        <td>{{$service->service_title}}</td> 
                                                        <td>{{$service->service_description}}</td>
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
    <div class="modal fade" id="add-service" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="service_form" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="service_title" class="form-label">Service Title</label>
                        <input type="text"  class="form-control" name="service_title"  id="service_title" placeholder="Enter Service Title...">
                        
                        <div id="service_title_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="service_title" class="form-label">Service Description</label>
                        <textarea name="service_description" class="form-control" placeholder="Describe yourself here..." id="service_description" rows="4">

                        </textarea>
                        
                        <div id="service_description_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="service_image" class="form-label">Service Image</label>
                        <input type="file"  class="form-control" name="service_image"  id="service_image" >
                        
                        <div id="service_image_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-6 mt-2">
                         <img src="" alt=""  id="service_new_preview" style="display: none;width:150px;height:auto">
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

    <div class="modal fade" id="edit-service" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="service_update_form" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <input type="hidden" name="service_id" id="service_id">
                    <div class="col-md-12 mb-4">
                        <img src="" class="previous_service_image" alt="" id="previous_service_image" style="width:200px;height:140px">
                    </div>
                    <div class="col-md-12">
                        <label for="service_update_title" class="form-label">Service Title</label>
                        <input type="text"  class="form-control" name="service_update_title"  id="service_update_title" placeholder="Enter Service Title...">
                        
                        <div id="service_title_update_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="service_update_description" class="form-label">Service Description</label>
                        <textarea name="service_update_description" class="form-control" placeholder="Describe yourself here..." id="service_update_description" rows="4">

                        </textarea>
                        
                        <div id="service_description_update_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="service_update_image" class="form-label">Service Image</label>
                        <input type="file"  class="form-control" name="service_update_image"  id="service_update_image" >
                        
                        <div id="service_image_update_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-6 mt-2">
                         <img src="" alt=""  id="service_update_preview" style="display: none;width:150px;height:auto">
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
     $(function service(){
          table = $("#service-table").DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{route('service.index')}}",
            columns:[
            {data:'DT_RowIndex',name:'DT_RowIndex'},
            {data:'service_image',name:'service_image'},
            {data:'service_title',name:'service_title'},
            {data:'service_description',name:'service_description'},
            {data:'action',name:'action',orderable:true,searchable:true}
            ]
          });
     });


     //======= add new service=======//
     $("#service_form").submit(function(e){
        e.preventDefault();
        let formData = new FormData(this)
        
        $.ajax({
            type:"POST",
            url:'{{route('add.service')}}',
            data:formData,
            contentType: false,
            processData: false,
            success:function(response){
                if(response.success==true){
                    $('.modal').modal('hide');
                    toastr.success(response.message);
                     
                    $('#service-table').DataTable().ajax.reload();
                    $("#service_new_preview").css('display','none');
                    $("#service_form")[0].reset();
                    $("#service_title_error").find('p:first').remove();
                    $("#service_description_error").find('p:first').remove();
                    $("#service_image_error").find('p:first').remove();
                }
            },
            error:function (error){
                $("#service_title_error").html(`<p class="text-danger">${error.responseJSON.errors.service_title ? error.responseJSON.errors.service_title :''}</p>`);
                $("#service_description_error").html(`<p class="text-danger">${error.responseJSON.errors.service_description ? error.responseJSON.errors.service_description :''}</p>`);
                $("#service_image_error").html(`<p class="text-danger">${error.responseJSON.errors.service_image ? error.responseJSON.errors.service_image :'' }</p>`);
            }
        })
     });


     //for edit service==========//
     $('body').on("click",".edit_service",function(){
        var id = $(this).data("id");
           $.ajax({
              type:"GET",
              url:'{{route("edit.service")}}',
              data:{id:id},
              success: function (response){
                  $("#previous_service_image").attr('src',`{{asset('backend/service_images/${response[0].service_image}')}}`);
                  $("#service_update_title").val(response[0].service_title)
                  $("#service_update_description").val(response[0].service_description)
                  $("#service_id").val(response[0].id);
                },
              error:function (error) {
                 console.log(error)
              }
           });
     });

     //======= update new service=======//
     $("#service_update_form").submit(function(e){
        e.preventDefault();
        let formData = new FormData(this)
        
        $.ajax({
            type:"POST",
            url:'{{route('update.service')}}',
            data:formData,
            contentType: false,
            processData: false,
            success:function(response){
                if(response.success==true){
                    $('.modal').modal('hide');
                    toastr.success(response.message);
                     
                    $('#service-table').DataTable().ajax.reload();
                    $("#service_update_preview").css('display','none');
                    $("#service_update_form")[0].reset();
                    $("#service_title_update_error").find('p:first').remove();
                    $("#service_description_update_error").find('p:first').remove();
                    $("#service_image_update_error").find('p:first').remove();
                }
            },
            error:function (error){
                $("#service_title_update_error").html(`<p class="text-danger">${error.responseJSON.errors.service_update_title ? error.responseJSON.errors.service_update_title :''}</p>`);
                $("#service_description_update_error").html(`<p class="text-danger">${error.responseJSON.errors.service_update_description ? error.responseJSON.errors.service_update_description :''}</p>`);
            }
        })
     });





     //for delete single row====//
     function  deleteService (id){
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
                        url:"{{route('delete.service')}}",
                        data:{id:id},
                        type:"post",
                        success:function(response){
                            if(response.success == true){
                                toastr.success(response.message); 
                                $('#service-table').DataTable().ajax.reload();
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


     //===== image preview for add service=========//
     $("#service_image").change(function (){
           let reader = new FileReader();

           reader.onload = (e) =>{
              $("#service_new_preview").css('display','block');
              $("#service_new_preview").attr('src',e.target.result)
           } 

           reader.readAsDataURL(this.files[0]);
       });

       //===== image preview for update logo=========//
     $("#service_update_image").change(function (){
           let reader = new FileReader();

           reader.onload = (e) =>{
              $("#service_update_preview").css('display','block');
              $("#service_update_preview").attr('src',e.target.result)
           } 

           reader.readAsDataURL(this.files[0]);
       });
</script>
@endsection
