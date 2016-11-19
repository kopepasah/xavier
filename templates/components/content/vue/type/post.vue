<template>
	<article class="container">
		<entry-title v-bind:title="post.title"></entry-title>
		<entry-content v-bind:content="post.content"></entry-content>
	</article>
</template>

<script>
import EntryTitle from 'content/element/title';
import EntryContent from 'content/element/content';

export default {
	name : 'post',

	components : {
		EntryTitle,
		EntryContent,
	},

	data () {
		return {
			post : {},
		}
	},

	created () {
		this.load( xavier.query.post.ID );
	},

	methods : {
		load : function( post ) {
			this.$http.get( xavier.utils.root + 'wp/v2/posts/' + xavier.query.post.ID ).then( ( response ) => {
				this.post = {
					data    : response.body,
					title   : response.body.title.rendered,
					content : response.body.content.rendered,
				};
			}, ( response ) => {
				this.post = {
					title   : 'Not Found',
					content : 'This is not the post for which you are looking.',
				};
			});
		},
	},
};
</script>

<style lang="sass">

</style>
