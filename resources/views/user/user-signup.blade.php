@include('user.component.header')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Sign Up</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ route('index') }}">Home</a>
                        <span>Sign Up</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Sign Up Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__text">
                    <h3>Join Our Community</h3>
                    <p>Create your account to start shopping and enjoy exclusive benefits with our store.</p>
                    <div class="contact__widget">
                        <ul>
                            <li><i class="fa fa-user"></i> Personal Account</li>
                            <li><i class="fa fa-truck"></i> Fast Shipping</li>
                            <li><i class="fa fa-gift"></i> Special Offers</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="contact__form">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-4">
                            <p>Full Name<span>*</span></p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="form-control">
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="mb-4">
                            <p>Email Address<span>*</span></p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                </div>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="form-control">
                            </div>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <p>Password<span>*</span></p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                <input id="password" type="password" name="password" required autocomplete="new-password" class="form-control">
                            </div>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <p>Confirm Password<span>*</span></p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="form-control">
                            </div>
                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4 text-left">
                            <p>Already have an account? <a href="{{ route('user.login') }}" class="text-decoration-none">Sign in</a></p>
                        </div>

                        <button type="submit" class="site-btn">Create Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Sign Up Section End -->
    </form>

@include('user.component.footer')