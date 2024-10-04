<form wire:submit="save" class="text-sm">
    <input type="file" wire:model="courseFile">
    @error('photo') <span class="error">{{ $message }}</span> @enderror
    <button type="submit" class="hover:underline">Upload Course</button>
</form>
