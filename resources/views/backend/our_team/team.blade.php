


@extends('backend.master')
@section('title')
     Our Team
@endsection
@section('main_content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Manage Team Mumbers</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-header">
                                @if (Auth::user()->can('add.team'))
                                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-team-mumber">Add New Team Mumber</button>
                                @endif
                             
                            </div>

                                <div class="card-body">
                                    <div class="example-container">
                                        <div class="example-content">
                                            <div class="table-responsive">
                                            <table id="team_mumbers_table" class="display nowrap" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Team Mumber Image</th>
                                                        <th>Team Mumber Name</th>
                                                        <th>Team Mumber Position</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach ($teams as $key => $team)
                                                    <tr>
                                                        <td>{{$key + 1}}</td>
                                                        <td><img src="{{asset('backend/team_mumbers_images')}}/{{$team->team_mumber_image}}" alt=""></td>
                                                        <td>{{$team->team_mumber_name}}</td> 
                                                        <td>{{$team->team_mumber_position}}</td>
                                                        <td>{{$team->status}}</td>
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
    <div class="modal fade" id="add-team-mumber" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Team Mumber</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="team_mumber_form" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="team_mumber_name" class="form-label">Team Mumber Name<span class="text-danger">*</span></label>
                        <input type="text"  class="form-control" name="team_mumber_name"  id="team_mumber_name" placeholder="Enter Team Mumber Name...">
                        
                        <div id="team_mumber_name_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="team_mumber_position" class="form-label">Team Mumber Position<span class="text-danger">*</span></label>
                        <input type="text"  class="form-control" name="team_mumber_position"  id="team_mumber_position" placeholder="Enter Team Mumber Position...">
                        <div id="team_mumber_position_error" class="mt-2">
                              
                        </div>

                    </div>

                    <div class="col-md-12 mt-4">
                        <label for="facebook_link" class="form-label">Facebook Link(optional)</label>
                        <input type="text"  class="form-control" name="facebook_link"  id="facebook_link" placeholder="Enter Facebook Link...">
                    </div>

                    <div class="col-md-12 mt-4">
                        <label for="instagram_link" class="form-label">Instagram Link(optional)</label>
                        <input type="text"  class="form-control" name="instagram_link"  id="instagram_link" placeholder="Enter Instagram Link...">
                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="linkedin_link" class="form-label">Linkedin Link(optional)</label>
                        <input type="text"  class="form-control" name="linkedin_link"  id="linkedin_link" placeholder="Enter Linkedin Link...">
                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="twitter_link" class="form-label">Twitter Link(optional)</label>
                        <input type="text"  class="form-control" name="twitter_link"  id="twitter_link" placeholder="Enter Twitter Link...">
                    </div>

                    <div class="col-md-12 mt-4">
                        <label for="team_mumber_image" class="form-label">Team Mumber Image<span class="text-danger">*</span></label>
                        <input type="file"  class="form-control" name="team_mumber_image"  id="team_mumber_image" >
                        
                        <div id="team_mumber_image_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-6 mt-2">
                         <img src="" alt=""  id="team_mumber_new_image_preview" style="display: none;width:150px;height:auto">
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

    <div class="modal fade" id="edit_team_mumber" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="team_mumber_update_form" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <input type="hidden" name="team_mumber_id" id="team_mumber_id">
                    <div class="col-md-12 mb-4">
                        <img src="" class="previous_team_mumber_photo" alt="" id="previous_team_mumber_photo" style="width:200px;height:140px">
                    </div>
                    <div class="col-md-12">
                        <label for="team_mumber_update_name" class="form-label">Team Mumber Name</label>
                        <input type="text"  class="form-control" name="team_mumber_update_name"  id="team_mumber_update_name">
                        
                        <div id="team_mumber_update_name_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="team_mumber_update_position" class="form-label">Team Mumber Position</label>
                        <input type="text" class="form-control" name="team_mumber_update_position" id="team_mumber_update_position"> 
                        
                        <div id="team_mumber_update_position_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="facebook_update_link" class="form-label">Facebook Link</label>
                        <input type="text"  class="form-control" name="facebook_update_link"  id="facebook_update_link" placeholder="Enter Facebook Link...">
                    </div>

                    <div class="col-md-12 mt-4">
                        <label for="instagram_update_link" class="form-label">Instagram Link</label>
                        <input type="text"  class="form-control" name="instagram_update_link"  id="instagram_update_link" placeholder="Enter Instagram Link...">
                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="linkedin_update_link" class="form-label">Linkedin Link </label>
                        <input type="text"  class="form-control" name="linkedin_update_link"  id="linkedin_update_link" placeholder="Enter Linkedin Link...">
                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="twitter_update_link" class="form-label">Twitter Link</label>
                        <input type="text"  class="form-control" name="twitter_update_link"  id="twitter_update_link" placeholder="Enter Twitter Link...">
                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="team_mumber_update_image" class="form-label">Team Mumber Image</label>
                        <input type="file"  class="form-control" name="team_mumber_update_image"  id="team_mumber_update_image" >
                        
                        <div id="team_mumber_update_image_error" class="mt-2">
                              
                        </div>

                    </div>
                    <div class="col-md-6 mt-2">
                         <img src="" alt=""  id="team_mumber_image_update_preview" style="display: none;width:150px;height:auto">
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
     $(function team(){
          table = $("#team_mumbers_table").DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{route('team.index')}}",
            columns:[
            {data:'DT_RowIndex',name:'DT_RowIndex'},
            {data:'team_mumber_image',name:'team_mumber_image'},
            {data:'team_mumber_name',name:'team_mumber_name'},
            {data:'team_mumber_position',name:'team_mumber_position'},
            {data:'status',name:'status'},
            {data:'action',name:'action',orderable:true,searchable:true}
            ]
          });
     });


     //======= add new team=======//
     $("#team_mumber_form").submit(function(e){
        e.preventDefault();
        let formData = new FormData(this)
        
        $.ajax({
            type:"POST",
            url:'{{route('add.team')}}',
            data:formData,
            contentType: false,
            processData: false,
            success:function(response){
                if(response.success==true){
                    $('.modal').modal('hide');
                    toastr.success(response.message);
                     
                    $('#team_mumbers_table').DataTable().ajax.reload();
                    $("#team_mumber_new_image_preview").css('display','none');
                    $("#team_mumber_form")[0].reset();
                    $("#team_mumber_name_error").find('p:first').remove();
                    $("#team_mumber_position_error").find('p:first').remove();
                    $("#team_mumber_image_error").find('p:first').remove();
                }
            },
            error:function (error){
                $("#team_mumber_name_error").html(`<p class="text-danger">${error.responseJSON.errors.team_mumber_name ? error.responseJSON.errors.team_mumber_name :''}</p>`);
                $("#team_mumber_position_error").html(`<p class="text-danger">${error.responseJSON.errors.team_mumber_position ? error.responseJSON.errors.team_mumber_position :''}</p>`);
                $("#team_mumber_image_error").html(`<p class="text-danger">${error.responseJSON.errors.team_mumber_image ? error.responseJSON.errors.team_mumber_image :'' }</p>`);
            }
        })
     });


     //for edit team==========//
     $('body').on("click",".edit_team_mumber",function(){
        var id = $(this).data("id");
           $.ajax({
              type:"GET",
              url:'{{route("edit.team")}}',
              data:{id:id},
              success: function (response){
                  $("#previous_team_mumber_photo").attr('src',`{{asset('backend/team_mumbers_images/${response[0].team_mumber_image}')}}`);
                  $("#team_mumber_update_name").val(response[0].team_mumber_name)
                  $("#team_mumber_update_position").val(response[0].team_mumber_position)
                  $("#facebook_update_link").val(response[0].facebook_link)
                  $("#instagram_update_link").val(response[0].instagram_link)
                  $("#linkedin_update_link").val(response[0].linkedin_link)
                  $("#twitter_update_link").val(response[0].twitter_link)
                  $("#team_mumber_id").val(response[0].id);
                },
              error:function (error) {
                 console.log(error)
              }
           });
     });

     //======= update new team=======//
     $("#team_mumber_update_form").submit(function(e){
        e.preventDefault();
        let formData = new FormData(this)
        
        $.ajax({
            type:"POST",
            url:'{{route('update.team')}}',
            data:formData,
            contentType: false,
            processData: false,
            success:function(response){
                if(response.success==true){
                    $('.modal').modal('hide');
                    toastr.success(response.message);
                     
                    $('#team_mumbers_table').DataTable().ajax.reload();
                    $("#team_mumber_image_update_preview").css('display','none');
                    $("#team_mumber_update_form")[0].reset();
                    $("#team_mumber_update_name_error").find('p:first').remove();
                    $("#team_mumber_update_position_error").find('p:first').remove();
                    $("#team_mumber_update_image_error").find('p:first').remove();
                }
            },
            error:function (error){
                $("#team_mumber_update_name_error").html(`<p class="text-danger">${error.responseJSON.errors.team_mumber_update_name ? error.responseJSON.errors.team_mumber_update_name :''}</p>`);
                $("#team_mumber_update_position_error").html(`<p class="text-danger">${error.responseJSON.errors.team_mumber_update_position ? error.responseJSON.errors.team_mumber_update_position :''}</p>`);
            }
        })
     });





     //for delete single row====//
     function  deleteTeam (id){
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
                        url:"{{route('delete.team')}}",
                        data:{id:id},
                        type:"post",
                        success:function(response){
                            if(response.success == true){
                                toastr.success(response.message); 
                                $('#team_mumbers_table').DataTable().ajax.reload();
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
        var team_mumber_id = $(this).data('id');  
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{route("change.team.mumber.status")}}',
            data: {'status': status, 'team_mumber_id': team_mumber_id},
            success: function(response){
                if(response.success == true){
                   $('#team_mumbers_table').DataTable().ajax.reload();
                }
            },
            error:function(error){
                console.log(error)
            }
        });
     })


     //===== image preview for add service=========//
     $("#team_mumber_image").change(function (){
           let reader = new FileReader();

           reader.onload = (e) =>{
              $("#team_mumber_new_image_preview").css('display','block');
              $("#team_mumber_new_image_preview").attr('src',e.target.result)
           } 

           reader.readAsDataURL(this.files[0]);
       });

       //===== image preview for update logo=========//
     $("#team_mumber_update_image").change(function (){
           let reader = new FileReader();

           reader.onload = (e) =>{
              $("#team_mumber_image_update_preview").css('display','block');
              $("#team_mumber_image_update_preview").attr('src',e.target.result)
           } 

           reader.readAsDataURL(this.files[0]);
       });
</script>
@endsection
