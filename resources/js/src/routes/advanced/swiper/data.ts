import {
    Autoplay,
    EffectCreative,
    EffectFade,
    EffectFlip,
    Mousewheel,
    Navigation,
    Pagination,
    Scrollbar
} from 'swiper/modules';
import type {SwiperOptions} from "swiper/types";

export const defaultOptions: SwiperOptions = {
    modules: [Autoplay],
    loop: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
}


export const navigationAndPaginationOptions: SwiperOptions = {
    modules: [Autoplay, Navigation, Pagination],
    loop: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        clickable: true,
        el: ".swiper-pagination",
    }
}
export const paginationOptions: SwiperOptions = {
    modules: [Autoplay, Pagination],
    loop: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    pagination: {
        clickable: true,
        el: ".swiper-pagination",
        dynamicBullets: true,
    },
}

export const effectFadeOptions: SwiperOptions = {
    modules: [Autoplay, Pagination, EffectFade],
    loop: true,
    effect: "fade",
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
}

export const effectCreativeOptions: SwiperOptions = {
    modules: [Autoplay, Pagination, EffectCreative],
    loop: true,
    grabCursor: true,
    effect: "creative",
    creativeEffect: {
        prev: {
            shadow: true,
            translate: [0, 0, -400],
        },
        next: {
            translate: ["100%", 0, 0],
        },
    },
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
}

export const effectFlipOptions: SwiperOptions = {
    modules: [Autoplay, Pagination, EffectFlip],
    loop: true,
    effect: "flip",
    grabCursor: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
}

export const scrollbarOptions: SwiperOptions = {
    modules: [Autoplay, Navigation, Scrollbar],
    loop: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    scrollbar: {
        el: ".swiper-scrollbar",
        hide: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    }
}

export const verticalOptions: SwiperOptions = {
    modules: [Autoplay, Pagination],
    loop: true,
    direction: "vertical",
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
}
export const mousewheelOptions: SwiperOptions = {
    modules: [Autoplay, Pagination, Mousewheel],
    loop: true,
    direction: "vertical",
    mousewheel: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
}

export const responsiveOptions: SwiperOptions = {
    modules: [Autoplay, Pagination],
    loop: true,
    slidesPerView: 1,
    spaceBetween: 10,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        768: {
            slidesPerView: 2,
            spaceBetween: 40,
        },
        1200: {
            slidesPerView: 3,
            spaceBetween: 50,
        },
    },
}