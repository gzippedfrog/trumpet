<?php view('partials/head', ['title' => 'Log in']) ?>

<div
    class="w-full m-auto bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            Sign in to your account
        </h1>
        <form method="POST" action="/session" class="space-y-4 md:space-y-6">
            <div>
                <label for="username" class="block mb-2 text-gray-900 dark:text-white">Username</label>
                <input type="text" name="username" id="username" value="<?= old('username') ?? '' ?>" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <?php if (isset($errors['username'])): ?>
                    <p class=" text-red-600 dark:text-red-500">
                        <?= $errors['username'] ?>
                    </p>
                <?php endif; ?>
            </div>
            <div>
                <label for="password" class="block mb-2  text-gray-900 dark:text-white">Password</label>
                <input type="password" name="password" id="password" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <?php if (isset($errors['password'])): ?>
                    <p class=" text-red-600 dark:text-red-500">
                        <?= $errors['password'] ?>
                    </p>
                <?php endif; ?>
            </div>
            <button type="submit"
                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sign
                in</button>
            <p class="text-gray-500 dark:text-gray-400">
                Don't have an account yet? <a href="/register"
                    class="text-blue-600 hover:underline dark:text-blue-500">Sign up</a>
            </p>
        </form>
    </div>
</div>

<?php view('partials/footer') ?>