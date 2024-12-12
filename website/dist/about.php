<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/output.css">

    <!-- Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Flowbite & DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />

    <!-- CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Portfolio - Your Name</title>
</head>
<body>
    <?php include '../assets/component/navbar.php' ?>

    <!-- Hero Section -->
    <section class="p-4 container mx-auto">
        <div class="hero bg-base-200 h-96 rounded-2xl flex items-center justify-center" style="background-image: url(../img/image/hero.jpg);">
            <div class="hero-content text-center flex flex-col text-white">
                <h1 class="text-5xl font-bold">Hello, I’m [Your Name]</h1>
                <p class="py-6">A Web Developer passionate about creating beautiful and functional websites.</p>
                <a href="#projects" class="btn btn-primary">View My Work</a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="p-4 container mx-auto">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold">About Me</h2>
            <p class="text-gray-600">A brief introduction about yourself, your skills, and your passion.</p>
        </div>
        <div class="flex flex-col md:flex-row items-center gap-8">
            <img src="../img/author/1.jpeg" alt="Your Photo" class="rounded-full w-48 h-48">
            <div>
                <p class="text-gray-700">I am a dedicated web developer with experience in HTML, CSS, JavaScript, and PHP. I specialize in creating responsive and user-friendly websites that cater to client needs. My passion lies in problem-solving and turning ideas into reality through code.</p>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="p-4 container mx-auto">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold">My Projects</h2>
            <p class="text-gray-600">A showcase of some of the projects I have worked on.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <img src="../img/projects/project1.jpg" alt="Project 1" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-bold">Project Title 1</h3>
                    <p class="text-gray-600">Brief description of the project.</p>
                    <a href="#" class="text-blue-500 hover:underline">View Details</a>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <img src="../img/projects/project2.jpg" alt="Project 2" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-bold">Project Title 2</h3>
                    <p class="text-gray-600">Brief description of the project.</p>
                    <a href="#" class="text-blue-500 hover:underline">View Details</a>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <img src="../img/projects/project3.jpg" alt="Project 3" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-bold">Project Title 3</h3>
                    <p class="text-gray-600">Brief description of the project.</p>
                    <a href="#" class="text-blue-500 hover:underline">View Details</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="p-4 container mx-auto">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold">Get in Touch</h2>
            <p class="text-gray-600">Feel free to reach out to discuss projects or collaborations.</p>
        </div>
        <form class="max-w-md mx-auto space-y-4">
            <input type="text" placeholder="Your Name" class="input input-bordered w-full">
            <input type="email" placeholder="Your Email" class="input input-bordered w-full">
            <textarea placeholder="Your Message" class="textarea textarea-bordered w-full"></textarea>
            <button type="submit" class="btn btn-primary w-full">Send Message</button>
        </form>
    </section>

    <?php include '../assets/component/footer.php' ?>

    <!-- Flowbite & DaisyUI -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>