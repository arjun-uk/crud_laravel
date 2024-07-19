@extends('layouts.base')

@section('content')
<section class="vh-100" style="background-color: #508bfc;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <h3 class="mb-5">Please Login</h3>

                        <form method="POST" action="{{ route('checkLogin') }}">
                        @csrf
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="email" id="id_email" class="form-control form-control-lg" name="email"/>
                                <label class="form-label" for="id_email">Email</label>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="password" id="id_password" class="form-control form-control-lg" name="password"/>
                                <label class="form-label" for="id_password">Password</label>
                            </div>
                            <input data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block"
                                type="submit" />

                        </form>

                        <div>
                            <p class="mb-0 mt-2">Don't have an account? <a href="{{ route('register') }}" class="text-blue-50 fw-bold">Sign
                                    Up</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    
</section>
@endsection