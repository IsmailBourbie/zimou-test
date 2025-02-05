@component('layouts.base', ['title' => 'Register'])
    <div class="pt-28">
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">
                    Register a new account
                </h2>
            </div>
            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" action="{{route('register.store')}}" method="POST">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm/6 font-medium text-gray-900">Full Name</label>
                        <div class="mt-2">
                            <input type="text" name="name" id="name" value="{{old('name')}}" autocomplete="name" required
                                   class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                        @error('name')
                        <em class="text-xs font-bold tracking-wide text-red-600">{{$message}}</em>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                        <div class="mt-2">
                            <input type="email" name="email" id="email" value="{{old('email')}}" autocomplete="email" required
                                   class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                        @error('email')
                        <em class="text-xs font-bold tracking-wide text-red-600">{{$message}}</em>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                        <div class="mt-2">
                            <input type="password" name="password" id="password" autocomplete="password" required
                                   class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                        @error('password')
                        <em class="text-xs font-bold tracking-wide text-red-600">{{$message}}</em>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-900">Password Confirmation</label>
                        <div class="mt-2">
                            <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="password_confirmation" required
                                   class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                        @error('password_confirmation')
                        <em class="text-xs font-bold tracking-wide text-red-600">{{$message}}</em>
                        @enderror
                    </div>

                    <div>
                        <button type="submit"
                                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Sign up
                        </button>
                    </div>
                </form>

                <p class="mt-10 text-center text-sm/6 text-gray-500">
                    Already have an account?
                    <a href="{{route('login')}}" class="font-semibold text-blue-600 hover:text-blue-500">Login</a>
                </p>
            </div>
        </div>
    </div>
@endcomponent
