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
            <div class="w-100">
                <nav >
                    <div class="" id="nav-tab" role="tablist">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="/transaction?transaction_status=add_order" name="add_order">Add New</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/transaction?transaction_status=all_order" name="all_order">All Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/transaction?transaction_status=pending_order" name="pending_order">Pending Orders 5 </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/transaction?transaction_status=processed_order" name="processed_order">Processed Orders 5  </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/transaction?transaction_status=shipped_order" name="shipped_order">Shipped Orders 5  </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/transaction?transaction_status=completed_order" name="completed_order">Completed Orders 5 </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/transaction?transaction_status=canceled_order" name="canceled_order">Canceled Orders</a>
                            </li>
                        
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="border border-top-0 bg-white rounded-bottom d-flex flex-row">
                <div class="w-100">
                    <div class="tab-content" id="nav-tabContent">
                        @include('transaction_content/'.$transaction_status)
                    </div>
                </div>
            </div>
        </div>

    </div>
 
    
@endsection

@section('additional_script')
    <script type="text/javascript">
        
        $(document).ready(function(){

            // setInterval(function() {
            //     $('#time').text(new Date);
            // }, 1000);

            var x = window.location.href ; 
            var url = new URL(x);
            var c = url.searchParams.get('transaction_status');

            if(c === null ){
                c = 'all_order' ; 
            }
            z = '[name='+c+']' ;  
            $(z).addClass('active') ;
            
        }) ; 

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function searchItem(x) {
            var search = x.value ; 
            var p = x.parentElement.parentElement ;

            console.log(search) ; 
            $.ajax({
                // pengecualian , kebetulan script dlm php 
                method :"POST" , 
                url : "/transaction/searchItem" ,
                data : {                     
                    _token: '{{csrf_token()}}' ,
                     keyword : search 
                } , 
                success : function(data){
                    console.log(data) ; 
                    var new_data = $.parseJSON(data) ; 
                    console.log(new_data) ; 

                    p.querySelector('td[name=item-price]').innerHTML = new_data['sell_price'] ; 
                    p.querySelector('td[name=item-name]').innerHTML = new_data['name'] ; 
                    p.querySelector('#true-sku').value = new_data['SKU'] ; 
                    p.querySelector('img[name=item-image').src="/asset/image/"+new_data['image'] ;
                    
                 }
            }) ;
        }

        function updateTotalPrice(x){

            var p = x.parentElement.parentElement ; 
            var price = p.querySelector('td[name=item-price]').innerHTML  ; 
            var qty = p.querySelector('input[name=item-qty]').value ; 
            
            // console.log(price) ; 

            var totalprice =  Number(qty)*Number(price) ; 
            totalprice.toLocaleString() ; 

            // console.log(totalprice) ; 


            p.querySelector('td[name=item-total-price]').innerHTML = formatNumber(totalprice) ; 


        }

        function updateBanners(){

            var tableBody = document.getElementById("table-body") ; 
            var totalSKU = tableBody.childElementCount ;
            console.log(totalSKU) ; 
            var tableBodyChild = document.getElementById('table-body').children ;  
            var totalPrice = 0  ; 
            var totalQty = 0 ; 
            for (var i = 0; i < tableBodyChild.length; i++) {

                totalQty += Number(tableBodyChild[i].querySelector('input[name=item-qty]').value) ; 
                curr_price = tableBodyChild[i].querySelector('td[name=item-total-price]').innerHTML  ; 
                console.log(curr_price) ; 
                curr_price = curr_price.replace(/,/g, '');
                console.log(curr_price) ;
                totalPrice = Number(totalPrice) + Number(curr_price) ;

            }

            document.querySelector('#banner-total-qty-item').innerHTML = formatNumber(totalQty) ;
            document.querySelector('#banner-total-transaction-value').innerHTML = formatNumber(totalPrice) ;
            document.querySelector('#banner-total-sku').innerHTML = formatNumber(totalSKU) ;

        }

   
        function addTransactionNewRow(x){

            var p = x.parentElement.parentElement; 

            var content = p.cloneNode(true) ; 
            content.querySelector('button').remove() ; 
            content.querySelector('.button-col').innerHTML = `
                <button class="badge btn-danger btn" onclick="addTransactionDelRow(this)">
                    <i class="fas fa-fw fa-trash-alt "></i>Delete
                </button>
            ` ; 
            content.querySelector('#true-sku').removeAttribute("id") ; 
            
            $('#table-body').append(content) ; 

            updateBanners() ; 


        }

        function addTransactionDelRow(x){

            var p = x.parentElement.parentElement ; 
            p.remove() ; 

            updateBanners() ; 

        }
        
        function clearAllRow(){

            document.querySelector('#table-body').innerHTML = '' ; 


            updateBanners() ; 
        }


    </script>
@endsection

