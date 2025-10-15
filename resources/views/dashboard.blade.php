<x-layouts.app :title="$title">
    <div
        class="flex justify-center items-center min-h-screen bg-[rgb(242,242,242)] bg-gradient-to-t from-[#f2f2f2] to-[#369acb]">
        <div class="bg-white shadow-lg rounded-xl p-12 mx-6 max-w-md w-full bg-opacity-[75%]">
            <h1 class="text-center text-gray-800 font-semibold text-xl mb-5">DASHBOARD</h1>
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <button type="submit"
                    class="mt-5 w-full bg-red-500 text-sm text-white p-2 rounded-lg font-medium hover:bg-red-600">
                    LOGOUT
                </button>
            </form>
        </div>
    </div>
</x-layouts.app>
