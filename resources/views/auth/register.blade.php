<x-layout>

  <!-- Validation Errors -->
  @error('password')
      <div>{{ $message }}</div>
  @enderror

  <form method="POST" action="{{ route('register') }}">
      @csrf

      <!-- Name -->
      <div>
          <label for="name">Имя</label>

          <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus />
      </div>

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
                          required autocomplete="new-password" />
      </div>

      <!-- Confirm Password -->
      <div>
          <label for="password_confirmation">Подтвердите пароль</label>

          <input id="password_confirmation" 
                          type="password"
                          name="password_confirmation" required />
      </div>

      <div>
          <a href="{{ route('login') }}">
              Уже зарегистрированы?
          </a>

          <button>
              Зарегистрироваться
          </button>
      </div>
  </form>
   
</x-layout>