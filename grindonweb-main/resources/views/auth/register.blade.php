<!DOCTYPE html>
<html>

<head>
  @include('home.css')
  <style>
    .custom-text-input {
        background-color: white !important;
        color: black !important; /* Ensure text inside is visible on white background */
        border: 1px solid #696969; /* Change border color to #696969 */
        padding: 8px;
        border-radius: 4px;
    }

    .custom-input-label {
        color: black !important; /* Black color for the labels */
    }

    /* Register button styles */
    .register-button {
      background-color: white;
      color: black;
      border: 1px solid #696969;
      padding: 10px 20px;
      cursor: pointer;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    .register-button:hover {
      background-color: black;
      color: white;
    }

    /* "Already registered?" link styles */
    .already-registered-link {
      color: black;
      text-decoration: underline;
    }

    .already-registered-link:hover {
      color: black; /* No hover effect */
    }
  </style>
</head>

<body>
  <div class="hero_area">
    <!-- Header section -->
    @include('home.header')

    <!-- Form layout -->
    <x-guest-layout>
      <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
          <x-input-label for="name" :value="__('Name')" class="custom-input-label" />
          <x-text-input id="name" class="block mt-1 w-full custom-text-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
          <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
          <x-input-label for="email" :value="__('Email')" class="custom-input-label" />
          <x-text-input id="email" class="block mt-1 w-full custom-text-input" type="email" name="email" :value="old('email')" required autocomplete="username" />
          <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div>
          <x-input-label for="phone" :value="__('Phone')" class="custom-input-label" />
          <x-text-input id="phone" class="block mt-1 w-full custom-text-input" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="phone" />
          <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Address -->
        <div>
          <x-input-label for="address" :value="__('Address')" class="custom-input-label" />
          <x-text-input id="address" class="block mt-1 w-full custom-text-input" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
          <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
          <x-input-label for="password" :value="__('Password')" class="custom-input-label"/>
          <x-text-input id="password" class="block mt-1 w-full custom-text-input" type="password" name="password" required autocomplete="new-password" />
          <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
          <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="custom-input-label"/>
          <x-text-input id="password_confirmation" class="block mt-1 w-full custom-text-input" type="password" name="password_confirmation" required autocomplete="new-password" />
          <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit -->
        <div class="flex items-center justify-end mt-4">
          <a class="already-registered-link" href="{{ route('login') }}">
            {{ __('Already registered?') }}
          </a>

          <button type="submit" class="ms-4 register-button">
            {{ __('Register') }}
          </button>
        </div>
      </form>
    </x-guest-layout>
  </div>
</body>

</html>
