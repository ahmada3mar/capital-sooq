<template>
	<article class="entry entry-display">
		<figure class="entry-media">
			<nuxt-link :to="'/blog/single/default/' + blog.slug">
				<img
					v-lazy="`${baseUrl}${blog.image[0].url}`"
					alt="blog"
					:width="blog.image[0].width"
					:height="blog.image[0].height"
				/>
			</nuxt-link>
		</figure>

		<div class="entry-body text-center">
			<div class="entry-meta">
				<nuxt-link :to="'/blog/single/default/' + blog.slug">{{ date }}</nuxt-link>,&nbsp;
				<nuxt-link :to="'/blog/single/default/' + blog.slug">{{ blog.comments }} Comments</nuxt-link>
			</div>

			<h2 class="entry-title">
				<nuxt-link :to="'/blog/single/default/' + blog.slug">{{ blog.title }}</nuxt-link>
			</h2>

			<div class="entry-content">
				<nuxt-link
					:to="'/blog/single/default/' + blog.slug"
					class="read-more"
				>Continue Reading</nuxt-link>
			</div>
		</div>
	</article>
</template>
<script>
import { baseUrl } from '~/repositories/repository';

export default {
	props: {
		blog: Object
	},
	data: function() {
		return {
			baseUrl: baseUrl
		};
	},
	computed: {
		date: function() {
			let options = {
				year: 'numeric',
				month: 'short',
				day: '2-digit',
				timeZone: 'UTC'
			};

			return new Date(this.blog.date).toLocaleString('en-us', options);
		}
	}
};
</script>