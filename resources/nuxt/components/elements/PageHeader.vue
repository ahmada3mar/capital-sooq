<template>
    <div class="page-header text-center" v-lazy:background-image="'./images/page-header-bg.jpg'">
        <div class="container">
            <h1 class="page-title">
                {{ title }}
                <span v-if="subtitle">{{ subtitle }}</span>
            </h1>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        title: {
            type: String,
            required: true
        },
        subtitle: String
    }
};
</script>