<template>
	<div class="site-container">
		<mast></mast>
		<deck></deck>
		<keel></keel>
	</div>
</template>

<script>
import Mast from 'components/header';
import Keel from 'components/footer';
import Deck from 'components/posts';

export default {
	name : 'xavier',

	components : {
		Mast,
		Deck,
		Keel,
	},
};
</script>
