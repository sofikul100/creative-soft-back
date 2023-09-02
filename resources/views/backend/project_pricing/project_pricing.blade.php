


@extends('backend.master')
@section('title')
     Project Pricing
@endsection
@section('main_content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Manage Project Pricing</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-header">
                             @if (Auth::user()->can('add.project_price'))
                             <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-slider">Add New Project Pricing</button>
                             @endif   
                            
                            </div>

                                <div class="card-body">
                                    <div class="example-container">
                                        <div class="example-content">
                                            <div class="table-responsive">
                                            <table id="project_pricing_table" class="display nowrap" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Project Name</th>
                                                        <th>Pricing Type Name</th>
                                                        <th>Pricing Ammount</th>
                                                        <th>Pricing Features</th>
                                                        <th>IsPopuler</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach ($project_pricings as $key => $project_pricing)
                                                    <tr>
                                                        <td>{{$key + 1}}</td>
                                                        <td>{{$project_pricing->project_id}}</td>
                                                        <td>{{$project_pricing->pricing_type_name}}</td>
                                                        <td>{{$project_pricing->pricing_features}}</td>
                                                        <td></td>
                                                        <td>{{$project_pricing->status}}</td>
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

    <!------add project pricing model start ----->
    <div class="modal fade" id="add-slider" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Project Pricing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="project_pricing_form" enctype="multipart/form-data">
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
                        <label for="pricing_type_name" class="form-label">Project Pricing Type Name<span class="text-danger">*</span></label>
                        <input type="text"  class="form-control"  name="pricing_type_name"  id="pricing_type_name" placeholder="Enter project pricing type name...">
                        
                        <div id="pricing_type_name_error" class="mt-2">
                              
                        </div>

                    </div>

                    <div class="col-md-12 mt-4">
                        <label for="pricing_features" class="form-label">Pricing Features<span class="text-danger">*</span></label>
                        <textarea name="pricing_features" class="form-control" id="pricing_features" cols="30" rows="10">

                        </textarea>
                        
                        <div id="pricing_features_error" class="mt-2">
                              
                        </div>

                    </div>

                    <div class="col-md-12 mt-4">
                        <label for="pricing_ammount" class="form-label">Pricing Ammount<span class="text-danger">*</span></label>
                        <input type="text"  class="form-control"  name="pricing_ammount"  id="pricing_ammount" placeholder="Enter pricing ammount">
                        
                        <div id="pricing_ammount_error" class="mt-2">
                              
                        </div>

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
    <!------end pricing modal end modal  ----->
</div>
<!------- jquery-------->
<script src="{{asset('backend/assets/plugins/jquery/jquery-3.5.1.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
     // for yajra datatable ========//
     $(function project_pricing(){
          table = $("#project_pricing_table").DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{route('project_pricing.index')}}",
            columns:[
            {data:'DT_RowIndex',name:'DT_RowIndex'},
            {data:'project_title',name:'project_id'},
            {data:'pricing_type_name',name:'pricing_type_name'},
            {data:'pricing_ammount',name:'pricing_ammount'},
            {data:'pricing_features',name:'pricing_features'},
            {data:'is_populer',name:'is_populer'},
            {data:'status',name:'status'},
            {data:'action',name:'action',orderable:true,searchable:true}
            ]
          });
     });


     //======= add new project detail section=======//
     $("#project_pricing_form").submit(function(e){
        e.preventDefault();
        let formData = new FormData(this)
        
        $.ajax({
            type:"POST",
            url:'{{route('add.projet_pricing')}}',
            data:formData,
            contentType: false,
            processData: false,
            success:function(response){
                if(response.success==true){
                    $('.modal').modal('hide');
                    toastr.success(response.message);
                     
                    $('#project_pricing_table').DataTable().ajax.reload();
                    $("#project_pricing_form")[0].reset();
                    $("#project_id").find('p:first').remove();
                    $("#pricing_features").find('p:first').remove();
                    $("#pricing_type_name").find('p:first').remove();
                    $("#pricing_ammount").find('p:first').remove();
                }
            },
            error:function (error){
                $("#project_id_error").html(`<p class="text-danger">${error.responseJSON.errors.project_id ? error.responseJSON.errors.project_id :''}</p>`);
                $("#pricing_type_name_error").html(`<p class="text-danger">${error.responseJSON.errors.pricing_type_name ? error.responseJSON.errors.pricing_type_name :''}</p>`);
                $("#pricing_ammount_error").html(`<p class="text-danger">${error.responseJSON.errors.pricing_ammount ? error.responseJSON.errors.pricing_ammount :''}</p>`);
                $("#pricing_features_error").html(`<p class="text-danger">${error.responseJSON.errors.pricing_features ? error.responseJSON.errors.pricing_features :'' }</p>`);
            }
        })
     });




     //for delete single row====//
     function  delete_product_pricing (id){
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
                        url:"{{route('delete.project_pricing')}}",
                        data:{id:id},
                        type:"post",
                        success:function(response){
                            if(response.success == true){
                                toastr.success(response.message); 
                                $('#project_pricing_table').DataTable().ajax.reload();
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
        var project_pricing_id = $(this).data('id');  
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{route("change.project.pricing.status")}}',
            data: {'status': status, 'project_pricing_id': project_pricing_id},
            success: function(response){
                if(response.success == true){
                   $('#project_pricing_table').DataTable().ajax.reload();
                }
            },
            error:function(error){
                console.log(error)
            }
        });
     });

     //======0 and 1 is_populer=============//
     $('body').on('change','.toggle-class-populer',function (){
        var is_populer = $(".toggle-class-populer").prop('checked') == true ? 1 : 0;
        var project_pricing_id = $(this).data('id');  
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{route("change.project.pricing.is_populer")}}',
            data: {'is_populer': is_populer, 'project_pricing_id': project_pricing_id},
            success: function(response){
                if(response.success == true){
                   $('#project_pricing_table').DataTable().ajax.reload();
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
