<template>
    <footer class="footer footer-2">
        <div class="footer-middle" :class="{'border-0': $route.path=='/'}">
            <div :class="isFullwidth ? 'container-fluid' : 'container'">
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <div class="widget widget-about">
                            <img
                                v-lazy="'./images/logo-footer.png'"
                                class="footer-logo bg-transparent"
                                alt="Footer Logo"
                                width="104"
                                height="24"
                            />
                            <p>Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</p>

                            <div class="widget-about-info">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4">
                                        <span class="widget-about-title">Got Question? Call us 24/7</span>
                                        <a href="tel:123456789">+0123 456 789</a>
                                    </div>

                                    <div class="col-sm-6 col-md-8">
                                        <span class="widget-about-title">Payment Method</span>
                                        <figure class="footer-payments">
                                            <img
                                                v-lazy="'./images/payments.png'"
                                                alt="Payment methods"
                                                class="bg-transparent"
                                                width="272"
                                                height="20"
                                            />
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-2">
                        <div class="widget">
                            <h4 class="widget-title">Information</h4>

                            <ul class="widget-list">
                                <li>
                                    <nuxt-link :to='localePath("/pages/about")'>About Molla</nuxt-link>
                                </li>
                                <li>
                                    <a href="#">How to shop on Molla</a>
                                </li>
                                <li>
                                    <a href="#">FAQ</a>
                                </li>
                                <li>
                                    <nuxt-link :to='localePath("/pages/contact")'>Contact us</nuxt-link>
                                </li>
                                <li>
                                    <nuxt-link :to='localePath("/pages/login")'>Log in</nuxt-link>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-2">
                        <div class="widget">
                            <h4 class="widget-title">Customer Service</h4>

                            <ul class="widget-list">
                                <li>
                                    <a href="#">Payment Methods</a>
                                </li>
                                <li>
                                    <a href="#">Money-back guarantee!</a>
                                </li>
                                <li>
                                    <a href="#">Returns</a>
                                </li>
                                <li>
                                    <a href="#">Shipping</a>
                                </li>
                                <li>
                                    <a href="#">Terms and conditions</a>
                                </li>
                                <li>
                                    <a href="#">Privacy Policy</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-2">
                        <div class="widget">
                            <h4 class="widget-title">My Account</h4>

                            <ul class="widget-list">
                                <li>
                                    <a href="#">Sign In</a>
                                </li>
                                <li>
                                    <nuxt-link :to='localePath("/shop/cart")'>View Cart</nuxt-link>
                                </li>
                                <li>
                                    <nuxt-link :to='localePath("/shop/wishlist")'>My Wishlist</nuxt-link>
                                </li>
                                <li>
                                    <nuxt-link :to='localePath("/shop/dashboard")'>Track My Order</nuxt-link>
                                </li>
                                <li>
                                    <a href="#">Help</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div :class="isFullwidth ? 'container-fluid' : 'container'" class="pb-2 pt-2">
                <p
                    class="footer-copyright"
                >Copyright © {{ new Date().getFullYear() }} Molla Store. All Rights Reserved.</p>

                <ul class="footer-menu">
                    <li>
                        <a href="#">Terms Of Use</a>
                    </li>
                    <li>
                        <a href="#">Privacy Policy</a>
                    </li>
                </ul>

                <div class="social-icons social-icons-color">
                    <span class="social-label">Social Media</span>
                    <a
                        href="#"
                        class="social-icon social-facebook"
                        title="Facebook"
                        target="_blank"
                    >
                        <i class="icon-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank">
                        <i class="icon-twitter"></i>
                    </a>
                    <a
                        href="#"
                        class="social-icon social-instagram"
                        title="Instagram"
                        target="_blank"
                    >
                        <i class="icon-instagram"></i>
                    </a>
                    <a href="#" class="social-icon social-youtube" title="Youtube" target="_blank">
                        <i class="icon-youtube"></i>
                    </a>
                    <a
                        href="#"
                        class="social-icon social-pinterest"
                        title="Pinterest"
                        target="_blank"
                    >
                        <i class="icon-pinterest"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="mb-10" v-if="bottomSticky"></div>
	</footer>
</template>

<script>
export default {
    data: function () {
        return {
            bottomSticky: false
        }
    },
    computed: {
        isFullwidth: function() {
            return this.$route.path.includes('fullwidth');
        }
    },
    watch: {
        $route: function () {
            this.handleBottomSticky();
        }
    },
    mounted: function() {
        this.handleBottomSticky();
        window.addEventListener('resize', this.handleBottomSticky, {passive: true});
    },
    destroyed: function () {
        window.removeEventListener('resize', this.handleBottomSticky);
    },
    methods: {
        handleBottomSticky: function () {
            this.bottomSticky = this.$route.path.includes('/product/default') && (window.innerWidth > 991);
        }
    }
};
</script>