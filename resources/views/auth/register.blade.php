@extends('layout.layout')
@section('title','NoteManagement Registration')
@section('content')

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">

                <div class="row">

                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h1 text-gray-900 mb-4"><i class="fas fa-sticky-note"></i>  Note Management</h1>

                                <h3 class="h4 text-gray-900 mb-4">Create an Account!</h3>
                            </div>
                            <form method="post" action="{{ route('user.register') }}" class="user">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" name="fullname" class="form-control form-control-user" id="exampleFullName"
                                            placeholder="Full Name" value="{{ old('fullname') }}">
                                    </div>
                                    @if ($errors->has('fullname'))
                                        <div class="text-danger">
                                            <p>{{ $errors->first('fullname') }}</p>
                                        </div>
                                    @endif

                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address" value="{{ old('email') }}">
                                </div>
                                     @if ($errors->has('email'))
                                        <div class="text-danger">
                                            <p>{{ $errors->first('email') }}</p>
                                        </div>
                                    @endif
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" value="{{ old('password') }}">
                                    </div>

                                    <div class="col-sm-6">
                                        <input type="password" name="password_confirmation" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password" value="{{ old('password_confirmation') }}">
                                    </div>

                                </div>
                                        @if ($errors->has('password'))
                                            <div class="text-danger">
                                                <p>{{ $errors->first('password') }}</p>
                                            </div>
                                        @endif

                                <input type="submit" class="btn btn-primary btn-user btn-block" value="Register Account">

                                <hr>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('forgot-password') }}">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

