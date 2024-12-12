<?php

require_once __DIR__  . "/../../Dashboard/public/Model/Model.php";
require_once __DIR__  . "/../../Dashboard/public/Model/Category.php";
require_once __DIR__  . "/../../Dashboard/public/Model/Post.php";
require_once __DIR__  . "/../../Dashboard/public/Model/Tags.php";
require_once __DIR__  . "/../../Dashboard/public/Model/User.php";
require_once __DIR__  . "/../Model/Model.php";

$users = new Users();
$users = $users->top_user(4);
$categories = new Category();
$categories = $categories->all_category();


$posts = new Post();
$posts = $posts->all_3(0, 1);
// var_dump($posts);
$blog_data = new Blogs_new();
$blogs = $blog_data->all_new(0, 4);
// var_dump($blogs);
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

  <!-- Slick CSS -->
  <link rel="stylesheet" href="../assets/slick/slick.css">
  <link rel="stylesheet" href="../assets/slick/slick-theme.css">

  <!-- CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <title>Lux Ventus</title>
</head>
<body>
    <?php include '../assets/component/navbar.php'?>
    
    <!-- Hero Centent -->
    <section class="p-4 container -z-10 mx-auto">
      <div class="hero bg-base-200 h-screen md:max-h-96 rounded-2xl" style="background-image: url(../img/image/hero.jpg);">
        <div class="hero-content text-center">
          <div class="max-w-md">
            <h1 class="text-5xl text-white font-bold">Hello there</h1>
            <p class="py-6 text-white">
              Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem
              quasi. In deleniti eaque aut repudiandae et a id nisi.
            </p>
            <button class="btn btn-primary">Get Started</button>
          </div>
        </div>
      </div>
    </section>

    <!-- Author -->
    <section>
      <div class="container p-4 mx-auto">
        
        <div class="author slider mt-4">
          <?php foreach ($users as $user) : ?>
          <div class="card min-h-24 flex flex-row relative">
            <img src="../img/author/1.jpeg" alt="" class="w-[200px] rounded-xl">
            <div class="detail p-4 absolute right-2 space-y- bg-white space-y-1 w-2/3 top-1/2 left-1/2 transform -translate-x-1/4 -translate-y-1/2 rounded-md shadow">
              <a href="./author.php?id=<?= $user['id_user'] ?>" class="font-bold text-xl text-gray-800"><?= $user['full_name'] ?></a>
              <p class="text-[10px] text-gray-600"><?= $user['email'] ?></p>
              <div class="sosmed space-x-1 text-blue-600">
                <i class="fa-brands fa-instagram "></i>
                <i class="fa-brands fa-facebook "></i>
                <i class="fa-brands fa-linkedin "></i>
                <i class="fa-brands fa-whatsapp"></i>
              </div>
            </div>
          </div>
          <?php endforeach ?>
        </div>
    </section>

    <!-- Categori -->
    <section>
      <div class="container p-4 mx-auto ">
        <div class="category">
          <h1 class="mb-4 text-xl text-center font-bold">Category</h1>
          <div class="tags grid grid-cols-2 gap-4 md:grid-cols-4">
            <?php foreach ($categories as $category) : ?>
            <div class="detail-tags p-4 shadow flex-col flex items-center rounded-md bg-white transition duration-300 transform hover:-translate-y-2 hover:bg-gray-200 hover:shadow-md">
              <i class="fa-solid fa-tags text-3xl text-gray-600 transition-transform duration-300 hover:text-gray-800 hover:rotate-12"></i>
              <h1 class="font-bold text-gray-600 mt-2 transition-colors duration-300 hover:text-gray-800"><?= $category['name_category'] ?></h1>
            </div>
            <?php endforeach ?>
          </div>
        </div>
      </div>
    </section>


    <!-- Blog Terbaru -->
    <section>
      <hr class="my-4">
      <div class="container mx-auto p-4 md:flex md:flex-row-reverse gap-8">
        <div class="about md:w-1/3 lg:w-1/4 mb-8">
          <div class="about-card p-6 flex gap-8 items-center md:flex-col shadow-md rounded-md mb-4">
            <img src="../img/author/1.jpeg" alt="" class="w-20 h-20 rounded-full border-4 border-gray-600">
            <div class="detail-about md:flex md:flex-col md:items-center space-y-2">
              <h5 class="text-xs text-gray-500 tracking-widest">Portofolio</h5>
              <h1 class="text-xl font-bold text-gray-700">Iqbal Pahlevi</h1>
              <p class="text-[10px] mb-2 text-center text-gray-600 hidden md:block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, voluptates optio eveniet nostrum magnam expedita aliquid perspiciatis eum error quasi.</p>
              <button class="bg-blue-500 text-xs px-4 py-2 text-white rounded-full font-bold">Read</button>
            </div>
          </div>
          <div class="message p-6  space-y-4 shadow-md rounded-md">
            <h1 class="text-xl font-bold text-gray-600">Send Message</h1>
            <p class="text-xs text-gray-400">Give Us Your Feedback</p>
            <input type="text" name="" id="" class="w-full rounded-full border-gray-400 h-10 text-xs text-gray-500">
            <button class="bg-blue-500 px-4 py-2 text-white rounded-full w-full font-bold ">Read</button>
          </div>
          
        </div>
        <div class="blog md:w-2/3 lg:w-3/4">
          <div class="container mt-8">
            <div class="title mb-4 flex w-full justify-between items-center">
              <h1 class="text-2xl font-bold">Berita <span class="text-lime-400 ">Populer</span></h1>
              <a href="" class="text-sm text-blue-500">View All ></a>
            </div>
            <hr>
            <div class="new-blog mt-4">
              <?php foreach ($blogs as $blog) : ?>
              <div class="overflow-hidden rounded-lg shadow transition hover:shadow-lg mb-4 flex flex-col lg:flex-row">
                <img
                  alt=""
                  src="../../Dashboard/public/assets/Public/Post/<?= $blog['attachment'] ?>"
                  class="w-96 h-full object-cover"
                />
              
                <div class="bg-white p-4 sm:p-6">
                  <time datetime="2022-10-10" class="block text-xs text-gray-500"> <?= date("M, d, Y", strtotime($blog['created_at_post']))?> </time>
              
                  <a href="#">
                    <h3 class="mt-0.5 text-lg text-gray-900"><?= $blog['title'] ?></h3>
                  </a>
              
                  <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae dolores, possimus
                    pariatur animi temporibus nesciunt praesentium dolore sed nulla ipsum eveniet corporis quidem,
                    mollitia itaque minus soluta, voluptates neque explicabo tempora nisi culpa eius atque
                    dignissimos. Molestias explicabo corporis voluptatem?
                  </p>
                  <a href="./detail-blog.php?id=<?= $blog["id_post"]?>&id_user=<?= $blog["id_user"]?>&id_cat=<?= $blog["id_category"]?>" class="mt-4 block text-sm font-medium text-blue-600">Read Blog</a>
                </div>
              </div>
              <?php endforeach ?>
              <!-- <div class="flex flex-col lg:flex-row gap-8">
                <div class="group shadow-md rounded-lg">
                  <img
                    alt=""
                    src="https://images.unsplash.com/photo-1631451095765-2c91616fc9e6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                    class="h-56 w-full rounded-xl object-cover transition group-hover:grayscale-[50%]"
                  />
                
                  <div class="p-4">
                    <a href="#">
                      <h3 class="text-lg font-medium text-gray-900">Finding the Journey to Mordor</h3>
                    </a>
                
                    <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae dolores, possimus
                      pariatur animi temporibus nesciunt praesentium dolore sed nulla ipsum eveniet corporis quidem,
                      mollitia itaque minus soluta, voluptates neque explicabo tempora nisi culpa eius atque
                      dignissimos. Molestias explicabo corporis voluptatem?
                    </p>
                  </div>
                </div>
                <div class="group shadow-md rounded-lg">
                  <img
                    alt=""
                    src="https://images.unsplash.com/photo-1631451095765-2c91616fc9e6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                    class="h-56 w-full rounded-xl object-cover transition group-hover:grayscale-[50%]"
                  />
                
                  <div class="p-4">
                    <a href="#">
                      <h3 class="text-lg font-medium text-gray-900">Finding the Journey to Mordor</h3>
                    </a>
                
                    <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae dolores, possimus
                      pariatur animi temporibus nesciunt praesentium dolore sed nulla ipsum eveniet corporis quidem,
                      mollitia itaque minus soluta, voluptates neque explicabo tempora nisi culpa eius atque
                      dignissimos. Molestias explicabo corporis voluptatem?
                    </p>
                  </div>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Tags -->
     <section>
      <div class="container p-4 mx-auto flex gap-2 flex-wrap mb-4">
        <h1 class="text-sm font-bold text-gray-600">Tags :</h1>
        <p class="bg-gray-300 w-fit px-4 text-sm rounded text-gray-400">Pendidikan</p>
        <p class="bg-gray-300 w-fit px-4 text-sm rounded text-gray-400">Pendidikan</p>
        <p class="bg-gray-300 w-fit px-4 text-sm rounded text-gray-400">Pendidikan</p>
        <p class="bg-gray-300 w-fit px-4 text-sm rounded text-gray-400">Pendidikan</p>
        <p class="bg-gray-300 w-fit px-4 text-sm rounded text-gray-400">Pendidikan</p>
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
    <script src="./JS/script.js"></script>

    <!-- jQuery (diperlukan oleh Slick) -->
    <script src="../assets/jquery/jquery-3.7.1.min.js"></script>


    <!-- Slick JS -->
    <script src="../assets/slick/slick.min.js"></script>

    <script src="../JS/script.js"></script>

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