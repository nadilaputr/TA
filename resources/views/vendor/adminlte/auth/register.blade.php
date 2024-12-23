@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])
@php($roles = Spatie\Permission\Models\Role::all()->pluck('name'))
@php($login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login'))
@php($register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register'))

@if (config('adminlte.use_route_url', false))
    @php($login_url = $login_url ? route($login_url) : '')
    @php($register_url = $register_url ? route($register_url) : '')
@else
    @php($login_url = $login_url ? url($login_url) : '')
    @php($register_url = $register_url ? url($register_url) : '')
@endif

@section('auth_header', __('Pengelolaan Surat Badan Pusat Statistik'))

@section('auth_body')
    <form action="{{ $register_url }}" method="post">
        @csrf

        {{-- Name field --}}
        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" placeholder="Nama Lengkap" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    {{-- <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span> --}}
                </div>
            </div>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>



        {{-- jabatan field --}}
        <div class="input-group mb-3">
            <input type="jabatan" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror"
                value="{{ old('jabatan') }}" placeholder="Jabatan">

            <div class="input-group-append">
                <div class="input-group-text">
                    {{-- <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span> --}}
                </div>
            </div>

            @error('jabatan')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        
        {{-- username field --}}
        <div class="input-group mb-3">
            <input type="username" name="username" class="form-control @error('username') is-invalid @enderror"
                value="{{ old('username') }}" placeholder="Username">

            <div class="input-group-append">
                <div class="input-group-text">
                    {{-- <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span> --}}
                </div>
            </div>

            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- role field --}}
        <div class="form-group">
            <select class="form-control" id="role" name="role" required>
                <option value="" selected>Pilih Role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role }}">
                        {{ $role }}</option>
                @endforeach
            </select>
        </div>

            {{-- bidang field --}}
            <div class="form-group">
                <select class="form-control" name="bidang" required>
                    <option value="" selected>Pilih Bidang</option>
                    @foreach ($bidang as $row)
                    <option value="{{ $row->id }}">
                        {{ $row->bidang }}
                    </option>
                @endforeach
    
                </select>
    
                @error('bidang')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="{{ __('adminlte::adminlte.password') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    {{-- <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span> --}}
                </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Confirm password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                class="form-control @error('password_confirmation') is-invalid @enderror"
                placeholder="{{ __('adminlte::adminlte.retype_password') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    {{-- <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span> --}}
                </div>
            </div>

            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>



        {{-- Register button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            {{ __('adminlte::adminlte.register') }}
        </button>

    </form>
@stop

