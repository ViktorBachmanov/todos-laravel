<x-layout>

  <div class="container auth-form">
    <!-- Validation Errors -->
    @error('password')
        <div style="color: magenta">{{ $message }}</div>
    @enderror

    <form method="POST" action="{{ route('register') }}"  class="my-3">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus />
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input id="password" 
                    class="form-control"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Подтвердите пароль</label>
            <input id="password_confirmation" 
                    class="form-control"
                            type="password"
                            name="password_confirmation" required />
        </div>

        
        <button class="btn btn-primary">
            Зарегистрироваться
        </button>
    </form>

  </div>
   
</x-layout>