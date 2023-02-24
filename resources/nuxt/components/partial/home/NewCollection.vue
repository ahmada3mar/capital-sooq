<template>
    <div class="container recent-arrivals">
        <div class="heading-flex align-items-center mb-3">
            <h2 class="title title-lg text-center">{{ $t('Recent Arrivals') }}</h2>

            <tabs
                class="nav-pills nav-pills nav-border-anim justify-content-center"
                :data="tabsData"
                id="tab2"
            ></tabs>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active p-0" id="tab2-all">
                <div class="products">
                    <div class="row justify-content-center">
                        <div
                            class="col-6 col-md-4 col-lg-3"
                            v-for="(product, index) in products.slice(0, 8)"
                            :key="index"
                        >
                            <product-twelve :product="product"></product-twelve>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade p-0" id="tab2-women">
                <div class="products">
                    <div class="row justify-content-center">
                        <div
                            class="col-6 col-md-4 col-lg-3"
                            v-for="(product, index) in womenProducts"
                            :key="index"
                        >
                            <product-twelve :product="product"></product-twelve>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade p-0" id="tab2-men">
                <div class="products">
                    <div class="row justify-content-center">
                        <div
                            class="col-6 col-md-4 col-lg-3"
                            v-for="(product, index) in menProducts"
                            :key="index"
                        >
                            <product-twelve :product="product"></product-twelve>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade p-0" id="tab2-shoes">
                <div class="products">
                    <div class="row justify-content-center">
                        <div
                            class="col-6 col-md-4 col-lg-3"
                            v-for="(product, index) in shoes"
                            :key="index"
                        >
                            <product-twelve :product="product"></product-twelve>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="more-container text-center mt-3 mb-3">
            <nuxt-link to="/shop/sidebar/4cols" class="btn btn-outline-dark-3 btn-more">
                <span>{{  $t('View More') }}</span>
                <i class="icon-long-arrow-right"></i>
            </nuxt-link>
        </div>
    </div>
</template>
<script>
import Tabs from '~/components/elements/Tabs';
import ProductTwelve from '~/components/elements/products/ProductTwelve';
import { catFilter } from '~/utilities/common';

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
                    id: 'all',
                    title: 'All',
                    active: true
                },
                {
                    id: 'women',
                    title: 'Women'
                },
                {
                    id: 'men',
                    title: 'Men'
                },
                {
                    id: 'shoes',
                    title: 'Shoes & Boots'
                }
            ]
        };
    },
    computed: {
        womenProducts: function() {
            return catFilter(this.products, ['women']);
        },
        menProducts: function() {
            return catFilter(this.products, ['men']);
        },
        shoes: function() {
            return catFilter(this.products, ['shoes', 'boots']);
        }
    }
};
</script>