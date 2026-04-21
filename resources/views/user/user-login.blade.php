@include('user.component.header')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Login</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ route('index') }}">Home</a>
                        <span>Login</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Login Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__text">
                    <h3>Welcome Back</h3>
                    <p>Please sign in to your account to continue shopping and access your order history.</p>
                    <div class="contact__widget">
                        <ul>
                            <li><i class="fa fa-lock"></i> Secure Login</li>
                            <li><i class="fa fa-shopping-cart"></i> Access Your Cart</li>
                            <li><i class="fa fa-history"></i> Order History</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="contact__form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="alert alert-success mb-4">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Email Address -->
                        <div class="mb-4">
                            <p>Email Address<span>*</span></p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                </div>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="form-control">
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
                                <input id="password" type="password" name="password" required autocomplete="current-password" class="form-control">
                            </div>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4 text-left">
                            <p>Don't have an account? <a href="{{ route('user.register') }}" class="text-decoration-none">Create an account</a></p>
                        </div>

                        <button type="submit" class="site-btn">Sign In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Login Section End -->

@include('user.component.footer')