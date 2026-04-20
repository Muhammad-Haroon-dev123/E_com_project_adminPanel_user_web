@include('user.component.header')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shopping Cart</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (session('success'))
                                <tr>
                                    <td colspan="4" style="color:green;">
                                        {{ session('success') }}
                                    </td>
                                </tr>
                            @endif

                            @php $grandTotal = 0; @endphp

                            @if (count($cart) > 0)

                                @foreach ($cart as $id => $item)
                                    @php
                                        $total = $item['price'] * $item['quantity'];
                                        $grandTotal += $total;
                                    @endphp

                                    <tr data-id="{{ $id }}" data-price="{{ $item['price'] }}">
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__pic">
                                                <img src="{{ Storage::url($item['image']) }}" style="width:100px;" alt="">
                                            </div>
                                            <div class="product__cart__item__text">
                                                <h6>{{ $item['name'] }}</h6>
                                                <h5>${{ number_format($item['price'], 2) }}</h5>
                                            </div>
                                        </td>
                                        <td class="quantity__item">
                                            <div class="quantity">
                                                <div class="pro-qty-2">
                                                    <input type="number" min="1" class="cart-quantity" data-id="{{ $id }}" value="{{ $item['quantity'] }}">
                                                </div>
                                            </div>               
                                        </td>
                                        <td class="cart__price" id="cart-item-total-{{ $id }}">${{ number_format($total, 2) }}</td>
                                        <td class="cart__close">
                                            <a href="{{ route('cart.remove', $id) }}">
                                            <i class="fa fa-close"></i>
                                        </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">Cart is empty</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="{{ route('checkout') }}">Continue Shopping</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn update__btn">
                            {{-- <a href="#"><i class="fa fa-spinner"></i> Update cart</a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart__discount">
                    <h6>Discount codes</h6>
                    <form action="#">
                        <input type="text" placeholder="Coupon code">
                        <button type="submit">Apply</button>
                    </form>
                </div>
                <div class="cart__total">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal <span id="cart-subtotal">${{ number_format($grandTotal, 2) }}</span></li>
                        <li>Total <span id="cart-total">${{ number_format($grandTotal, 2) }}</span></li>
                    </ul>
                    <a href="{{ route('checkout') }}" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->

<script src="{{ asset('js/cart.js') }}"></script>

@include('user.component.footer')
