<x-layout title="Login">
    <div class="auth-wrap">
        <div class="auth-card">

            <div class="titlebar">
                <span class="dot red"></span>
                <span class="dot yellow"></span>
                <span class="dot green"></span>
                <span class="path">login.sh</span>
            </div>

            <div class="auth-body">

                <h2>Xush kelibsiz</h2>
                <p class="sub">
                    Hisobingizga kirish uchun ma'lumotlarni kiriting.
                </p>

                <form action="{{ route('authenticate') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">email</label>

                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="siz@example.com">

                        @error('email')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">parol</label>

                        <input type="password" id="password" name="password" placeholder="••••••••">

                        @error('password')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label class="checkbox-row">
                            <input type="checkbox" name="remember">
                            Meni eslab qol
                        </label>

                        <a href="#">Parolni unutdingizmi?</a>
                    </div>

                    <button type="submit" class="btn">
                        Kirish
                    </button>
                </form>

                <p class="auth-foot">
                    Hisobingiz yo'qmi?
                    <a href="{{ route('register') }}">
                        Ro'yxatdan o'tish
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-layout>
