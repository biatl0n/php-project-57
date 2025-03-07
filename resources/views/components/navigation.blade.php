      <nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-800 shadow-md">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
          <a href="{{ route("index") }}" class="flex items-center">
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{ __('translations.heading') }}</span>
          </a>
          <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1">
            <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
              <li><a href="{{ route('tasks.index')  }}" class="block py-2 pl-3 pr-4 text-gray-900 dark:text-slate-50 hover:text-blue-700 lg:p-0">{{ __('translations.tasks') }}</a></li>
              <li><a href="{{ route('task_statuses.index') }}" class="block py-2 pl-3 pr-4 text-gray-900 dark:text-slate-50 hover:text-blue-700 lg:p-0">{{ __('translations.statuses') }}</a></li>
              <li><a href="{{ route('labels.index') }}" class="block py-2 pl-3 pr-4 text-gray-900 dark:text-slate-50 hover:text-blue-700 lg:p-0">{{ __('translations.labels') }}</a></li>
            </ul>
          </div>
          <div class="flex items-center lg:order-2">
            @if(Route::has('login'))
            @auth
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <a href="{{route('logout')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2" onclick="event.preventDefault();this.closest('form').submit();">{{ __('translations.logout') }}</a>
            </form>
                @else
                <a href="{{route('login')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('translations.login') }}</a>
                @if(Route::has('register'))
                  <a href="{{route('register')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">{{ __('translations.register') }}</a>
                @endif
              @endauth
            @endif
          </div>
        </div>
      </nav>
