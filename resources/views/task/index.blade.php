<x-app-layout>
    <x-section>
            <div class="grid col-span-full">
                <h1 class="mb-5 dark:text-white text-5xl">{{ __('translations.tasks') }}</h1>
                <x-div class="w-full flex items-center">
                    <x-div>
                        ---
                    </x-div>
                    @auth()
                    <x-div class="ml-auto">
                        <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">{{ __('task.create-task') }}</a>
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
                        </tr>
                    @endforeach
                    </tbody>
                    </thead>
                </table>
            </div>
            <div class="grid col-span-full mt-4">
                {{ $tasks->links() }}
            </div>
    </x-section>
</x-app-layout>