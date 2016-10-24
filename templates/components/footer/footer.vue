<template>
	<footer class="container">
		<p>
			&copy; 2016 - <a v-bind:href="utils.home_url" rel="home">{{ utils.site_name }}</a>
		<p>
	</footer>
</template>

<script>
export default {
	name : 'keel',

	data () {
		return window.xavier
	}
}
</script>

<style lang="sass" scoped>
@import "./scss/footer.scss"
</style>
