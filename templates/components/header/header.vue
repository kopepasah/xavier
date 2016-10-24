<template>
	<header class="container">
		<nav class="navbar navbar-dark bg-inverse">
			<a v-bind:href="utils.home_url" rel="home" class="navbar-brand">{{ utils.site_name }}</a>

			<sail></sail>
		</nav>
	</header>
</template>

<script>
import Sail from 'header/nav';

export default {
	name : 'mast',

	components : {
		Sail,
	},

	data () {
		return window.xavier
	},
};
</script>

<style lang="sass" scoped>
@import "scss/header"
</style>
