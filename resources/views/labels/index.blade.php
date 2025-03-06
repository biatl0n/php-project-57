<x-app-layout>
    <x-section>
        <div class="grid col-span-full">
            <h1 class="mb-5 dark:text-white text-5xl">{{ __('translations.labels') }}</h1>
            @include('flash::message')
            @auth
                <div>
                    <a href="{{ route('labels.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('labels.create-label') }}</a>
                </div>
            @endauth
            <table class="mt-4">
                <thead class="border-b-2 border-solid border-black text-left dark:border-white dark:text-white">
                <tr>
                    <th>ID</th>
                    <th>{{ __('translations.name') }}</th>
                    <th>{{ __('translations.description') }}</th>
                    <th>{{ __('translations.creation-date') }}</th>
                    @auth
                        <th>{{ __('translations.actions') }}</th>
                    @endauth
                </tr>
                </thead>
                <tbody>
                @foreach($labels as $label)
                    <tr class="border-b text-left dark:text-white">
                        <td>{{ $label->id }}</td>
                        <td>{{ $label->name }}</td>
                        <td>{{ $label->description }}</td>
                        <td>{{ $label->created_at->format('d.m.Y') }}</td>
                        @auth()
                            <td>
                                <a class="text-red-600 hover:text-ted-900" href="{{ route('labels.destroy', $label->id) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a>
                                <a class="text-blue-600 hover:text-blue-900" href="{{ route('labels.edit', $label->id) }}">Изменить</a>
                            </td>
                        @endauth
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $labels->links() }}
            </div>
        </div>
    </x-section>
</x-app-layout>