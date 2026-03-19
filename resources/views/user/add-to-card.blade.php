@include('user.header')
<style>
    #card-add{
        margin-top: 200px;
    }
</style>
<div class="container" id="card-add">
    <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:50%">Product</th>
                <th style="width:10%">Price</th>
                <th style="width:8%">Quantity</th>
                <th style="width:22%" class="text-center">Subtotal</th>
                <th style="width:10%"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td data-th="Product">
                    <div class="row">
                        <div class="col-sm-2 hidden-xs"><img src="{{$product->product_image}}" alt="..."
                                class="img-responsive" /></div>
                        <div class="col-sm-10">
                            <h4 class="nomargin"> {{$product->product_name}} </h4>
                            <p>{{$product->product_description}}</p>
                        </div>
                    </div>
                </td>
                <td data-th="Price">${{$product->product_price}}</td>
                <td data-th="Quantity">
                    <input type="number" class="form-control text-center" value="1">
                </td>
                <td data-th="Subtotal" class="text-center">${{$product->product_price}}</td>
                <td class="actions" data-th="">
                    <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr class="visible-xs">
                <td class="text-center"><strong>Total $ 5.11</strong></td>
            </tr>
            <tr>
                <td><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                </td>
                <td colspan="2" class="hidden-xs"></td>
                <td class="hidden-xs text-center"><strong>Total $ 5.11</strong></td>
                <td><a href="#" class="btn btn-success btn-block">Checkout</a>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
@include('user.footer')
