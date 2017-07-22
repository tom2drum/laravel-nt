<div class="row">
    <div class="col l10 offset-l1">
        <div class="contact">
            <h2>Login</h2>
            <p class="contact__text">Ut ullamcorper, risus a rhoncus fringilla, dui nisl viverra nunc, quis consectetur massa purus a nulla.</p>
            <form action="{{ route('client.auth.login') }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col l8">
                        <div class="input-field col l12">
                            <input type="text" name="login" id="login" value="{{ old('login') }}" placeholder="Type in your login" required>
                            <label for="login">Login</label>
                        </div>
                        <div class="input-field col l12">
                            <input type="password" name="password" id="password" value="" placeholder="Type in your login" required>
                            <label for="password">Password</label>
                        </div>
                        <p>
                            <input type="checkbox" name="remember" class="filled-in" id="remember">
                            <label for="remember">Remember me</label>
                        </p>

                        <input type="submit" value="Login" class="btn">
                        @if (session('authError'))
                            <p>{{ session('authError') }}</p>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

