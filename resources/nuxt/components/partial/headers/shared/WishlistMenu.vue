<template>
    <nuxt-link :to='localePath("/shop/wishlist")' class="wishlist-link" title="Wishlist">
        <i class="icon-heart-o"></i>
        <span class="wishlist-count">{{ wishlistQty }}</span>
    </nuxt-link>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    computed: {
        ...mapGetters('wishlist', ['wishlistQty'])
    }
};
</script>