
@extends('admin.app')

@section('content')
<div class="body-wrapper-inner">
    <div class="container-fluid">
        <div class="row">

            {{-- LEFT SIDE - CATEGORY TABLE --}}
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">All Categories</h5>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Slug</th>
                                    <th width="150">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $key => $cat)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $cat->name }}</td>
                                    <td>
                                        @if($cat->image)
                                            <img src="{{ Storage::url($cat->image) }}" alt="{{ $cat->name }}" width="50" class="rounded-circle">
                                        @else
                                            N/A
                                        @endif
                                    
                                    <td>{{ $cat->slug }}</td>
                                    <td>
                                        <a href="{{ route('category.edit', $cat->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                        <form action="{{ route('category.delete', $cat->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            {{-- RIGHT SIDE - ADD/UPDATE CATEGORY FORM --}}
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">
                            {{ isset($category) ? 'Update Category' : 'Add Category' }}
                        </h5>

                        <form action="{{ isset($category) ? route('category.update', $category->id) : route('category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $category->name ?? '' }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Slug</label>
                                <input type="text" class="form-control" name="slug" value="{{ $category->slug ?? '' }}">
                            </div>
                            

                            <div class="mb-3">
                                <img src="{{ Storage::url($category->image ?? '') }}" alt="" width="100" >
                                <br>
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                {{ isset($category) ? 'Update Category' : 'Submit Category' }}
                            </button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection