@extends('layouts.base')

@section('content')
<section class="vh-100" style="background-color: #508bfc;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <h3 class="mb-5">Add Products</h3>

                        <form method="POST" action="{{ route('add_products_submit') }}" enctype="multipart/form-data">
                        @csrf
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="id_product_name" placeholder="enter product name" class="form-control form-control-lg" name="name" required/>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="number" id="id_price" placeholder="enter product price" class="form-control form-control-lg" name="price" required/>
                            </div>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="number" id="id_quantity" placeholder="enter product quantity" class="form-control form-control-lg" name="quantity" required/>
                            </div>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="id_category" placeholder="enter product category" class="form-control form-control-lg" name="category" required/>
                            </div>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="file" id="id_category" class="form-control form-control-lg" name="image" required/>
                            </div>
                            <input data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block"
                                type="submit" />

                        </form>

                

                    </div>
                </div>
            </div>
        </div>
    </div>

    
</section>
@endsection()