<x-app-layout>
    <x-container>
        {{-- se valida a traves del metodo isRelated que el usuario autenticado no haya realizado una solicitud de amistad al usuario visualizado o viceversa --}}
        @if (!auth()->user()->isRelated($user))
            <form action="{{ route('friends.store', $user) }}" class="mb-8" method="POST">
                @csrf
                <x-submit-button>Add friend</x-submit-button>
            </form>
        @endif

        <div class="flex items-center gap-[5px] px-2 text-slate-400 text-sm mb-2">
            <svg class="h-4" data-slot="icon" fill="currentColor" viewBox="0 0 16 16"
                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path
                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z">
                </path>
            </svg>
            {{ $user->name }}
        </div>

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
