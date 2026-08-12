<x-layout title="Registration">
    <div class="auth-wrap">
        <div class="auth-card">
            <div class="titlebar">
                <span class="dot red"></span>
                <span class="dot yellow"></span>
                <span class="dot green"></span>
                <span class="path">register.sh</span>
            </div>
            <div class="auth-body">
                <h2>Hisob yarating</h2>
                <p class="sub">
                    Bir necha soniyada ro'yxatdan o'ting.
                </p>
                <form action="{{ route('register.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">ism</label>

                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            placeholder="Ismingiz">

                        @error('name')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
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
                    <div class="form-group">
                        <label for="password_confirmation">
                            parolni tasdiqlang
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="••••••••">
                        @error('password_confirmation')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn">
                        Ro'yxatdan o'tish
                    </button>
                </form>
                <p class="auth-foot">
                    Hisobingiz bormi?
                    <a href="{{ route('login') }}">
                        Kirish
                    </a>
                </p>

            </div>
        </div>
    </div>
</x-layout>
