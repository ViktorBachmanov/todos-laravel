<x-layout>

  <div class="container">

    <!-- Validation Errors -->
    @error('password')
        <div>{{ $message }}</div>
    @enderror

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input id="password" 
                  type="password"
                  name="password"
                  class="form-control"
                  required autocomplete="current-password" />
        </div>

        
        <button type="submit" class="btn btn-primary">
            Войти
        </button>
    </form>

  </div>
   
</x-layout>