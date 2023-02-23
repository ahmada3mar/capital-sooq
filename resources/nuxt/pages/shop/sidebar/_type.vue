<template>
    <main class="main">
        <page-header :title="pageTitle" subtitle="Shop"></page-header>
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <nuxt-link :to='localePath("/")'>{{ $t('Home') }}</nuxt-link> 
                    </li>
                    <li class="breadcrumb-item">
                        <nuxt-link :to='localePath("/shop/sidebar/list")'>{{ $t('Shop') }}</nuxt-link>
                    </li>
                    <li class="breadcrumb-item active">{{ pageTitle }}</li>
                    <li class="breadcrumb-item" v-if="$route.query.searchTerm">
                        <span>Search - {{ $route.query.searchTerm }}</span>
                    </li>
                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div
                        class="col-lg-9 skeleton-body skel-shop-products"
                        :class="{loaded: loaded}"
                    >
                        <div class="toolbox">
                            <div class="toolbox-left">
                                <div class="toolbox-info">
                                     {{ $t('Showing') }}
                                    <span>{{ products.length }} {{ $t('of') }} {{ totalCount }}</span> {{ $t('Products') }}
                                </div>
                            </div>

                            <div class="toolbox-right">
                                <div class="toolbox-sort">
                                    <label for="sortby">{{ $t('Sort by:') }}</label>
                                    <div class="select-custom">
                                        <select
                                            name="sortby"
                                            id="sortby"
                                            class="form-control"
                                            @change.prevent="getProducts"
                                            v-model="orderBy"
                                        >
                                            <option value="default">{{ $t('Default') }}</option>
                                            <option value="featured">{{ $t('Most Popular') }}</option>
                                            <option value="rating">{{ $t('Most Rated') }}</option>
                                            <option value="new">{{ $t('Date') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="toolbox-layout">
                                    <nuxt-link
                                        to="/shop/sidebar/list"
                                        class="btn-layout"
                                        :class="{active: type === 'list'}"
                                    >
                                        <svg width="16" height="10">
                                            <rect x="0" y="0" width="4" height="4" />
                                            <rect x="6" y="0" width="10" height="4" />
                                            <rect x="0" y="6" width="4" height="4" />
                                            <rect x="6" y="6" width="10" height="4" />
                                        </svg>
                                    </nuxt-link>

                                    <nuxt-link
                                        to="/shop/sidebar/2cols"
                                        class="btn-layout"
                                        :class="{active: type === '2cols'}"
                                    >
                                        <svg width="10" height="10">
                                            <rect x="0" y="0" width="4" height="4" />
                                            <rect x="6" y="0" width="4" height="4" />
                                            <rect x="0" y="6" width="4" height="4" />
                                            <rect x="6" y="6" width="4" height="4" />
                                        </svg>
                                    </nuxt-link>

                                    <nuxt-link
                                        to="/shop/sidebar/3cols"
                                        class="btn-layout"
                                        :class="{active: type === '3cols'}"
                                    >
                                        <svg width="16" height="10">
                                            <rect x="0" y="0" width="4" height="4" />
                                            <rect x="6" y="0" width="4" height="4" />
                                            <rect x="12" y="0" width="4" height="4" />
                                            <rect x="0" y="6" width="4" height="4" />
                                            <rect x="6" y="6" width="4" height="4" />
                                            <rect x="12" y="6" width="4" height="4" />
                                        </svg>
                                    </nuxt-link>

                                    <nuxt-link
                                        to="/shop/sidebar/4cols"
                                        class="btn-layout"
                                        :class="{active: type === '4cols'}"
                                    >
                                        <svg width="22" height="10">
                                            <rect x="0" y="0" width="4" height="4" />
                                            <rect x="6" y="0" width="4" height="4" />
                                            <rect x="12" y="0" width="4" height="4" />
                                            <rect x="18" y="0" width="4" height="4" />
                                            <rect x="0" y="6" width="4" height="4" />
                                            <rect x="6" y="6" width="4" height="4" />
                                            <rect x="12" y="6" width="4" height="4" />
                                            <rect x="18" y="6" width="4" height="4" />
                                        </svg>
                                    </nuxt-link>
                                </div>
                            </div>
                        </div>

                        <shop-list-one :products="products" :per-page="perPage" :loaded="loaded"></shop-list-one>

                        <pagination :per-page="perPage" :total="totalCount"></pagination>
                    </div>

                    <aside class="col-lg-3 order-lg-first" sticky-container>
                        <div v-sticky="!isSidebar" sticky-offset="{ top: 69 }">
                            <button
                                class="sidebar-fixed-toggler"
                                @click="toggleSidebar"
                                v-if="isSidebar"
                            >
                                <i class="icon-cog"></i>
                            </button>

                            <div class="sidebar-filter-overlay" @click="hideSidebar"></div>
                            <shop-sidebar-one :is-sidebar="isSidebar"></shop-sidebar-one>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import { mapGetters } from 'vuex';

import PageHeader from '~/components/elements/PageHeader';
import ShopListOne from '~/components/partial/shop/list/ShopListOne';
import ShopSidebarOne from '~/components/partial/shop/sidebar/ShopSidebarOne';
import Pagination from '~/components/elements/Pagination';

import Repository, { baseUrl } from '~/repositories/repository.js';
import { scrollToPageContent } from '~/utilities/common';

export default {
    components: {
        PageHeader,
        ShopListOne,
        ShopSidebarOne,
        Pagination
    },
    data: function() {
        return {
            products: [],
            perPage: 5,
            type: 'list',
            totalCount: 0,
            orderBy: 'default',
            isSidebar: true,
            loaded: false
        };
    },
    computed: {
        ...mapGetters('demo', ['currentDemo'])
    },
    watch: {
        $route: function() {
            this.getProducts(true);
        }
    },
    created: function() {
        this.getProducts();
    },
    mounted: function() {
        this.resizeHandler();
        window.addEventListener('resize', this.resizeHandler, {
            passive: true
        });
    },
    destroyed: function() {
        window.removeEventListener('resize', this.resizeHandler);
    },
    methods: {
        getProducts: async function(samePage = false) {
            this.type = this.$route.params.type;
            if (this.type == 'list') {
                this.pageTitle = 'List';
                this.perPage = 5;
            } else if (this.type == '2cols') {
                this.pageTitle = 'Grid 2 Columns';
                this.perPage = 6;
            } else if (this.type == '3cols') {
                this.pageTitle = 'Grid 3 Columns';
                this.perPage = 9;
            } else if (this.type == '4cols') {
                this.pageTitle = 'Grid 4 Columns';
                this.perPage = 12;
            }

            this.loaded = false;
            await Repository.get(`/shop`, {
                params: {
                    ...this.$route.query,
                    orderBy: this.orderBy,
                    perPage: this.perPage,
                    demo: this.currentDemo
                }
            })
                .then(response => {
                    this.products = response.data.products;
                    this.totalCount = response.data.totalCount;
                    this.loaded = true;

                    if (samePage) {
                        scrollToPageContent();
                    }
                })
                .catch(error => ({ error: JSON.stringify(error) }));
        },
        toggleSidebar: function() {
            if (
                document
                    .querySelector('body')
                    .classList.contains('sidebar-filter-active')
            ) {
                document
                    .querySelector('body')
                    .classList.remove('sidebar-filter-active');
            } else {
                document
                    .querySelector('body')
                    .classList.add('sidebar-filter-active');
            }
        },

        hideSidebar: function() {
            document
                .querySelector('body')
                .classList.remove('sidebar-filter-active');
        },
        resizeHandler: function() {
            if (window.innerWidth > 991) this.isSidebar = false;
            else this.isSidebar = true;
        }
    }
};
</script>
