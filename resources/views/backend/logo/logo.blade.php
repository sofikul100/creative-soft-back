


@extends('backend.master')
@section('title')
     Logo-Index
@endsection
@section('main_content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Manage Logo</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-header">
                             @if (Auth::user()->can('add.logo'))
                              <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-logo">Add Logo</button>
                             @endif
                            </div>

                                <div class="card-body">
                                    <div class="example-container">
                                        <div class="example-content">
                                            <table id="logo-table" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Logo Image</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach ($logo as $key => $lg)
                                                    <tr>
                                                        <td>{{$key + 1}}</td>
                                                        <td>{{$lg->logo}}</td>
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
    <div class="modal fade" id="add-logo" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Logo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('add.logo')}}" method="POST" id="logo_form" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="logo" class="form-label">Logo Image</label>
                        <input type="file"  class="form-control" name="logo"  id="logo" >
                        
                        <div id="logo_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-6 mt-2">
                         <img src="" alt=""  id="logo_new_preview" style="display: none;width:150px;height:auto">
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

    <div class="modal fade" id="edit-logo" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Logo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('update.logo')}}" method="POST" id="logo_update_form" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <div class="col-md-6">
                        <img src="" id="previous_logo" alt="" style="width:200px;height:100px">
                   </div>
                    <div class="col-md-12 mt-4">
                       
                        <label for="update_logo" class="form-label">Logo Image</label>
                        <input type="file"  class="form-control" name="update_logo"  id="update_logo" >
                        <input type="hidden" name="logo_id" id="logo_id">
                        <div id="logo_update_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-6 mt-2">
                         <img src="" alt=""  id="logo_update_preview" style="display: none;width:200px;height:100px;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i class="material-icons m-auto text-center">close</i>Close</button>
                    <button type="submit" class="btn btn-primary"> <i class="material-icons m-auto text-center">update</i> Update Now</button>
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
     $(function logo(){
          table = $("#logo-table").DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{route('logo.index')}}",
            columns:[
            {data:'DT_RowIndex',name:'DT_RowIndex'},
            {data:'logo',name:'logo'},
            {data:'action',name:'action',orderable:true,searchable:true}
            ]
          });
     });


     //======= add new logo=======//
     $("#logo_form").submit(function(e){
        e.preventDefault();
        let formData = new FormData(this)
        
        $.ajax({
            type:"POST",
            url:'{{route('add.logo')}}',
            data:formData,
            contentType: false,
            processData: false,
            success:function(response){
                if(response.success==true){
                    $('.modal').modal('hide');
                    toastr.success(response.message);
                     
                    $('#logo-table').DataTable().ajax.reload();
                    $("#logo_new_preview").css('display','none');
                    $("#logo_form")[0].reset();
                    $("#logo_error").find('p:first').remove();
                }
            },
            error:function (error){
                $("#logo_error").html(`<p class="text-danger">${error.responseJSON.message ? error.responseJSON.message :''}</p>`);
            }
        })
     });


     //for edit logo==========//
     $('body').on("click",".edit_logo",function(){
        var id = $(this).data("id");
           $.ajax({
              type:"GET",
              url:'{{route("logo.edit")}}',
              data:{id:id},
              success: function (response){
                  $("#previous_logo").attr('src',`{{asset('backend/logo_images/${response[0].logo}')}}`);
                  $("#logo_id").val(response[0].id);
                },
              error:function (error) {
                console.log(error)
              }
           });
     });

     //======= update new logo=======//
     $("#logo_update_form").submit(function(e){
        e.preventDefault();
        let formData = new FormData(this)
        
        $.ajax({
            type:"POST",
            url:'{{route('update.logo')}}',
            data:formData,
            contentType: false,
            processData: false,
            success:function(response){
                 if(response.success == true){
                    $('.modal').modal('hide');
                    toastr.success(response.message);
                    $('#logo-table').DataTable().ajax.reload();
                    $("#logo_update_preview").css('display','none');
                    $("#logo_update_form")[0].reset();
                    $("#logo_update_error").find('p:first').remove();
                 }
            },
            error:function (error){
                
                $("#logo_update_error").html(`<p class="text-danger">${error.responseJSON.message ? error.responseJSON.message :''}</p>`);
            }
        })
     });





     //for delete single row====//
     function  deleteLogo (id){
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
                        url:"{{route('delete.logo')}}",
                        data:{id:id},
                        type:"post",
                        success:function(response){
                            if(response.success == true){
                                toastr.success(response.message); 
                                $('#logo-table').DataTable().ajax.reload();
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


     //===== image preview for add logo=========//
     $("#logo").change(function (){
           let reader = new FileReader();

           reader.onload = (e) =>{
              $("#logo_new_preview").css('display','block');
              $("#logo_new_preview").attr('src',e.target.result)
           } 

           reader.readAsDataURL(this.files[0]);
       });

       //===== image preview for update logo=========//
     $("#update_logo").change(function (){
           let reader = new FileReader();

           reader.onload = (e) =>{
              $("#logo_update_preview").css('display','block');
              $("#logo_update_preview").attr('src',e.target.result)
           } 

           reader.readAsDataURL(this.files[0]);
       });
</script>
@endsection
