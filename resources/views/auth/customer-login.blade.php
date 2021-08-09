<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="stylesheet" href="{{ asset('frontend/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="flex items-center justify-center bg-light" style="min-height:100vh">
        <div class="bg-white py-10 px-4 lg:px-8" style="min-width:360px">
            <div class="flex justify-center">
                <a href="/">
                    @include('frontend.components.logo')
                </a>
            </div>
            <h1 class="mt-6 text-center text-2xl font-bold text-dark">
                Sign in to your account
            </h1>
            <form action="{{route('login')}}" method="post" data-toggle="validator">
                @csrf
                <div class="mb-6">
                    <label for="email-address" class="text-sm">Email address</label>
                    <input id="email-address" name="email" value="{{old('email')}}" type="email" autocomplete="email" required
                        class="block w-full p-4 border-light"
                        placeholder="Email address">
                </div>
                <div class="mb-6">
                    <label for="password" class="text-sm">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="block w-full p-4 border-light"
                        placeholder="Password">
                </div>

                <div class="flex items-center mb-10">
                    <input id="remember_me" name="remember_me" type="checkbox"
                        class="h-4 w-4 border-light rounded">
                    <label for="remember_me" class="ml-2 block text-sm text-dark">
                        Remember me
                    </label>
                </div>
                <button type="submit"
                    class="btn btn-secondary mb-6">
                    <svg class="mr-2 h-4 w-4"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                            clip-rule="evenodd" />
                    </svg>
                    Sign in
                </button>
                <div class="mb-2 text-sm text-light">
                    <a href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                </div>
                <div class="text-sm text-light">
                    New User?
                    <a href="{{ route('register') }}" class="text-secondary">
                        Create an account.
                    </a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function() {
            let success_message = "{!! session()->get('success_message') !!}";
            let error_message = "{!! session()->get('error_message') !!}";
            if (success_message) {
                toastr.success(success_message);
            }

            if (error_message) {
                toastr.error(error_message);
            }
        });
    </script>
</body>

</html>
