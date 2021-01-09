<div class="d-flex flex-column  p-1 ">

  <!-- section atas -->
  <div class="bg-light shadow-lg border border-secondary p-2 top-header-add-transaction d-flex flex-row justify-content-between  mb-2">
    <div class="col-md-8 border-secondary border-right">
      <div class=" col-md-12 ">
        <div class="card-header shadow-lg text-left bg-light text-secondary">
          <strong>
            <i class="fas fa-fw fa-money-bill-wave"></i> Total Transaction Value
          </strong>
        </div>
        <div class="p-2 rounded-bottom bg-light shadow-lg text-center  text-muted " >
          <strong>
            <h1 class="mr-3">
              <div class="d-flex flex-row justify-content-end ">
                  <div class="float-left  ">
                    Rp. 
                  </div>
                  <div id="banner-total-transaction-value" class="text-truncate">
                    0
                  </div>
              </div>
            </h1>
          </strong>
        </div>
      </div>
    </div>
  
    <div class="col-md-4">
      <div class="col-md-6 float-right">
        <div class="card-header shadow-lg t text-left bg-light text-secondary">
          <strong>Total SKU</strong>
        </div>
        <div class="p-2 rounded-bottom  shadow-lg bg-light  text-center text-muted">
          <strong>
            <h1>
              <div id="banner-total-sku" class="text-truncate">
                0
              </div>  
            </h1>
          </strong>
        </div>
      </div>
      <div class="col-md-6 ">
        <div class="card-header shadow-lg  text-left bg-light text-secondary ">
          <strong>Total Qty Item</strong>
        </div>
        <div class="p-2 rounded-bottom  shadow-lg bg-light  text-center text-muted">
          <strong>
            <h1>
                <div id="banner-total-qty-item"  class="text-truncate">
                0
              </div>
            </h1>
          </strong>
        </div>
      </div>
    </div>
  </div>

  <form action="" method="post">

    <!-- section tengah -->
    <div class="bg-light border-top border-left border-right border-secondary overflow-auto d-flex flex-column align-items-end" style="max-height: 350px ; min-height: 350px ; " id="add-transaction-table-content-div">
      <table class="table table-hover" id="add-new-transaction-table" style="">
        <thead class="">
          <tr>
            <th scope="col" style="width: 5% ; ">#</th>
            <th scope="col" style="width: 10% ; ">Image</th>
            <th scope="col" style="width: 10% ;">SKU</th>
            <th scope="col" style="width: 30% ;" class="overflow-hidden">Item Name</th>
            <th scope="col" style="width: 15% ;">Price</th>
            <th scope="col" style="width: 10% ;">Qty</th>
            <th scope="col" style="width: 10% ;">Total</th>
            <th scope="col" style="width: 10% ; ">Action</th>
          </tr>
        </thead>
        <tbody id="table-body">
          <!-- <tr>
            <th scope="row"></th>
            <td >
              <img name="item-image" src="" alt="" width="100" class="rounded-lg shadow-sm">
            </td>
            <td><input type="text" class="input-group-text bg-white text-left container-fluid p-1 " name="item-sku" oninput ="searchItem(this)" ></td>
            <td name="item-title" ></td>
            <td><input type="text" class="input-group-text bg-white text-left container-fluid p-1 " name="item-price"></td>
            <td><input type="text" class="input-group-text bg-white text-left container-fluid p-1 " name="item-qty" ></td>
            <td name="item-total-price"></td>
            <td>                                   
              <button class="badge btn-danger btn" onclick="addTransactionDelRow(this)">
                <i class="fas fa-fw fa-trash-alt "></i>Delete
              </button>
            </td> 
          </tr>  -->
        </tbody>
      </table>      
    </div>
    <div class="bg-light shadow-lg border-bottom border-left border-right border-secondary">
      <table class="table table-hover mt-auto mb-0 border-top border-secondary" id="add-transaction-add-row-table">
        <thead>
          <tr>
            <th scope="col" style="width: 5% ; "></th>
            <th scope="col" style="width: 10% ; ">Image</th>
            <th scope="col" style="width: 10% ;" >SKU</th>
            <th scope="col" style="width: 30% ;" class="overflow-hidden">Item Name</th>
            <th scope="col" style="width: 15% ;">Price</th>
            <th scope="col" style="width: 10% ;">Qty</th>
            <th scope="col" style="width: 10% ;">Total</th>
            <th scope="col" style="width: 10% ; ">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row"></th>
            <td>
              <img name="item-image" src="" alt="" width="75" class="rounded-lg shadow-sm">
            </td>
            <td>
              <input type="text" class="input-group-text bg-white text-left container-fluid p-1 item-sku " name="item-sku" oninput ="searchItem(this)" autofocus>
            </td>
            <input type="hidden" name="true-sku[]" id="true-sku" value="">
            <td name="item-name"></td>
            <td name="item-price"></td>
            <td><input type="text" class="input-group-text bg-white text-left container-fluid p-1 item-qty" name="item-qty" onchange="updateTotalPrice(this)" value="0"></td>
            <td name="item-total-price"></td>
            <td class="button-col">                             
              <button class="badge btn-success btn" onclick="addTransactionNewRow(this)" type='button'>
                <i class="fas fa-fw fa-plus"></i>New Row
              </button>
            </td>
          </tr> 
        </tbody>
      </table>  
    </div>

     <!-- section bawah  -->
    <div class="bg-light shadow border border-secondary mt-3 p-2 ">
      <div class="d-flex justify-content-start">
        <div class="d-flex flex-column col-md-2 border-secondary border-right">
          <button class="btn btn-danger mb-2" onclick="clearAllRow()" type="button">
            <strong><i class="fa fa-fw fa-minus-circle"></i> Clear All Row </strong>
          </button>
        </div>
        <div class="d-flex flex-column col-md-4 border-secondary border-right">
          <div class="input-group w-100 mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text" >Address Name</span>
            </div>
            <input type="text" class="form-control" placeholder="Address Name" name="address_name">
          </div>
          <div class="input-group w-100 mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text" >Address Phone</span>
            </div>
            <input type="text" class="form-control" placeholder="address Phone" name="address_phone_number">
          </div>
          <div class="input-group w-100 mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text" >Address Detail</span>
            </div>
            <input type="text" class="form-control" placeholder="Address Detail" name="address_address">
          </div>
          <div class="input-group w-100 mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text" >Address Postal Code</span>
            </div>
            <input type="text" class="form-control" placeholder="Address Postal Code" name="address_postal_code">
          </div>
        </div>
        <div class="col-md-6 d-flex flex-column align-items-end">
          <div class="d-flex flex-row justify-content-start mb-2 w-100">
            <div class="input-group mr-2 w-50">
              <div class="input-group-prepend">
                <label class="input-group-text" for="selectCourierAddTransaction">Courier</label>
              </div>
              <select class="custom-select" id="selectCourierAddTransaction"   name="courier_id" >
                <option selected>Choose Courier...</option>
                <?php foreach ($courier as $c): ?>
                  <option value="<?= $c['id'] ; ?>">
                     <?= $c['name'] ; ?>
                  </option>
                <?php endforeach ;?>
              </select>
            </div>
            <div class="input-group mr-2 w-50">
              <div class="input-group-prepend">
                <label class="input-group-text" for="selectUserShopAccountAddTransaction">User Shop Account</label>
              </div>
              <select class="custom-select" id="selectUserShopAccountAddTransaction"   name="user_shop_account_id">
                <option selected>Choose Account...</option>
                <?php foreach ($user_shop_accounts as $usa): ?>
                  <option value="<?= $usa['id'] ; ?>">
                     <?= $usa['user_shop_name'] ; ?> - <?= $usa['marketplace_name']; ?>
                  </option>
                <?php endforeach ;?>
              </select>
            </div>
          </div>
          <div class="d-flex flex-row justify-content-start mb-2 w-100">
          </div>
          <div class="input-group w-100 mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Tracking number </span>
            </div>
            <input type="text" class="form-control" placeholder="Tracking number ... " name="tracking_number" aria-label="Username" aria-describedby="basic-addon1">
          </div>

          <div class="w-100 mt-auto">
              <button class="btn btn-success float-right" type="submit">
                <i class="fa fa-fw fa-plus"></i> <strong>Add Transaction</strong>
              </button>
          </div>  
        </div>
      </div>
    </div>

  

  </form>
</div>
