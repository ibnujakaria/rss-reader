@extends('template')

@section('title', 'RSS Reader | Home')

@section('body')
<div id="home">
	<h2>Welcome to Home</h2>

	<div style="border: 1px solid black; float: left; padding: 20px; width: 200px">
		Saved Articles
		<ul>
			<li v-for="article in savedArticles"><a href="javascript:void(0)">@{{article.title}}</a></li>
		</ul>
		Collections
		<ul>
			<span v-if="!collections.length">Loading...</span>
			<li v-for="collection in collections" v-else>
				<a href="">@{{collection.title}}</a>
				<ul>
					<li v-for="site in collection.sites"><a href="javascript:void(0)" @click="getTimeLine(site.url)">@{{site.title}}</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<div style="float: left; margin-left: 20px; width: 800px">
		<div style="border: 1px solid red; padding: 20px;">
			<form @submit.prevent="searchSites">
				<input type="text" placeholder="Search site" v-model="keyword">
				<span v-if="searchSitesLoading">
					Loading...
				</span>
			</form>
			<div>
				<table v-if="searchResult">
					<tr>
						<td>Title</td>
						<td>@{{searchResult.title}}</td>
					</tr>
					<tr>
						<td>URL</td>
						<td><a :href="searchResult.url">@{{searchResult.url}}</a></td>
					</tr>
					<tr>
						<td>Description</td>
						<td>@{{searchResult.description}}</td>
					</tr>
					<tr>
						<td colspan="2">
							<div v-if="addToCollectionVisibility">
								<div>
									<div>
										<input type="radio" v-model="addToExistingCollection" value="yes">
										Select collection to add
									</div>
									<select v-model="selectedCollectionToAdd">
										<option v-for="collection in collections" :value="collection.id">@{{collection.title}}</option>
									</select>
								</div>
								<div>
									<div>
										<input type="radio" v-model="addToExistingCollection" value="no">
										Or create a new collection
									</div>
									<input type="text" v-model="newCollectionTitle">
								</div>
							</div>

							<button @click="addToCollection">Add to Collection</button>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div style="border: 1px solid green; padding: 20px; margin-top: 20px">
			<div v-if="timeline && timeline.site">
				<h1 style="color: green">@{{timeline.site.title}}</h1>
				<hr>
				<div v-for="article in timeline.site.articles">
					<h3>@{{article.title}}</h3>
					<small>@{{article.author}} | @{{article.pub_date}}</small>
					<p v-html="article.description"></p>
					<p>
						<a target="_blank" :href="article.link">See more</a>
						<a href="javascript:void(0)" @click="saveItLater(article.id)">Save it later</a>
					</p>
					<hr>
				</div>
			</div>

			<div v-if="timeline && timeline.articles">
				<h1 style="color: green">Today</h1>
				<div v-for="article in timeline.articles.data">
					<h3>@{{article.title}}</h3>
					<small>@{{article.author}} | @{{article.pub_date}}</small>
					<p v-html="article.description"></p>
					<p>
						<a target="_blank" :href="article.link">See more</a>
						<a href="javascript:void(0)" @click="saveItLater(article.id)">Save it later</a>
					</p>
					<hr>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('script')
<script type="text/javascript">
	var csrf_token = '{{csrf_token()}}';
</script>
<script src="{{asset('dist/js/home.js')}}"></script>
@stop

