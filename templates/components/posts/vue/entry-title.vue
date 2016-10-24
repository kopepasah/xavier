<template>
	<h2 v-if="link"><a v-bind:href="link" v-html="title"></a></h2>
	<h1 v-else v-html="title"></h1>
</template>

<script>
export default {
	name : 'entry-title',

	props : [ 'title', 'link' ],
};
</script>

<style lang="sass">

</style>
