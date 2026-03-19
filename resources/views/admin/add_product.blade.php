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
                    <h5 class="card-title fw-semibold mb-4">Add Product</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Product Name</label>
                                    <input type="text" class="form-control" name="product_name">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Product Description</label>
                                    <textarea class="form-control" name="product_description"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Product Price</label>
                                    <input type="number" class="form-control" name="product_price" step="0.01">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Select Categories</label>
                                    <div>
                                        @foreach ($categories as $category)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="category_id[]"
                                                    value="{{ $category->id }}" id="category{{ $category->id }}">
                                                <label class="form-check-label" for="category{{ $category->id }}">
                                                    {{ $category->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Product Image</label>
                                    <input type="file" class="form-control" name="product_image">
                                </div>

                                <button type="submit" class="btn btn-primary">Submit Product</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
