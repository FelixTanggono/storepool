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

        <div class="d-flex flex-column w-100">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#user_shop" role="tab" aria-controls="user_shop" aria-selected="true">Your Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#user_shop_account" role="tab" aria-controls="user_shop_account" aria-selected="false">Your Account</a>
                </li>
            </ul>
            <div class="tab-content border border-top-0 bg-white rounded-bottom shadow-lg" id="myTabContent">
                <div class="tab-pane fade show active" id="user_shop" role="tabpanel" aria-labelledby="user_shop-tab">
                    <div class="col-md-10">
                        <div class="m-3">
                            <h3>Your Shop </h3>
                        </div>
                        <div class="m-3 w-100 d-flex justify-content-end">
                            <div class="">
                                  <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" id='add-item-btn' data-target="#modalAddShop">
                                    Add Shop
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="modalAddShop" tabindex="-1" role="dialog" aria-labelledby="modalAddShopTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalAddShopTitle">Add Shop</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="/addShop" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                        <div class="m-2 d-flex flex-column">                               
                                                            <div class="m-2">
                                                                Shop Name
                                                                <input type="text" value="" class="input-group-text bg-white container-fluid"  name="aname">
                                                                @error('aname') 
                                                                    <p style="color:red ;">{{$message}}</p>
                                                                @enderror
                                                            </div>
                                                            <small>Shop Name Must be Unique</small>
                                                            <br><br>
                                                            <div class="input-group">
                                                                <div class=" w-100">
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" id="aimage_file" name="aimage_file" accept="image/*"  value ="" onchange="loadFile(event)">
                                                                        <label class="custom-file-label" for="image_file">Choose file</label>
                                                                    </div>
                                                                </div>
                                                                @error('aimage_file') 
                                                                    <p style="color:red ;">{{$message}}</p>
                                                                @enderror
                                                                <div class="w-100  mt-5 d-flex justify-content-center">
                                                                    <div class="mx-auto">
                                                                        <img id="output_image" width="200"/>	
                                                                    </div>
                                                                </div>
                                                            </div>					    	
                                                        </div>
                                                </div>
                                                {{csrf_field()}}
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" value="submit" class="btn btn-primary">Add Shop</button>
                                                </div>
                                            </form>	
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            @if(!empty($user_shop))
                            <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Shop Logo</th>
                                            <th scope="col">Shop Name</th>
                                            <th scope="col">Established</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $c = 1 ;  ?>
                                        @foreach($user_shop as $us)
                                        <form action="/editShop" method="post" enctype="multipart/form-data">
                                            <tr>
                                                <th scope="row"><?php echo $c ; $c++ ;  ?></th>
                                                <td>
                                                <button type="button" class="btn" data-toggle="modal" data-target="#modalEditShop{{$us['id']}}">
                                                    <img src="/asset/image/{{$us['logo']}}" alt="" width="100" id="output_image_detail_{{$us['id']}}">
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="modalEditShop{{$us['id']}}" tabindex="-1" role="dialog" aria-labelledby="modalEditShop{{$us['id']}}Title" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalEditShop{{$us['id']}}Title">Change Logo</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="input-group">
                                                                    <div class=" w-100">
                                                                        <div class="custom-file">
                                                                            <input type="file" class="custom-file-input" id="image_file" name="cimage_file" accept="image/*"  value ="" onchange="loadFileDetail(event , '<?php echo $us['id'];?>')">
                                                                            <label class="custom-file-label" for="image_file">Choose file</label>
                                                                        </div>
                                                                    </div>
                                                                    @error('cimage_file') 
                                                                        <p style="color:red ;">{{$message}}</p>
                                                                    @enderror
                                                                    <div class="w-100  d-flex justify-content-center">
                                                                        <div class="mx-auto">
                                                                            <img id="output_image_detail_in_{{$us['id']}}" width="200"/>	
                                                                        </div>
                                                                    </div>
                                                                </div>	
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <!-- <button type="submit" value="submit" class="btn btn-primary">Add Item</button> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </td>
                                                <td>
                                                    {{$us['name']}}
                                                </td>
                                                <td>
                                                    {{date('Y', strtotime($us['created_at']))}}
                                                </td>
                                                {{csrf_field()}}
                                                <input type="hidden" name="shop_id" value="{{$us['id']}}">
                                                <td scope="col">
                                                    <button type="submit" class="badge badge-success btn btn-edit-item" value="submit">
                                                        <i class="fas fa-fw fa-edit"></i>Edit
                                                    </button>
                                                    <a href="/deleteShop/{{$us['id']}}"> 
                                                        <button type="button" class="badge badge-danger btn btn-edit-item"  onclick="return confirm('Are you sure ? deleted shop cannot be recovered along with acccounts associated with it !')">
                                                            <i class="fas fa-fw fa-trash"></i>Delete
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        </form>
                                        @endforeach
                                    </tbody>
                            </table>
                            @else
                                <h3>You seems to not have any shop !</h3>
                            @endif

                        </div>
                    
                    </div>
                </div>
                <div class="tab-pane fade" id="user_shop_account" role="tabpanel" aria-labelledby="user_shop_account-tab">
                    User Shop Account
                </div>
            </div>
        </div>

    </div>
 

    <script type="text/javascript">
        var loadFile = function(event) {
            var image = document.getElementById('output_image');
            image.src = URL.createObjectURL(event.target.files[0]);

        };
        var loadFileDetail = function(event , id) {
            var image = document.getElementById('output_image_detail_'+id);
            var image_1 = document.getElementById('output_image_detail_in_'+id);

            image.src = URL.createObjectURL(event.target.files[0]);
            image_1.src = URL.createObjectURL(event.target.files[0]);

        };
    </script>
@endsection



