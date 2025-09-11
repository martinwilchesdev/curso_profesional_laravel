<x-app-layout>
    <x-container>
        {{-- formulario para realizar una solicitud de amistad --}}
        <form action="{{ route('friends.store', $user) }}" class="mb-8" method="POST">
            @csrf
            <x-submit-button>Add friend</x-submit-button>
        </form>

        @foreach ($posts as $post)
            <x-card class="mb-4">
                {{ $post->body }}
                <div class="text-xs text-slate-400 mt-2">
                    {{-- diffForHumans() muestra en un formato legible el tiempo desde que se ha creado el registro --}}
                    {{ $post->created_at->diffForHumans() }}
                </div>
            </x-card>
        @endforeach
    </x-container>
</x-app-layout>
