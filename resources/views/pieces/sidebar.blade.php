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
      <a href="javascript:void(0)" @click="getTimeLine()">
        All
      </a>
    </li>
    <li>
      <a href="javascript:void(0)" @click="getTimeLine({type: 'today'})">
        Today
      </a>
    </li>
    <li class="parent ">
      <a href="javascript:void(0)">
        <span data-toggle="collapse" href="#savArt"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>
        Saved Articles
      </a>
      <ul class="children collapse" id="savArt">
        <li v-for="article in savedArticles">
          <a href="javascript:void(0)">
            @{{article.title}}
          </a>
        </li>
      </ul>
    </li>
    <li class="parent ">
      <a href="javascript:void(0)">
        <span data-toggle="collapse" href="#collect"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>
        Collections
      </a>
      <ul class="children collapse" id="collect">
        <span v-if="!collections.length">Loading...</span>
        <li v-for="collection in collections" v-else class="parent ">
          <a href="javascript:void(0)">
            <span data-toggle="collapse" href="#collection"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>
            @{{collection.title}}
          </a>
          <ul class="children collapse" id="collection">
            <li v-for="site in collection.sites">
              <a href="javascript:void(0)" @click="getTimeLine({url: site.url})">@{{site.title}}</a>
            </li>
          </ul>
        </li>
      </ul>
    </li>
    @endif
    <li class="active"><a href="index.html"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
    <li><a href="widgets.html"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Widgets</a></li>
    <li><a href="charts.html"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Charts</a></li>
    <li><a href="tables.html"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Tables</a></li>
    <li><a href="forms.html"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Forms</a></li>
    <li><a href="panels.html"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Alerts &amp; Panels</a></li>
    <li><a href="icons.html"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> Icons</a></li>
    <li class="parent ">
      <a href="#">
        <span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Dropdown
      </a>
      <ul class="children collapse" id="sub-item-1">
        <li>
          <a class="" href="#">
            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 1
          </a>
        </li>
        <li>
          <a class="" href="#">
            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 2
          </a>
        </li>
        <li>
          <a class="" href="#">
            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 3
          </a>
        </li>
      </ul>
    </li>
    <li role="presentation" class="divider"></li>
    <li><a href="login.html"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Login Page</a></li>
  </ul>

</div><!--/.sidebar-->
