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
		timeline: null,
		timelineLabel: null,
		savedArticlesCount: null
	},
	methods: {
		searchSites: function () {
			this.searchSitesLoading = true
			var notif = alertify.message("Searching " + this.keyword + "..", 0)
			this.$http.get('/home/collections/sites/find', {params: {site: this.keyword}}).then(function (response) {
				this.searchResult = response.body
				this.searchSitesLoading = false
				notif.dismiss()

				if (this.searchResult.is_already_added) {
					this.getTimeLine({url: this.searchResult.url})
				}
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

			var notif = alertify.message("Add to collections", 0)
			if (this.addToExistingCollection === 'no') {
				this.$http.post('/home/collections', {
					collection_title: this.newCollectionTitle,
					site_id: this.searchResult.id,
					_token: csrf_token
				}).then(function (response) {
					this.searchResult = null
					this.newCollectionTitle = null
					this.getCollectionList()
					this.success("Added to collection.")
				});
			} else {
				this.$http.post('/home/collections/add-site/' + this.selectedCollectionToAdd + '/' + this.searchResult.id, {
					_token: csrf_token
				})
				.then(function (response) {
					this.searchResult = null
					this.getCollectionList()
					notif.dismiss()
					alertify.success("Added to collection.")
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
					this.searchResult =  null
				}
			}

			var notify = alertify.message('Loading articles..', 0)
			this.$http.get('/home/collections/sites', {params: params}).then(function (response) {
				this.timeline = response.body
				notify.dismiss()
				alertify.success('Articles loaded', 'success').delay(3)
				$("html, body").animate({ scrollTop: 0 }, "slow");
			})
		},
		getNextTimeLine: function () { // this to get the next page of the timeline
			if (this.timeline.articles) {
				if (this.timeline.articles.current_page === this.timeline.articles.last_page) {
					return false;
				}

				var oldData = this.timeline.articles.data
				var params = {page: this.timeline.articles.current_page + 1}

				this.$http.get(this.timeline.articles.next_page_url).then(function (response) {
					this.timeline = response.body
					this.timeline.articles.data = oldData.concat(this.timeline.articles.data)
					this.searchResult =  null
				})
			}

		},
		saveItLater: function (article_id) {
			var notify = alertify.message("Saving to read later..", 0)
			this.$http.post('/home/collections/sites/save-it-later/' + article_id, {
				_token: csrf_token
			}).then(function (response) {
				notify.dismiss()
				alertify.success("Article saved")
				this.savedArticlesCount += 1
			}, function (response) {
				notify.dismiss()
				if (response.status === 400) {
					alertify.error("Article already added.")
				} else {
					alertify.error("Some errors occured :(")
				}
			})
		},
		getSavedArticles: function () {
			this.$http.get('/home/collections/sites/saved-articles').then(function (response) {
				this.timeline = response.body
				this.timelineLabel = 'My Saved Articles'
				$("html, body").animate({ scrollTop: 0 }, "slow");
				this.searchResult =  null
			})
		},
		getCountSavedArticles: function() {
			this.$http.get('/home/collections/sites/saved-articles/count').then(function (response) {
				this.savedArticlesCount = response.body
			})
		}
	}
});

home.getTimeLine()
home.getCollectionList()
home.getSavedArticles()
home.getCountSavedArticles()
