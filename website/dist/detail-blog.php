<?php

require_once __DIR__ . '/../../Dashboard/public/Model/Model.php';
require_once __DIR__ . '/../../Dashboard/public/Model/Post.php';
require_once __DIR__ . '/../../Dashboard/public/Model/Category.php';
require_once __DIR__ . '/../../Dashboard/public/Model/Tags.php';
require_once __DIR__ . '/../../Dashboard/public/Model/User.php';
require_once __DIR__ . '/../Model/Model.php';   

$id = $_GET['id'];
$id_user = $_GET['id_user'];
$id_cat = $_GET['id_cat'];
$categoryModel = new Category();
$categories = $categoryModel->all();

$tagModel = new Tags();
$tags = $tagModel->all();

$userModel = new Users();
$users = $userModel->all();

// Instance untuk post
$postModel = new Blogs_new();
$posts = $postModel->find_blog($id);
$new_post = $postModel->all_new(0, 5);
$blog_author = $postModel->blog_author($id_user, 3);
$blog_cat = $postModel->blog_category($id_cat, 3);
// var_dump($blog_cat);
// die;
// var_dump($blog_author);
// die;






// var_dump($posts);
// die;




?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/output.css">

    <!-- Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Flowbite & DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />

    <!-- CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Lux Ventus</title>
    </head>
<body>
    <?php include '../assets/component/navbar.php' ?>

    <section>
        <div class="container mx-auto p-4 flex flex-col md:flex-row gap-8">
          <div class="detail-blog md:w-2/3 space-y-8">
            <div class="category space-x-1 bg-gray-200 py-2 px-4 ">
              <a href="./index.php" class=" text-sm text-blue-400">Home</a>
              <span class="text-xs font-semibold text-gray-500">|</span>
              <a href="./blog.php" class=" text-sm text-blue-400">Blog</a>
              <span class="text-xs font-semibold text-gray-500">|</span>
              <a href="" class=" text-sm text-blue-400"><?= $posts[0]['name_category'] ?></a>
            </div>
            <div class="author flex gap-4 items-center">
              <img src="../../Dashboard/public/assets/Public/Users/<?= $posts[0]['avatar'] ?>" alt="" class="w-14 h-14 rounded-full border-2 border-gray-600">
              <div class="detail-author">
                <h1 class="text-xl font-bold text-gray-700"><?= $posts[0]['full_name'] ?></h1>
                <h5 class="text-xs text-gray-500 "><?= $posts[0]['email'] ?></h5>
              </div>
            </div>
            <div class="title">
              <h1 class="text-2xl mb-4 font-bold text-gray-700"><?= $posts[0]['title'] ?></h1>
              <hr>
            </div>
            <div class="blog overflow-hidden rounded-lg border border-gray-100 bg-white ">
              <img
                alt=""
                src="../../Dashboard/public/assets/Public/Post/<?= $posts[0]['attachment'] ?>"
                class="h-56 w-full object-cover"
              />
              <div class="p-4 space-y-4">
                <p class="text-sm text-gray-500"><?= $posts[0]['content'] ?></p>
                
                <div class="container mx-auto flex gap-2 flex-wrap mb-4">
                  <h1 class="text-sm font-bold text-gray-600">Tags :</h1>
                  <div class="flex space-x-2">
                    <p class="bg-gray-300 w-fit px-4 text-sm text-gray-400"><?= $posts[0]['tags'] ?></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="share flex gap-2 items-center w-full justify-between border border-gray-100 bg-white p-4 rounded-md">
              <h1 class="text-xl font-bold text-gray-700">Let's Share it</h1>
              <div class="sosmed space-x-1 md:space-x-4 text-blue-600">
                <i class="fa-brands text-3xl md: fa-instagram "></i>
                <i class="fa-brands text-3xl md: fa-facebook "></i>
                <i class="fa-brands text-3xl md: fa-linkedin "></i>
                <i class="fa-brands text-3xl md: fa-whatsapp"></i>
              </div>
            </div>
            <div class="reply  space-y-3 items-center w-full  border border-gray-100 bg-white p-4 rounded-md">
              <h1 class="text-xl font-bold text-gray-700">Leave a Reply</h1>
              <p class="text-xs text-gray-500">Your email address will not be published. Required fields are marked</p>
              <h1 class="text-xs font-light text-gray-500">Write a comment*</h1>
              <textarea name="" id="" class="w-full rounded-md border-gray-400 h-32 p-2 text-xs text-gray-500"></textarea>
              <div class="flex flex-col md:flex-row gap-4 w-full">
                <div class="space-y-1 w-full">
                  <h1 class="text-xs font-light text-gray-500">Name*</h1>
                  <input type="text" name="" id="" class="w-full rounded-md border-gray-400 h-10 text-xs text-gray-500">
                </div>
                <div class="space-y-1 w-full">
                  <h1 class="text-xs font-light text-gray-500">Email*</h1>
                  <input type="text" name="" id="" class="w-full rounded-md border-gray-400 h-10 text-xs text-gray-500">
                </div>
              </div>
              <button class="bg-blue-500 px-4 py-2 text-white rounded-md w-full font-bold ">Read</button>
            </div>
          </div>
          <div class="about md:w-1/3 mb-8 space-y-4">
            <div class="author border-gray-100 border  p-6 flex gap-4 items-center md:flex-col  rounded-md mb-4">
              <img src="../img/author/1.jpeg" alt="" class="w-20 h-20 rounded-full border-4 border-gray-600">
              <div class="detail-about md:flex md:flex-col md:items-center space-y-2">
                <h1 class="text-xl font-bold text-gray-700">Iqbal Pahlevi</h1>
                <h5 class="text-xs text-gray-500 tracking-widest">Author</h5>
                <p class="text-xs mb-2 text-center text-gray-600 hidden md:block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, voluptates optio eveniet nostrum magnam expedita aliquid perspiciatis eum error quasi.</p>
                <button class="bg-blue-500 text-xs px-4 py-2 text-white rounded-md font-bold">Read</button>
              </div>
            </div>
            <div class="berita-terbaru border-gray-100 border rounded-md p-4 space-y-4">
              <h1 class="text-xl font-bold text-gray-700">Berita Terbaru dari <?= $posts[0]['full_name'] ?></h1>
              <?php foreach ($blog_author as $post) : ?>
              <hr>
              <div class="berita flex gap-4 items-center">
                <img src="../../Dashboard/public/assets/Public/Post/<?= $post['attachment'] ?>" width="80" height="80" alt="" class="rounded- ">
                <div class="isi">
                  <h4 class="font-semibold text-gray-700"><?= $post['title'] ?></h4>
                  <a href="./detail-blog.php?id=<?= $post["id_post"]?>&id_user=<?= $post["id_user"]?>&id_cat=<?= $post["category_id"]?>" class="text-xs font-extralight text-blue-500">Read More</a>
                </div>
              </div>
              <?php endforeach ?>
            </div>
            <div class="berita-terkait border-gray-100 border rounded-md p-4 space-y-4">
              <h1 class="text-xl font-bold text-gray-700">Berita Terkait</h1>
              <?php foreach ($blog_cat as $post) : ?>
              <hr>
              <div class="isi">
                  <h4 class="font-semibold text-lg text-gray-700"><?= $post['title'] ?></h4>
                  <p class="text-xs font-extralight text-gray-500 line-clamp-2 mb-2"><?= $post['content'] ?></p>
                  <a href="./detail-blog.php?id=<?= $post["id_post"]?>&id_user=<?= $post["user_id"]?>&id_cat=<?= $post["category_id"]?>" class="text-xs font-extralight text-blue-500">Read More</a>
              </div>
              <?php endforeach ?> 
            </div>
          </div>
          
        </div>
    </section>

    <?php include '../assets/component/footer.php' ?>

    <!-- Search Modal -->
    <div id="searchModal" class="modal ">
      <div class="modal-box">
        <h3 class="font-bold text-lg">Search</h3>
        <form>
          <input
            type="text"
            placeholder="Type something..."
            class="input input-bordered w-full mt-2"
          />
          <div class="modal-action">
            <button type="button" class="btn btn-ghost" onclick="toggleSearchModal(false)">Close</button>
            <button type="submit" class="btn">Search</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Notification Container -->
    <div id="notification" class="hidden fixed bottom-5 right-5 w-72 bg-white  rounded-lg border border-gray-300 p-4">
      <div class="flex items-start">
        <div class="flex-shrink-0">
          <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M9 12l2 2l4 -4m6 2a9 9 0 11-18 0a9 9 0 0118 0z" />
          </svg>
        </div>
        <div class="ml-3">
          <p class="text-sm font-medium text-gray-900">You have a new notification!</p>
          <p class="text-sm text-gray-500">Click the button to see more details.</p>
        </div>
      </div>
    </div>

    <!-- Flowbite & DaisyUI -->
    <script src="./node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
      function toggleSearchModal(show) {
      const modal = document.getElementById('searchModal');
      if (show) {
          modal.classList.add('modal-open');
          } else {
          modal.classList.remove('modal-open');
          }
      }

      function showNotification() {
        const notification = document.getElementById('notification');
        notification.classList.remove('hidden');
          // Auto-hide after 5 seconds
        setTimeout(() => {
            notification.classList.add('hidden');
            }, 5000);
      }
    </script>
</body>
</body>
</html>