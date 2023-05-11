@extends('adminlte::page')

@section('content')

@if (session('success'))
<h6 class="alert alert-success">{{ session('success') }}</h6>
@endif
@error('title')
<h6 class="alert alert-danger">{{ $message }}</h6>
@enderror

<br />
<div class="container w-75 p-4">
    <div class="card border border-dark">
        <div class="card-header bg-dark">
            <h5>{{config('app.nav_section3')}} &nbsp;&nbsp;/&nbsp;&nbsp; {{$section3_category_name[0]->name}} &nbsp;&nbsp;->&nbsp;&nbsp; Related images</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="bg-light table-sm">
                            <th scope="col" class="text-left w-25">Image</th>
                            <th scope="col" class="text-left w-25">File name</th>
                            <th scope="col" class="text-left w-25">Category</th>
                            <th scope="col"></th>
                            <th scope="col" class="bg-dark text-center">
                                <a href="{{ route('section3_category_images.create',['section3_category_image'=>$section3_category_name[0]->name])}}">

                                    <i class="fa fa-file fa-lg"></i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($section3_category_images as $section3_category_image)
                        <tr>
                            <td class="align-middle">
                                <div class="ratio ratio-1x1">
                                    <div>
                                        <a href="{{URL::asset('/images/'.$section3_category_image->image)}}" target="_blank">
                                            <img class='img-thumbnail img-md img-responsive' src="{{URL::asset('/images/'.$section3_category_image->image)}}" />
                                        </a>
                                    </div>
                                </div>
                            </td>

                            <td class='w-50 align-middle'>
                                {{ $section3_category_image->image }}
                            </td>

                            <td class="align-middle">
                                {{$section3_category_name[0]->name}}
                            </td>

                            <td class="align-middle">
                                <a href="{{ route('section3_category_images.edit',['section3_category_image'=>$section3_category_image->id]) }}">
                                    <button class="btn btn-link">
                                        <i class="fa fa-edit fa-lg" style="color:#31ab59"></i>
                                    </button>
                                </a>
                            </td>
                            <td class="align-middle">
                                <form action="{{ route('section3_category_images.destroy',[$section3_category_image->id]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-link" onclick="return confirm('Are yo sure to delete the image: {{$section3_category_image->image}}?')">
                                        <i class="fa fa-trash fa-lg" style="color:#f16d6d"></i>
                                    </button>
                                </form>
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