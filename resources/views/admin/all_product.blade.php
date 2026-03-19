@extends('admin.app')
@section('content')
<!--  ALL PRODUCTS -->
       <div class="body-wrapper-inner">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
            <div class="table-responsive">
              <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Products</h4>
            <a href="{{ route('add_product') }}" class="btn btn-primary">
                <i class="ti ti-plus"></i> Add Product
            </a>
        </div>
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Row -->
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if ($product->product_image)
                                        <img src="{{ Storage::url($product->product_image) }}" 
                                             class="rounded" 
                                             width="60" height="60">
                                    @else
                                        <img src="https://via.placeholder.com/60" 
                                             class="rounded" 
                                             width="60" height="60">
                                    @endif
                                </td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->product_description }}</td>
                                <td>${{ $product->product_price }}</td>
                                <td style="display: flex; gap: 5px;">
                                    <a href="{{ route('products.edit',$product->id) }}" class="btn btn-sm btn-warning">
                                        Update
                                    </a>
                                    <a href="{{ route('products.delete', $product->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach   
                  </tbody>
                </table>
            </div>
        </div>
          </div>
        </div>   

        @endsection