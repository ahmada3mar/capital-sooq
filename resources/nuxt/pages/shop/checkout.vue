<template>
    <main class="main">
        <page-header title="Checkout" subtitle="Shop"></page-header>
        <nav class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <nuxt-link :to='localePath("/")'>{{ $t('Home') }}</nuxt-link>
                    </li>
                    <li class="breadcrumb-item">
                        <nuxt-link :to='localePath("/shop/sidebar/list")'>{{ $t('Shop') }}</nuxt-link>
                    </li>
                    <li class="breadcrumb-item active">{{ $t('home') }}</li>
                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="checkout">
                <div class="container">
                    <div class="checkout-discount">
                        <form action="#">
                            <input
                                type="text"
                                class="form-control"
                                required
                                id="checkout-discount-input"
                                @click="clickCoupon($event)"
                            />
                            <label for="checkout-discount-input" class="text-truncate">
                                {{ $t('Have a coupon?') }}
                                <span>{{ $t('Click here to enter your code') }}</span>
                            </label>
                        </form>
                    </div>

                    <form action="#">
                        <div class="row">
                            <div class="col-lg-9">
                                <h2 class="checkout-title">{{ $t('Billing Details') }}</h2>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>{{ $t('First Name') }} *</label>
                                        <input type="text" class="form-control" required />
                                    </div>

                                    <div class="col-sm-6">
                                        <label>{{ $t('ast Name') }}L *</label>
                                        <input type="text" class="form-control" required />
                                    </div>
                                </div>

                                <label>Company Name (Optional)</label>
                                <input type="text" class="form-control" />

                                <label>{{ $t('Country') }} *</label>
                                <input type="text" class="form-control" required />

                                <label>{{ $t('Street address') }} *</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    :placeholder="$t('House number and Street name')"
                                    required
                                />
                                <input
                                    type="text"
                                    class="form-control"
                                    :placeholder="$t('Appartments, suite, unit etc ...')"
                                    required
                                />

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>{{ $t('Town / City') }} *</label>
                                        <input type="text" class="form-control" required />
                                    </div>

                                    <div class="col-sm-6">
                                        <label>State / County *</label>
                                        <input type="text" class="form-control" required />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>{{ $t('Postcode / ZIP') }} *</label>
                                        <input type="text" class="form-control" required />
                                    </div>

                                    <div class="col-sm-6">
                                        <label>{{ $t('Phone') }} *</label>
                                        <input type="tel" class="form-control" required />
                                    </div>
                                </div>

                                <label>{{ $t('Email address') }} *</label>
                                <input type="email" class="form-control" required />

                                <div class="custom-control custom-checkbox">
                                    <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        id="checkout-create-acc"
                                    />
                                    <label
                                        class="custom-control-label"
                                        for="checkout-create-acc"
                                    >{{ $t('Create an account?') }}</label>
                                </div>

                                <div class="custom-control custom-checkbox">
                                    <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        id="checkout-diff-address"
                                    />
                                    <label
                                        class="custom-control-label"
                                        for="checkout-diff-address"
                                    >{{ $t('Ship to a different address?') }}</label>
                                </div>

                                <label>{{ $t('Order notes (optional)') }}</label>
                                <textarea
                                    class="form-control"
                                    cols="30"
                                    rows="4"
                                    placeholder="Notes about your order, e.g. special notes for delivery"
                                ></textarea>
                            </div>

                            <aside class="col-lg-3">
                                <div class="summary">
                                    <h3 class="summary-title">{{ $t('Your Order') }}</h3>

                                    <table class="table table-summary">
                                        <thead>
                                            <tr>
                                                <th>{{ $t('Product') }}</th>
                                                <th>{{ $t('Total') }}</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(product, index) in cartList" :key="index">
                                                <td>
                                                    <nuxt-link
                                                        :to="'/product/default/' + product.slug"
                                                    >{{ product.name }}</nuxt-link>
                                                </td>
                                                <td>${{ product.sum }}</td>
                                            </tr>

                                            <tr class="summary-subtotal">
                                                <td>{{ $t('Subtotal') }}:</td>
                                                <td>${{ priceTotal }}</td>
                                            </tr>

                                            <tr>
                                                <td>{{ $t('Shipping') }}:</td>
                                                <td>{{ $t('Free shipping') }}</td>
                                            </tr>
                                            <tr class="summary-total">
                                                <td>{{ $t('Total') }}:</td>
                                                <td>${{ priceTotal }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="accordion-summary">
                                        <div class="card">
                                            <div class="card-header">
                                                <h2 class="card-title">
                                                    <a
                                                        class="toggle-button"
                                                        :class="{expanded: toggleState[0], collapsed: !toggleState[0]}"
                                                        @click.prevent="changeToggle(0)"
                                                        href="#"
                                                    >{{ $t('Direct bank transfer') }}</a>
                                                </h2>
                                            </div>

                                            <vue-slide-toggle :open="toggleState[0]">
                                                <div
                                                    class="card-body"
                                                >{{ $t('Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.') }}</div>
                                            </vue-slide-toggle>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <h2 class="card-title">
                                                    <a
                                                        class="toggle-button"
                                                        :class="{expanded: toggleState[1], collapsed: !toggleState[1]}"
                                                        @click.prevent="changeToggle(1)"
                                                        href="#"
                                                    >{{ $t('Check payments') }}</a>
                                                </h2>
                                            </div>

                                            <vue-slide-toggle :open="toggleState[1]">
                                                <div
                                                    class="card-body"
                                                >Ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis.</div>
                                            </vue-slide-toggle>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <h2 class="card-title">
                                                    <a
                                                        class="toggle-button"
                                                        :class="{expanded: toggleState[2], collapsed: !toggleState[2]}"
                                                        @click.prevent="changeToggle(2)"
                                                        href="#"
                                                    >{{ $t('Cash on delivery') }}</a>
                                                </h2>
                                            </div>

                                            <vue-slide-toggle :open="toggleState[2]">
                                                <div
                                                    class="card-body"
                                                >Quisque volutpat mattis eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.</div>
                                            </vue-slide-toggle>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <h2 class="card-title">
                                                    <a
                                                        class="toggle-button"
                                                        :class="{expanded: toggleState[3], collapsed: !toggleState[3]}"
                                                        @click.prevent="changeToggle(3)"
                                                        href="#"
                                                    >
                                                    {{ $t('PayPal') }} 
                                                        <small
                                                            class="float-right paypal-link"
                                                        >What is PayPal?</small>
                                                    </a>
                                                </h2>
                                            </div>

                                            <vue-slide-toggle :open="toggleState[3]">
                                                <div
                                                    class="card-body"
                                                >Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum.</div>
                                            </vue-slide-toggle>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <h2 class="card-title">
                                                    <a
                                                        class="toggle-button"
                                                        :class="{expanded: toggleState[4], collapsed: !toggleState[4]}"
                                                        @click.prevent="changeToggle(4)"
                                                        href="#"
                                                    >
                                                    {{ $t('Credit Card') }} 
                                                        <img
                                                            v-lazy="'./images/payments-summary.png'"
                                                            alt="payments cards"
                                                            class="bg-white"
                                                        />
                                                    </a>
                                                </h2>
                                            </div>

                                            <vue-slide-toggle :open="toggleState[4]">
                                                <div
                                                    class="card-body"
                                                >Donec nec justo eget felis facilisis fermentum.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Lorem ipsum dolor sit ame.</div>
                                            </vue-slide-toggle>
                                        </div>
                                    </div>

                                    <button
                                        type="submit"
                                        class="btn btn-outline-primary-2 btn-order btn-block"
                                    >
                                        <span class="btn-text">{{ $t('Place Order') }}</span>
                                        <span class="btn-hover-text">{{ $t('Proceed to Checkout') }}</span>
                                    </button>
                                </div>
                            </aside>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import { mapGetters } from 'vuex';
import { VueSlideToggle } from 'vue-slide-toggle';
import PageHeader from '~/components/elements/PageHeader';

export default {
    components: {
        VueSlideToggle,
        PageHeader
    },
    data: function() {
        return {
            toggleState: [true, false, false, false, false]
        };
    },
    computed: {
        ...mapGetters('cart', ['cartList', 'priceTotal', 'qtyTotal'])
    },
    methods: {
        updateCart: function() {
            this.updateCart(this.cartItems);
        },
        clickCoupon(event) {
            event.currentTarget.parentElement.querySelector('label').style =
                'opacity: 0';
        },
        changeToggle: function(index1) {
            this.toggleState = this.toggleState.reduce((acc, cur, index) => {
                if (index == index1) return [...acc, !cur];
                return [...acc, false];
            }, []);
        }
    }
};
</script>