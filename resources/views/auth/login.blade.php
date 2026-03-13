<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6 text-center ">
        <h2 class="text-2xl font-bold text-gray-800">
            LOGIN
        </h2>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="flex items-center border border-gray-300 rounded-md mt-1">

                <x-text-input id="password" class="block w-full border-0 focus:ring-0" type="password" name="password"
                    required autocomplete="current-password" />

                <!-- Icon -->
                <span onclick="togglePassword()" class="px-3 cursor-pointer text-gray-500">
                    <i id="toggleIcon" class="bi bi-eye-slash-fill"></i>
                </span>

            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">
                    {{ __('Remember me') }}
                </span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">

            <div class="mt-6">
                <x-primary-button class="block mx-auto">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>

        </div>
    </form>
</x-guest-layout>

<script>
    function togglePassword() {

        const password = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');

        if (password.type === "password") {
            password.type = "text";
            icon.classList.replace("bi-eye-slash-fill", "bi-eye-fill");
        } else {
            password.type = "password";
            icon.classList.replace("bi-eye-fill", "bi-eye-slash-fill");
        }

    }
</script>
