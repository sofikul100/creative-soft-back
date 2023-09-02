


@extends('backend.master')
@section('title')
     Slider
@endsection
@section('main_content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Manage Sliders</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-header">
                             @if (Auth::user()->can('add.slider'))
                             <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-slider">Add New Slider</button>
                             @endif   
                             
                            </div>

                                <div class="card-body">
                                    <div class="example-container">
                                        <div class="example-content">
                                            <div class="table-responsive">
                                            <table id="slider_table" class="display nowrap" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Slider Image</th>
                                                        <th>Slider TopTitle</th>
                                                        <th>Slider MainTitle</th>
                                                        <th>Slider SubTitle</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach ($sliders as $key => $slider)
                                                    <tr>
                                                        <td>{{$key + 1}}</td>
                                                        <td><img src="{{asset('backend/slider_images')}}/{{$slider->slider_image}}" alt="" style="width:200px;height:auto"></td>
                                                        <td>{{$slider->toptitle}}</td> 
                                                        <td>{{$slider->maintitle}}</td>
                                                        <td>{{$slider->subtitle}}</td>
                                                        <td>{{$slider->status}}</td>
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

    <!------add slider modal start ----->
    <div class="modal fade" id="add-slider" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Slider</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="slider_add_form" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="slider_toptitle" class="form-label">Slider Top Title<span class="text-danger">*</span></label>
                        <input type="text" required class="form-control"  name="slider_toptitle"  id="slider_toptitle" placeholder="Enter Toptitle Name...">
                        
                        <div id="slider_toptitle_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12">
                        <label for="slider_maintitle" class="form-label">Slider Main Title<span class="text-danger">*</span></label>
                        <input type="text" required class="form-control"  name="slider_maintitle"  id="slider_maintitle" placeholder="Enter Maintitle Name...">
                        
                        <div id="slider_maintitle_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="slider_subtitle" class="form-label">Slider Sub Title<span class="text-danger">*</span></label>
                        <textarea name="slider_subtitle" required class="form-control"  id="slider_subtitle" rows="4">

                        </textarea>
                        
                        <div id="slider_subtitle_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="slider_image" class="form-label">Slider Image<span class="text-danger">*</span></label>
                        <input type="file" required class="form-control"  name="slider_image"  id="slider_image" >
                        
                        <div id="slider_image_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-6 mt-2">
                         <img src="" alt=""  id="slider_new_image_preview" style="display: none;width:200px;height:auto">
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
    <!------end add slider modal start ----->

    {{-- edit slider form --}}

    <div class="modal fade" id="edit_slider" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Slider</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="slider_update_form" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <input type="hidden" name="slider_id" id="slider_id">
                    <div class="col-md-12 mb-4">
                        <img src="" class="preview_slider_image" alt="" id="preview_slider_image" style="width:200px;height:auto">
                    </div>
                    <div class="col-md-12">
                        <label for="slider_update_toptitle" class="form-label">Slider Top Title</label>
                        <input type="text"  class="form-control"  name="slider_update_toptitle"  id="slider_update_toptitle" placeholder="Enter top title Name...">
                        
                        <div id="slider_update_toptitle_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12">
                        <label for="slider_update_maintitle" class="form-label">Slider Main Title</label>
                        <input type="text"  class="form-control"  name="slider_update_maintitle"  id="slider_update_maintitle" placeholder="Enter Main title name....">
                        
                        <div id="slider_update_maintitle_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="slider_update_subtitle" class="form-label">Slider Sub Title</label>
                        <textarea name="slider_update_subtitle"  class="form-control"  id="slider_update_subtitle" rows="4">

                        </textarea>
                        
                        <div id="slider_update_subtitle_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="slider_update_image" class="form-label">Slider Image</label>
                        <input type="file"  class="form-control"  name="slider_update_image"  id="slider_update_image" >
                    </div>
                    <div class="col-md-6 mt-2">
                         <img src="" alt=""  id="slider_update_image_preview" style="display: none;width:200px;height:auto">
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

    {{-- end edit slider form --}}

</div>
<!------- jquery-------->
<script src="{{asset('backend/assets/plugins/jquery/jquery-3.5.1.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
     // for yajra datatable ========//
     $(function slider(){
          table = $("#slider_table").DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{route('slider.index')}}",
            columns:[
            {data:'DT_RowIndex',name:'DT_RowIndex'},
            {data:'slider_image',name:'slider_image'},
            {data:'slider_toptitle',name:'slider_toptitle'},
            {data:'slider_maintitle',name:'slider_maintitle'},
            {data:'slider_subtitle',name:'slider_subtitle'},
            {data:'status',name:'status'},
            {data:'action',name:'action',orderable:true,searchable:true}
            ]
          });
     });


     //======= add new slider=======//
     $("#slider_add_form").submit(function(e){
        e.preventDefault();
        let formData = new FormData(this)
        
        $.ajax({
            type:"POST",
            url:'{{route('add.slider')}}',
            data:formData,
            contentType: false,
            processData: false,
            success:function(response){
                if(response.success==true){
                    $('.modal').modal('hide');
                    toastr.success(response.message);
                     
                    $('#slider_table').DataTable().ajax.reload();
                    $("#slider_new_image_preview").css('display','none');
                    $("#slider_add_form")[0].reset();
                    $("#slider_toptitle_error").find('p:first').remove();
                    $("#slider_maintitle_error").find('p:first').remove();
                    $("#slider_subtitle_error").find('p:first').remove();
                    $("#slider_image_error").find('p:first').remove();
                }
            },
            error:function (error){
                $("#slider_toptitle_error").html(`<p class="text-danger">${error.responseJSON.errors.slider_toptitle ? error.responseJSON.errors.slider_toptitle :''}</p>`);
                $("#slider_maintitle_error").html(`<p class="text-danger">${error.responseJSON.errors.slider_maintitle ? error.responseJSON.errors.slider_maintitle :''}</p>`);
                $("#slider_subtitle_error").html(`<p class="text-danger">${error.responseJSON.errors.slider_subtitle ? error.responseJSON.errors.slider_subtitle :'' }</p>`);
                $("#slider_image_error").html(`<p class="text-danger">${error.responseJSON.errors.slider_image ? error.responseJSON.errors.slider_image :'' }</p>`);
            }
        })
     });


     //for edit slider==========//
     $('body').on("click",".edit_slider",function(){
        var id = $(this).data("id");
           $.ajax({
              type:"GET",
              url:'{{route("edit.slider")}}',
              data:{id:id},
              success: function (response){
                  $("#preview_slider_image").attr('src',`{{asset('backend/slider_images/${response[0].slider_image}')}}`);
                  $("#slider_update_toptitle").val(response[0].slider_toptitle)
                  $("#slider_update_maintitle").val(response[0].slider_maintitle)
                  $("#slider_update_subtitle").val(response[0].slider_subtitle)
                  $("#slider_id").val(response[0].id);
                },
              error:function (error) {
                 console.log(error)
              }
           });
     });

     //======= update new slider=======//
     $("#slider_update_form").submit(function(e){
        e.preventDefault();
        let formData = new FormData(this)
        
        $.ajax({
            type:"POST",
            url:'{{route('update.slider')}}',
            data:formData,
            contentType: false,
            processData: false,
            success:function(response){
                if(response.success==true){
                    $('.modal').modal('hide');
                    toastr.success(response.message);
                     
                    $('#slider_table').DataTable().ajax.reload();
                    $("#preview_slider_image").css('display','none');
                    $("#slider_update_image_preview").css('display','none');
                    $("#slider_update_form")[0].reset();
                    $("#slider_update_toptitle_error").find('p:first').remove();
                    $("#slider_update_maintitle_error").find('p:first').remove();
                    $("#slider_update_subtitle_error").find('p:first').remove();
                }
            },
            error:function (error){
                $("#slider_update_toptitle_error").html(`<p class="text-danger">${error.responseJSON.errors.slider_update_toptitle ? error.responseJSON.errors.slider_update_toptitle :''}</p>`);
                $("#slider_update_maintitle_error").html(`<p class="text-danger">${error.responseJSON.errors.slider_update_maintitle ? error.responseJSON.errors.slider_update_maintitle :''}</p>`);
                $("#slider_update_subtitle_error").html(`<p class="text-danger">${error.responseJSON.errors.slider_update_subtitle ? error.responseJSON.errors.slider_update_subtitle :''}</p>`);
            }
        })
     });





     //for delete single row====//
     function  deleteSlider (id){
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
                        url:"{{route('delete.slider')}}",
                        data:{id:id},
                        type:"post",
                        success:function(response){
                            if(response.success == true){
                                toastr.success(response.message); 
                                $('#slider_table').DataTable().ajax.reload();
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
        var slider_id = $(this).data('id');  
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{route("change.slider.status")}}',
            data: {'status': status, 'slider_id': slider_id},
            success: function(response){
                if(response.success == true){
                   $('#slider_table').DataTable().ajax.reload();
                }
            },
            error:function(error){
                console.log(error)
            }
        });
     })


     //===== image preview for add service=========//
     $("#slider_image").change(function (){
           let reader = new FileReader();

           reader.onload = (e) =>{
              $("#slider_new_image_preview").css('display','block');
              $("#slider_new_image_preview").attr('src',e.target.result)
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
