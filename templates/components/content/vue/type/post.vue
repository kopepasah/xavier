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
		if ( 'undefined' !== typeof this.$route.params.id ) {
			this.post.id = this.$route.params.id;
		} else {
			this.post.id = xavier.query.post.ID;
		}

		this.load( this.post.id );
	},

	methods : {
		load : function( id ) {
			this.$http.get( xavier.utils.root + 'wp/v2/posts/' + id ).then( ( response ) => {
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
