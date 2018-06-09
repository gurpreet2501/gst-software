new Vue({
	el: '#add-cash-transaction',
	data: {
		iterator: {received: [0], paid: [0]},
		credit:{amount: [], party_ids: []},
		debit:{amount: [], party_ids: []}
	},
	computed: {},
	methods: {
		iteratorInsert: function(index){
			var self = this;
			var lastEle = this.iterator[index][this.iterator[index].length-1];
			this.iterator[index].push(lastEle+1);
		},

		iteratorRemove: function(index, id){
			if(this.iterator[index].length <= 1)
				return alert('Cannot delete there should be at-least one entry.')
			this.iterator[index].splice(this.iterator[index].indexOf(id), 1);
		},

		onSubmit: function(e){
			var self = this;
			e.preventDefault();
			var creditHasinput = false;
			var debitHasinput = false;

			if (self.credit.amount.length !== 0)
				creditHasinput = true;

			if (self.debit.amount.length !== 0)
				debitHasinput = true;

			if (!debitHasinput && !creditHasinput){
				$('.form-error').slideDown();
			}else {
				$('.form-error').slideUp();
				$('.storage-form').submit();
			}
		},

		calculateBalance: function(e){
			$('#add-cash-transaction form').submit();
		}
	}
});