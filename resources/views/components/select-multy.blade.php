@props(['items', 'selected'])

<select {{ $attributes->merge(['class' => 'rounded dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 border-gray-300 w-1/3']) }}>
    @foreach($items as $key => $item)
        <option @if(in_array($key, $selected)) selected @endif value="{{ $key }}">{{ $item }}</option>
    @endforeach
</select>