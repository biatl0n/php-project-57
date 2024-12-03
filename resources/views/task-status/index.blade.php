<x-app-layout>

    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
            <div class="grid col-span-full">
                <h1 class="mb-5 dark:text-white text-5xl">{{ __('translations.task-status.text1') }}</h1>
                @auth
                    <div>
                        <a href="{{ route('task_statuses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('translations.task-status.create.text') }}</a>
                    </div>
                @endauth
                <table class="mt-4">
                    <thead class="border-b-2 border-solid border-black text-left dark:text-white">
                        <tr>
                            <th>ID</th>
                            <th>{{ __('translations.task-status.table-column2') }}</th>
                            <th>{{ __('translations.task-status.table-column3') }}</th>
                            @auth
                                <th>{{ __('translations.task-status.table-column4') }}</th>
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($taskStatuses as $taskStatus)
                            <tr class="border-b border-dashed text-left dark:text-white">
                                <td>{{ $taskStatus->id }}</td>
                                <td>{{ $taskStatus->Name }}</td>
                                <td>{{ $taskStatus->created_at }}</td>
                                @auth()
                                    <td>
                                        <a class="text-red-600 hover:text-ted-900" href="{{ route('task_statuses.destroy', $taskStatus->id) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a>
                                        <a class="text-blue-600 hover:text-blue-900" href="{{ route('task_statuses.edit', $taskStatus->id) }}">Изменить</a></td>
                                @endauth
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</x-app-layout>