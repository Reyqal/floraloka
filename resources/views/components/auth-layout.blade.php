@props(['title', 'section_title', 'section_description'])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css" />
    <title>{{ $title }}</title>
</head>
<body class="bg-zinc-100 flex items-center justify-center min-h-screen">
    <div class="space-y-6 p-6 max-w-[30rem] w-full">
        <div class="flex flex-col w-full gap-4 border border-zinc-300 bg-white p-6 shadow">
            <div class="space-y-2 text-center">
                <h1 class="font-semibold text-2xl">{{ $section_title }}</h1>
                <p class="text-zinc-600 text-sm">{{ $section_description }}</p>
            </div>
            <div class="h-[1px] bg-zinc-300"></div>
            
            {{ $slot }}
        </div>
    </div>
</body>
</html>