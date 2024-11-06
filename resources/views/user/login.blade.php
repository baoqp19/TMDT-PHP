<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('users/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('users/css/auth.css')}}" rel="stylesheet" />
    <title>Đăng nhập</title>
</head>

<body>
    <!----------------------- Main Container -------------------------->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <!----------------------- Login Container -------------------------->
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <!--------------------------- Left Box ----------------------------->
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #B5292F;">
                <div class="featured-image mb-3">
                    {{-- <img src="{{asset('users/img/1.png')}}" class="img-fluid" style="width: 250px;"> --}}
                </div>
                <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Be Verified</p>
                <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Nền tảng mua sắm lớn nhất thế giới</small>
            </div>
            <!--------------------------- Right Box ----------------------------->
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="text-center mb-4">
                        <h2 class="card-title">Đăng nhập</h2>
                        <small class="card-text">Chúng tôi rất vui khi được chào đón bạn trở lại.</small>
                    </div>
                    <form action="{{route('user.handlelogin')}}" method="POST" class="sign-in-form">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Địa chỉ email</label>
                            <input type="email" name="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" placeholder="Nhập địa chỉ email..." value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" name="password" class="form-control form-contol-sm @error('password') is-invalid @enderror" placeholder="Nhập mật khẩu...">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if ($errors->has('email_or_pass'))
                            <p class="error">{{$errors->first('email_or_pass')}}</p>
                            @endif
                        </div>
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                            </div>
                            <a href="{{route('user.forgot_password')}}" class="text-decoration-none">Quên mật khẩu?</a>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="button-login btn btn-lg btn-primary text-light w-100 fs-6">Đăng nhập</button>
                            <a type="button" href="{{route('social.google')}}" class="btn btn-lg btn-light w-100 fs-6" >
                                <img src="{{asset('users/img/google.png')}}" alt="Google" style="width:20px" class="me-2">
                                 Đăng nhập bằng Google
                            </a>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                            <small>Chưa có tài khoản? <a href="{{route('user.register')}}" class="text-decoration-none">Đăng ký</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
