@extends('layouts.base')

@section('content')
<section class="vh-100" style="background-color: #508bfc;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <h3 class="mb-5">Edit Product</h3>

                        <form method="POST" action="{{ route('editProduct') }}" enctype="multipart/form-data">
                            @csrf
                            
                            <input type="hidden" name="id" value="{{ $product->id }}" />

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="id_product_name" placeholder="Enter product name" class="form-control form-control-lg" name="name" value="{{ $product->product_name }}" required />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="number" id="id_price" placeholder="Enter product price" class="form-control form-control-lg" name="price" value="{{ $product->product_price }}" required />
                            </div>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="number" id="id_quantity" placeholder="Enter product quantity" class="form-control form-control-lg" name="quantity" value="{{ $product->product_quantity }}" required />
                            </div>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="id_category" placeholder="Enter product category" class="form-control form-control-lg" name="category" value="{{ $product->product_category }}" required />
                            </div>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="file" id="id_image" class="form-control form-control-lg" name="image" />
                            </div>
                            <input data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" type="submit" value="Update Product" />

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
