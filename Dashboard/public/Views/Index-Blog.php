<?php

require_once __DIR__ . "/../Model/Model.php";
require_once __DIR__ . "/../Model/post.php";
require_once __DIR__ . "/../Model/Category.php";

if (!isset($_SESSION['full_name'])) {
    header("Location: ./login.php");
}


$blogs = new Post();
// Set limit data per halaman
$limit = 3;
$pageActive = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$totalData = count($blogs->all());
$totalPages = ceil($totalData / $limit);

$startData = ($pageActive - 1) * $limit;

$blogs = $blogs->all();




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


<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tables - Windmill Dashboard</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script
        src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
        defer></script>
    <script src="../assets/js/init-alpine.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../assets/js/focus-trap.js" defer></script>
</head>

<body>
    <div
        class="flex h-screen bg-gray-50 dark:bg-gray-900"
        :class="{ 'overflow-hidden': isSideMenuOpen}">
        <!-- Desktop sidebar -->
        <?php include '../Layout/Sidebar.php'; ?>
        <div class="flex flex-col flex-1 w-full">
            <?php include '../Layout/Header.php'; ?>
            <main class="h-full pb-16 overflow-y-auto">
                <div class="container grid px-6 mx-auto">
                    <h2
                        class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        Tables
                    </h2>
                    <!-- CTA -->
                    <a
                        class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
                        href="https://github.com/estevanmaito/windmill-dashboard">
                        <div class="flex items-center">
                            <svg
                                class="w-5 h-5 mr-2"
                                fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <span>Star this project on GitHub</span>
                        </div>
                        <span>View more &RightArrow;</span>
                    </a>
                    <!-- With actions -->
                    <div class="flex w-full mb-4 justify-between items-center">
                        <h4
                            class=" text-lg font-semibold text-gray-600 dark:text-gray-300">
                            Table with actions
                        </h4>
                        <div
                            class="relative w-full max-w-sm focus-within:text-purple-500">
                            <div class="absolute inset-y-0 flex items-center pl-2">
                                <svg
                                    class="w-4 h-4 fill-gray-400"
                                    aria-hidden="true"
                                    fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input
                                class="w-full pl-8 pr-2 text-sm text-gray-200 placeholder-gray-400 bg-gray-800 border-0 rounded-md focus:outline-none focus:shadow-outline-purple form-input"
                                type="text" id="keyword"
                                placeholder="Search for projects"
                                aria-label="Search" />
                        </div>
                    </div>
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
                </div>
            </main>
        </div>

</body>

<script  src="../assets/Jquery/jquery.min.js"></script>
<script>
    var keyword = $("#keyword")
    var container = $("#container")

    keyword.on("keyup", () => {
        console.log(keyword.val())
        container.load("./Search-Blog.php?keyword=" + keyword.val())
    });
</script>

</html>