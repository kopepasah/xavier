<template>
	<h2 v-if="route">
		<router-link :to="route" v-html="title"></router-link>
	</h2>
	<h1 v-else v-html="title"></h1>
</template>

<script>
export default {
	name : 'entry-title',

	props : [ 'title', 'route' ],
};
</script>

<style lang="sass">

</style>
