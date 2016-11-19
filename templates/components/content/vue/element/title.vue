<template>
	<h2 v-if="route">
		<router-link v-if="id" v-html="title" :to="{ name: 'post', params : { id : id } }"></router-link>
		<router-link v-else :to="route" v-html="title"></router-link>
	</h2>
	<h1 v-else v-html="title"></h1>
</template>

<script>
export default {
	name : 'entry-title',

	props : [ 'title', 'route', 'id' ],
};
</script>

<style lang="sass">

</style>
