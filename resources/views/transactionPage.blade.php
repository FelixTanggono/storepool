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
            <!-- @if(session('error_edit'))
                @if($errors->any())
                    {!! implode('', $errors->all('<p style="color:red ;">:message</p>')) !!}
                @endif
            @endif -->
        </div>
       


    </div>
 
        <!-- <script type="text/javascript">
            var loadFile = function(event) {
                var image = document.getElementById('output_image');
                image.src = URL.createObjectURL(event.target.files[0]);

        };
        var loadFileDetail = function(event , id) {
            var image = document.getElementById('output_image_detail_'+id);
            var image_1 = document.getElementById('output_image_detail_in_'+id);

            image.src = URL.createObjectURL(event.target.files[0]);
            image_1.src = URL.createObjectURL(event.target.files[0]);
        }; -->
    </script>
@endsection