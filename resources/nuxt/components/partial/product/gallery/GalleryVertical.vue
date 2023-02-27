<template>
    <div class="product-gallery product-gallery-vertical" v-if="product">
        <div class="row m-0">
            <figure class="product-main-image">
                <span class="product-label label-new" v-if="product.new">{{ $t('New') }} </span>
                <span class="product-label label-sale" v-if="product.sale_price">{{ $t('Sale') }}</span>
                <span class="product-label label-top" v-if="product.top">{{ $t('Top') }}</span>
                <span class="product-label label-out" v-if="product.stock === 0">{{ $t('Out Of Stock') }}</span>
                <img
                    id="product-zoom"
                    v-lazy="`${product.pictures[currentIndex].url}`"
                    alt="product"
                    :width="product.pictures[currentIndex].width"
                    :height="product.pictures[currentIndex].height"
                />

                <a
                    href="#"
                    id="btn-product-gallery"
                    class="btn-product-gallery"
                    @click.prevent="openLightBox"
                >
                    <i class="icon-arrows"></i>
                </a>
            </figure>

            <div id="product-zoom-gallery" class="product-image-gallery">
                <a
                    class="product-gallery-item h-100 h-lg-auto carousel-dot"
                    :class="{active: currentIndex== index}"
                    href="#"
                    v-for="(smPicture, index) in product.sm_pictures"
                    :key="index"
                    @click.prevent="changePicture(index)"
                >
                    <img
                        :src="`${smPicture.url}`"
                        :width="smPicture.width"
                        :height="smPicture.height"
                        alt="product side"
                    />
                </a>
            </div>

            <light-box
                ref="lightbox"
                class="light-box"
                :media="lightBoxMedia"
                :show-caption="true"
                :show-light-box="false"
            ></light-box>
        </div>
    </div>
</template>
<script>
import LightBox from 'vue-image-lightbox';

import { VueLazyloadImage } from 'vue-lazyload';
import 'vue-image-lightbox/dist/vue-image-lightbox.min.css';
import { baseUrl } from '~/repositories/repository.js';

export default {
    components: {
        LightBox
    },
    props: {
        product: {
            type: Object,
            default: function() {
                return {
                    sm_pictures: [],
                    pictures: []
                };
            }
        }
    },
    data: function() {
        return {
            baseUrl: baseUrl,
            currentIndex: 0
        };
    },
    computed: {
        lightBoxMedia: function() {
            return this.product.pictures.reduce((acc, cur) => {
                return [
                    ...acc,
                    {
                        thumb: `${cur.url}`,
                        src: `${cur.url}`,
                        caption: this.product.name
                    }
                ];
            }, []);
        }
    },
    methods: {
        changePicture: function(index) {
            this.currentIndex = index;
        },
        openLightBox: function() {
            this.$refs.lightbox.showImage(this.currentIndex);
        }
    }
};
</script>
