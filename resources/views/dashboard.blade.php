{{-- los componentes en blade.php se definen mediante la nomenclatura x-<nombre del componente> --}}
{{-- el codigo definido entre las etiquetas de apetura y cierre del componente, sera recibido por el $slot definido dentro del componente mismo --}}
<x-app-layout>
    <x-container>
        {{-- formulario para la creacion de posts --}}
        <form action="{{ route('posts.store') }}" class="mb-8" method="POST">
            {{-- la directiva csrf le indica a la aplicacion que el formulario no es externo --}}
            @csrf
            <textarea name="body" rows="10"
                class="w-full h-14 p-0 bg-transparent text-slate-100 resize-none overflow-hidden border-0 border-b-2 border-slate-400 focus:border-slate-600 focus:ring-0"
                placeholder="Your comment..."></textarea>
            <input type="submit" class="px-4 py-2 bg-yellow-400 text-gray-800 font-semibold text-sm rounded-sm"
                value="Submit">
        </form>

        @foreach ($posts as $post)
            <a href="{{ route('friendProfile.show', $post->user) }}">
                <div class="flex items-center gap-[5px] px-2 text-slate-400 text-sm">
                    <svg class="h-4" data-slot="icon" fill="currentColor" viewBox="0 0 16 16"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path
                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z">
                        </path>
                    </svg>
                    {{ $post->user->name }}
                </div>
            </a>
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
