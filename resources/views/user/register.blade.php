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
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="text-center mb-4">
                        <h2 class="card-title">Đăng kí</h2>
                        <small class="card-text">Chúng tôi rất vui khi được chào đón bạn trở lại.</small>
                    </div>
                    <form action="{{route('user.handleSignup')}}" method="POST" class="sign-in-form">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên đăng ký</label>
                            <input type="name" name="name" class="form-control form-control-sm" id="name" placeholder="Nhập name...">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email đăng ký</label>
                            <input type="email" name="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" placeholder="Nhập địa chỉ email..." value="{{ old('email') }}">
                            @if ($errors->has('email'))
                            <label class="text-danger"> {{ $errors->first('email') }} </label>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="number" class="form-label">SDT đăng ký</label>
                            <input type="number" name="phone" class="form-control form-control-sm " id="phone" placeholder="Nhập địa chỉ email...">
                            @if ($errors->has('phone'))
                            <label class="text-danger"> {{ $errors->first('phone') }} </label>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu đăng ký</label>
                            <input type="password" name="password" class="form-control form-control-sm @error('password') is-invalid @enderror" placeholder="Nhập mật khẩu...">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Nhập lại mật khẩu</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-sm" placeholder="Nhập lại mật khẩu" />
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="button-login btn btn-lg btn-primary text-light w-100 fs-6">Đăng ký</button>
                            <button type="button" class="btn btn-lg btn-light w-100 fs-6">
                                <img src="{{asset('users/img/google.png')}}" alt="Google" style="width:20px" class="me-2">
                                Đăng nhập bằng Google
                            </button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <small>Tôi đã có tài khoản? <a href="{{route('user.login')}}" class="text-decoration-none">Đăng nhập</a></small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #F78B6C;">
                <div class="featured-image mb-3">
                    {{-- <img src="{{asset('users/img/1.png')}}" class="img-fluid" style="width: 250px;"> --}}
                </div>
                <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Be Verified</p>
                <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Nền tảng mua sắm lớn nhất thế giới</small>
            </div>
        </div>
    </div>
</body>

</html>
