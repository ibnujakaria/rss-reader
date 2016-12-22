@extends('template', ['app_id' => 'home'])

@section('title', 'RSS Reader | Home')

@section('body')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header" v-if="timeline && timeline.site">Welcome to Home | @{{timeline.site.title}}</h1>
		<h1 class="page-header" v-else-if="timelineLabel">Welcome to Home | @{{timelineLabel}}</h1>
		<h1 class="page-header" v-else>Welcome to Home</h1>
	</div>
</div><!--/.row-->

<div class="col-xs-12 col-md-6 col-lg-9" v-if="searchResult">
	<div class="panel panel-primary">
		<div class="panel-heading dark-overlay">Hasil Pencarian</div>
		<div class="panel-body">
			<div class="header">
				<strong class="primary-font">Title</strong>
			</div>
			<p>
				@{{searchResult.title}}
			</p>
			<div class="header">
				<strong class="primary-font">URL</strong>
			</div>
			<p>
				<a :href="searchResult.url">@{{searchResult.url}}</a>
			</p>
			<div class="header">
				<strong class="primary-font">Description</strong>
			</div>
			<p>
				@{{searchResult.description}}
			</p>
			<div v-if="!searchResult.is_already_added">
				<div class="form-group" v-if="addToCollectionVisibility">
					<div class="radio">
						<label>
							<input type="radio" v-model="addToExistingCollection" value="yes">
							Select collection to add
						</label>
					</div>
					<select class="form-control" v-model="selectedCollectionToAdd">
						<option v-for="collection in collections" :value="collection.id">@{{collection.title}}</option>
					</select>
					<div class="radio">
						<label>
							<input type="radio" v-model="addToExistingCollection" value="no">
							Or create a new collection
						</label>
					</div>
					<input class="form-control" type="text" v-model="newCollectionTitle">
				</div>
				<button class="btn btn-primary" @click="addToCollection">Add to Collection</button>
			</div>
		</div>
	</div>
</div>

<div class="col-xs-12 col-md-6 col-lg-9">
	<!-- untuk websitenya -->
	<div v-if="timeline && timeline.site">
		<div class="panel panel-primary" v-for="article in timeline.site.articles">
			<div class="panel-heading" style="background:#336E7B;">@{{article.title}}</div>
			<div class="panel-body">
				<small class="text-muted">@{{article.author}} | @{{article.pub_date}}</small>
				<p v-html="article.description"></p>
			</div>
			<div class="panel-footer">
				<p>
					<span class="glyphicon glyphicon-ok"></span>
					<a target="_blank" :href="article.link"> See more </a>
					<span class="glyphicon glyphicon-time"></span>
					<a href="javascript:void(0)" @click="saveItLater(article.id)"> Save it later</a>
				</p>
			</div>
		</div>
	</div>

	<!-- untuk semua article -->
	<div v-if="timeline && timeline.articles">
		<div class="panel panel-primary" v-for="article in timeline.articles.data">
			<div class="panel-heading" style="background:#336E7B;">@{{article.title}}</div>
			<div class="panel-body">
				<small class="text-muted">@{{article.author}} | @{{article.pub_date}}</small>
				<p v-html="article.description"></p>
			</div>
			<div class="panel-footer">
				<p>
					<span class="glyphicon glyphicon-ok"></span>
					<a target="_blank" :href="article.link"> See more </a>
					<span class="glyphicon glyphicon-time"></span>
					<a href="javascript:void(0)" @click="saveItLater(article.id)"> Save it later</a>
				</p>
			</div>
		</div>
		<div style="text-align: center" v-if="timeline.articles.current_page < timeline.articles.last_page">
			<button class="btn btn-link" @click="getNextTimeLine">Load More</button>
		</div>
		<div v-else>
			There is no entries.
		</div>
	</div>
</div>

<div class="col-xs-12 col-md-6 col-lg-3">
	<div class="panel panel-primary">
		<div class="panel-heading" style="background:#34495E;">
			YOU MIGHT ALSO LIKE
		</div>
		<div class="panel-body">
			<p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</p>
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
