<div
    class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <ul>
            @auth
                <li><a href="{{ url('/standings') }}" class="text-sm text-gray-700 dark:text-gray-500 no-underline">
                    <i class="bi bi-sort-numeric-down"></i>Standings</a></li>
                <li><a href="{{ url('/matches') }}" class="text-sm text-gray-700 dark:text-gray-500 no-underline">
                    <i class="bi bi-calendar3"></i>Schedule</a></li>
                <li><a href="{{ url('/teams') }}" class="text-sm text-gray-700 dark:text-gray-500 no-underline">
                    <i class="bi bi-list-ol"></i>Team's</a></li>
                <li><a href="{{ url('/matches/predicts') }}" class="text-sm text-gray-700 dark:text-gray-500 no-underline">
                    <i class="bi bi-search"></i>Predicts</a></li>
                <li><a href="{{ url('/userstanding') }}" class="text-sm text-gray-700 dark:text-gray-500 no-underline">
                    <i class="bi bi-person-lines-fill"></i>Users</a></li>
                <li><a href="{{ url('/logout') }}" class="text-sm text-gray-700 dark:text-gray-500 no-underline">
                    <i class="bi bi-box-arrow-left"></i>Logout</a></li>
            @else
                <li><a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 no-underline">
                    <i class="bi bi-box-arrow-in-right"></i>Login</a></li>
                @if (Route::has('register'))
                     <li><a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 no-underline">
                        <i class="bi bi-pencil-square"></i>Register</a></li>
                @endif
            @endauth
            </ul>
        </div>
@endif
