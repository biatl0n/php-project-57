<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-blue-500 dark:bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-gray-900 dark:text-white tracking-widest hover:bg-blue-700 dark:hover:bg-glue-700 focus:bg-gray-700 dark:bg-glue-700 active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
