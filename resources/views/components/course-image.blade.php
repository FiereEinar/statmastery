<div>
    <img 
        class="h-[11.5rem] object-cover object-center" 
        src="{{ file_exists(public_path($source)) ? asset($source) : asset('images/courses/placeholder.png') }}" 
        alt="Course image" 
    />
</div>