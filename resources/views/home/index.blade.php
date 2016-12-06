@extends('template')

@section('title', 'RSS Reader | Home')

@section('body')
<div id="home">
	<h2>Welcome to Home</h2>

	<div style="border: 1px solid black; float: left; padding: 20px; width: 200px">
		Collections
		<ul>
			<span v-if="!collections.length">Loading...</span>
			<li v-for="collection in collections" v-else>
				<a href="">@{{collection.title}}</a>
				<ul>
					<li v-for="site in collection.sites"><a href="">@{{site.title}}</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<div style="float: left; margin-left: 20px; width: 800px">
		<div style="border: 1px solid red; padding: 20px;">
			<form @submit.prevent="searchSites">
				<input type="text" placeholder="Search site" v-model="keyword">
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
			<div v-for="article in articles">
				@{{article}}
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

