<x-app-layout>
    <x-section>
            <div class="grid col-span-full">
                <h2 class="mb-5 dark:text-white text-[2rem]">Просмотр задачи: {{ $task->name }}
                    <a href="{{ route('tasks.edit', $task->id) }}">⚙</a>
                </h2>
                <p class="dark:text-white">
                    <span class="font-black font-bold dark:text-white">Имя: </span>
                    {{ $task->name }}
                </p>
                <p class="dark:text-white">
                    <span class="font-black font-bold dark:text-white">Статус: </span>
                    {{ $task->taskStatuses->name }}
                </p>
                <p class="dark:text-white">
                    <span class="font-black font-bold dark:text-white">Описание: </span>
                    {{ $task->description }}
                </p>
                <x-div class="flex items-center">
                    <p class="dark:text-white mr-2">
                        <span class="font-black font-bold dark:text-white">Метки:</span>
                    </p>
                    @foreach($task->labels as $label)
                        <x-div class="text-xs inline-flex max-w-max items-center font-bold leading-sm uppercase px-3 py-1 bg-blue-200 text-blue-700 rounded-full mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            {{$label->name}}
                        </x-div>
                    @endforeach
                </x-div>
            </div>
    </x-section>
</x-app-layout>