<x-app-layout>
    <x-section>
            <div class="grid col-span-full">
                <h1 class="mb-5 dark:text-white text-5xl">{{ __('translations.tasks') }}</h1>
                @include('flash::message')
                <x-div class="w-full flex items-center">
                    <div>
                        {{ html()->modelForm($tasks, 'GET', route('tasks.index'))->open() }}
                        <div class="flex">
                            <x-select class="w-full" name="filter[status_id]" id="filter[status_id]" :items="$taskStatuses" :value="request('filter.status_id')" :selectedOption="$name='Статус'"/>
                            <x-select class="w-full" name="filter[created_by_id]" id="filter[created_by_id]" :items="$users" :value="request('filter.created_by_id')" :selectedOption="$name='Автор'"/>
                            <x-select class="w-full" name="filter[assigned_to_id]" id="filter[assigned_to_id]" :items="$taskExecutors" :value="request('filter.assigned_to_id')" :selectedOption="$name='Исполнитель'"/>
                            <x-primary-button class="ml-2 font-bold">
                                {{ __('translations.prepare') }}
                            </x-primary-button>
                        </div>
                        {{ html()->closeModelForm() }}
                    </div>
                    @auth()
                    <x-div class="ml-auto">
                        <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">{{ __('tasks.create-task') }}</a>
                    </x-div>
                    @endauth
                </x-div>
                <table class="mt-4">
                    <thead class="border-b-2 border-solid border-black dark:border-white text-left dark:text-white">
                        <tr>
                            <th>ID</th>
                            <th>Статус</th>
                            <th>Имя</th>
                            <th>Автор</th>
                            <th>Исполнитель</th>
                            <th>Дата создания</th>
                            @auth()<th>Действия</th>@endauth
                        </tr>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr class="border-b border-dashed text-left dark:text-white">
                            <td> {{ $task->id }} </td>
                            <td> {{ $task->taskStatuses->name }} </td>
                            <td> <a class="text-blue-600 hover:text-blue-900" href="{{ route("tasks.show", $task->id) }}">{{ $task->name }}</a> </td>
                            <td> {{ $task->createdBy->name }} </td>
                            <td> {{ $task->assignedTo->name ?? '' }} </td>
                            <td> {{ $task->created_at }} </td>
                            @auth()
                                <td>
                                    @can('delete', $task)
                                        <a class="text-red-600 hover:text-ted-900" href="{{ route('tasks.destroy', $task->id) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a>
                                    @endcan
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-600 hover:text-blue-900">{{ __('translations.change') }}</a>
                                </td>
                            @endauth
                        </tr>
                    @endforeach
                    </tbody>
                    </thead>
                </table>
                <div class="mt-4">
                    {{ $tasks->links() }}
                </div>
            </div>
    </x-section>
</x-app-layout>