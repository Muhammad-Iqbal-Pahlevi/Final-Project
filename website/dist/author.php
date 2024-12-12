<?php

require_once __DIR__ . '/../../Dashboard/public/Model/Model.php';
require_once __DIR__ . '/../../Dashboard/public/Model/User.php';
require_once __DIR__ . '/../Model/Model.php';

$id = $_GET['id'];
$users = new Users();
$users = $users->find($id);

$blog_author = new Blogs_new();
$blog_author = $blog_author->blog_author($id, 3);
// var_dump($blog_author);
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

  <!-- Hero Centent -->
  <section class="p-4 container -z-10 mx-auto">
    <div class="hero bg-base-200 h-screen md:max-h-72 rounded-2xl" style="background-image: url(../img/image/hero.jpg);">
      <div class="hero-content text-center">
        <div class="max-w-md">
          <h1 class="text-5xl text-white font-bold">Author</h1>
          <p class="py-6 text-white">
            Get more info about the author
          </p>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container mx-auto flex flex-col md:flex-row gap-8">
      <div class="detail-blog md:w-2/3 space-y-8">
        <div class=" container mx-auto ">
          <div class="w-full bg-white  rounded-lg p-6">
            <div class="flex items-center mb-6">
              <img src="../../Dashboard/public/assets/Public/Users/<?= $users[0]['avatar'] ?>" alt="image" class="w-24 h-24 rounded-full">
              <div class="ml-4 space-y-1">
                <h3 class="text-xl font-bold"><a href="#"><?= $users[0]['full_name'] ?></a></h3>
                <h6 class="text-sm text-gray-500"><?= $users[0]['email'] ?></h6>
              </div>
            </div>
            <p class="text-gray-700 font-semibold"><?= $users[0]['bio'] ?></p>
            <p class="text-gray-500  text-sm ">Phone : <?= $users[0]['phone'] ?></p>
            <hr class="my-4">
            <div class="flex items-center space-x-2">
              <span class="text-gray-500 font-semibold text-sm">Follow <?= $users[0]['full_name'] ?> On</span>
              <a href="#" class="text-blue-600"><i class="fab fa-facebook-f"></i></a>
              <a href="#" class="text-blue-400"><i class="fab fa-twitter"></i></a>
              <a href="#" class="text-gray-700"><i class="fab fa-github"></i></a>
              <a href="#" class="text-pink-500"><i class="fab fa-instagram"></i></a>
            </div>
            <h6 class="text-xs font-light italic mb-2 text-gray-500">Bergabung sejak 2022</h6>

            <div class="mt-6 text-right">
              <a href="#" class="text-blue-500 hover:underline">View Posts <i class="fas fa-chevron-right"></i></a>
            </div>
          </div>
        </div>
        
      </div>
      <div class="about md:w-1/3 mb-8 space-y-4">
        <div class="berita-terbaru  rounded-md p-4 space-y-4">
          <h1 class="text-xl font-bold text-gray-700">Berita dari <?= $users[0]['full_name']?></h1>
          <?php foreach ($blog_author as $blog) : ?>
            <hr>
            <div class="berita flex gap-4 items-center">
              <img src="../../Dashboard/public/assets/Public/Post/<?= $blog['attachment'] ?>" width="80" height="80" alt="" class="rounded-md">
              <div class="isi">
                <h4 class="font-semibold text-gray-700"><?= $blog['title']?></h4>
                <a href="./detail-blog.php?id=<?= $blog['id_post']?>" class="text-xs font-extralight text-blue-500">Read More</a>
              </div>
            </div>
          <?php endforeach; ?>
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
          class="input input-bordered w-full mt-2" />
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

</html>