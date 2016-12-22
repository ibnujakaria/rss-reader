var home = new Vue({
	el: '#home',
	data: {
		keyword: null,
		searchResult: null,
		searchSitesLoading: false,
		addToCollectionVisibility: false,
		selectedCollectionToAdd: null,
		newCollectionTitle: null,
		addToExistingCollection: 'yes',
		collections: [],
		savedArticles: [],
		timeline: null
	},
	methods: {
		searchSites: function () {
			this.searchSitesLoading = true
			this.$http.get('/home/collections/sites/find', {params: {site: this.keyword}}).then(function (response) {
				this.searchResult = response.body
				this.searchSitesLoading = false
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

			if (this.addToExistingCollection === 'no') {
				this.$http.post('/home/collections', {
					collection_title: this.newCollectionTitle,
					site_id: this.searchResult.id,
					_token: csrf_token
				}).then(function (response) {
					this.searchResult = null
					this.newCollectionTitle = null
					this.getCollectionList()
				});
			} else {
				this.$http.post('/home/collections/add-site/' + this.selectedCollectionToAdd + '/' + this.searchResult.id, {
					_token: csrf_token
				})
				.then(function (response) {
					this.searchResult = null
					this.getCollectionList()
				})
			}
		},
		getTimeLine: function (options) {
			params = {}

			if (options) {
				if (options.url)
					params = {site: options.url}
				if (options.type){
					params = options;
					this.timelineLabel = options.type
				}
			}

			this.$http.get('/home/collections/sites', {params: params}).then(function (response) {
				this.timeline = response.body
			})
		},
		getNextTimeLine: function () { // this to get the next page of the timeline
			if (this.timeline.articles) {
				if (this.timeline.articles.current_page === this.timeline.articles.last_page) {
					return false;
				}

				var oldData = this.timeline.articles.data
				var params = {page: this.timeline.articles.current_page + 1}

				this.$http.get('/home/collections/sites', {params: params}).then(function (response) {
					this.timeline = response.body
					this.timeline.articles.data = oldData.concat(this.timeline.articles.data)
				})
			}
		},
		saveItLater: function (article_id) {
			this.$http.post('/home/collections/sites/save-it-later/' + article_id, {
				_token: csrf_token
			}).then(function (response) {
				this.getSavedArticles()
			})
		},
		getSavedArticles: function () {
			this.$http.get('/home/collections/sites/saved-articles').then(function (response) {
				this.savedArticles = response.body.articles
			})
		}
	}
});

home.getTimeLine()
home.getCollectionList()
home.getSavedArticles()
