<div class="modal fade asdh-delete make-darker"
         id="view-products"
         tabindex="-1"
         role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header"
               style="padding: 20px 24px">
            <button type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-hidden="true">
              <i class="material-icons">clear</i>
            </button>
            <h4 class="modal-title"
                v-if="products.length">All products of order with
              <b>ID: @{{ products[0].order_code }}</b></h4>
          </div>
          <div class="modal-body"
               style="padding: 10px 24px">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Size</th>
                  <th>Color</th>
                  
                  <th class="text-center">Quantity</th>
               
                  <th class="text-right">Price</th>
                  <th class="text-right">Total</th>
                  <th class="text-right">Status</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="product in products"  class="">
                  <td v-text="product.product.title"></td>
                  <td v-if="product.size">@{{product.size.size}}</td>
                  <td v-else>-</td>
                  <td v-if="product.color">@{{product.color.name}}</td>
                  <td v-else>-</td>
                  <td class="text-center"
                      v-text="product.quantity"></td>
                  <td class="text-right"
                      v-text="product.rate"></td>
                  <td class="text-right"
                      v-text="product.quantity*product.rate"></td>
                 <td>
                   <select name="status" class="form-control" 
                           id="order-status"
                           @change="">
                     @foreach(['pending', 'processing', 'delivered'] as $orderStatus)
                       <option value="{{ $orderStatus }}" {{ $orderStatus==$order->status?'selected':'' }}>{{ ucwords($orderStatus) }}</option>
                     @endforeach
                   </select>
                 </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                  <th>Total</th>
                  <th></th>
                  <th></th>
                
                  <th class="text-center"
                      v-text="totalQuantity"></th>
                  <th class="text-right"></th>
                  <th class="text-right"
                      v-text="totalPrice"></th>
                </tr>
                </tfoot>
              </table>
              <h4>Shipping Info:</h4>


              <table class="table table-striped">
                <thead>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Contact Number</th>
                  <th>Address</th>
                  <th>Message</th>
                </thead>
                <tbody>
                  <td v-text="shipping.first_name"></td>
                  <td v-text="shipping.last_name"></td>
                  <td v-text="shipping.contact_number"></td>
                  <td v-text="shipping.address"></td>
                  <td v-text="shipping.message"></td>
                  

                </tbody>
                


              </table>
            </div>
          </div>
        </div>
      </div>
    </div>