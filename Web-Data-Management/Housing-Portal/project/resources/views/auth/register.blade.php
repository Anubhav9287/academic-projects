@extends('layouts.app')
<style>
    .hide {
        display: none;
    }
</style>
<script>
    function show_subvision() {
        document.getElementById('subdivision_preference').style.display = 'block';
        document.getElementById('building_preference').style.display = 'none';
        document.getElementById('floor_preference').style.display = 'none';
    }

    function show_building() {
        document.getElementById('subdivision_preference').style.display = 'block';
        document.getElementById('building_preference').style.display = 'block';
        document.getElementById('floor_preference').style.display = 'none';
    }

    function show_apartment() {
        document.getElementById('subdivision_preference').style.display = 'block';
        document.getElementById('building_preference').style.display = 'block';
        document.getElementById('floor_preference').style.display = 'block';
        document.getElementById('apartment_preference').style.display = 'block';
    }
    function check() {
        console.log(document.getElementById('subdivision_pre').value);
        console.log(document.getElementById('building_pre').value);
        document.getElementById('floor_pre').value;
        document.getElementById('apartment_pre').value;
    }
</script>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Full Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Username Field -->
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">User Name</label>

                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <!-- Address Field -->
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="address" class="form-control @error('username') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">

                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Contact Number Field -->
                        <div class="form-group row">
                            <label for="contactnumber" class="col-md-4 col-form-label text-md-right">Contact Number</label>

                            <div class="col-md-6">
                                <input id="contactnumber" type="contactnumber" class="form-control @error('contactnumber') is-invalid @enderror" name="contactnumber" value="{{ old('contactnumber') }}" required autocomplete="contactnumber">

                                @error('contactnumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Responsible Contact Field -->
                        <div class="form-group row">
                            <label for="r_name" class="col-md-4 col-form-label text-md-right">Responsible Contact Name</label>

                            <div class="col-md-6">
                                <input id="r_name" type="name" class="form-control @error('r_name') is-invalid @enderror" name="r_name" value="{{ old('r_name') }}" required autocomplete="r_name">

                                @error('r_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Responsible Contact Number Field -->
                        <div class="form-group row">
                            <label for="r_contactnumber" class="col-md-4 col-form-label text-md-right">Responsible Contact Number</label>

                            <div class="col-md-6">
                                <input id="r_contactnumber" type="r_contactnumber" class="form-control @error('r_contactnumber') is-invalid @enderror" name="r_contactnumber" value="{{ old('r_contactnumber') }}" required autocomplete="r_contactnumber">

                                @error('r_contactnumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Owner Field Field -->
                        <div class="form-group row">
                            <label for="signup" class="col-md-4 col-form-label text-md-right">Want to Sign Up for?</label>
                            <div class="col-md-6" >
                                <input type="radio" id="subdivision" name="signup" value="subdivision" onclick="show_subvision()" required>
                                <label for="subdivision">Sub Division</label><br>
                                <input type="radio" id="building" name="signup" value="building" onclick="show_building()">
                                <label for="building">Building</label><br>
                                <input type="radio" id="apartment" name="signup" value="apartment" onclick="show_apartment()">
                                <label for="apartment">Apartment</label>
                                <div id="subdivision_preference" class="hide">
                                    <hr>
                                    <p>Select you prefered Sub Division:</p>
                                    <input type="radio" id="subdivision_pre" name="subdivision_name" value="Gryffindor">
                                    Gryffindor
                                    <input type="radio" id="subdivision_pre" name="subdivision_name" value="Hufflepuff">
                                    Hufflepuff
                                    <input type="radio" id="subdivision_pre" name="subdivision_name" value="Ravenclaw">
                                    Ravenclaw
                                    <input type="radio" id="subdivision_pre" name="subdivision_name" value="Slytherin">
                                    Slytherin
                                </div>
                                <div id="building_preference" class="hide">
                                    <hr>
                                    <p>Select you prefered Building:</p>
                                    <input type="radio" id="building_pre" name="building_no" value="1">
                                    1 &nbsp;
                                    <input type="radio" id="building_pre" name="building_no" value="2">
                                    2 &nbsp;
                                    <input type="radio" id="building_pre" name="building_no" value="3">
                                    3 &nbsp;
                                    <input type="radio" id="building_pre" name="building_no" value="4">
                                    4 &nbsp;
                                </div>
                                <div id="floor_preference" class="hide" onclick="check()">
                                    <hr>
                                    <p>Select you prefered Floor:</p>
                                    <input type="radio" id="floor_pre" name="floor_no" value="0">
                                    Ground &nbsp;
                                    <input type="radio" id="floor_pre" name="floor_no" value="1">
                                    First &nbsp;
                                    <input type="radio" id="floor_pre" name="floor_no" value="2">
                                    Second &nbsp;
                                    <input type="radio" id="floor_pre" name="floor_no" value="3">
                                    Third &nbsp;
                                </div>
                                <div id="apartment_preference" class="hide">
                                    <hr>
                                    <p>Available Apartment on this floor:</p>
                                    <input type="radio" id="apartment_pre" name="apartment_no" value="0">
                                    1 &nbsp;
                                    <input type="radio" id="apartment_pre" name="apartment_no" value="1">
                                    2 &nbsp;
                                    <input type="radio" id="apartment_pre" name="apartment_no" value="2">
                                    3 &nbsp;
                                    <input type="radio" id="apartment_pre" name="apartment_no" value="3">
                                    4 &nbsp;
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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