<x-app-layout>
    <x-container>
        <h2 class="text-slate-100 mb-2">Pending to confirm</h2>
        @foreach ($requests as $request)
            <x-card class="mb-4">
                <div class="flex justify-between items-center">
                    {{ $request->name }}
                    <x-submit-button>Confirm</x-submit-button>
                </div>
            </x-card>
        @endforeach
    </x-container>
</x-app-layout>
