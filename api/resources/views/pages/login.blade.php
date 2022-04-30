
@extends('index')

@section('content')
<div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url({{ asset('images/auth-bg.jpg') }}) no-repeat center center;">
    <div class="auth-box">
        <div>

            <div class="logo">
                <span class="db"><img src="{{ asset('images/logo-icon.png') }}" alt="logo" /></span>
                <h5 class="font-medium m-b-20">ADMIN LOGIN</h5>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <form class="form-horizontal m-t-20" id="loginform" novalidate>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                            </div>
                            <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required validate>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required validate>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn btn-block btn-lg btn-info" type="submit">Log In</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('script')

    <script>

        let loginProcess = false
        $(document).on("submit","#loginform",e => {
            e.preventDefault();

            const form = document.getElementById('loginform');
            if(loginProcess || !form.checkValidity) return;

            loader.show();

            loginProcess = true;
            $.ajax({
                type: 'POST',
                url: "{{ url('login') }}",
                dataType: 'json',
                data: $(form).serialize(),
                cache : false,
                processData: false,
                success: (response, status, xhr) => {
                    if(response.result) return window.location.replace('dashboard');
                    loader.hide();
                    loginProcess = false;
                    alert(response.error);
                },
                error: () => loginProcess = false
            });
        });
        
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
        
    </script>

@stop