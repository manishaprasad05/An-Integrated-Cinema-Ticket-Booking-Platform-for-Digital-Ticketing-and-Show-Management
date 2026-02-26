<nav class="bg-black text-white shadow">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo / Brand -->
            <div class="flex items-center gap-2">
                <span class="text-xl">🎬</span>
                <a href="{{ route('home') }}" class="text-lg font-bold">
                    Multiplex Booking
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-6">

                <a href="{{ route('home') }}"
                   class="hover:text-yellow-400 transition">
                    Home
                </a>

                @auth
                    <a href="{{ route('profile.edit') }}"
                       class="hover:text-yellow-400 transition">
                        Hi, {{ Auth::user()->name }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            class="bg-yellow-500 text-black px-4 py-1 rounded hover:bg-yellow-400 transition">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="hover:text-yellow-400 transition">
                        Login
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div x-data="{ open: false }" class="md:hidden">
                <button @click="open = !open" class="focus:outline-none">
                    ☰
                </button>

                <!-- Mobile Menu -->
                <div x-show="open"
                     class="absolute right-4 mt-3 w-48 bg-black border border-gray-700 rounded shadow-lg p-3 space-y-3">

                    <a href="{{ route('home') }}" class="block hover:text-yellow-400">
                        Home
                    </a>

                    @auth
                        <a href="{{ route('profile.edit') }}" class="block hover:text-yellow-400">
                            Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left hover:text-yellow-400">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block hover:text-yellow-400">
                            Login
                        </a>
                    @endauth
                </div>
            </div>

        </div>
    </div>
</nav>
