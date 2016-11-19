<template>
	<ul class="nav navbar-nav float-lg-right" role="navigation" aria-label="Site Navigation">
		<li class="nav-item" v-for="item in items">
			<router-link :to="item.route" class="nav-link">{{ item.title }}</router-link>
		</li>
	</ul>
</template>

<script>
export default {
	name : 'sail',

	data () {
		return {
			items : window.xavier.menus.header
		}
	},
};
</script>

<style lang="sass" scoped>
@import "../scss/nav"
</style>
