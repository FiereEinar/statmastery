<div>
    <img src="{{ file_exists(public_path($source)) ? asset($source) : asset($defaultImg) }}" class="{{ $className }}" alt="{{ $alt }}" />
</div>