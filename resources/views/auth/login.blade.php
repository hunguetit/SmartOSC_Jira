@extends('auth.layouts.default')

@section('title','Login')

@section('content')
<!-- Top content -->
<div class="top-content">
	
    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1><strong>SmartOSC</strong> Jira</h1>
                    <div class="description">
                    	<p style="font-family: 'Calibri'; font-size: 22px;">
                        	<strong>Manager Project</strong> - work with <strong>PASSION</strong>
                    	</p>
                    </div>
                </div>
            </div>
            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">
                	<div class="form-top">
                		<div class="form-top-left">
                			<h3>Login to SmartOSC Jira</h3>
                            <p>If you don't have acc. Please contact to IT admin</p>
                		</div>
                		<div class="form-top-right">
                			<i class="fa fa-lock"></i>
                		</div>
                    </div>
                    <div class="form-bottom">
	                    <form role="form" method="POST" action="{{ url('/auth/login') }}" class="login-form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
	                    	<div class="form-group">
	                    		<label class="sr-only" for="form-username">Username
                                    <span class="required">* </span>
                                </label>
	                        	<input type="text" name="username" placeholder="Username..." class="form-username form-control" id="form-username">
	                        </div>
	                        <div class="form-group">
	                        	<label class="sr-only" for="form-password">Password
                                    <span class="required">* </span>
                                </label>
	                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
	                        </div>
	                        <button type="submit" class="btn">Log in!</button>
	                    </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 social-login">
                	<h3>...or login with:</h3>
                	<div class="social-login-buttons">
                    	<a class="btn btn-link-2" href="#">
                    		<i class="fa fa-facebook"></i> Facebook
                    	</a>
                    	<a class="btn btn-link-2" href="#">
                    		<i class="fa fa-twitter"></i> Twitter
                    	</a>
                    	<a class="btn btn-link-2" href="#">
                    		<i class="fa fa-google-plus"></i> Google Plus
                    	</a>
                	</div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 social-login">
                    <a class="btn btn-link-2" href="{{ url('password/email') }}">
                        <i class="fa fa-send"></i> Forget my password
                    </a>
            </div>
        </div>
    </div>
    
</div>