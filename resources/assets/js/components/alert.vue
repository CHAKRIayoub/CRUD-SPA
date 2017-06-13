<simplert useRadius=true
          useIcon=true
          ref="simplert">
</simplert>




<script>
	
	export default {
	   components: {Simplert}
	};

	let obj = {

	   title: 'Custom Function',
	   message: 'Click close to trigger custom function',
	   type: 'info',
	   onClose: this.onClose

	}

	this.$refs.simplert.openSimplert(obj)

</script>