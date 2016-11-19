<template>
	<section class="container">
		<article v-for="post in posts">
			<entry-title v-bind:title="post.title" v-bind:route="post.route" v-bind:id="post.id"></entry-title>
			<entry-content v-bind:content="post.content"></entry-content>
		</article>

		<!-- named route -->
		<router-link :to="{ name : 'paged', params : { page : ( $route.params.page ) ? +$route.params.page + 1 : 2 } }">Load More</router-link>
	</section>
</template>

<script>
import EntryTitle from 'content/element/title';
import EntryContent from 'content/element/content';

export default {
	name : 'posts',

	components : {
		EntryTitle,
		EntryContent,
	},

	data () {
		return {
			posts : [],
		}
	},

	created () {
		this.load( this.$route.params.page );
	},

	methods : {
		load : function( page ) {
			var posts,
				query = [],
				params = {
					per_page : 2,
				};

			if ( 'undefined' !== typeof page ) {
				params.page = page;
			}

			for ( var param in params ) {
				if ( params.hasOwnProperty( param )) {
					query.push( param + '=' + params[ param ] );
				}
			}

			this.$http.get( xavier.utils.root + 'wp/v2/posts?' + query.join( '&' ) ).then( ( response ) => {
				posts = response.body;

				for ( var index in posts ) {
					this.posts.push( {
						id      : posts[ index ]['id'],
						slug    : posts[ index ]['slug'],
						title   : posts[ index ]['title']['rendered'],
						content : posts[ index ]['content']['rendered'],
						route   : posts[ index ]['link'].replace( xavier.utils.home, '' ),
					} );
				}
			}, (response) => {} );
		},
	},

	watch : {
		'$route' ( to, from ) {
			this.load( to.params.page );
		}
	},
};
</script>

<style lang="sass" scoped></style>
