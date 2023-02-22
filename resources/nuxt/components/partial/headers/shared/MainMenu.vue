<template>
    <nav class="main-nav">
        <ul class="menu">
            <li class="megamenu-container" :class="{ active: current == '/' }">
                <nuxt-link :to="localePath('/')" class="sf-with-ul" >Home</nuxt-link>
            </li>
            <li :class="{ active: current == 'shop' }">
                <nuxt-link
                    :to="localePath('/shop/sidebar/4cols')"
                    class="sf-with-ul"
                    >Shop</nuxt-link>
            </li>
            <li :class="current == 'market' ? 'active' : '' ">
                <nuxt-link :to="localePath('/shop/market')" >CATEGORIES</nuxt-link>

                <ul>
                    <li class="ml-5 mb-1">Popular Categories</li>
                    <li>
                        <nuxt-link  to="/52222">Electric</nuxt-link>
                    </li>
                    <li>
                        <nuxt-link to="iii">Cars</nuxt-link>
                    </li>
                    <li>
                        <nuxt-link to="121">
                            <span>
                                Clothing
                                <span class="tip tip-new">New</span>
                            </span>
                        </nuxt-link>
                    </li>
                    <li>
                        <nuxt-link to="1111">Gallery</nuxt-link>
                    </li>
                    <li>
                        <nuxt-link to="1111">Accessories</nuxt-link>
                    </li>
                    <li>
                        <nuxt-link to="1111">Laptops</nuxt-link>
                    </li>
                    <li>
                        <nuxt-link to="1111">Computers</nuxt-link>
                    </li>
                    <li>
                        <nuxt-link to="1111">Mobiles</nuxt-link>
                    </li>
                </ul>
            </li>
            <!-- <li :class="{ active: current == 'pages' }">
                <a href="javascript:;" class="sf-with-ul">Pages</a>
                <ul>
                    <li>
                        <nuxt-link
                            :to="localePath('/pages/about')"
                            class="sf-with-ul"
                            >About</nuxt-link
                        >

                        <ul>
                            <li>
                                <nuxt-link :to="localePath('/pages/about')"
                                    >About 01</nuxt-link
                                >
                            </li>
                            <li>
                                <nuxt-link :to="localePath('/pages/about-2')"
                                    >About 02</nuxt-link
                                >
                            </li>
                        </ul>
                    </li>
                    <li>
                        <nuxt-link
                            :to="localePath('/pages/contact')"
                            class="sf-with-ul"
                            >Contact</nuxt-link
                        >

                        <ul>
                            <li>
                                <nuxt-link :to="localePath('/pages/contact')"
                                    >Contact 01</nuxt-link
                                >
                            </li>
                            <li>
                                <nuxt-link :to="localePath('/pages/contact-2')"
                                    >Contact 02</nuxt-link
                                >
                            </li>
                        </ul>
                    </li>
                    <li>
                        <nuxt-link :to="localePath('/pages/login')"
                            >Login</nuxt-link
                        >
                    </li>
                    <li>
                        <nuxt-link :to="localePath('/pages/faq')"
                            >FAQs</nuxt-link
                        >
                    </li>
                    <li>
                        <nuxt-link :to="localePath('/pages/404')"
                            >Error 404</nuxt-link
                        >
                    </li>
                    <li>
                        <nuxt-link :to="localePath('/pages/coming-soon')"
                            >Coming Soon</nuxt-link
                        >
                    </li>
                </ul>
            </li> -->
            <li :class="{ active: current == 'shop' }">
                <nuxt-link
                to="/"
                    class="sf-with-ul"
                    >Merchants</nuxt-link>
            </li>
            <li :class="{ active: current == 'shop' }">
                <nuxt-link
                to="/"
                    class="sf-with-ul"
                    >FAQs</nuxt-link>
            </li>
            <!-- <li :class="{ active: current == 'blog' }">
                <nuxt-link :to="localePath('/blog/classic')" class="sf-with-ul"
                    >Blog</nuxt-link
                >
                <ul>
                    <li>
                        <nuxt-link :to="localePath('/blog/classic')"
                            >Classic</nuxt-link
                        >
                    </li>
                    <li>
                        <nuxt-link :to="localePath('/blog/listing')"
                            >Listing</nuxt-link
                        >
                    </li>
                    <li>
                        <nuxt-link
                            :to="localePath('/blog/grid/grid-2')"
                            class="sf-with-ul"
                            >Grid</nuxt-link
                        >
                        <ul>
                            <li>
                                <nuxt-link :to="localePath('/blog/grid/grid-2')"
                                    >Grid 2 columns</nuxt-link
                                >
                            </li>
                            <li>
                                <nuxt-link :to="localePath('/blog/grid/grid-3')"
                                    >Grid 3 columns</nuxt-link
                                >
                            </li>
                            <li>
                                <nuxt-link :to="localePath('/blog/grid/grid-4')"
                                    >Grid 4 columns</nuxt-link
                                >
                            </li>
                            <li>
                                <nuxt-link
                                    :to="localePath('/blog/grid-sidebar')"
                                    >Grid sidebar</nuxt-link
                                >
                            </li>
                        </ul>
                    </li>
                    <li>
                        <nuxt-link
                            :to="localePath('/blog/masonry/masonry-2')"
                            class="sf-with-ul"
                            >Masonry</nuxt-link
                        >
                        <ul>
                            <li>
                                <nuxt-link
                                    :to="localePath('/blog/masonry/masonry-2')"
                                    >Masonry 2 columns</nuxt-link
                                >
                            </li>
                            <li>
                                <nuxt-link
                                    :to="localePath('/blog/masonry/masonry-3')"
                                    >Masonry 3 columns</nuxt-link
                                >
                            </li>
                            <li>
                                <nuxt-link
                                    :to="localePath('/blog/masonry/masonry-4')"
                                    >Masonry 4 columns</nuxt-link
                                >
                            </li>
                            <li>
                                <nuxt-link
                                    :to="localePath('/blog/masonry-sidebar')"
                                    >Masonry sidebar</nuxt-link
                                >
                            </li>
                        </ul>
                    </li>
                    <li>
                        <nuxt-link
                            :to="localePath('/blog/mask/grid')"
                            class="sf-with-ul"
                            >Mask</nuxt-link
                        >
                        <ul>
                            <li>
                                <nuxt-link :to="localePath('/blog/mask/grid')"
                                    >Blog mask grid</nuxt-link
                                >
                            </li>
                            <li>
                                <nuxt-link
                                    :to="localePath('/blog/mask/masonry')"
                                    >Blog mask masonry</nuxt-link
                                >
                            </li>
                        </ul>
                    </li>
                    <li>
                        <nuxt-link
                            to="/blog/single/default/cras-ornare-tristique-elit."
                            class="sf-with-ul"
                            >Single Post</nuxt-link
                        >
                        <ul>
                            <li>
                                <nuxt-link
                                    to="/blog/single/default/cras-ornare-tristique-elit."
                                    >Default with sidebar</nuxt-link
                                >
                            </li>
                            <li>
                                <nuxt-link
                                    to="/blog/single/fullwidth/fusce-pellentesque-suscipit."
                                    >Fullwidth no sidebar</nuxt-link
                                >
                            </li>
                            <li>
                                <nuxt-link
                                    to="/blog/single/sidebar/utaliquam-sollicitzdvudin-leo"
                                    >Fullwidth with sidebar</nuxt-link
                                >
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li :class="{ active: current == 'elements' }">
                <nuxt-link :to="localePath('/elements')" class="sf-with-ul"
                    >Elements</nuxt-link
                >

                <ul>
                    <li>
                        <nuxt-link :to="localePath('/elements/products')"
                            >Products</nuxt-link
                        >
                    </li>
                    <li>
                        <nuxt-link :to="localePath('/elements/typography')"
                            >Typography</nuxt-link
                        >
                    </li>
                    <li>
                        <nuxt-link :to="localePath('/elements/titles')"
                            >Titles</nuxt-link
                        >
                    </li>
                    <li>
                        <nuxt-link :to="localePath('/elements/banners')"
                            >Banners</nuxt-link
                        >
                    </li>
                    <li>
                        <nuxt-link :to="localePath('/elements/categories')"
                            >Product Category</nuxt-link
                        >
                    </li>
                    <li>
                        <nuxt-link :to="localePath('/elements/video-banners')"
                            >Video Banners</nuxt-link
                        >
                    </li>
                    <li>
                        <nuxt-link :to="localePath('/elements/buttons')"
                            >Buttons</nuxt-link
                        >
                    </li>
                    <li>
                        <nuxt-link :to="localePath('/elements/accordions')"
                            >Accordions</nuxt-link
                        >
                    </li>
                    <li>
                        <nuxt-link :to="localePath('/elements/tabs')"
                            >Tabs</nuxt-link
                        >
                    </li>
                    <li>
                        <nuxt-link :to="localePath('/elements/testimonials')"
                            >Testimonials</nuxt-link
                        >
                    </li>
                    <li>
                        <nuxt-link :to="localePath('/elements/blog-posts')"
                            >Blog Posts</nuxt-link
                        >
                    </li>
                    <li>
                        <nuxt-link :to="localePath('/elements/portfolio')"
                            >Portfolio</nuxt-link
                        >
                    </li>
                    <li>
                        <nuxt-link :to="localePath('/elements/cta')"
                            >Call to Action</nuxt-link
                        >
                    </li>
                    <li>
                        <nuxt-link :to="localePath('/elements/icon-boxes')"
                            >Icon Boxes</nuxt-link
                        >
                    </li>
                </ul>
            </li> -->
        </ul>
    </nav>
</template>
<script>
export default {
    computed: {
        current: function () {
            if (this.$route.path.includes('elements')) return 'elements';
            if (this.$route.path.includes('market')) return 'market';
            if (this.$route.path.includes('shop')) return 'shop';
            if (this.$route.path.includes('blog')) return 'blog';
            if (this.$route.path.includes('pages')) return 'pages';
            return '/';
        },
    },
    methods: {
        viewAllDemos: function (e) {
            var list = document.querySelectorAll('.demo-list .hidden');
            for (let i = 0; i < list.length; i++) {
                list[i].classList.add('show');
            }

            e.currentTarget.parentElement.classList.add('d-none');
        },
    },
};
</script>