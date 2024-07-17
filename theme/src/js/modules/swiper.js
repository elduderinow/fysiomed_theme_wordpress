import Swiper from 'swiper/bundle';

const proto = {
    swiperContainers: [...document.getElementsByClassName('swiper-container')],
    checkFullWidth: (el, ratio) => {
        let fullWidth = el.getAttribute('data-size');
        if (fullWidth === 'true') {
            return 1;
        }
        if (el.classList.contains('image') && !el.classList.contains('single')) {
            return ratio;
        }
        return 'auto';
    },
    init () {
        proto.swiperContainers.forEach(container => {
            if (container.classList.contains('gallery') || container.classList.contains('gallery-thumbs')) {
                const galleryThumbs = new Swiper('.gallery-thumbs', {
                    spaceBetween: 10,
                    slidesPerView: 5,
                    freeMode: true,
                    watchSlidesProgress: true
                });

                const _ = new Swiper('.gallery', {
                    spaceBetween: 10,
                    thumbs: {
                        swiper: galleryThumbs
                    }
                });
            } else {
                const swiper = new Swiper(container, {
                    speed: 600,
                    autoplay: false,
                    grabCursor: true,
                    centeredSlides: false,
                    spaceBetween: 20,
                    navigation: (function () {
                        if (container.getElementsByClassName('swiper-button-next')[0] || container.getElementsByClassName('swiper-button-prev')[0]) {
                            return {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev'
                            };
                        }
                        return false;
                    }()),
                    loop: true,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                        dynamicBullets: false
                    },
                    // direction: 'horizontal', // Set the direction to horizontal
                    // mousewheel: {
                    //     forceToAxis: true,  // Force horizontal scroll on trackpad
                    // },
                    breakpoints: {
                        0: {
                            slidesPerView: 1.4
                        },
                        640: {
                            slidesPerView: 2.4
                        },
                        1024: {
                            slidesPerView: 3.4
                        }
                    }
                });
            }
        });
    }
};

export default Object.create(proto);
