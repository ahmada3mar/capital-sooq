<template>
    <div class="container special-collection">
        <tabs
            class="nav nav-pills nav-border-anim nav-big justify-content-center mb-3"
            :data="tabsData"
            id="tab1"
        ></tabs>

        <div class="tab-content tab-content-carousel">
            <div class="tab-pane fade show active" id="tab1-featured">
                <div class="swiper-carousel carousel-with-shadow swiper-1">
                    <div class="mb-0" v-swiper:swiper1="carouselSetting1">
                        <div class="swiper-wrapper">
                            <div
                                class="swiper-slide"
                                v-for="(product, index) in featuredProducts"
                                :key="index"
                            >
                                <product-twelve :product="product"></product-twelve>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-dots swiper-dots-inner d-lg-none"></div>
                </div>
            </div>

            <div class="tab-pane fade" id="tab1-on-sale">
                <div class="swiper-carousel carousel-with-shadow swiper-2">
                    <div class="mb-0" v-swiper:swiper2="carouselSetting2">
                        <div class="swiper-wrapper">
                            <div
                                class="swiper-slide"
                                v-for="(product, index) in saleProducts"
                                :key="index"
                            >
                                <product-twelve :product="product"></product-twelve>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="tab1-top-rated">
                <div class="swiper-carousel carousel-with-shadow swiper-3">
                    <div class="mb-0" v-swiper:swiper3="carouselSetting3">
                        <div class="swiper-wrapper">
                            <div
                                class="swiper-slide"
                                v-for="(product, index) in ratedProducts"
                                :key="index"
                            >
                                <product-twelve :product="product"></product-twelve>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-dots swiper-dots-inner d-md-none"></div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Tabs from '~/components/elements/Tabs';
import ProductTwelve from '~/components/elements/products/ProductTwelve';

import { attrFilter } from '~/utilities/common';
import { carouselSetting1 } from '~/utilities/carousel';

export default {
    components: {
        Tabs,
        ProductTwelve
    },
    props: {
        products: Array
    },
    data: function() {
        return {
            tabsData: [
                {
                    id: 'featured',
                    title: this.$t('Featured'),
                    active: true
                },
                {
                    id: 'on-sale',
                    title: this.$t('On Sale')
                },
                {
                    id: 'top-rated',
                    title: this.$t('Top Rated')
                }
            ],
            carouselSetting1: {
                ...carouselSetting1,
                slidesPerView: 4,
                pagination: {
                    el: '.special-collection .swiper-1 .swiper-dots',
                    clickable: true
                }
            },
            carouselSetting2: {
                ...carouselSetting1,
                slidesPerView: 4,
                pagination: {
                    el: '.special-collection .swiper-2 .swiper-dots',
                    clickable: true
                }
            },
            carouselSetting3: {
                ...carouselSetting1,
                slidesPerView: 4,
                pagination: {
                    el: '.special-collection .swiper-3 .swiper-dots',
                    clickable: true
                }
            }
        };
    },
    computed: {
        featuredProducts: function() {
            return attrFilter(this.products, 'featured');
        },
        ratedProducts: function() {
            return attrFilter(this.products, 'rated');
        },
        saleProducts: function() {
            return attrFilter(this.products, 'sale');
        }
    }
};
</script>
