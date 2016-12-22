<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
  @if (@$app_id === 'home')
  <form @submit.prevent="searchSites">
    <div class="form-group">
      <input type="text" class="form-control" placeholder="Search site" v-model="keyword">
      <span v-if="searchSitesLoading">
        Loading...
      </span>
    </div>
  </form>
  @endif
  <ul class="nav menu">
    @if (@$app_id === 'home')
    <li class="parent">
      <a href="javascript:void(0)" @click="getTimeLine({type: 'all'})">
        <span class="glyphicon glyphicon-home"></span>
        All
      </a>
    </li>
    <li>
      <a href="javascript:void(0)" @click="getTimeLine({type: 'today'})">
        <span class="glyphicon glyphicon-flag"></span>
        Today
      </a>
    </li>
    <li class="parent active" v-if="timelineLabel == 'My Saved Articles'">
      <a @click="getSavedArticles()" href="javascript:void(0)">
        <span class="glyphicon glyphicon-bookmark"></span>
        Saved Articles
      </a>
    </li>
    <li class="parent" v-else>
      <a @click="getSavedArticles()" href="javascript:void(0)">
        <span class="glyphicon glyphicon-bookmark"></span>
        Saved Articles
      </a>
    </li>
    <li class="parent ">
      <a data-toggle="collapse" href="#collect">
        <span class="glyphicon glyphicon-plus"></span>
        Collections
      </a>
      <ul class="children collapse" id="collect">
        <span v-if="!collections.length">Loading...</span>
        <li v-for="(collection, index) in collections" v-else class="parent">
          <a data-toggle="collapse" :href="'#collect-'+index">
            <span><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>
            @{{collection.title}}
          </a>
          <ul class="children collapse" :id="'collect-'+index">
            <li v-for="site in collection.sites">
              <a href="javascript:void(0)" @click="getTimeLine({url: site.url})">
                <svg class="glyph stroked arrow right"><use xlink:href="#stroked-arrow-right"/></svg>
                @{{site.title}}
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </li>
    @endif


</div><!--/.sidebar-->
