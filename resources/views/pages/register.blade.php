@extends('layouts.base')

@section('content')
<section class="vh-100" style="background-color: #508bfc;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <h3 class="mb-5">Please Register</h3>

                        <form method="POST" action="{{ route('submitRegister') }}">
                        @csrf
                        <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="id_name" class="form-control form-control-lg" name="name" required/>
                                <label class="form-label" for="id_name">Name</label>
                            </div>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="email" id="id_email" class="form-control form-control-lg" name="email" required/>
                                <label class="form-label" for="id_email">Email</label>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="password" id="id_password" class="form-control form-control-lg" name="password" required/>
                                <label class="form-label" for="id_password">Password</label>
                            </div>
                            <input data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block"
                                type="submit"/>

                                <div>
                                    <p class="mb-0 mt-2">Already have an account? <a href="{{ route('login') }}" class="text-blue-50 fw-bold">Login
                                            In</a>
                                    </p>
                                </div>
                                <div>
                                    <p></p>
                                </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if(Session::has('success'))
    <div id="success-alert" class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif

@if(Session::has('error'))
    <div id="error-alert" class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif

<script>
    // Auto-close success message after 3 seconds
    setTimeout(function() {
        $('#success-alert').fadeOut('slow');
    }, 3000);

    // Auto-close error message after 3 seconds
    setTimeout(function() {
        $('#error-alert').fadeOut('slow');
    }, 3000);
</script>
@endsection