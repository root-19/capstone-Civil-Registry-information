<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-custom {
            background-color: #f8f9fa;
        }
    </style>
    <script>
        // Redirect to home page after 5 seconds
        setTimeout(function() {
            window.location.href = '../sindex.php'; 
        }, 5000);
    </script>
</head>
<body class="bg-custom flex flex-col h-screen">
    <main class="flex-grow flex items-center justify-center">
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg text-center">
            <h1 class="text-4xl font-bold text-red-500 mb-4">404</h1>
            <p class="text-lg mb-4">Sorry, the page you are looking for does not exist.</p>
            <p class="text-sm text-gray-600">You will be redirected to the homepage in 5 seconds.</p>
        </div>
    </main>
</body>
</html>
