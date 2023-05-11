@extends('adminlte::page')

@section('content')

@if (session('success'))
<h6 class="alert alert-success">{{ session('success') }}</h6>
@endif

<br />
<div class="container w-50 p-4">
    <div class="card border border-dark">
        <div class="card-header bg-dark">
            <h5> {{config('app.nav_section2')}} / NEW IMAGE </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('section2_img.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Title: </label>
                    <input type="text" name="title" class="form-control" value="">
                    @error('title') <div class="text-danger text-center">Required value</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Description: </label>
                    <textarea rows="5" class="w-100" type="text" name="description" class="form-control"></textarea>
                    @error('description') <div class="text-danger text-center">Required value</div>@enderror
                </div>

                <div>
                    <label for="title" class="form-label">Image: </label>
                </div>

                <div class='mb-3 text-center'>
                    <input type="file" name="image" class="form-control w-100" value="">
                    @error('image') <div class="text-danger text-center">Required value</div>@enderror
                </div>

                <div class="text-right mt-3">
                    <button type=" submit" class="btn btn-primary">Create</button>
                </div>

            </form>
        </div> <!-- card body  -->
    </div> <!-- card border  -->
</div> <!-- container  -->

@endsection