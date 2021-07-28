@extends('auth.templates.template')

@section('content-form')

        <form method="POST" action="/password/email" class="login form">
            {!! csrf_field() !!}

            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="form-group">
                E-mail
                <input type="email" name="email" value="{{ old('email') }}" class="form-control">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-dark">
                    Recuperar senha
                </button>
            </div>
        </form>

@endsection