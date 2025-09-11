<x-app-layout>
    <x-container>
        @if (count($requests) > 0)
            <h2 class="text-slate-100 text-lg mb-2">Friend request sent</h2>
            @foreach ($requests as $user)
                <x-card class="mb-4">
                    <div class="flex justify-start items-center">
                        {{ $user->name }}
                    </div>
                </x-card>
            @endforeach
        @endif

        @if (count($sent) > 0)
            <h2 class="text-slate-100 text-lg mb-2">Friend requests received</h2>
            @foreach ($sent as $user)
                <x-card class="mb-4">
                    <div class="flex justify-between items-center">
                        {{ $user->name }}
                        <form action="{{ route('friends.update', $user) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <x-submit-button>Add friend</x-submit-button>
                        </form>
                    </div>
                </x-card>
            @endforeach
        @endif

        @if (count($friends) > 0)
            <h2 class="text-slate-100 text-lg mb-2">Friends</h2>
            @foreach ($friends as $user)
                <x-card class="mb-4">
                    <div class="flex justify-start items-center">
                        {{ $user->name }}
                    </div>
                </x-card>
            @endforeach
        @endif
    </x-container>
</x-app-layout>
