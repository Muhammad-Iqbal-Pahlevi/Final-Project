<?php

require_once __DIR__ . '/../Model/Model.php';
require_once __DIR__ . '/../Model/Category.php';

if (!isset($_SESSION['full_name'])) {
	header("Location: ./login.php");
}


if (isset($_POST['submit'])) {
	$category = [
		"name_category" => $_POST['name_category']
	];
	if (strlen($_POST["name_category"]) > 225) {
		echo "<script>alert('Nama kategori harus dibawah 225 karakter'); window.location = 'create-category.php';</script>;";
		die;
	}
	$categories = new Category();
	$result = $categories->create($category);
	if ($result !== false) {
		echo "<script>alert('Kategori berhasil ditambahkan dengan nama {$result["name_category"]}'); window.location = 'index-category.php';</script>;";
		die;
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
</head>

<body>
    <div
        class="flex h-screen bg-gray-50 dark:bg-gray-900"
        :class="{ 'overflow-hidden': isSideMenuOpen}">
        <?php include '../Layout/Sidebar.php'; ?>
        <div class="flex flex-col flex-1">
            <?php include '../Layout/Header.php'; ?>
            <main class="h-full pb-16 overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    <h2
                        class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        Forms
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
                    <!-- Inputs with buttons -->
                    <h4
                        class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                        Create Category
                    </h4>
                    <form method="post" action=""
                        class="p-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <label for="name_category" class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Masukan Nama Category
                            </span>
                            <div
                                class="relative text-gray-500 focus-within:text-purple-600">
                                <input
                                    id="name_category" name="name_category"
                                    class="block w-full pr-20 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                                    placeholder="Jane Doe" />
                                <button
                                    name="submit" type="submit"
                                    class="absolute inset-y-0 right-0 px-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-r-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                    Add
                                </button>
                            </div>
                        </label>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>

</html>