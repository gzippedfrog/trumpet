<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= isset($title) ? "$title | " : '' ?>Trumpet
    </title>
    <link href="/css/output.css" rel="stylesheet">
</head>

<body class="min-h-screen flex flex-col bg-gray-100 dark:bg-gray-900">
    <nav class="w-full bg-gray-800 text-white dark:bg-gray-900 dark:text-white sticky top-0 shadow-sm">
        <div class="max-w-screen-xl mx-auto flex flex-wrap items-center justify-between p-4">
            <a href="/" class="self-center text-2xl font-semibold whitespace-nowrap">Trumpet</a>

            <?php if (isset($_SESSION['username'])): ?>
                <div>
                    Hi, <span class="text-primary-500 dark:text-primary-600 mr-6">
                        <?= "@" . htmlspecialchars($_SESSION['username']) ?>
                    </span>
                    <form class="inline hover:text-primary-700 dark:hover:text-primary-600 cursor-pointer" method="POST"
                        action="/session">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit">Log out</button>
                    </form>
                </div>
            <?php else: ?>
                <div>
                    <a class="hover:text-primary-700 dark:hover:text-primary-600  mr-6" href="/register">Register</a>
                    <a class="hover:text-primary-700 dark:hover:text-primary-600" href="/login">Log in</a>
                </div>
            <?php endif; ?>
        </div>
    </nav>

    <main class="p-5 flex flex-col flex-1 max-w-xl w-full mx-auto">