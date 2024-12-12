$(document).ready(function(){
    $('.slider').slick({
        infinite: true,            // Menggunakan huruf kecil
        slidesToShow: 3,
        slidesToScroll: 1,         // Typo diperbaiki
        autoplay: true,
        dots: true,
        arrows: false,
        autoplaySpeed: 2000,

        // Pengaturan responsive
        responsive: [
            {
                breakpoint: 1024,  // Untu layar <= 1024px
                settings: {
                    slidesToShow: 2,   // Menampilkan 2 slide
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 768,   // Untuk layar <= 768px
                settings: {
                    slidesToShow: 1,   // Menampilkan 1 slide
                    slidesToScroll: 1
                }
            }
        ]
        });
    });


