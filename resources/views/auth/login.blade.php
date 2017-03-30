@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="logo-login">
                <img src="/images/scawt.png" alt="" class="">
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"  style="padding-bottom: 60px;">
                            <label for="email" class="col-md-12 control-label">E-Mail Address</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-12 control-label">Password</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12" style="padding-top: 20px;">
                                <button type="submit" class="btn btn-sm btn-block btn-primary">
                                    Log In
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12" style="text-align: center;">
                                <a class="btn btn-link" href="{{ route('password.request') }}" style="margin-top: 6px;">
                                    <label>Forgot Your Password?</label>
                                </a>
                                <hr style="margin-top: 5px;">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12" style="margin-bottom: 15px;">

                                <button type="submit" class="btn btn-sm btn-success btn-block btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
