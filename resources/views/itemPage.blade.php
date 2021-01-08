@extends('master')

@section('content')

    
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Item Page</h1>
            
        </div>

        <!-- Content Row -->
        <div class="row d-flex flex-row justify-content-between">
            <div class="col-md-5">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search Keyword..." name="keyword" autocomplete="off" autofocus  value="">
                        <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" >	
                        </div>
                    </div>
                </form>
            </div>
            <div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
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
                    <div class="modal-body">
                        <form action="/addItem" method="post">
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
                        </form>	
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" value="submit" class="btn btn-primary">Add Item</button>
                    </div>
                    </div>
                </div>
                </div>
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
                        <form action="/editItem/{{$i['id']}}" method="POST">
                            <td scope="col"><?php echo $c ; ?></td>
                            <td scope="col"><img src="/asset/image/{{$i['image']}}" alt="" width="70"></td>
                            <td scope="col" class="w-25">
                                <input type="text" class="input-group-text bg-white container-fluid text-left"  name="cname" value="{{$i['name']}}">
                            </td>
                            <td scope="col">
                                <input type="text" class="input-group-text bg-white container-fluid text-left"  name="csku" value="{{$i['SKU']}}">
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
                            <td scope="col">
                                <button type="submit" class="badge badge-success btn btn-edit-item" data-item-id="{{$i['id']}}" data-pathway="1" value="submit">
                                    <i class="fas fa-fw fa-edit"></i>Edit
                                </button>
                                <a href="/deleteItem/{{$i['id']}}"> 
                                    <button type="button" class="badge badge-danger btn btn-edit-item" data-item-id="{{$i['id']}}" data-pathway="1">
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
        </div>


    </div>
    <!-- /.container-fluid -->

    <script>
        var loadFile = function(event) {
            var image = document.getElementById('output_image');
            image.src = URL.createObjectURL(event.target.files[0]);

        };

        var loadFileDetail = function(event) {
            var image = document.getElementById('output_image_detail');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endsection