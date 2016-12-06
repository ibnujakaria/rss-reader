var home = new Vue({
	el: '#home',
	data: {
		keyword: null,
		searchResult: null,
		addToCollectionVisibility: false,
		selectedCollectionToAdd: null,
		newCollectionTitle: null,
		collections: [
			{
				id: 1,
				title: 'Muslim',
				sites: [
					{
						title: 'Muslim Afiyah'
					},
					{
						title: 'Muslim.or.id'
					},
					{
						title: 'Muslimah.or.id'
					}
				]
			},
			{
				id: 2,
				title: 'Bola'
			},
			{
				id: 3,
				title: 'Politik'
			}
		]
	},
	methods: {
		searchSites: function () {
			this.$http.get('/home/collections/sites/find', {params: {site: this.keyword}}).then(function (response) {
				this.searchResult = response.body
			})
		},
		addToCollection: function () {
			console.log("opoooo")
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
			});
		}
	}
});