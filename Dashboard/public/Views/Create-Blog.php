<?php

require_once __DIR__ . '/../Model/Model.php';
require_once __DIR__ . '/../Model/Category.php';
require_once __DIR__ . '/../Model/Post.php';
require_once __DIR__ . '/../Model/Tags.php';
require_once __DIR__ . '/../Model/User.php';

if (!isset($_SESSION['full_name'])) {
    header("Location: ./login.php");
}


$categories = new Category();
$categories = $categories->all();

$tags = new Tags();
$tags = $tags->all();

$users = new Users();
$users = $users->all();

$blogs = new Post();

if (isset($_POST["submit"])) {
    $datas = [
        "post" => $_POST,
        "files" => $_FILES,
    ];
    $result = $blogs->create($datas);
    if (gettype($result) == "string") {
        echo "<script>alert('{$result}');</script>";
    } else {
        echo "<script>alert('Blog berhasil ditambahkan); window.location = 'index-blogs.php';</script>;";
    }
}

?>

<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Windmill Dashboard - Forms</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
    <script
        src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
        defer></script>
    <script src="../assets/js/init-alpine.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/preline/dist/preline.css">
</head>
<body>
    <div
        class="flex h-screen bg-gray-50 dark:bg-gray-900"
        :class="{ 'overflow-hidden': isSideMenuOpen}">
        <?php include '../Layout/Sidebar.php'; ?>
        <div class="flex flex-col flex-1">
           <?php include '/../Layout/Header.php'; ?>
            <main class="h-full pb-16 overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    <h2
                        class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        Forms
                    </h2>
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
                    <!-- Inputs with buttons -->
                    <h4
                        class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                        Create Category
                    </h4>
                    <form method="post" action="" enctype="multipart/form-data"
                        class="p-4 mb-8 bg-white rounded-lg shadow-md space-y-2 dark:bg-gray-800">
                        <label class="block text-sm" for="title">
                            <span class="text-gray-700 dark:text-gray-400 mb-2">Name</span>
                            <input
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="Jane Doe" name="title" id="title" />
                        </label>

                        <label class="block mt-4 text-sm" for="content">
                            <span class="text-gray-700 dark:text-gray-400 mb-2">Content</span>
                            <textarea
                                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                rows="3" name="content" id="content"
                                placeholder="Enter some long form content."></textarea>
                        </label>
                        <label class="block text-sm" for="category">
                            <span class="text-gray-700 dark:text-gray-400 mb-2">
                                Chose Category
                            </span>
                            <select name="category" id="category"
                                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category['id_category'] ?>"><?= $category['name_category'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                        <label class="block text-sm" for="user">
                            <span class="text-gray-700 dark:text-gray-400 mb-2">
                                Chose Author
                            </span>
                            <select name="user" id="user"
                                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                <?php foreach ($users as $user) : ?>
                                    <option value="<?= $user['id_user'] ?>"><?= $user['full_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                        <!-- Select -->
                        <label for="tag_id_pivot" class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400 mb-2">
                                Chose Tags
                            </span>
                            <select multiple="multiple" name="tag_id_pivot[]" id="tag_id_pivot" data-hs-select='{
                                "placeholder": "Select multiple options...",
                                "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                "toggleClasses": "hs-select-disabled:pointer-events-none text-sm hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray",
                                "toggleCountText": "selected",
                                "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300",
                                "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100",
                                "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                                "extraMarkup": ""
                                }' class="hidden">
                                <?php foreach ($tags as $tag) : ?>
                                    <option value="<?= $tag['id_tag'] ?>"><?= $tag['name_tag'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                        <label for="attachment" class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400 mb-2">
                                Attachment
                            </span>
                            <input type="file" name="attachment" id="attachment" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-input">
                        </label>
                        <!-- End Select -->
                        <button name="submit" type="submit"
                            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Submit
                        </button>

                    </form>
                </div>
            </main>
        </div>
    </div>
</body>
<script src="../../node_modules/preline/dist/preline.js"></script>

</html>