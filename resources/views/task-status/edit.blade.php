<x-app-layout>

    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
            <div class="grid col-span-full">
                <h1 class="mb-5 dark:text-white text-5xl">{{ __('translations.task-status.edit.text') }}</h1>
                <x-error />
                {{ html()->modelForm($taskStatus->name, 'PATCH', route('task_statuses.update', $taskStatus['id']))->class('w-50')->open() }}
                    {{ html()->div()->class('flex flex-col')->open() }}
                        {{ html()->div()->open() }}
                            {{ html()->label(__('translations.task-status.table-column2'))->for('name')->class('dark:text-white') }}
                        {{ html()->div()->close() }}
                        {{ html()->div()->class('mt-2')->open() }}
                            {{ html()->input()->class('rounded border-gray-300 w-1/3')->name('name')->id('name')->type('text')->value($taskStatus['Name']) }}
                        {{ html()->div()->close() }}
                        {{ html()->div()->class('mt-2')->open() }}
                            {{ html()->button(__('translations.task-status.edit.button'))->type('submit')->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded') }}
                        {{ html()->div()->close() }}
                    {{ html()->div()->close() }}
                {{ html()->closeModelForm() }}
            </div>
        </div>
    </section>

</x-app-layout>