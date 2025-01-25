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
                <p class="dark:text-white">
                    <span class="font-black font-bold dark:text-white">Метки: </span>
                </p>
            </div>
    </x-section>
</x-app-layout>