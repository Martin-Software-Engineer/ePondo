@extends('layouts.app')

@section('content')
<div class="row">
        <div class="mt-4"><h1>Public Path Products!</h1></div>
    </div>

    <table class="table">
        <thead>
            <tr>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Category Name</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            
            <tr>
            <td><a href="#">{{ $product -> name }}</a></td>
            <td>{{ $product -> description }}</td>
            <td>#</td>
            <td>#</td>
            <td>
                <a class="btn btn-sm btn-primary" href="{{$product -> publicpath() }}" role="button">View</a>
            </td>
            </tr>
            
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}

@endsection