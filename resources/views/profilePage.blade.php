@extends('master')

@section('content')

    
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{$pages}} Page</h1>      
        </div>

        <div>
            @if (session('failure'))
                <div class="alert alert-danger alert-dismissible fade flash-div show col-md-5">
                    {{ session('failure') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade flash-div show col-md-5">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session('error_edit'))
                @if($errors->any())
                    {!! implode('', $errors->all('<p style="color:red ;">:message</p>')) !!}
                @endif
            @endif
        </div>

        <div class="row">
          	<div class="col-lg-8">
                <form action="/editProfile" method="post" enctype="multipart/form-data" >
                    @csrf
          		  <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" id="email" value="{{$profile['email']}}" readonly>
                        </div>
                
				  </div>	
				  <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">User name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="username" name="username" value="{{$profile['username']}}" >
                        </div>
                        @if($errors->has('username'))
                            <p style="color:red ;">{{$errors->first('username')}}</p>
                        @endif
				  </div>	
                  <div class="form-group row">
                        <label for="old_password" class="col-sm-2 col-form-label">
                            Old Password 
                            <span class='clickableAwesomeFont'>
                                <i class="fas fa-fw fa-eye-slash" aria-hidden="true" onclick="togglePassword(this)"></i>
                            </span>
                        </label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="old_password" name="old_password" value="" >
                        </div>
                        @if($errors->has('old_password'))
                            <p style="color:red ;">{{$errors->first('old_password')}}</p>
                        @endif
				  </div>	
                  <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">
                            New Password 
                            <span class='clickableAwesomeFont'>
                                <i class="fas fa-fw fa-eye-slash" aria-hidden="true" onclick="togglePassword(this)"></i>
                            </span>
                        </label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password" value="" >
                        </div>
                        @if($errors->has('password'))
                            <p style="color:red ;">{{$errors->first('password')}}</p>
                        @endif
				  </div>		
				  <div class="form-group row">
				  	<div class="col-sm-2">Picture</div>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="/asset/image/{{$user_logo}}" class="img-thumbnail" id="output_image" >
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image_file" name="image_file"  onchange="loadFile(event)">
                                    <label class="custom-file-label" for="image_file" >Choose file</label>
                                    </div>
                                </div>
                                @if($errors->has('image_file'))
                                    <p style="color:red ;">{{$errors->first('image_file')}}</p>
                                @endif
                            </div>
                        </div>
				  </div>	
				  <div class="form-group row w-100  justify-content-end">
                        <div class="">
                            <button type="submit" class="btn btn-primary">Edit Profile</button>
                        </div>
				  </div>	
          		</form>
          	</div>
        </div>
        
        <div style="height:500px ;">
        </div>
        

    </div>
  
@endsection

@section('additional_script')
<script>
    function togglePassword(i) {
        var p = i.parentElement.parentElement.parentElement;
        var x = p.querySelectorAll("input") ; 
        x = x[0] ; 
        if (x.type === "password") {
            x.type = "text";
            i.classList.remove('fa-eye-slash');
            i.classList.add('fa-eye');
        } else {
            x.type = "password";
            i.classList.remove('fa-eye');
            i.classList.add('fa-eye-slash');
        }
    }

    var loadFile = function(event) {
            var image = document.getElementById('output_image');
            image.src = URL.createObjectURL(event.target.files[0]);

    };
</script>
@endsection