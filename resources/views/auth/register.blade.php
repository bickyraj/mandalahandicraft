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
                <a href="{{ route('home') }}">
                    @include('frontend.components.logo')
                </a>
            </div>
            <h1 class="mt-6 text-center text-2xl font-bold text-dark">
                Create an account
            </h1>
            <form action="{{route('register')}}" method="post" id="register_form" data-toggle="validator">
                @csrf
                <div class="mb-6">
                    <label for="name" class="text-sm">Name</label>
                    <input id="name" name="name" value="{{old('name')}}" type="text" autocomplete="name" required
                        class="block w-full p-4 border-light"
                        placeholder="Name">
                </div>
                <div class="mb-6">
                    <label for="email-address" class="text-sm">Email address</label>
                    <input id="email-address" name="email" value="{{old('email')}}" type="email" autocomplete="email" required
                        class="block w-full p-4 border-light"
                        placeholder="Email address">
                </div>
                <div class="mb-6">
                    <label for="password" class="text-sm">Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password"
                        data-minlength="5" required data-required-error="The password filed is required"
                        class="block w-full p-4 border-light"
                        placeholder="Password">
                </div>
                <div class="mb-6">
                    <label for="confirm-password" class="text-sm">Confirm Password</label>
                    <input id="confirm-password" name="password_confirmation" type="password" autocomplete="new-password"
                        data-match="#password" required data-match-error="The confirmed password doesn't match with password"
                        class="block w-full p-4 border-light"
                        placeholder="Confirm Password">
                </div>

                <div class="flex items-center mb-10">
                    <input id="agree" id="checkbox1" name="agree" type="checkbox"
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
                    Register
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @push('script')
    <script type="text/javascript">
        $(function(){
            $('#checkbox1').on('click',function(){
                 if($(this).is(':checked')) {
                    console.log('checked');
                    $('#signup').prop('disabled',false);
                    $('#signup').removeClass('disable-button');

                } else {
                    console.log('not checked');
                    $('#signup').prop('disabled',true);
                    $('#signup').addClass('disable-button');

                }
            });
        });
    </script>
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
    @endpush
</body>

</html>
