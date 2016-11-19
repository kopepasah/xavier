<template>
	<section v-html="content"></section>
</template>

<script>
export default {
	name : 'entry-content',

	props : [ 'content' ],
};
</script>
