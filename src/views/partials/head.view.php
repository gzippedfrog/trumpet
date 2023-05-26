<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= isset($title) ? "$title | " : '' ?>PHP blog
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</head>

<body class="min-h-screen flex flex-col bg-gray-50 dark:bg-gray-900">

    <nav class="max-w-screen-xl w-full mx-auto flex flex-wrap items-center justify-between p-4 dark:text-white">
        <a href="/" class="self-center text-2xl font-semibold whitespace-nowrap">Blog</a>

        <?php if (isset($_SESSION['username'])): ?>
            <div>
                Hi, <span class="text-blue-700 dark:text-blue-600 mr-6">
                    <?= "@" . htmlspecialchars($_SESSION['username']) ?>
                </span>
                <form class="inline hover:text-blue-700 dark:hover:text-blue-600 cursor-pointer" method="POST"
                    action="/session">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit">Log out</button>
                </form>
            </div>
        <?php else: ?>
            <div>
                <a class="hover:text-blue-700 dark:hover:text-blue-600  mr-6" href="/register">Register</a>
                <a class="hover:text-blue-700 dark:hover:text-blue-600" href="/login">Log in</a>
            </div>
        <?php endif; ?>
    </nav>

    <main class="p-5 flex flex-col flex-1 max-w-xl w-full mx-auto">