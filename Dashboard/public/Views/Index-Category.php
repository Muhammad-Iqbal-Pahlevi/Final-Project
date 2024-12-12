<?php

require_once __DIR__ . "/../Model/Model.php";
require_once __DIR__ . "/../Model/Category.php";

if (!isset($_SESSION['full_name'])) {
    header("Location: ./login.php");
}

$categories = new Category();

// Set limit data per halaman
$limit = 2;
$pageActive = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$totalData = count($categories->all());
$totalPages = ceil($totalData / $limit);

$startData = ($pageActive - 1) * $limit;

$categories = $categories->paginate($startData, $limit); // Fungsi ini akan kita buat


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
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script
        src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
        defer></script>
    <script src="../assets/js/init-alpine.js"></script>
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
                        <div class="w-full overflow-x-auto">
                            <table  class="w-full whitespace-no-wrap">
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
    </div>
</body>
<script  src="../assets/Jquery/jquery.min.js"></script>
<script>
    var keyword = $("#keyword")
    var container = $("#container")

    keyword.on("keyup", () => {
        console.log(keyword.val())
        container.load("./Search-Category.php?keyword=" + keyword.val())
    });
</script>

</html>