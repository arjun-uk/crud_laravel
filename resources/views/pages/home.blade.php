@extends('layouts.base')

@section('content')

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('add_products') }}">Add Products</a>
              </li>
        
            </ul>
            <div class="d-flex">
                <a class="navbar-brand" href="{{ route('home') }}">{{ session('user.name') }}</a>
                <a class="btn btn-danger"  href="{{ route('logout') }}">Logout</a>
            </div>
          </div>
        </div>
      </nav>


      <div class="container mt-5">
        <h2>Products List</h2>
        <form method="POST" action="{{ route('destroy') }}" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete All</button>
        </form>
        @if($products->isEmpty())
            <p>No products available.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->product_price }}</td>
                            <td>{{ $product->product_quantity }}</td>
                            <td>{{ $product->product_category }}</td>
                            <td><img src="{{ Storage::url($product->product_image) }}" 
                                alt="{{ $product->product_name }}" width="50"></td>
                                <td>
                                    <a href="{{ route('deleteProductShow', ['id' => $product->id]) }}">
                                        <i class="fa-solid fa-trash p-2"></i>
                                    </a>
                                    <a href="{{ route('editProductShow', ['id' => $product->id]) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection