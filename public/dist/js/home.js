var home = new Vue({
	el: '#home',
	data: {
		keyword: null,
		searchResult: null,
		addToCollectionVisibility: false,
		selectedCollectionToAdd: null,
		newCollectionTitle: null,
		collections: []
	},
	methods: {
		searchSites: function () {
			this.$http.get('/home/collections/sites/find', {params: {site: this.keyword}}).then(function (response) {
				this.searchResult = response.body
			})
		},
		getCollectionList: function () {
			this.$http.get('/home/collections').then(function (response) {
				this.collections = response.body
			})
		},
		addToCollection: function () {
			if (!this.addToCollectionVisibility) {
				this.addToCollectionVisibility = true
				return
			}

			this.$http.post('/home/collections', {
				collection_title: this.newCollectionTitle,
				site_id: this.searchResult.id,
				_token: csrf_token
			}).then(function (response) {
				console.log(response.body)
				this.getCollectionList()
			});
		}
	}
});

home.getCollectionList()