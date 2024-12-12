<?php


require_once __DIR__ . "/../Model/Model.php";
require_once __DIR__ . "/../Model/Post.php";

$keyword = $_GET["keyword"];
$blogs = new Post();

$keyword = isset($_GET["keyword"]) ? $_GET["keyword"] : '';
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 3;
$pageActive = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$totalData = count($blogs->search($keyword));
$totalPages = ceil($totalData / $limit);

$startData = ($pageActive - 1) * $limit;

$blogs = $blogs->search($keyword, $startData, $limit); // Fungsi ini akan kita buat


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
<div id="container" class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full grid grid-cols-1 py-4 md:grid-cols-2 lg:grid-cols-3 gap-2">
        <?php foreach ($blogs as $blog) : ?>
            <div class="flex transition shadow hover:shadow-xl dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                <div class="rotate-180 text-white p-2 [writing-mode:_vertical-lr]">
                    <time
                        datetime="2022-10-10"
                        class="flex items-center justify-between gap-4 text-xs font-bold uppercase text-gray-500">
                        <span><?= date('Y', strtotime($blog['created_at_post'])) ?></span>
                        <span class="w-px flex-1 bg-gray-500"></span>
                        <span><?= date('M, d', strtotime($blog['created_at_post'])) ?></span>
                    </time>
                </div>
                <div class="flex flex-1 flex-col justify-between">
                    <img src="../assets/img/dashboard.png" alt="">
                    <div class="border-s border-gray-900/10  sm:border-l-transparent p-4">
                        <a href="#">
                            <h3 class="font-bold uppercase text-gray-500">
                                <?= $blog['title'] ?>
                            </h3>
                        </a>

                        <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
                            <?= $blog['content'] ?>
                        </p>
                    </div>

                    <div class="sm:flex sm:items-end sm:justify-end gap-2 p-2">
                        <button
                            data-id="1"
                            @click="openModal"
                            class="px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            <i class="fa-solid fa-circle-info"></i>
                        </button>
                        <a href="./Edit-Blog.php?id=<?= $blog['id_post'] ?>"
                            class="px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            aria-label="Edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="../Service/Delete-Blog.php?id=<?= $blog['id_post'] ?>"
                            class="px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            aria-label="Delete">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
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
</div>