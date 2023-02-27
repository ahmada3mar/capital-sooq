<template>
    <main class="main">
        <page-header title="My Account" subtitle="Shop"></page-header>
        <nav class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <nuxt-link :to='localePath("/")'>{{ $t('Home') }}</nuxt-link>
                    </li>
                    <li class="breadcrumb-item">
                        <nuxt-link :to='localePath("/shop/sidebar/list")'>{{ $t('Shop') }}</nuxt-link>
                    </li>
                    <li class="breadcrumb-item active">{{ $t('My Account') }}</li>
                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="dashboard")'>
                <div class="container">
                    <div class="row">
                        <aside class="col-md-4 col-lg-3">
                            <tabs class="nav-dashboard flex-column mb-3 mb-md-0" :data="tabsData"></tabs>
                        </aside>

                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab1">
                                    <p>
                                        {{ $t('Hello') }} 
                                        <span class="font-weight-normal text-dark">User</span> (not
                                        <span class="font-weight-normal text-dark">User</span>?
                                        <a href="#"> {{ $t('Log out') }}</a>)
                                        <br /> {{ $t('From your account dashboard you can view your') }}
                                        <a
                                            href="#tab-orders"
                                            class="tab-trigger-link link-underline"
                                            @click.prevent="toOrder"
                                        > {{ $t('recent orders') }}</a>,  {{ $t('manage your') }}
                                        <a
                                            href="#tab-address"
                                            class="tab-trigger-link"
                                            @click.prevent="toAddress"
                                        >{{ $t('shipping and billing addresses') }}</a>, {{ $t('and') }}
                                        <a
                                            href="#tab-account"
                                            class="tab-trigger-link"
                                            @click.prevent="toAccount"
                                        >{{ $t('edit your password and account details') }}</a>.
                                    </p>
                                </div>

                                <div class="tab-pane fade" id="tab2">
                                    <p>{{ $t('No order has been made yet.') }}</p>
                                    <nuxt-link
                                        to="/shop/sidebar/3cols"
                                        class="btn btn-outline-primary-2"
                                    >
                                        <span>{{ $t('GO TO SHOP') }}</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </nuxt-link>
                                </div>

                                <div class="tab-pane fade" id="tab3">
                                    <p>{{ $t('No downloads available yet.') }}</p>
                                    <nuxt-link
                                        to="/shop/sidebar/3cols"
                                        class="btn btn-outline-primary-2"
                                    >
                                        <span>{{ $t('GO TO SHOP') }}</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </nuxt-link>
                                </div>

                                <div class="tab-pane fade" id="tab4">
                                    <p>{{ $t('The following addresses will be used on the checkout page by default.') }}</p>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card card-dashboard")'>
                                                <div class="card-body">
                                                    <h3 class="card-title">{{ $t('Billing Address') }}</h3>

                                                    <p>
                                                        {{ $t('User Name') }} 
                                                        <br />User Company
                                                        <br />John str
                                                        <br />New York, NY 10001
                                                        <br />1-234-987-6543
                                                        <br />yourmail@mail.com
                                                        <br />
                                                        <a href="#">
                                                            {{ $t('Edit') }}   
                                                            <i class="icon-edit"></i>
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="card card-dashboard")'>
                                                <div class="card-body">
                                                    <h3 class="card-title">{{ $t('Shipping Address') }} </h3>

                                                    <p>
                                                        {{ $t('You have not set up this type of address yet.') }} 
                                                        <br />
                                                        <a href="#">
                                                            {{ $t('Edit') }}
                                                            <i class="icon-edit"></i>
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab5">
                                    <form action="#">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label> {{ $t('First Name') }} *</label>
                                                <input type="text" class="form-control" required />
                                            </div>

                                            <div class="col-sm-6">
                                                <label>{{ $t('Last Name') }} *</label>
                                                <input type="text" class="form-control" required />
                                            </div>
                                        </div>

                                        <label>{{ $t('Display Name') }} *</label>
                                        <input type="text" class="form-control" required />
                                        <small
                                            class="form-text"
                                        >{{ $t('This will be how your name will be displayed in the account section and in reviews') }}</small>

                                        <label>{{ $t('Email address') }} *</label>
                                        <input type="email" class="form-control" required />

                                        <label>{{ $t('Current password') }} {{ $t('(leave blank to leave unchanged)') }}</label>
                                        <input type="password")' class="form-control" />

                                        <label>{{ $t('New password') }} {{ $t('(leave blank to leave unchanged)') }}</label>
                                        <input type="password")' class="form-control" />

                                        <label>{{ $t('Confirm new password') }}</label>
                                        <input type="password")' class="form-control mb-2" />

                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>{{ $t('SAVE CHANGES') }}</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import PageHeader from '~/components/elements/PageHeader';
import Tabs from '~/components/elements/Tabs';

export default {
    components: {
        Tabs,
        PageHeader
    },
    data: function() {
        return {
            tabsData: [
                {
                    id: 'tab1',
                    title: this.$t('Dashboard'),
                    active: true
                },
                {
                    id: 'tab2',
                    title: this.$t('Orders')
                },
                {
                    id: 'tab3',
                    title: this.$t('Downloads')
                },
                {
                    id: 'tab4',
                    title: this.$t('Addresses')
                },
                {
                    id: 'tab5',
                    title: this.$t('Account Details')
                },
                {
                    id: 'tab6',
                    title: this.$t('Sign Out')
                }
            ]
        };
    },
    methods: {
        toOrder: function() {
            document
                .querySelector('.nav-dashboard .nav-item:nth-child(2) a')
                .click();
        },
        toAddress: function() {
            document
                .querySelector('.nav-dashboard .nav-item:nth-child(4) a')
                .click();
        },
        toAccount: function() {
            document
                .querySelector('.nav-dashboard .nav-item:nth-child(5) a')
                .click();
        }
    }
};
</script>