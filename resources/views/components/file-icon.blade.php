@php
    $icons = [
        'csv' => 'csv-file.png',
        'pdf' => 'pdf.png',
        'jpg' => 'image.png',
        'jpeg' => 'image.png',
        'png' => 'image.png',
        'gif' => 'image.png',
        'ppt' => 'ppt.png',
        'pptx' => 'ppt.png',
        'txt' => 'txt-file.png',
        'doc' => 'word.png',
        'docx' => 'word.png',
        'xls' => 'xls.png',
        'xlsx' => 'xls.png',
    ];

    $ext = strtolower($fileExt ?? '');
    $icon = $icons[$ext] ?? 'doc.png';
@endphp

<img class="{{ $className }}" src="{{ asset('file_icons/' . $icon) }}" alt="{{ $fileExt }} icon" class="w-6 h-6 inline-block" />
