@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-gray-700 dark:text-white']) }}>
    {{ $value ?? $slot }}
</label>
