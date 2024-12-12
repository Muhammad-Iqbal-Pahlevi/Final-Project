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
                <h1 class="text-5xl text-white font-bold">Contact</h1>
                <p class="py-6 text-white">
                  Contact us for more info
                </p>
              </div>
            </div>
          </div>
    </section>

    <section>
      <div class="container mx-auto p-4 flex flex-col md:flex-row gap-8">
        <div class="message md:w-2/3 space-y-8">
          <div class="send  space-y-3 items-center w-full  border border-gray-100 bg-white p-4 rounded-md">
            <h1 class="text-xl font-bold text-gray-700">Send Message For Us</h1>
            <p class="text-xs text-gray-500">Give your Feedback or Your Request </p>
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
            <h1 class="text-xs font-light text-gray-500">Message*</h1>
            <textarea name="" id="" class="w-full rounded-md border-gray-400 h-32 p-2 text-xs text-gray-500"></textarea>
            <button class="bg-blue-500 px-4 py-2 text-white rounded-md w-full font-bold ">Send</button>
          </div>
        </div>
        <div class="contact md:w-1/3 mb-8 space-y-4">
          <div class="detail-contact space-y-4">
            <h1 class="text-xl font-bold text-gray-600">Phone</h1>
            <div class="whatsapp flex gap-2 items-center shadow-md p-4 rounded-md">
              <i class="fa-brands text-gray-600 fa-whatsapp text-3xl"></i>
              <p class="text-sm font-semibold text-gray-500">+62 878-9899-0000</p>
            </div>
            <h1 class="text-xl font-bold text-gray-600">Instagram</h1>
            <div class="whatsapp flex gap-2 items-center shadow-md p-4 rounded-md">
              <i class="fa-brands text-gray-600 fa-instagram text-3xl"></i>
              <p class="text-sm font-semibold text-gray-500">@lux_ventus</p>
            </div>
            <h1 class="text-xl font-bold text-gray-600">Phone</h1>
            <div class="whatsapp flex gap-2 items-center shadow-md p-4 rounded-md">
              <i class="fa-brands text-gray-600 fa-whatsapp text-3xl"></i>
              <p class="text-sm font-semibold text-gray-500">+62 878-9899-0000</p>
            </div>
            <h1 class="text-xl font-bold text-gray-600">Phone</h1>
            <div class="whatsapp flex gap-2 items-center shadow-md p-4 rounded-md">
              <i class="fa-brands text-gray-600 fa-whatsapp text-3xl"></i>
              <p class="text-sm font-semibold text-gray-500">+62 878-9899-0000</p>
            </div>
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
</body>
</html>