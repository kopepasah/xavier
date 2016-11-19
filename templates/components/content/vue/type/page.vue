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
		this.load( xavier.query.post.ID );
	},

	methods : {
		load : function( post ) {
			console.log(xavier.query);
			this.$http.get( xavier.utils.root + 'wp/v2/pages/' + xavier.query.post.ID ).then( ( response ) => {
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
