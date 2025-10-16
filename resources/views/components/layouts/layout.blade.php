<x-layouts.app :title="$title">
    <div class="h-[100vh] bg-[rgb(242,242,242)] bg-gradient-to-t from-[#f2f2f2] to-[#369acb]">
        <!-- Navbar -->
        <x-navbar :active="$active" />

        <!-- Main Content -->
        <main class="h-[89%]">
            {{ $slot }}
        </main>
    </div>
</x-layouts.app>
