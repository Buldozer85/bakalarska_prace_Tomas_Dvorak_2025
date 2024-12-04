<div {{ $attributes->merge(['class' => 'flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse']) }}>
    <button type="button" class="flex text-sm bg-brand-black focus:ring-4 focus:ring-gray-300 w-[250px] items-center rounded-md p-2 gap-x-4 justify-between" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
        <span class="sr-only">Open user menu</span>
        <div class="w-8 h-8 rounded-full text-brand-black flex items-center justify-center bg-white" > {{ user()->initials }}</div>
        <div class="text-white">{{ user()->full_name }}</div>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-white">
            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
        </svg>


    </button>
    <!-- Dropdown menu -->
    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600 w-[250px]" id="user-dropdown">
        <div class="px-4 py-3">
            <span class="block text-sm text-gray-900 dark:text-white">{{ user()->role->label() }}</span>
            <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{ user()->email }}</span>
        </div>
        <ul class="py-2" aria-labelledby="user-menu-button">
            <li>
                <a href="{{ route('administration.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('administration.user.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Úprava údajů</a>
            </li>
            <li>
                <a href="{{ route('administration.logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Odhlásit se</a>
            </li>
        </ul>
    </div>
</div>
