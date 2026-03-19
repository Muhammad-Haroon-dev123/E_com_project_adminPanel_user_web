@extends('admin.app')

@section('content')
    <div class="body-wrapper-inner">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h5 class="card-title fw-semibold mb-4">Edit Product</h5>

                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('products.update', $product->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf


                                <div class="mb-3">
                                    <label class="form-label">Product Name</label>
                                    <input type="text" class="form-control" name="product_name"
                                        value="{{ $product->product_name }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Product Description</label>
                                    <textarea class="form-control" name="product_description">{{ $product->product_description }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Product Price</label>
                                    <input type="number" class="form-control" name="product_price" step="0.01"
                                        value="{{ $product->product_price }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Select Categories</label>
                                    <div>
                                        @foreach ($categories as $category)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="category_id[]"
                                                    value="{{ $category->id }}" id="category{{ $category->id }}"
                                                    {{ $product->categories->contains($category->id) ? 'checked' : '' }}>

                                                <label class="form-check-label" for="category{{ $category->id }}">
                                                    {{ $category->name }}
                                                </label>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Product Image</label><br>

                                    @if ($product->product_image)
                                        <img src="{{ asset('storage/' . $product->product_image) }}" width="80"
                                            class="mb-2">
                                    @endif

                                    <input type="file" class="form-control" name="product_image">
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Update Product
                                </button>

                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
