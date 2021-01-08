@extends('master')

@section('content')

    
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Item Page</h1>      
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
        <!-- Content Row Header -->
        <div class="row d-flex flex-row justify-content-between">
            <div class="col-md-5">
                <form action="" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search Keyword..." name="search" id="search" autocomplete="off" autofocus  value="">
                        <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" >	
                        </div>
                    </div>
                    {{ csrf_field()  }}
                </form> 
            </div>
            <div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" id='add-item-btn' data-target="#exampleModalLong">
                    Add Item
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                           
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Add Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="/addItem" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                        <div class="m-2 d-flex flex-column">                               
                                            <div class="m-2">
                                                Item Name
                                                <input type="text" value="" class="input-group-text bg-white container-fluid"  name="aname">
                                                @error('aname') 
                                                    <p style="color:red ;">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="m-2">
                                                Item SKU
                                                <input type="text" value="" class="input-group-text bg-white container-fluid"  name="aSKU">
                                                @error('aSKU') 
                                                    <p style="color:red ;">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="m-2">
                                                Sell Price ( Rp )
                                                <input type="text" value="" class="input-group-text bg-white container-fluid"  name="asell_price">
                                                @error('asell_price') 
                                                    <p style="color:red ;">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="m-2">
                                                Buy Price ( Rp )
                                                <input type="text" value="" class="input-group-text bg-white container-fluid"  name="abuy_price">
                                                @error('abuy_price') 
                                                    <p style="color:red ;">{{$message}}</p>
                                                @enderror
                                            </div>	
                                            <div class="m-2">
                                                Stock
                                                <input type="text" value="" class="input-group-text bg-white container-fluid"  name="astock">
                                                @error('astock') 
                                                    <p style="color:red ;">{{$message}}</p>
                                                @enderror
                                            </div>
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
                                    <button type="submit" value="submit" class="btn btn-primary">Add Item</button>
                                </div>
                            </form>	
                        </div>
                    </div>
                </div>

            </div> 
        </div>
        <div class="row d-flex justify-content-center w-100 ">
            <div>
                @if($keyword)
                <h3 class='text-center'>Results for "{{$keyword}}" : {{$keywordCount}} items</h3>
                @endif 
            </div>
            
        </div>
        <!-- Content Row -->
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col" class="w-25">Name</th>
                        <th scope="col">SKU</th>
                        <th scope="col">Buy Price</th>
                        <th scope="col">Sell Price</th>
                        <!-- <th scope="col">Margin</th> -->
                        <th scope="col">Stock</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $c = 1 ; ?>
                    @foreach($item as $i)
                    <tr>
                        <form action="/editItem" method="POST" enctype="multipart/form-data" >
                            <td scope="col"><?php echo $c ; ?></td>
                            <td scope="col">
                                <button type="button" class="" data-toggle="modal" data-target="#exampleModalLong{{$i['id']}}">
                                    <img src="/asset/image/{{$i['image']}}" alt="" width="70" id="output_image_detail_{{$i['id']}}">
                                </button>
                                  <!-- Modal -->
                                <div class="modal fade" id="exampleModalLong{{$i['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle{{$i['id']}}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Change Picture</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="input-group">
                                                <div class=" w-100">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="image_file_{{$i['id']}}" name="cimage_file" accept="image/*"  value ="" onchange="loadFileDetail(event , '<?php echo $i['id'];?>')">
                                                        <label class="custom-file-label" for="image_file_{{$i['id']}}">Choose file</label>
                                                    </div>
                                                </div>
                                                <!-- @error('image_file') 
                                                    <p style="color:red ;">{{$message}}</p>
                                                @enderror -->
                                                <div class="w-100  d-flex justify-content-center">
                                                    <div class="mx-auto">
                                                        <img id="output_image_detail_in_{{$i['id']}}" width="200"/>	
                                                    </div>
                                                </div>
                                            </div>	
                                            <!-- <form action="/addItem" method="post">
                                                <div class="m-2 d-flex flex-column">                               
                                                    <div class="m-2">
                                                        Item Name
                                                        <input type="text" value="" class="input-group-text bg-white container-fluid"  name="aname">
                                                    </div>
                                                    <div class="m-2">
                                                        Item SKU
                                                        <input type="text" value="" class="input-group-text bg-white container-fluid"  name="asku">
                                                    </div>
                                                    <div class="m-2">
                                                        Sell Price ( Rp )
                                                        <input type="text" value="" class="input-group-text bg-white container-fluid"  name="asellprice">
                                                    </div>
                                                    <div class="m-2">
                                                        Buy Price ( Rp )
                                                        <input type="text" value="" class="input-group-text bg-white container-fluid"  name="abuyprice">
                                                    </div>	
                                                    <div class="m-2">
                                                        Stock
                                                        <input type="text" value="" class="input-group-text bg-white container-fluid"  name="astock">
                                                    </div>
                                                    <br><br>
                                                    <div class="input-group">
                                                        <div class=" w-100">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="image_file" name="aimage_file" accept="image/*"  value ="" onchange="loadFile(event)">
                                                                <label class="custom-file-label" for="image_file">Choose file</label>
                                                            </div>
                                                        </div>
                                                        @error('image_file') 
                                                            <p style="color:red ;">{{$message}}</p>
                                                        @enderror
                                                        <div class="w-100  d-flex justify-content-center">
                                                            <div class="mx-auto">
                                                                <img id="output_image" width="200"/>	
                                                            </div>
                                                        </div>
                                                    </div>					    	
                                                </div>
                                            </form>	 -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <!-- <button type="submit" value="submit" class="btn btn-primary">Add Item</button> -->
                                        </div>
                                        </div>
                                    </div>
                                </div>
                
                            </td>
                            <td scope="col" class="w-25">
                                <input type="text" class="input-group-text bg-white container-fluid text-left"  name="cname" value="{{$i['name']}}">
                            </td>
                            <td scope="col">
                                <input type="text" class="input-group-text bg-white container-fluid text-left"  name="cSKU" value="{{$i['SKU']}}">
                            </td>
                            <td scope="col">
                                <input type="text" class="input-group-text bg-white container-fluid text-left"  name="cbuy_price" value="{{$i['buy_price']}}">
                            </td>
                            <td scope="col">
                                <input type="text" class="input-group-text bg-white container-fluid text-left"  name="csell_price" value="{{$i['sell_price']}}">
                            </td>
                            <!-- <td scope="col"><?php ($i['sell_price']-$i['buy_price'])/$i['sell_price'] ;  ?></td> -->
                            <td scope="col">
                                <input type="text" class="input-group-text bg-white container-fluid text-left"  name="cstock" value="{{$i['stock']}}">
                            </td>
                            <input type="hidden" value="{{$i['id']}}" name="item_id">
                            {{ csrf_field()  }}

                            <td scope="col">
                                <button type="submit" class="badge badge-success btn btn-edit-item" data-item-id="{{$i['id']}}" data-pathway="1" value="submit">
                                    <i class="fas fa-fw fa-edit"></i>Edit
                                </button>
                                <a href="/deleteItem/{{$i['id']}}"> 
                                    <button type="button" class="badge badge-danger btn btn-edit-item" data-item-id="{{$i['id']}}" data-pathway="1"  onclick="return confirm('Are you sure ? deleted item cannot be recovered !')">
                                        <i class="fas fa-fw fa-trash"></i>Delete
                                    </button>
                                </a>
                            </td>
                        </form>
                    </tr>
                    <?php $c++ ;  ?>
                    @endforeach

                </tbody>
            </table>
            <div class="d-flex justify-content-center w-100">
                {{$item->appends(request()->query())->links() }}
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->
    <!-- @if(session('error_code_add_item'))
        <script>
            $(document).ready(function(){
                $("#exampleModalLong").modal();
            }); 
        </script>
    @endif -->
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