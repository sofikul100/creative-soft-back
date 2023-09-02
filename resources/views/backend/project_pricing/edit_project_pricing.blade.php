


@extends('backend.master')
@section('title')
     Edit-Project-Pricing
@endsection
@section('main_content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Edit Project Pricing</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-header">
                             <a href="{{route('project_pricing.index')}}"> <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-slider">Back To All Project Pricings</button></a>
                            </div>

                                <div class="card-body">
                                    <div class="example-container">
                                        <div class="example-content">
                                          <form action="{{route('update.project_pricing',$project_pricing->id)}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-md-12 mt-4">
                                            <label for="project_id" class="form-label">Select Project Name<span class="text-danger">*</span></label>
                        
                                            <select name="project_id" id="project_id" class="form-select">
                                                 @foreach ($projects as $project)
                                                 <option value="{{$project->id}}" {{$project_pricing->project_id == $project->id ? 'selected':''}}>{{$project->project_title}}</option>
                                                 @endforeach
                                                 
                                            </select>
                                            @error('project_id')
                                                      <p class="text-danger mt-2">{{$message}}</p>
                                            @enderror
                                            
                    
                                        </div>
                                       
                                        <div class="col-md-12 mt-4">
                                            <label for="pricing_type_name" class="form-label">Project Pricing Type Name<span class="text-danger">*</span></label>
                                            <input type="text"  class="form-control" value="{{$project_pricing->pricing_type_name}}"  name="pricing_type_name"  id="pricing_type_name" placeholder="Enter project pricing type name...">
                                            
                                            @error('pricing_type_name')
                                            <p class="text-danger mt-2">{{$message}}</p>
                                             @enderror
                    
                                        </div>
                    
                                        <div class="col-md-12 mt-4">
                                            <label for="pricing_features" class="form-label">Pricing Features<span class="text-danger">*</span></label>
                                            <textarea name="pricing_features" class="form-control" id="pricing_features" cols="30" rows="10">
                                                {{$project_pricing->pricing_features}}
                                            </textarea>
                                            @error('pricing_features')
                                            <p class="text-danger mt-2">{{$message}}</p>
                                             @enderror
                                            
                    
                                        </div>
                    
                                        <div class="col-md-12 mt-4">
                                            <label for="pricing_ammount" class="form-label">Pricing Ammount<span class="text-danger">*</span></label>
                                            <input type="text"  class="form-control" value="{{$project_pricing->pricing_ammount}}"  name="pricing_ammount"  id="pricing_ammount" placeholder="Enter pricing ammount">
                                            
                                            @error('pricing_ammount')
                                            <p class="text-danger mt-2">{{$message}}</p>
                                             @enderror
                    
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
