<?php
/**
 * @var string $prevPageUrl
 * @var string $nextPageUrl
 */
?>

<div class="w-52 flex gap-3 mx-auto">
    <?php if ($prevPageUrl ?? null): ?>
        <a href="<?= $prevPageUrl ?>"
           class="flex-1 inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white select-none">
            Previous
        </a>
    <?php else: ?>
        <div
                class="flex-1 inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-400 select-none">
            Previous
        </div>
    <?php endif ?>

    <?php if ($nextPageUrl ?? null): ?>
        <a href="<?= $nextPageUrl ?>"
           class="flex-1 inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white select-none">
            Next
        </a>
    <?php else: ?>
    <div
            class="flex-1 inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-400 select-none">
        Next
        <?php endif ?>
    </div>