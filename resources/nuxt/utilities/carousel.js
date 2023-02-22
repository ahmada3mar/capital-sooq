export const carouselSettingDefault = {
    loop: true,
    scrollbar: {
        draggable: true
    },
    spaceBetween: 20,
    slidesPerView: 4,
};

export const carouselSettingSingle = {
    loop: true,
    scrollbar: {
        draggable: false,
    },
    spaceBetween: 0,
    slidesPerView: 1,
}

export const carouselSetting1 = {
    ...carouselSettingDefault,

    breakpoints: {
        768: {
            slidesPerView: 2
        },
        992: {
            slidesPerView: 3
        }
    }
};