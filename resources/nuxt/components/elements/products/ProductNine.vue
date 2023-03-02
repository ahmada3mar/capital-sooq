<template>
    <div class="product product-7 text-center">
        <figure class="product-media">
            <span class="product-label label-new" v-if="product.new">New</span>
            <span class="product-label label-sale" v-if="product.sale_price">Sale</span>
            <span class="product-label label-top" v-if="product.top">Top</span>
            <span class="product-label label-top" v-if="product.digital">Digital</span>
            <span class="product-label label-out" v-if="product.stock == 0 && !product.digital">Out Of Stock</span>

            <nuxt-link :to="'/product/default/' + product.id">
                <img v-lazy="`${product.galleries[0].image}`" height="100" width="100" alt="Product" class="product-image" />
                <img v-lazy="`${product.galleries[1].image}`"  height="100" width="100" alt="Product" class="product-image-hover"
                    v-if="product.galleries[1]" />
            </nuxt-link>
            <nuxt-link :to="{ path: '/shop/organization/list', query: { category: product.category.id } }">
                <div class="product-cat bg-primary text-white py-1">
                    <span>
                        By {{ product.organization.name }}
                    </span>
                </div>
            </nuxt-link>

            <div class="product-action-vertical" v-if="product.stock != 0 || product.digital">
                <nuxt-link to="/shop/wishlist" class="btn-product-icon btn-wishlist btn-expandable added-to-wishlist"
                    v-if="isInWishlist(product)" key="inWishlist">
                    <span>go to wishlist</span>
                </nuxt-link>
                <a href="javascript:;" class="btn-product-icon btn-wishlist btn-expandable"
                    @click.prevent="addToWishlist({ product: product })" v-else key="notInWishlist">
                    <span>add to wishlist</span>
                </a>
                <a href="javascript:;" class="btn-product-icon btn-quickview" title="Quick view"
                    @click.prevent="quickView({ product: product })">
                    <span>Quick view</span>
                </a>
                <a href="javascript:;" class="btn-product-icon btn-compare added-to-compare" title="Compare"
                    v-if="isInCompare(product)" key="inCompare">
                    <span>Compare</span>
                </a>
                <a href="#" class="btn-product-icon btn-compare" title="Compare"
                    @click.prevent="addToCompare({ product: product })" v-else key="notInCompare">
                    <span>Compare</span>
                </a>
            </div>

            <div class="product-action" v-if="product.stock !== 0 || product.digital">
                <nuxt-link :to="'/product/default/' + product.id" class="btn btn-product btn-cart btn-select"
                    v-if="product.attributes.length > 0">
                    <span>select options</span>
                </nuxt-link>
                <a href="javascript:;" class="btn btn-product btn-cart" @click.prevent="addToCart({ product: product })"
                    v-else>
                    <span>add to cart</span>
                </a>
            </div>
        </figure>

        <div class="product-body">
            <div class="product-cat">
                <span>
                    <nuxt-link :to="{ path: '/shop/sidebar/list', query: { category: product.category.id } }">{{
                        product.category.name }}</nuxt-link>
                </span>
            </div>
            <h3 class="product-title">
                <nuxt-link :to="'/product/default/' + product.id">{{ product.name }}</nuxt-link>
            </h3>

            <div class="product-price" v-if="product.stock == 0 && !product.digital" key="outPrice">
                <span class="out-price">${{ product.price.toFixed(2) }}</span>
            </div>

            <template v-else>
                <template>
                    <div class="product-price mb-0">{{ product.price }} {{ product.organization.currency }}</div>
                </template>
            </template>




            <div class="ratings-container">
                <div class="ratings">
                    <div class="ratings-val" :style="{ width: product.ratings * 20 + '%' }"></div>
                    <span class="tooltip-text">{{ 4 }}</span>
                </div>
                <span class="ratings-text">( {{ product.review }} Reviews )</span>
            </div>

            <div class="product-nav product-nav-dots" v-if="product.attributes.length > 0">
                <div class="row no-gutters">
                    <a href="javascript:;" :style="{ 'background-color': item.color }"
                        v-for="(item, index) in product.attributes" :key="index">
                        <span class="sr-only">Color name</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex';
import { baseUrl } from '~/repositories/repository';
export default {
    props: {
        product: Object
    },
    data: function () {
        return {
            baseUrl: baseUrl,
            maxPrice: 0,
            minPrice: 99999
        };
    },
    computed: {
        ...mapGetters('cart', ['canAddToCart']),
        ...mapGetters('wishlist', ['isInWishlist']),
        ...mapGetters('compare', ['isInCompare'])
    },

    created: function () {
        let min = this.minPrice;
        let max = this.maxPrice;
        this.product.attributes.map(item => {
            if (min > item.price) min = item.price;
            if (max < item.price) max = item.price;
        }, []);

        if (this.product.attributes.length == 0) {
            min = this.product.sale_price
                ? this.product.sale_price
                : this.product.price;
            max = this.product.price;
        }

        this.minPrice = min;
        this.maxPrice = max;
    },
    methods: {
        ...mapActions('cart', ['addToCart']),
        ...mapActions('wishlist', ['addToWishlist']),
        ...mapActions('compare', ['addToCompare']),
        quickView: function () {
            this.$modal.show(
                () => import('~/components/elements/modals/QuickViewModal'),
                {
                    product: this.product
                },
                { width: '1030', height: 'auto', adaptive: true }
            );
        }
    },
    mounted() {
        console.log(this.product.price.toFixed(2))
    }
};
</script>
