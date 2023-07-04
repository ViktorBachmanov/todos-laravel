<x-layout>

  <!-- Validation Errors -->
  @error('password')
      <div>{{ $message }}</div>
  @enderror

  <form method="POST" action="{{ route('login') }}">
      @csrf

      <!-- Email Address -->
      <div>
          <label for="email">Email</label>

          <input id="email" type="email" name="email" value="{{ old('email') }}" required />
      </div>

      <!-- Password -->
      <div>
          <label for="password">Пароль</label>

          <input id="password" 
                          type="password"
                          name="password"
                          required autocomplete="current-password" />
      </div>

      
      <div>
          <button>
              Войти
          </button>
      </div>
  </form>
   
</x-layout>