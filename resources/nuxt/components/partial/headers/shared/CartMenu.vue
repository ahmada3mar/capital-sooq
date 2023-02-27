<template>
    <div class="dropdown cart-dropdown">
        <nuxt-link :to='localePath("/shop/cart")' class="dropdown-toggle">
            <i class="icon-shopping-cart"></i>
            <span class="cart-count">{{ qtyTotal }}</span>
            <span class="cart-txt">$ {{ priceTotal.toFixed(2) }}</span>
        </nuxt-link>

        <div class="dropdown-menu dropdown-menu-right" v-if="cartList.length > 0" key="hasCart">
            <div class="dropdown-cart-products">
                <div class="product" v-for="(product, index) in cartList" :key="index">
                    <div class="product-cart-details">
                        <h4 class="product-title">
                            <nuxt-link :to="'/product/default/' + product.slug">{{ product.name }}</nuxt-link>
                        </h4>

                        <span class="cart-product-info">
                            <span class="cart-product-qty">{{ product.qty }}</span>
                            x ${{ product.sale_price ? product.sale_price.toFixed(2): product.price.toFixed(2) }}
                        </span>
                    </div>

                    <figure class="product-image-container">
                        <nuxt-link :to="'/product/default/' + product.slug" class="product-image">
                            <img
                                v-lazy="`${product.sm_pictures[0].url}`"
                                alt="product"
                                :width="product.sm_pictures[0].width"
                                :height="product.sm_pictures[0].height"
                            />
                        </nuxt-link>
                    </figure>
                    <a
                        href="#"
                        class="btn-remove"
                        title="Remove Product"
                        @click.prevent="removeFromCart({product: product})"
                    >
                        <i class="icon-close"></i>
                    </a>
                </div>
            </div>

            <div class="dropdown-cart-total">
                <span>{{ $t('Total') }} </span>

                <span class="cart-total-price">${{ priceTotal.toFixed(2) }}</span>
            </div>

            <div class="dropdown-cart-action">
                <nuxt-link :to='localePath("/shop/cart")' class="btn btn-primary">{{ $t('View Cart') }}</nuxt-link>
                <nuxt-link :to='localePath("/shop/checkout")' class="btn btn-outline-primary-2">
                    <span>{{ $t('Checkout') }} </span>
                    <i class="icon-long-arrow-right"></i>
                </nuxt-link>
            </div>
        </div>
        <div class="dropdown-menu dropdown-menu-right" v-else key="noCart">
            <p class="text-center">{{ $t('No products in the cart.') }}</p>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex';
import { baseUrl } from '~/repositories/repository';

export default {
    data: function() {
        return {
            baseUrl: baseUrl
        };
    },
    computed: {
        ...mapGetters('cart', ['cartList', 'priceTotal', 'qtyTotal'])
    },
    methods: {
        ...mapActions('cart', ['removeFromCart'])
    }
};
</script>
