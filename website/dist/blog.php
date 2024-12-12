<?php

require_once __DIR__ . '/../Model/Model.php';

$posts = new Blogs_new();
$posts = $posts->all_new(0, 9);
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

        <!-- Hero Centent -->
    <section class="p-4 container -z-10 mx-auto">

          <div class="hero bg-base-200 h-screen md:max-h-72 rounded-2xl" style="background-image: url(../img/image/hero.jpg);">
            <div class="hero-content text-center">
              <div class="max-w-md">
                <h1 class="text-5xl text-white font-bold">Blog</h1>
                <p class="py-6 text-white">
                  Read Our Blogs
                </p>
              </div>
            </div>
          </div>
    </section>

    <section>
      <div class="container  p-4 mx-auto">
        <h1 class="text-2xl text-center font-bold">Latest From  <span class="text-lime-400 ">Our Blog</span></h1>
        <hr class="my-4">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
          <?php foreach ($posts as $post) : ?>
          <div class="group shadow-md rounded-lg">
            <img
              alt=""
              src="../../Dashboard/public/assets/Public/Post/<?= $post['attachment'] ?>"
              class="h-56 w-full rounded-xl object-cover transition group-hover:grayscale-[50%]"
            />
          
            <div class="p-4">
              <a href="./detail-blog.php?id=<?= $blog["id_post"]?>&id_user=<?= $blog["id_user"]?>&id_cat=<?= $blog["id_category"]?>">
                <h3 class="text-lg font-medium text-gray-900"><?= $post['title'] ?></h3>
              </a>
          
              <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
               <?= $post['content'] ?>
              </p>
              <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500"><?= $post['created_at_post'] ?></p>
            </div>
          </div>
          <?php endforeach; ?>
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
  </div>
    <!-- Flowbite & DaisyUI -->
    <script src="./node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./JS/script.js"></script>

    <!-- jQuery (diperlukan oleh Slick) -->
    <script src="./assets/jquery/jquery-3.7.1.min.js"></script>


    <!-- Slick JS -->
    <script src="./assets/slick/slick.min.js"></script>
    <script src="./JS/script.js"></script>

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