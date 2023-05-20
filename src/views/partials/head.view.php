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
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="min-h-screen flex flex-col items-stretch dark:bg-gray-900">

    <!--  HEADER-->
    <header>
        <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 dark:bg-gray-900">
            <div class="container flex flex-wrap items-center justify-between mx-auto">
                <a href="/" class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">PHP blog</a>

                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                    <ul
                        class="flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700 dark:text-gray-400">
                        <?php if (isset($_SESSION['username'])): ?>
                            <li>Hi, <span class="text-blue-700 dark:text-white">
                                    <?= htmlspecialchars($_SESSION['username']) ?>
                                </span></li>
                            <li class="hover:text-blue-700 cursor-pointer">
                                <form method="POST" action="/session">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit">Log out</button>
                                </form>
                            </li>
                        <?php else: ?>
                            <li class="hover:text-blue-700"><a href="/register">Register</a></li>
                            <li class="hover:text-blue-700"><a href="/login">Log in</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- MAIN SECTION -->
    <main class="p-3 flex flex-col flex-1 max-w-xl w-full mx-auto">