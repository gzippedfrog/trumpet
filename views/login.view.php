<?php view('partials/head', ['title' => 'Log in']) ?>

<form method="POST" action="/login">
    <div class="mb-6">
        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
        <input id="username" name="username" type="text" value="<?= $username ?? '' ?>" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <?php if (isset($errors['username'])) : ?>
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><?= $errors['username'] ?></p>
        <?php endif; ?>
    </div>

    <div class="mb-6">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
        <input id="password" name="password" type="password" value="<?= $password ?? '' ?>" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <?php if (isset($errors['password'])) : ?>
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><?= $errors['password'] ?></p>
        <?php endif; ?>
    </div>

    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
</form>

<?php view('partials/footer') ?>