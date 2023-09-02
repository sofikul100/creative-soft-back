


@extends('backend.master')
@section('title')
     Client-Says
@endsection
@section('main_content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Manage What Client Says</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-header">
                             <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-client-say">Add New Client Say</button>
                            </div>

                                <div class="card-body">
                                    <div class="example-container">
                                        <div class="example-content">
                                            <div class="table-responsive">
                                            <table id="client_says_table" class="display nowrap" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Client Photo</th>
                                                        <th>Client Name</th>
                                                        <th>Client Position</th>
                                                        <th>Client Message</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach ($client_says as $key => $client_say)
                                                    <tr>
                                                        <td>{{$key + 1}}</td>
                                                        <td><img src="{{asset('backend/what_client_says_images')}}/{{$client_say->client_image}}" alt=""></td>
                                                        <td>{{$client_say->client_name}}</td> 
                                                        <td>{{$client_say->client_position}}</td>
                                                        <td>{{$client_say->client_message}}</td>
                                                        <td>{{$client_say->status}}</td>
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

    <!------add client say modal start ----->
    <div class="modal fade" id="add-client-say" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Client Say</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="client_say_form" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="client_name" class="form-label">Client Name<span class="text-danger">*</span></label>
                        <input type="text"  class="form-control" required name="client_name"  id="client_name" placeholder="Enter Client Name...">
                        
                        <div id="client_name_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12">
                        <label for="client_position" class="form-label">Client Position<span class="text-danger">*</span></label>
                        <input type="text"  class="form-control" required name="client_position"  id="client_position" placeholder="Enter Client Position...">
                        
                        <div id="client_position_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="client_message" class="form-label">Client Message<span class="text-danger">*</span></label>
                        <textarea name="client_message" required class="form-control"  id="client_message" rows="4">

                        </textarea>
                        
                        <div id="client_message_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="client_image" class="form-label">Client Photo<span class="text-danger">*</span></label>
                        <input type="file"  class="form-control" required name="client_image"  id="client_image" >
                        
                        <div id="client_image_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-6 mt-2">
                         <img src="" alt=""  id="client_new_image_preview" style="display: none;width:150px;height:auto">
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
    <!------end add client say modal start ----->

    {{-- edit client say form --}}

    <div class="modal fade" id="edit_client_say" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="client_say_update_form" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <input type="hidden" name="client_say_id" id="client_say_id">
                    <div class="col-md-12 mb-4">
                        <img src="" class="previous_client_image" alt="" id="previous_client_image" style="width:70px;height:70px">
                    </div>
                    <div class="col-md-12">
                        <label for="client_update_name" class="form-label">Client Name</label>
                        <input type="text"  class="form-control"  name="client_update_name"  id="client_update_name" placeholder="Enter Client Name...">
                        
                        <div id="client_update_name_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12">
                        <label for="client_update_position" class="form-label">Client Position</label>
                        <input type="text"  class="form-control"  name="client_update_position"  id="client_update_position" placeholder="Enter Client Position...">
                        
                        <div id="client_update_position_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="client_update_message" class="form-label">Client Message</label>
                        <textarea name="client_update_message"  class="form-control"  id="client_update_message" rows="4">

                        </textarea>
                        
                        <div id="client_update_message_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="client_update_image" class="form-label">Client Photo</label>
                        <input type="file"  class="form-control"  name="client_update_image"  id="client_update_image" >
                    </div>
                    <div class="col-md-6 mt-2">
                         <img src="" alt=""  id="client_new_image_update_preview" style="display: none;width:70px;height:70px">
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

    {{-- end edit client say form --}}

</div>
<!------- jquery-------->
<script src="{{asset('backend/assets/plugins/jquery/jquery-3.5.1.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
     // for yajra datatable ========//
     $(function client_says(){
          table = $("#client_says_table").DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{route('client_says.index')}}",
            columns:[
            {data:'DT_RowIndex',name:'DT_RowIndex'},
            {data:'client_image',name:'client_image'},
            {data:'client_name',name:'client_name'},
            {data:'client_position',name:'client_position'},
            {data:'client_message',name:'client_message'},
            {data:'status',name:'status'},
            {data:'action',name:'action',orderable:true,searchable:true}
            ]
          });
     });


     //======= add new client say=======//
     $("#client_say_form").submit(function(e){
        e.preventDefault();
        let formData = new FormData(this)
        
        $.ajax({
            type:"POST",
            url:'{{route('add.client_say')}}',
            data:formData,
            contentType: false,
            processData: false,
            success:function(response){
                if(response.success==true){
                    $('.modal').modal('hide');
                    toastr.success(response.message);
                     
                    $('#client_says_table').DataTable().ajax.reload();
                    $("#client_new_image_preview").css('display','none');
                    $("#client_say_form")[0].reset();
                    $("#client_name_error").find('p:first').remove();
                    $("#client_position_error").find('p:first').remove();
                    $("#client_message_error").find('p:first').remove();
                    $("#client_image_error").find('p:first').remove();
                }
            },
            error:function (error){
                $("#client_name_error").html(`<p class="text-danger">${error.responseJSON.errors.client_name ? error.responseJSON.errors.client_name :''}</p>`);
                $("#client_position_error").html(`<p class="text-danger">${error.responseJSON.errors.client_position ? error.responseJSON.errors.client_position :''}</p>`);
                $("#client_message_error").html(`<p class="text-danger">${error.responseJSON.errors.client_message ? error.responseJSON.errors.client_message :'' }</p>`);
                $("#client_image_error").html(`<p class="text-danger">${error.responseJSON.errors.client_image ? error.responseJSON.errors.client_image :'' }</p>`);
            }
        })
     });


     //for edit client say==========//
     $('body').on("click",".edit_client_say",function(){
        var id = $(this).data("id");
           $.ajax({
              type:"GET",
              url:'{{route("edit.client_say")}}',
              data:{id:id},
              success: function (response){
                  $("#previous_client_image").attr('src',`{{asset('backend/what_client_says_images/${response[0].client_image}')}}`);
                  $("#client_update_name").val(response[0].client_name)
                  $("#client_update_position").val(response[0].client_position)
                  $("#client_update_message").val(response[0].client_message)
                  $("#client_say_id").val(response[0].id);
                },
              error:function (error) {
                 console.log(error)
              }
           });
     });

     //======= update new client say=======//
     $("#client_say_update_form").submit(function(e){
        e.preventDefault();
        let formData = new FormData(this)
        
        $.ajax({
            type:"POST",
            url:'{{route('update.client_say')}}',
            data:formData,
            contentType: false,
            processData: false,
            success:function(response){
                if(response.success==true){
                    $('.modal').modal('hide');
                    toastr.success(response.message);
                     
                    $('#client_says_table').DataTable().ajax.reload();
                    $("#previous_client_image").css('display','none');
                    $("#client_say_update_form")[0].reset();
                    $("#client_update_name_error").find('p:first').remove();
                    $("#client_update_position_error").find('p:first').remove();
                    $("#client_update_message_error").find('p:first').remove();
                }
            },
            error:function (error){
                $("#client_update_name_error").html(`<p class="text-danger">${error.responseJSON.errors.client_update_name ? error.responseJSON.errors.client_update_name :''}</p>`);
                $("#client_update_position_error").html(`<p class="text-danger">${error.responseJSON.errors.client_update_position ? error.responseJSON.errors.client_update_position :''}</p>`);
                $("#client_update_message_error").html(`<p class="text-danger">${error.responseJSON.errors.client_update_message ? error.responseJSON.errors.client_update_message :''}</p>`);
            }
        })
     });





     //for delete single row====//
     function  deleteClientSay (id){
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
                        url:"{{route('delete.client_say')}}",
                        data:{id:id},
                        type:"post",
                        success:function(response){
                            if(response.success == true){
                                toastr.success(response.message); 
                                $('#client_says_table').DataTable().ajax.reload();
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
        var client_say_id = $(this).data('id');  
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{route("change.client.say.status")}}',
            data: {'status': status, 'client_say_id': client_say_id},
            success: function(response){
                if(response.success == true){
                   $('#client_says_table').DataTable().ajax.reload();
                }
            },
            error:function(error){
                console.log(error)
            }
        });
     })


     //===== image preview for add service=========//
     $("#client_image").change(function (){
           let reader = new FileReader();

           reader.onload = (e) =>{
              $("#client_new_image_preview").css('display','block');
              $("#client_new_image_preview").attr('src',e.target.result)
           } 

           reader.readAsDataURL(this.files[0]);
       });

       //===== image preview for update logo=========//
     $("#client_update_image").change(function (){
           let reader = new FileReader();

           reader.onload = (e) =>{
              $("#client_new_image_update_preview").css('display','block');
              $("#client_new_image_update_preview").attr('src',e.target.result)
           } 

           reader.readAsDataURL(this.files[0]);
       });
</script>
@endsection
