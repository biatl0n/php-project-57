@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        @if ($message['level'] == 'success')
            <div class="p-1 mb-4 text-lg text-white rounded-lg bg-green-300 dark:bg-green-800 dark:text-gray-300 w-fit" role="alert">
                {{ $message['message'] }}
            </div>
        @endif
        @if ($message['level'] == 'danger')
            <div class="p-1 mb-4 text-lg text-white rounded-lg bg-red-600 dark:bg-red-800 dark:text-gray-300 w-fit" role="alert">
                {{ $message['message'] }}
            </div>
        @endif
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
