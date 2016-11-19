<template>
	<ul class="nav navbar-nav float-lg-right" role="navigation" aria-label="Site Navigation">
		<li class="nav-item" v-for="item in items">
			<router-link v-if="item.id" class="nav-link" :to="{ name: item.type, params : { id : item.id } }">{{ item.title }}</router-link>
			<router-link v-else class="nav-link" :to="item.route">{{ item.title }}</router-link>
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
