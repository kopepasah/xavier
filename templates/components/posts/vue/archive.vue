<template>
	<section class="container">
		<article v-for="post in posts">
			<entry-title v-bind:title="post.title.rendered" v-bind:link="post.link"></entry-title>
			<entry-content v-bind:content="post.content.rendered"></entry-content>
		</article>

		<a href
		   class="btn"
		   v-bind:class="{ 'disabled' : previous_page, 'btn-primary' : next_page, 'btn-secondary' : previous_page }"
		   v-on:click.prevent="next"
		>Next</a>

		<a href
		   class="btn btn-primary"
		   v-on:click.prevent="previous"
		   v-bind:class="{ 'disabled': next_page, 'btn-primary' : previous_page, 'btn-secondary' : next_page }"
		>Previous</a>
	</section>
</template>

<script>
import EntryTitle from 'posts/entry-title';
import EntryContent from 'posts/entry-content';

export default {
	name : 'posts',

	components : {
		EntryTitle,
		EntryContent,
	},

	data () {
		return {
			posts : [],
			page : ( xavier.query.query_vars.paged ) ? xavier.query.query_vars.paged : 1,
			next_page : true,
			previous_page : true,
		}
	},

	created () {
		var page = '';

		if ( 1 !== this.page ) {
			page = '&page=' + this.page;
		} else {
			this.previous_page = false;
		}

		this.$http.get( xavier.utils.root + 'wp/v2/posts?per_page=' + xavier.per_page + page ).then( ( response ) => {
			// TODO: Let's build out the data we need per post.
			this.posts = response.body;
		}, (response) => {});
	},

	methods : {
		next : function () {

			if ( this.next_page ) {
				this.page = this.page + 1;
				this.next_page = true;
				this.previous_page = true;

				this.$http.get( xavier.utils.root + 'wp/v2/posts?per_page=' + xavier.per_page + '&page=' + this.page ).then( ( response ) => {
					this.posts = response.body;
				}, ( response ) => {} );
			}

			if ( this.page === xavier.query.max_num_pages ) {
				this.next_page = false;
			}
		},

		previous : function () {
			if ( this.previous_page ) {
				this.page = this.page - 1;
				this.next_page = true;
				this.previous_page = true;

				this.$http.get( xavier.utils.root + 'wp/v2/posts?per_page=' + xavier.per_page + '&page=' + this.page ).then( ( response ) => {
					this.posts = response.body;
				}, (response) => {});
			}

			if ( 1 === this.page ) {
				this.previous_page = false;
			}
		}
	},
};
</script>

<style lang="sass" scoped>
</style>
