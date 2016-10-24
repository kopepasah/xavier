<template>
	<post v-if="single"></post>
	<posts v-else></posts>
</template>

<script>
import Post from 'posts/single';
import Posts from 'posts/archive';

export default {
	name : 'deck',

	components : {
		Post,
		Posts,
	},

	data () {
		return {
			single : xavier.query.is_single,
		}
	},
};
</script>

<style lang="sass">

</style>
