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
    
<x-guest-layout>
    <div class="mb-4 text-sm text-black-600 dark:text-black-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="custom-input-label"/>
            <x-text-input id="email" class="block mt-1 w-full custom-text-input" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="custom-button ms-3">
                {{ __('Email Password Reset Link') }}
            </button>
        </div>
    </form>
</x-guest-layout>

</body>
</html>