@component('layouts.base', ['title' => 'Forgot password'])
    <div class="pt-28">
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Forgot password</h2>
                @if(session('status'))
                    <div class="bg-green-100 border border-green-300 text-green-700 font-medium tracking-wide px-4 py-2 text-center mt-5">
                        {{session('status')}}
                    </div>
                @endif
            </div>
            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" action="{{route('password.email')}}" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                        <div class="mt-2">
                            <input type="email" name="email" id="email" autocomplete="email" required
                                   class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                        @error('email')
                        <em class="text-xs font-bold tracking-wide text-red-600">{{$message}}</em>
                        @enderror
                    </div>

                    <div>
                        <button type="submit"
                                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Request Reset link
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endcomponent
