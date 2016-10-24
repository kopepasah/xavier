<template>
	<article class="container">
		<entry-title v-bind:title="post.title"></entry-title>
		<entry-content v-bind:content="post.content"></entry-content>
	</article>
</template>

<script>
import EntryTitle from 'posts/entry-title';
import EntryContent from 'posts/entry-content';

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

	beforeCreate () {
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

	methods : {},
};
</script>

<style lang="sass">

</style>
