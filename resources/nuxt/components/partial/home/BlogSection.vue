<template>
    <div class="blog-posts">
        <div class="container">
            <h2 class="title text-center">From Our Blog</h2>
            <div class="swiper-carousel carousel-with-shadow swiper-blog">
                <div class="mb-0" v-swiper:swiper1="carouselSetting">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" v-for="(blog, index) in blogs" :key="index">
                            <blog-four :blog="blog")' class="mb-2"></blog-four>
                        </div>
                    </div>
                </div>
                <div class="swiper-dots swiper-dots-inner d-block d-sm-none"></div>
            </div>

            <div class="more-container text-center">
                <nuxt-link :to='localePath("/blog/classic")' class="btn btn-outline-darker btn-more">
                    <span>View more articles</span>
                    <i class="icon-long-arrow-right"></i>
                </nuxt-link>
            </div>
        </div>
    </div>
</template>
<script>
import BlogFour from '~/components/elements/blogs/BlogFour';
import { carouselSettingDefault } from '~/utilities/carousel';

export default {
    components: {
        BlogFour
    },
    props: {
        blogs: Array
    },
    data: function() {
        return {
            carouselSetting: {
                ...carouselSettingDefault,
                slidesPerView: 3,
                breakpoints: {
                    480: {
                        slidesPerView: 1
                    },
                    768: {
                        slidesPerView: 2
                    },
                    992: {
                        slidesPerView: 3
                    }
                },
                pagination: {
                    el: '.blog-posts .swiper-dots',
                    clickable: true
                }
            }
        };
    }
};
</script>