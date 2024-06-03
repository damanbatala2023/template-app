@extends('page.temp')
@section('title','Create')
@section('content')

<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-primary-subtle">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">Create new User</h5>

                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div>
                            <a href="index.html">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <span class="avatar-title rounded-circle bg-light">
                                        <img src="assets/images/logo.svg" alt="" class="rounded-circle" height="34">
                                    </span>
                                </div>
                            </a>
                        </div>
                        <div class="p-2">
                            <form class="needs-validation" novalidate action="{{route('create')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <strong>{{$message}}</strong>
                                </div>
                                @endif
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter username" required>
                                    <div class="invalid-feedback">
                                        Please Enter Username
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                                    <div class="invalid-feedback">
                                        Please Enter Email
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                                    <div class="invalid-feedback">
                                        Please Enter Password
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter confirm password" required>
                                    <div class="invalid-feedback">
                                        Please Re-enter Password
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="photo" class="form-label">Upload Photo</label>
                                    <input type="file" class="form-control" id="photo" name="photo">
                                    @if (isset($user) && $user->photo)
                                    <img src="{{ asset('public/' . $user->photo) }}" alt="{{ $user->name }}" class="img-thumbnail mt-2" style="max-width: 100px;">
                                    @endif
                                </div>

                                <div class="mt-4 d-grid">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Register</button>
                                </div>


                            </form>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection