@props(['value'])

<textarea {{ $attributes->merge(['class' => 'rounded dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 border-gray-300 w-1/3 h-32']) }}>{{ $value ?? $slot }}</textarea>