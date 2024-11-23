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

    .custom-button {
        background-color: white;
        color: black;
        border: 2px solid black;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s ease, color 0.3s ease; /* Smooth hover effect */
    }

    .custom-button:hover {
        background-color: black;
        color: white;
    }

    body {
        background-color: #696969; /* Optional: Match the background color in your image */
    }
</style>

</head>

<body>
  <div class="hero_area">
    <!-- header section starts -->
    @include('home.header')
    <!-- end header section -->

    <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="custom-input-label" />
            <x-text-input id="email" class="block mt-1 w-full custom-text-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="custom-input-label" />
            <x-text-input id="password" class="block mt-1 w-full custom-text-input"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-black">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-black hover:text-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="custom-button ms-3">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
    </x-guest-layout>

  </div>
</body>

</html>
