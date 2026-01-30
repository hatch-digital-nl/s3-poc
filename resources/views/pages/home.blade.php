<?php

use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public $photo;

    public function save()
    {
        $this->validate([
            'photo' => 'max:1024', // 1MB Max
        ]);

        if ($this->photo) {
            $this->photo->store('photos');
        }
    }
}
?>

<div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-6 sm:p-8">
        <h1 class="text-xl font-semibold text-gray-900 mb-6">Upload een foto</h1>

        <form wire:submit.prevent="save" class="space-y-5">
            @if ($photo)
                <div class="space-y-2">
                    <p class="text-sm text-gray-600">Voorbeeld:</p>
                    <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="max-h-48 rounded-lg border border-gray-200">
                </div>
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bestand</label>
                <input type="file" wire:model="photo" class="block w-full text-sm file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer" />
                @error('photo')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="inline-flex items-center justify-center w-full rounded-lg bg-blue-600 px-4 py-2.5 text-white font-medium shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Opslaan
            </button>
        </form>
    </div>
</div>
