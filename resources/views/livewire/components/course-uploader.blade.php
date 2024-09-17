<form wire:submit="save">
    <input type="file" wire:model="courseFile">

    @error('photo') <span class="error">{{ $message }}</span> @enderror

    <button type="submit">Save photo</button>
</form>
