<template>
	<main class="main">
		<page-header
			title="Blog Listing"
			subtitle="Blog"
		></page-header>

		<nav class="breadcrumb-nav">
			<div class="container">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<nuxt-link :to='localePath("/")'>Home</nuxt-link>
					</li>
					<li class="breadcrumb-item">
						<nuxt-link :to='localePath("/blog/classic")'>Blog</nuxt-link>
					</li>
					<li class="breadcrumb-item active">Listing</li>
				</ol>
			</div>
		</nav>

		<div class="page-content">
			<div class="container">
				<div
					class="row skeleton-body"
					:class="{loaded: loaded}"
				>
					<div class="col-lg-9">
						<template v-if="!loaded">
							<div
								class="skel-list-post mb-6"
								v-for="(i,index) in [1,2,3,4,5,6]"
								:key="'skel' + index"
							></div>
						</template>

						<template v-else>
							<p
								class="blogs-info"
								v-if="blogs.length ===0"
							>No posts were found matching your selection.</p>

							<div
								v-for="(blog,index) in blogs"
								:key="index"
							>
								<blog-two :blog="blog"></blog-two>
							</div>

							<pagination
								:per-page="perPage"
								:total="totalCount"
							></pagination>
						</template> </div>

					<aside
						class="col-lg-3"
						sticky-container
					>
						<div
							class="sticky-content"
							v-sticky="shouldSticky"
							sticky-offset="{top: 69}"
						>
							<button
								class="sidebar-fixed-toggler right"
								@click="toggleSidebar"
								v-if="isSidebar"
							>
								<i class="icon-cog"></i>
							</button>

							<div
								class="sidebar-filter-overlay"
								@click="hideSidebar"
							></div>
							<blog-sidebar
								:blog-categories="blogCategories"
								type="listing"
								:class="isSidebar? 'sidebar-filter right':''"
							></blog-sidebar>
						</div>
					</aside>
				</div>
			</div>
		</div>
	</main>
</template>
<script>
import Sticky from 'vue-sticky-directive';
import BlogTwo from '~/components/elements/blogs/BlogTwo';
import PageHeader from '~/components/elements/PageHeader';
import BlogSidebar from '~/components/partial/blog/BlogSidebar';
import Pagination from '~/components/elements/Pagination';
import Repository, { baseUrl } from '~/repositories/repository.js';

export default {
	components: {
		BlogTwo,
		PageHeader,
		BlogSidebar,
		Pagination
	},
	directives: {
		Sticky
	},
	data: function() {
		return {
			blogs: [],
			blogCategories: [],
			page: 1,
			perPage: 9,
			totalCount: 0,
			certainTag: null,
			certainCategory: null,
			loaded: false,
			isSidebar: false,
			shouldSticky: false
		};
	},
	watch: {
		$route: function() {
			this.getBlogs();
		}
	},
	created: function() {
		this.getBlogs();
	},
	mounted: function() {
		this.resizeHandler();
		window.addEventListener('resize', this.resizeHandler, {
			passive: true
		});

		this.stickyHandle();
		window.addEventListener('resize', this.stickyHandle, { passive: true });
	},
	destroyed: function() {
		window.removeEventListener('resize', this.resizeHandler);

		window.removeEventListener('resize', this.stickyHandle);
	},
	methods: {
		getBlogs: async function() {
			this.loaded = false;

			let params = {
				page: this.$route.query.page
					? this.$route.query.page
					: this.page,
				perPage: this.perPage
			};

			if (this.$route.query.category) {
				params = { ...params, category: this.$route.query.category };
			}

			await Repository.get(`${baseUrl}/blogs/listing`, {
				params: params
			})
				.then(response => {
					this.blogs = response.data.blogs;
					this.blogCategories = response.data.categories;
					this.totalCount = response.data.totalCount;

					this.loaded = true;
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
			if (window.innerWidth > 992) this.isSidebar = false;
			else this.isSidebar = true;
		},
		stickyHandle: function() {
			if (window.innerWidth > 991) this.shouldSticky = true;
			else this.shouldSticky = false;
		}
	}
};
</script>