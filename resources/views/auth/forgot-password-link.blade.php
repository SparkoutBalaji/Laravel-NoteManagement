@extends('layout.layout')
@section('title', 'Forget Password Link')
@section('content')

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            {{-- <div class="col-lg-6 d-none d-lg-block bg-password-image"></div> --}}
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <form action="{{ route('reset.password.post') }}" method="POST">

                                            @csrf

                                            <input type="hidden" name="token" value="{{ $token }}">



                                            <div class="form-group row">
                                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                                <div class="col-md-6">
                                                    <input type="text" id="email_address" class="form-control" name="email" value="{{ $userEmail }}" readonly>
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                            </div>



                                            <div class="form-group row">

                                                <label for="password"
                                                    class="col-md-4 col-form-label text-md-right">Password</label>

                                                <div class="col-md-6">

                                                    <input type="password" id="password" class="form-control"
                                                        name="password" required autofocus>

                                                    @if ($errors->has('password'))
                                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                                    @endif

                                                </div>

                                            </div>



                                            <div class="form-group row">

                                                <label for="password-confirm"
                                                    class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                                <div class="col-md-6">

                                                    <input type="password" id="password-confirm" class="form-control"
                                                        name="password_confirmation" required autofocus>

                                                    @if ($errors->has('password_confirmation'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                                    @endif

                                                </div>

                                            </div>



                                            <div class="col-md-6 offset-md-4">

                                                <button type="submit" class="btn btn-primary">

                                                    Reset Password

                                                </button>

                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection
