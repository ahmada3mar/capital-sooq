<template>
    <main class="main">
        <page-header title="Wishlist" subtitle="Shop"></page-header>
        <nav class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <nuxt-link :to='localePath("/")'>{{ $t('Home') }}</nuxt-link>
                    </li>
                    <li class="breadcrumb-item">
                        <nuxt-link :to='localePath("/shop/sidebar/list")'>{{ $t('Shop') }}</nuxt-link>
                    </li>
                    <li class="breadcrumb-item active">{{ $t('Wishlist') }}</li>
                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="container" v-if="wishItems.length > 0" key="hasWishlist">
                <table class="table table-wishlist table-mobile">
                    <thead>
                        <tr>
                            <th>{{ $t('Product') }}</th>
                            <th>{{ $t('Price') }}</th>
                            <th>{{ $t('Stock Status') }}</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="(product, index) in wishItems" :key="index">
                            <td class="product-col">
                                <div class="product">
                                    <figure class="product-media">
                                        <nuxt-link :to="'/product/default/' + product.slug">
                                            <img
                                                v-lazy="`${product.sm_pictures[0].url}`"
                                                alt="Product"
                                                :width="product.sm_pictures[0].width"
                                                :height="product.sm_pictures[0].height"
                                            />
                                        </nuxt-link>
                                    </figure>

                                    <h3 class="product-title">
                                        <nuxt-link
                                            :to="'/product/default/' + product.slug"
                                        >{{ product.name }}</nuxt-link>
                                    </h3>
                                </div>
                            </td>
                            <td
                                class="price-col"
                            >
                                <div class="product-price mb-0" v-if="product.stock==0" key="outPrice">
                                    <span class="out-price">${{ product.price.toFixed(2) }}</span>
                                </div>

                                <template v-else>
                                    <div class="product-price d-inline-block mb-0" v-if="product.minPrice == product.maxPrice">${{ product.minPrice.toFixed(2) }}</div>
                                    <template v-else>
                                        <div class="product-price d-inline-block mb-0" v-if="product.variants.length == 0">
                                            <span class="new-price">${{ product.minPrice.toFixed(2) }}</span>
                                            <span class="old-price">${{ product.maxPrice.toFixed(2) }}</span>
                                        </div>
                                        <div
                                            class="product-price d-inline-block mb-0"
                                            v-else
                                        >${{product.minPrice.toFixed(2)}}&ndash;${{product.maxPrice.toFixed(2)}}</div>
                                    </template>
                                </template>
                            </td>
                            <td class="stock-col">
                                <span
                                    :class="product.stock && product.stock == 0 ? 'out-of-stock' : 'in-stock'"
                                >{{ product.stock && product.stock == 0 ? 'Out of stock' : 'In stock' }}</span>
                            </td>
                            <td class="action-col">
                                <div class="dropdown">
                                    <nuxt-link
                                        class="btn btn-block btn-outline-primary-2"
                                        :to="'/product/default/' + product.slug"
                                        v-if="product.variants.length > 0"
                                    >
                                        <i class="icon-list-alt"></i>{{ $t('Select Options') }}
                                    </nuxt-link>
                                    <button
                                        class="btn btn-block btn-outline-primary-2"
                                        @click.prevent="moveToCart({product: product})"
                                        v-else
                                    >
                                        <i class="icon-cart-plus"></i>Add to Cart
                                    </button>
                                </div>
                            </td>
                            <td class="remove-col">
                                <button
                                    class="btn-remove"
                                    @click.prevent="removeFromWishlist({product: product})"
                                >
                                    <i class="icon-close"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="wishlist-share">
                    <div class="social-icons social-icons-sm mb-2">
                        <label class="social-label">{{ $t('Share on') }}:</label>
                        <a href="#" class="social-icon" title="Facebook" target="_blank">
                            <i class="icon-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon" title="Twitter" target="_blank">
                            <i class="icon-twitter"></i>
                        </a>
                        <a href="#" class="social-icon" title="Instagram" target="_blank">
                            <i class="icon-instagram"></i>
                        </a>
                        <a href="#" class="social-icon" title="Youtube" target="_blank">
                            <i class="icon-youtube"></i>
                        </a>
                        <a href="#" class="social-icon" title="Pinterest" target="_blank">
                            <i class="icon-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="container" v-else key="noWishlist">
                <div class="text-center">
                    <i class="icon-heart-o wishlist-empty d-block"></i>
                    <span class="d-block mt-2">{{ $t('No products added to wishlist') }}</span>
                    <nuxt-link :to='localePath("/shop/sidebar/list")' class="btn btn-primary mt-2">{{ $t('Go to Shop') }}</nuxt-link>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import { mapGetters, mapActions } from 'vuex';
import PageHeader from '~/components/elements/PageHeader';
import { baseUrl } from '~/repositories/repository.js';

export default {
    components: {
        PageHeader
    },
    data: function() {
        return {
            baseUrl: baseUrl
        };
    },
    computed: {
        ...mapGetters('wishlist', ['wishlistQty', 'wishlist']),
        wishItems: function () {
            return this.wishlist.reduce((acc, product) => {
                    let max = 0;
                    let min = 999999;
                    product.variants.map(item => {
                        if (min > item.price) min = item.price;
                        if (max < item.price) max = item.price;
                    }, []);

                    if (product.variants.length == 0) {
                        min = product.sale_price
                            ? product.sale_price
                            : product.price;
                        max = product.price;
                    }

                    return [
                        ...acc,
                        {
                            ...product,
                            minPrice: min,
                            maxPrice: max
                        }
                    ]
            }, []);
        }
    },
    methods: {
        ...mapActions('wishlist', ['removeFromWishlist', 'moveToCart'])
    }
};
</script>
