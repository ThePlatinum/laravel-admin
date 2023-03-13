<x-guest-layout>

  <div class="bg-grey-200 h-screen overflow-hidden flex flex-col">
    <nav class="bg-white shadow-lg">
      <div class="container-fluid mx-auto px-4 py-2 flex justify-between items-center">
        <div></div>

        <!-- Settings Dropdown -->
        <div class="flex items-center">
          <x-dropdown align="right" width="48">
            <x-slot name="trigger">
              <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white focus:outline-none transition ease-in-out duration-150">
                <div>{{ Auth::user()->name }}</div>

                <div class="ml-1">
                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                  </svg>
                </div>
              </button>
            </x-slot>

            <x-slot name="content">
              <x-dropdown-link :href="route('profile.edit')">
                {{ __('Profile') }}
              </x-dropdown-link>

              <!-- Authentication -->
              <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <x-dropdown-link :href="route('admin.logout')" onclick="event.preventDefault();
                this.closest('form').submit();">
                  {{ __('Log Out') }}
                </x-dropdown-link>
              </form>
            </x-slot>
          </x-dropdown>
        </div>
      </div>
    </nav>

    <div class="container-fluid mx-auto w-full p-2 flex-1 flex flex-col md:flex-row h-full">
      <div class="bg-white shadow-lg mb-4 md:mb-0 md:w-1/5">
        <ul class="list-reset">
          <li class="border-l-4 border-gray-400 py-2 px-4">
            <a href="{{ route('admin.dashboard') }}" class="text-gray-800 hover:text-gray-600">
              Dashboard
            </a>
          </li>
          <li class="border-l-4 border-white py-2 px-4">
            <a href="#" class="text-gray-800 hover:text-gray-600">
              Settings
            </a>
          </li>
          <li class="border-l-4 border-white py-2 px-4">
            <a href="#" class="text-gray-800 hover:text-gray-600">
              Profile
            </a>
          </li>
          <li class="border-l-4 border-white py-2 px-4">
            <a href="#" class="text-gray-800 hover:text-gray-600">
              Users
            </a>
          </li>
        </ul>
      </div>

      <main class="bg-white shadow-lg px-4 py-6 md:w-4/5">
        @yield('content')
      </main>
    </div>
  </div>

</x-guest-layout>