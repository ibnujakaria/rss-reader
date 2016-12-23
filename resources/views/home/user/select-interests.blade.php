@extends('template', ['noSidebar' => true])

@section('title', 'Select Interests')

@section ('body')
<div class="panel panel-primary" style="margin-top: 50px" id="select-interests">
	<div class="panel-heading dark-overlay">
		Select Interests
	</div>
	<div class="panel-body">
		<button :class="{btn: true, 'btn-default': !isExists(interest), 'btn-success': isExists(interest)}" @click="select(interest)" style="margin-right: 10px" v-for="interest in interests">@{{interest.title}}</button>
	</div>

	<div class="panel-footer">
		<button class="btn btn-primary" @click="lanjutkan">Next @{{loading}}</button>
	</div>
</div>
@endsection


@section('script')
<script type="text/javascript">

	var csrf_token = '{{csrf_token()}}';

	var app = new Vue({
		el: '#select-interests',
		data: {
			interests: [],
			selected: [],
			loading: null
		},
		methods: {
			getInterests: function () {
				this.$http.get('/home/get-interests').then((response) => {
					this.interests = response.body.interests
				})
			},
			select: function (interest) {
				if (!this.isExists(interest)) {
					this.selected.push(interest)
				}
			},
			isExists: function (interest) {
				for (var i = 0; i < this.selected.length; i++) {
					if (this.selected[i].id === interest.id) {
						return true;
					}
				}

				return false
			},
			lanjutkan: function () {
				console.log("hello")
				var interests = []
				for (var i = 0; i < this.selected.length; i++) {
					interests.push(this.selected[i].id)
				}

				this.loading = 'Loading...'
				var notify = alertify.message('Saving interests..', 0)
				this.$http.post('/home/user/interest', {interests: interests, _token: csrf_token}).then((response) => {
					console.log(response.body)
					window.location = '/home'

					notify.dismiss();
					alertify.success('Success')
				})
			}
		}
	})

	app.getInterests()
</script>
@stop