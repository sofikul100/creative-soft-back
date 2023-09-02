


@extends('backend.master')
@section('title')
     Edit-Project-Detail-Section
@endsection
@section('main_content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Edit Project Details Section</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-header">
                             <a href="{{route('project_details.index')}}"> <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-slider">Back To All Project Detail Section</button></a>
                            </div>

                                <div class="card-body">
                                    <div class="example-container">
                                        <div class="example-content">
                                            
                                            <form action="{{route('upate.project_detail_section',$project_detail->id)}}" method="POST" id="project_detail_section_form" enctype="multipart/form-data">
                                                @csrf
                                                <div class="col-12 mb-4 ml-4">
                                                    <img src="{{asset('backend/project_detail_section_images')}}/{{$project_detail->project_detail_feature_image}}" style="width:200px;height:auto;border-radius:50%" alt="">
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="project_id" class="form-label">Select Project Name</label>
                                                    
                                                    <select name="project_id" id="project_id" class="form-control">
                                                        
                                                       @foreach ($projects as $project)
                                                           <option value="{{$project->id}}" {{$project->id == $project_detail->project_id ? 'selected':''}}>{{$project->project_title}}</option>
                                                       @endforeach
                                                         

                                                         
                                                    </select>
                                                    @error('project_id')
                                                      <p class="text-danger mt-2">{{$message}}</p>
                                                    @enderror
                                                    
                            
                                                </div>
                                                <div class="col-md-12 mt-4">
                                                    <label for="project_detail_feature_content" class="form-label">Project Detail Features</label>
                                                    
                                                    <textarea name="project_detail_feature_content"  class="form-control"    id="project_detail_feature_content" rows="4">
                                                        {{$project_detail->project_detail_feature_content}}
                                                    </textarea>
                                                    @error('project_detail_feature_content')
                                                      <p class="text-danger mt-2">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mt-4">
                                                    <label for="project_detail_feature_image" class="form-label">Project Detail Feature Image</label>
                                                    <input type="file"  class="form-control"  name="project_detail_feature_image"  id="project_detail_feature_image" >
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                     <img src="" alt=""  id="project_detail_feature_image_preview" style="display: none;width:200px;height:auto">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i class="material-icons m-auto text-center">close</i>Close</button>
                                                <button type="submit" class="btn btn-primary"> <i class="material-icons m-auto text-center">update</i>Update Now</button>
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
     //===== image preview for update logo=========//
     $("#project_detail_feature_image").change(function (){
           let reader = new FileReader();

           reader.onload = (e) =>{
              $("#project_detail_feature_image_preview").css('display','block');
              $("#project_detail_feature_image_preview").attr('src',e.target.result)
           } 

           reader.readAsDataURL(this.files[0]);
       });
</script>
@endsection
