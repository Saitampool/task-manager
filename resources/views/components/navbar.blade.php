<nav class="border-b border-gray-300 sticky top-0 z-50 h-[11%]">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <div class="md:w-[20%] font-semibold text-xl text-white">
            Task Manager
        </div>

        <!-- Hamburger Button -->
        <button id="menu-toggle" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:text-gray-300 focus:outline-none focus:ring-2"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>

        <div class="hidden w-full md:block md:w-auto w-[40%]">
            <ul class="flex font-medium w-full">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="block py-2 px-3 {{ $active === 'dashboard' ? 'text-zinc-800' : 'text-slate-200' }}">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('tasks.index') }}"
                        class="block py-2 px-3 {{ $active === 'tasks' ? 'text-zinc-800' : 'text-slate-200' }}">
                        Task
                    </a>
                </li>
            </ul>
        </div>
        <div class="md:flex md:items-center w-[40%] md:justify-end hidden w-full md:block">
            <div class="text-slate-200 text-sm font-medium">
                {{ auth()->user()->name }}
            </div>

            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf

                <button type="submit"
                    class="bg-gray-300 border border-gray-100 text-sm text-white p-[7px] rounded-full font-medium ml-3 hover:bg-gray-200 hover:text-gray-700">
                    <svg class="w-5 h-5 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div id="mobile-menu"
        class="hidden bg-[#2e87b2] md:hidden absolute w-full left-0 border-t border-gray-300 shadow-lg transform origin-top transition-all duration-300 ease-in-out opacity-0 scale-y-0">
        <ul class="flex flex-col font-medium p-4 space-y-3 text-white">
            <div class="space-y-1">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="block py-2 px-3 rounded  {{ $active === 'dashboard' ? 'bg-white text-zinc-800' : 'hover:bg-[#308cbf]' }}">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('tasks.index') }}"
                        class="block py-2 px-3 rounded {{ $active === 'tasks' ? 'bg-white text-zinc-800' : 'hover:bg-[#308cbf]' }}">
                        Task
                    </a>
                </li>
            </div>
            <li class="border-t border-slate-300 py-3">
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" id="logout-form-mobile">
                        @csrf
                        <button type="submit"
                            class="flex items-center text-sm bg-gray-300 border border-gray-100 text-gray-700 py-1 px-2 rounded-full font-medium hover:bg-gray-200">
                            <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>

<script>
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    function openMenu() {
        mobileMenu.classList.remove('hidden');
        setTimeout(() => {
            mobileMenu.classList.remove('opacity-0', 'scale-y-0');
            mobileMenu.classList.add('opacity-100', 'scale-y-100');
        }, 10);
    }

    function closeMenu() {
        mobileMenu.classList.remove('opacity-100', 'scale-y-100');
        mobileMenu.classList.add('opacity-0', 'scale-y-0');
        setTimeout(() => {
            mobileMenu.classList.add('hidden');
        }, 250);
    }

    let isOpen = false;

    menuToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        isOpen ? closeMenu() : openMenu();
        isOpen = !isOpen;
    });

    document.addEventListener('click', (e) => {
        const isClickInside = mobileMenu.contains(e.target) || menuToggle.contains(e.target);
        if (!isClickInside && isOpen) {
            closeMenu();
            isOpen = false;
        }
    });
</script>
