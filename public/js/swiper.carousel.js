var swiper = new Swiper(".mySwiper", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    coverflowEffect: {
      rotate: 50,
      stretch: 0,
      depth: 100,
      modifier: 1,
      slideShadows: true,
      
      slidesPerView: 1,
      spaceBetween: 10,
    },
    loop: true,
    pagination: {
      el: ".swiper-pagination",

      clickable: true,
    },

    breakpoints: {

        320: {
            slidesPerView: 1,
            spaceBetween: 10
        },

        480: {
            slidesPerView: 2,
            spaceBetween: 20
        },

        640: {
            slidesPerView: 3,
            spaceBetween: 30
        }
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },

    
  });

  

  var swiper = new Swiper('.swiper-container', {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });









