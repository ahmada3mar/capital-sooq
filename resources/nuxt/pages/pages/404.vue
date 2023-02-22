<template>
    <main class="main">
        <nav class="breadcrumb-nav border-0 mb-0">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <nuxt-link :to='localePath("/")'>Home</nuxt-link>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:;">Pages</a>
                    </li>
                    <li class="breadcrumb-item active">404</li>
                </ol>
            </div>
        </nav>

        <div
            class="error-content text-center"
            v-lazy:background-image="'./images/backgrounds/error-bg.jpg'"
        >
            <div class="container">
                <h1 class="error-title">Error 404</h1>

                <p>We are sorry, the page you've requested is not available.</p>
                <nuxt-link :to='localePath("/")' class="btn btn-outline-primary-2 btn-minwidth-lg">
                    <span>BACK TO HOMEPAGE</span>
                    <i class="icon-long-arrow-right"></i>
                </nuxt-link>
            </div>
        </div>
    </main>
</template>
<script>
export default {};
</script>