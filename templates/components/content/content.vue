<template>
	<router-view></router-view>
</template>

<script>
import Post from 'content/type/post';
import Page from 'content/type/page';
import Posts from 'content/type/posts';

export default {
	name : 'deck',

	components : {
		Post,
		Page,
		Posts,
	},

	data () {
		return {}
	},
};
</script>

<style lang="sass">

</style>
