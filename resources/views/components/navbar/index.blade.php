@props(['user'])
<nav x-data="{ isScrolled: false, open: false }"
     @scroll.window="isScrolled = window.scrollY > 50"
     :class="{'bg-white shadow': isScrolled, 'bg-transparent': !isScrolled }"
     class="fixed w-full z-20 top-0 start-0 transition-all duration-300">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4 mb">
        <a href="#" class="text-xl font-bold">
            {{config('app.name')}}
        </a>
        <div class="flex items-center md:order-2 md:space-x-0">
            @if($user)
                <h3 class="px-2 font-bold">{{$user->name}}</h3>
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button type="submit"
                            class="px-4 py-1.5 bg-slate-700 text-slate-50 rounded-lg hover:bg-slate-900 cursor-pointer">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{route('login')}}" type="button"
                   class="text-slate-600 hover:text-slate-950 hover:underline font-bold rounded-lg text-sm mr-2 px-4 py-2 text-center">
                    Login
                </a>
                <a href="{{route('register')}}" type="button"
                   class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm mr-2 px-4 py-2 text-center">
                    Register
                </a>
            @endif
            <button x-on:click="open = !open" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    :class="{'bg-white': open}"
                    aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>

                >>
            </button>
        </div>
        <div class="items-center justify-between w-full md:flex md:w-auto md:order-1"
             :class="open ? 'flex' : 'hidden'"
             x-cloak
        >
            <ul class="flex flex-col w-full p-4 md:p-0 mt-4 font-medium border border-slate-200 bg-slate-100 md:bg-transparent rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                <li>
                    <x-navbar.link label="Home" route="welcome"/>
                </li>
                @auth
                    <li>
                        <x-navbar.link label="Packages" route="packages.index"/>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
