
<form class="navbar-form navbar-right" role="form" method="POST" action="{{ route('login') }}">
    {!! csrf_field() !!}
    <div class="form-group">
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <div>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                       placeholder="Usuário" required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <div>
                <input id="password" type="password" class="form-control" name="password" placeholder="Senha"
                       required>

                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Entrar</button>
        </div>


    </div>

</form>

