@extends('frontend.user.user_layout.master')
@section('title', 'List Categories')
@section('user-manage')
    <div class="card">
        <div class="title-head">
            <div class="account-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path d="M12 13.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z"></path>
                    <path fill-rule="evenodd"
                        d="M19.071 3.429C15.166-.476 8.834-.476 4.93 3.429c-3.905 3.905-3.905 10.237 0 14.142l.028.028 5.375 5.375a2.359 2.359 0 003.336 0l5.403-5.403c3.905-3.905 3.905-10.237 0-14.142zM5.99 4.489A8.5 8.5 0 0118.01 16.51l-5.403 5.404a.859.859 0 01-1.214 0l-5.378-5.378-.002-.002-.023-.024a8.5 8.5 0 010-12.02z">
                    </path>
                </svg>
            </div>
            <div class="title-text">
                <h2> ข้อมูลส่วนตัว </h2>
                <span> สามารถแก้ไขที่อยู่ของคุณได้ </span>
            </div>

        </div>
        <div id="shipping-address-list">
            <div class="shipping-address">
                <div class="name-phone">
                    ชื่อ
                </div>
                <div class="address-info">
                    {{ Auth::user()->name }}
                </div>
                <div class="edit">
                    <button data-toggle="modal" data-target="#update-name" class="button">
                        แก้ไข
                    </button>

                </div>
            </div>
        </div>
        <div id="shipping-address-list">
            <div class="shipping-address">
                <div class="name-phone">
                    รหัสผ่าน
                </div>
                <div class="address-info">
                    ***************
                </div>
                <div class="edit">
                    <button data-toggle="modal" data-target="#update-pass" class="button">
                        เปลี่ยนรหัสผ่าน
                    </button>

                </div>
            </div>
        </div>

    </div>
    <!--Modal -->
    <div class="modal fade" id="update-pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 600px;">
            <div class="modal-content" style="padding: 0 20px;">
                <div class="modal-header">
                    <div class="modal-title">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill-rule="evenodd"
                                d="M11.03 2.59a1.5 1.5 0 011.94 0l7.5 6.363a1.5 1.5 0 01.53 1.144V19.5a1.5 1.5 0 01-1.5 1.5h-5.75a.75.75 0 01-.75-.75V14h-2v6.25a.75.75 0 01-.75.75H4.5A1.5 1.5 0 013 19.5v-9.403c0-.44.194-.859.53-1.144l7.5-6.363zM12 3.734l-7.5 6.363V19.5h5v-6.25a.75.75 0 01.75-.75h3.5a.75.75 0 01.75.75v6.25h5v-9.403L12 3.734z">
                            </path>
                        </svg>
                        <div>
                            <h1 class="shippingTitle">เปลี่ยนรหัสผ่าน</h1>

                        </div>
                    </div>
                    <button type="button" class="close sm-up" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body address-form-modal pt-0 pb-0" style="background-color: white; border-radius: 8px;">
                    <form id="update-pass">
                        @csrf
                        @method('PUT')

                        @if (session('status') == 'password-updated')
                            <div class="alert alert-success">
                                Password updated successfully.
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="current_password"
                                class="col-md-4 col-form-label text-md-right">{{ __('รหัสผ่านเก่า') }}</label>

                            <div class="col-md-6">
                                <input id="current_password" type="password"
                                    class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                                    name="current_password" required autofocus>
                                <div error-text-for="current_password" class="error-message">รหัสผ่านปัจจุบันไม่ถูกต้อง
                                </div>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('รหัสผ่านใหม่') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                                    name="password" required autocomplete="new-password">
                                <div error-text-for="password" class="error-message">รหัสผ่านต้องมีความยาวอย่างน้อย 8
                                    ตัวอักษร</div>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">{{ __('รหัสผ่านใหม่อีกครั้ง') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="mb-0 form-group row">
                            <div class="col-md-6 offset-md-4 mb-4">
                                <button type="submit" class="btn btn-primary ">
                                    {{ __('บันทึก') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End Modal -->
    <!--Modal -->
    <div class="modal fade" id="update-name" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 600px;">
            <div class="modal-content" style="padding: 0 20px;">
                <div class="modal-header">
                    <div class="modal-title">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill-rule="evenodd"
                                d="M11.03 2.59a1.5 1.5 0 011.94 0l7.5 6.363a1.5 1.5 0 01.53 1.144V19.5a1.5 1.5 0 01-1.5 1.5h-5.75a.75.75 0 01-.75-.75V14h-2v6.25a.75.75 0 01-.75.75H4.5A1.5 1.5 0 013 19.5v-9.403c0-.44.194-.859.53-1.144l7.5-6.363zM12 3.734l-7.5 6.363V19.5h5v-6.25a.75.75 0 01.75-.75h3.5a.75.75 0 01.75.75v6.25h5v-9.403L12 3.734z">
                            </path>
                        </svg>
                        <div>
                            <h1 class="shippingTitle">เปลี่ยนรหัสผ่าน</h1>

                        </div>
                    </div>
                    <button type="button" class="close sm-up" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body address-form-modal pt-0 pb-0" style="background-color: white; border-radius: 8px;">
                    <form id="update-name">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('ชื่อ-นามสกุล') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') ?? auth()->user()->name }}" required
                                    autocomplete="name" autofocus>
                                    <div error-text-for="current_password" class="error-message"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') ?? auth()->user()->email }}" required
                                    autocomplete="email" autofocus>
                                    <div error-text-for="email" class="error-message">อีเมล์นี้ถูกใช้งานแล้ว</div>

                            </div>
                        </div>


                        <div class="mb-0 form-group row">
                            <div class="col-md-8 offset-md-4 mb-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('บันทึก') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End Modal -->
    <script>
        var msg = '{{ Session::get('message') }}';
        var exist = '{{ Session::has('message') }}';
        if (exist) {
            alert(msg);
        }
    </script>
    <script>
        $('#update-pass').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '{{ route('user-password.update') }}',
                data: {
                    _method: 'put',
                    _token: $('input[name=_token]').val(),
                    current_password: $('#current_password').val(),
                    password: $('#password').val(),
                    password_confirmation: $('#password-confirm').val(),
                },
                error: function(data) {
                    if (data.status == 422) {
                        let errors = data.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $(`[error-text-for=${key}]`).addClass('error');
                        });
                    } else if (data.status == 401) {
                        window.location.href = '{{ route('login') }}';
                    }
                }
            });
        });
        $('#update-name').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '{{ route('user-profile-information.update') }}',
                data: {
                    _method: 'put',
                    _token: $('input[name=_token]').val(),
                    name: $('#name').val(),
                    email: $('#email').val(),
                },
                success: (data) => {
                    alert('อัพเดทข้อมูลสำเร็จ');
                    window.location.reload();
                },
                error: function(data) {
                    let errors = data.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $(`[error-text-for=${key}]`).addClass('error');
                    });
                }
            });
        });
    </script>
@endsection
