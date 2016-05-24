var app = angular.module('App.routers', [])

app.config(function ($stateProvider, $urlRouterProvider) {
	$stateProvider

		.state('app', {
		url: '/app',
		abstract: true,
		templateUrl: 'views/default/menu.html',
		controller: 'AppCtrl'
	})

	.state('login', {
		url: '/login',
		templateUrl: 'views/default/login.html',
		controller: 'LoginCtrl'
	})
	.state('app.home', {
		url: '/home',
		views: {
			'menuContent': {
				templateUrl: 'views/default/home.html',
				controller: 'HomeCtrl'
			}
		}
	})

	.state('app.list_mahasiswa', {
		url: '/list_mahasiswa',
		views: {
			'menuContent': {
				templateUrl: 'views/default/list_mahasiswa.html',
				controller: 'ListmahasiswaCtrl'
			}
		}
	})

	.state('app.mahasiswa', {
		url: '/mahasiswa/:kelasId',
		views: {
			'menuContent': {
				templateUrl: 'views/default/mahasiswa.html',
				controller: 'mahasiswaCtrl'
			}
		}
	})

	.state('app.detail_mhs', {
		url: '/mahasiswa/detail_mhs/:mahasiswaId',
		views: {
			'menuContent': {
				templateUrl: 'views/default/detail_mahasiswa.html',
				controller: 'DetailMahasiswaCtrl'
			}
		}
	})


	.state('app.add_mahasiswa', {
		url: '/add_mahasiswa',
		views: {
			'menuContent': {
				templateUrl: 'views/default/add_mahasiswa.html',
				controller: 'addMahasiswaCtrl'
			}
		}
	})


	.state('app.list_dosen', {
		url: '/list_dosen',
		views: {
			'menuContent': {
				templateUrl: 'views/default/list_dosen.html',
				controller: 'ListdosenCtrl'
			}
		}
	})

	
	$urlRouterProvider.otherwise('/login');
});