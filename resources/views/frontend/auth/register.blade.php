<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="flex items-center justify-center bg-light" style="min-height:100vh">
        <div class="bg-white py-10 px-4 lg:px-8" style="min-width:360px">
            <div class="flex justify-center">
                <a href="{{ route('home') }}">
                    <x-logo />
                </a>
            </div>
            <h1 class="mt-6 text-center text-2xl font-bold text-dark">
                Create an account
            </h1>
            <form class="mt-8" action="#" method="POST">
                <div class="mb-6">
                    <label for="name" class="text-sm">Name</label>
                    <input id="name" name="name" type="text" autocomplete="name" required
                        class="block w-full p-4 border-light"
                        placeholder="Name">
                </div>
                <div class="mb-6">
                    <label for="email-address" class="text-sm">Email address</label>
                    <input id="email-address" name="email" type="email" autocomplete="email" required
                        class="block w-full p-4 border-light"
                        placeholder="Email address">
                </div>
                <div class="mb-6">
                    <label for="password" class="text-sm">Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required
                        class="block w-full p-4 border-light"
                        placeholder="Password">
                </div>
                <div class="mb-6">
                    <label for="confirm-password" class="text-sm">Confirm Password</label>
                    <input id="confirm-password" name="cpassword" type="password" autocomplete="new-password" required
                        class="block w-full p-4 border-light"
                        placeholder="Confirm Password">
                </div>

                <div class="flex items-center mb-10">
                    <input id="agree" name="agree" type="checkbox"
                        class="h-4 w-4 border-light rounded">
                    <label for="agree" class="ml-2 block text-sm text-dark">
                        I have read and agree to the
                        <a href="#">Terms & Conditions.</a>
                    </label>
                </div>

                <button type="submit"
                    class="btn btn-secondary mb-10">
                    <svg class="mr-2 h-4 w-4"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                            clip-rule="evenodd" />
                    </svg>
                    Sign in
                </button>
                <div class="text-sm text-light">
                    Have an account already?
                    <a href="{{ route('login') }}" class="text-secondary">
                        Go to login.
                    </a>
                </div>

                <div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
