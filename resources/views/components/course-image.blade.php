<div>
    <img 
        class="h-[11.5rem] object-cover object-center" 
        src="{{ file_exists(public_path("./storage/".$source)) ? asset("storage/".$source) : asset('storage/thumbnails/placeholder.png') }}" 
        alt="Course image" 
    />
</div>