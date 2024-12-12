<?php


require_once __DIR__ . "/../Model/Model.php";
require_once __DIR__ . "/../Model/Category.php";

$keyword = $_GET["keyword"];
$categories = new Category();

$keyword = isset($_GET["keyword"]) ? $_GET["keyword"] : '';
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 3;
$pageActive = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$totalData = count($categories->search($keyword));
$totalPages = ceil($totalData / $limit);

$startData = ($pageActive - 1) * $limit;

$categories = $categories->search($keyword, $startData, $limit); // Fungsi ini akan kita buat


$prev = ($pageActive > 1) ? $pageActive - 1 : 1;
$next = ($pageActive < $totalPages) ? $pageActive + 1 : $totalPages;

$range = 1; // The number of pages before and after the active page
$start = max(1, $pageActive - $range); // Ensure the start page is at least 1
$end = min($totalPages, $pageActive + $range); // Ensure the end page is at most the total pages

// Adjust the range if close to the edges
if ($pageActive - $range < 1) {
    $end = min($totalPages, $end + (1 - ($pageActive - $range)));
}

if ($pageActive + $range > $totalPages) {
    $start = max(1, $start - (($pageActive + $range) - $totalPages));
}


?>

<table id="container" class="w-full whitespace-no-wrap">
    <thead>
        <tr
            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3">Name Category</th>
            <th class="px-4 py-3">Action</th>

        </tr>
    </thead>
    <?php $i = 1; ?>
    <?php foreach ($categories as $category) : ?>
        <tbody
            class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
            <tr class="text-gray-700 dark:text-gray-400">
                <td class="px-4 py-3 text-sm">
                    <?= $i ?>
                </td>
                <td class="px-4 py-3 text-sm">
                    <?= $category['name_category'] ?>
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center space-x-4 text-sm">
                        <a href="./Edit-Category.php?id=<?= $category['id_category'] ?>"
                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Edit">
                            <svg
                                class="w-5 h-5"
                                aria-hidden="true"
                                fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                        </a>
                        <a href="../Service/delete-category.php?id=<?= $category['id_category'] ?>"
                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Delete">
                            <svg
                                class="w-5 h-5"
                                aria-hidden="true"
                                fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </td>
            </tr>
        </tbody>
        <?php $i++; ?>
    <?php endforeach; ?>
</table>
<div class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
    <div class="buttons mx-auto flex justify-center p-4 gap-4">
        <nav aria-label="Page navigation example">
            <ul class="pagination flex list-none space-x-">
                <!-- Tombol Prev -->
                <li class="page-item <?= ($pageActive <= 1) ? 'opacity-50 pointer-events-none' : '' ?>">
                    <a class="page-link py-2 px-4  rounded-lg text-xs text-gray-500 "
                        href="?page=<?= $prev ?>" aria-label="Previous">
                        <i class="fa-solid fa-backward"></i>
                    </a>
                </li>

                <!-- Nomor Halaman -->
                <?php for ($i = $start; $i <= $end; $i++) : ?>
                    <li class="page-item <?= ($pageActive == $i) ? 'bg-gray-300 text-white' : '' ?>">
                        <a class="page-link py-2 px-4  rounded-lg text-xs <?= ($pageActive == $i) ? 'bg-gray-300 text-gray-600' : 'text-gray-600 ' ?> transition-colors"
                            href="<?= ($pageActive == $i) ? '#' : '?page=' . $i ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <!-- Tombol Next -->
                <li class="page-item <?= ($pageActive >= $totalPages) ? 'opacity-50 pointer-events-none' : '' ?>">
                    <a class="page-link py-2 px-4 text-xs text-gray-500 "
                        href="?page=<?= $next ?>" aria-label="Next">
                        <i class="fa-solid fa-forward"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>