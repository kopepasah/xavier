<template>
	<article class="container">
		<entry-title v-bind:title="page.title"></entry-title>
		<entry-content v-bind:content="page.content"></entry-content>
	</article>
</template>

<script>
import EntryTitle from 'content/element/title';
import EntryContent from 'content/element/content';

export default {
	name : 'page',

	components : {
		EntryTitle,
		EntryContent,
	},

	data () {
		return {
			page : {},
		}
	},

	created () {
		if ( 'undefined' !== typeof this.$route.params.id ) {
			this.page.id = this.$route.params.id;
		} else {
			this.page.id = xavier.query.post.ID;
		}

		this.load( this.page.id );
	},

	methods : {
		load : function( id ) {
			console.log( id );
			this.$http.get( xavier.utils.root + 'wp/v2/pages/' + id ).then( ( response ) => {
				console.log( response.body );
				this.page = {
					data    : response.body,
					title   : response.body.title.rendered,
					content : response.body.content.rendered,
				};
			}, ( response ) => {
				this.page = {
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
