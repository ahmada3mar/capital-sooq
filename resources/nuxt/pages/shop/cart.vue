<template>
    <main class="main">
        <page-header title="Shopping Cart" subtitle="Shop"></page-header>
        <nav class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <nuxt-link :to='localePath("/")'>Home</nuxt-link>
                    </li>
                    <li class="breadcrumb-item">
                        <nuxt-link :to='localePath("/shop/sidebar/list")'>Shop</nuxt-link>
                    </li>
                    <li class="breadcrumb-item active">Shopping Cart</li>
                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="cart">
                <div class="container">
                    <div class="row" v-if="cartList.length > 0" key="hasCart">
                        <div class="col-lg-9">
                            <table class="table table-cart table-mobile">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(product, index) in cartItems" :key="index">
                                        <td class="product-col">
                                            <div class="product">
                                                <figure class="product-media">
                                                    <nuxt-link
                                                        :to="'/product/default/' + product.slug"
                                                    >
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
                                        <td class="price-col">${{ product.price.toFixed(2) }}</td>
                                        <td class="quantity-col">
                                            <quantity-input
                                                :product="product"
                                                @change-qty="changeQty"
                                                class="cart-product-quantity"
                                            ></quantity-input>
                                        </td>
                                        <td class="total-col">${{ product.sum.toFixed(2) }}</td>
                                        <td class="remove-col">
                                            <button
                                                @click.prevent="removeFromCart({product: product})"
                                                class="btn-remove"
                                            >
                                                <i class="icon-close"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="cart-bottom">
                                <div class="cart-discount">
                                    <form action="#">
                                        <div class="input-group">
                                            <input
                                                type="text"
                                                class="form-control"
                                                required
                                                placeholder="coupon code"
                                            />
                                            <div class="input-group-append">
                                                <button
                                                    class="btn btn-outline-primary-2"
                                                    type="submit"
                                                >
                                                    <i class="icon-long-arrow-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <a
                                    href="#"
                                    class="btn btn-outline-dark-2"
                                    @click.prevent="updateCart({cartItems: cartItems})"
                                >
                                    <span>UPDATE CART</span>
                                    <i class="icon-refresh"></i>
                                </a>
                            </div>
                        </div>

                        <aside class="col-lg-3">
                            <div class="summary summary-cart">
                                <h3 class="summary-title">Cart Total</h3>

                                <table class="table table-summary">
                                    <tbody>
                                        <tr class="summary-subtotal">
                                            <td>Subtotal:</td>
                                            <td>${{ priceTotal.toFixed(2) }}</td>
                                        </tr>

                                        <tr class="summary-shipping">
                                            <td>Shipping:</td>
                                            <td>&nbsp;</td>
                                        </tr>

                                        <tr class="summary-shipping-row">
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input
                                                        type="radio"
                                                        id="free-shipping"
                                                        name="shipping"
                                                        v-model="shipping"
                                                        :value="0"
                                                        class="custom-control-input"
                                                    />
                                                    <label
                                                        class="custom-control-label"
                                                        for="free-shipping"
                                                    >Free Shipping</label>
                                                </div>
                                            </td>
                                            <td>$0.00</td>
                                        </tr>

                                        <tr class="summary-shipping-row">
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input
                                                        type="radio"
                                                        id="standart-shipping"
                                                        name="shipping"
                                                        class="custom-control-input"
                                                        v-model="shipping"
                                                        :value="10"
                                                    />
                                                    <label
                                                        class="custom-control-label"
                                                        for="standart-shipping"
                                                    >Standard:</label>
                                                </div>
                                            </td>
                                            <td>$10.00</td>
                                        </tr>

                                        <tr class="summary-shipping-row">
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input
                                                        type="radio"
                                                        id="express-shipping"
                                                        name="shipping"
                                                        class="custom-control-input"
                                                        v-model="shipping"
                                                        :value="20"
                                                    />
                                                    <label
                                                        class="custom-control-label"
                                                        for="express-shipping"
                                                    >Express:</label>
                                                </div>
                                            </td>
                                            <td>$20.00</td>
                                        </tr>

                                        <tr class="summary-shipping-estimate">
                                            <td>
                                                Estimate for Your Country
                                                <br />
                                                <nuxt-link :to='localePath("/shop/dashboard")'>Change address</nuxt-link>
                                            </td>
                                            <td>&nbsp;</td>
                                        </tr>

                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td>${{ (priceTotal + shipping).toFixed(2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <nuxt-link
                                    to="/shop/checkout"
                                    class="btn btn-outline-primary-2 btn-order btn-block"
                                >PROCEED TO CHECKOUT</nuxt-link>
                            </div>

                            <nuxt-link
                                to="/shop/sidebar/list"
                                class="btn btn-outline-dark-2 btn-block mb-3"
                            >
                                <span>CONTINUE SHOPPING</span>
                                <i class="icon-refresh"></i>
                            </nuxt-link>
                        </aside>
                    </div>

                    <div class="row" v-else key="noCart">
                        <div class="col-12">
                            <div class="cart-empty-page text-center">
                                <i class="cart-empty icon-shopping-cart"></i>
                                <p class="px-3 py-2 cart-empty mb-3">No products added to the cart</p>
                                <p class="return-to-shop mb-0">
                                    <nuxt-link
                                        to="/shop/sidebar/list"
                                        class="btn btn-primary"
                                    >RETURN TO SHOP</nuxt-link>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import { mapGetters, mapActions, mapMutations } from 'vuex';
import PageHeader from '~/components/elements/PageHeader';
import QuantityInput from '~/components/elements/QuantityInput';
import { baseUrl } from '~/repositories/repository';

export default {
    components: {
        PageHeader,
        QuantityInput
    },
    data: function() {
        return {
            cartItems: [],
            baseUrl: baseUrl,
            shipping: 0
        };
    },
    computed: {
        ...mapGetters('cart', ['cartList', 'priceTotal', 'qtyTotal'])
    },
    watch: {
        cartList: function() {
            this.cartItems = [...this.cartList];
        }
    },
    created: function() {
        this.cartItems = [...this.cartList];
    },
    methods: {
        ...mapActions('cart', ['removeFromCart']),
        ...mapActions('cart', ['updateCart']),
        changeQty: function(value, product) {
            this.cartItems = this.cartItems.reduce((acc, cur) => {
                if (cur.name == product.name)
                    return [
                        ...acc,
                        {
                            ...cur,
                            qty: value,
                            sum:
                                (product.sale_price
                                    ? product.sale_price
                                    : product.price) * value
                        }
                    ];
                return [...acc, cur];
            }, []);
        }
    }
};
</script>
