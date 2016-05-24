var app = angular.module('App.services', [])

app.factory('kelasService', function ($http) {
	//var baseUrl = 'http://localhost:8080/tbwebservice/server/kelas/';
	var baseUrl = 'http://localhost:8080/tbwebservice/server/kelas/';
	return {
		getAll: function () {
			return $http.get(baseUrl + 'select.php');
		},
	};

})

app.factory('dosenService', function ($http) {
	var baseUrl = 'http://localhost:8080/tbwebservice/server/dosen/';
	return {
		getAll: function () {
			return $http.get(baseUrl + 'select_dosen.php');
		},
	};

})

app.factory('mahasiswaService', function ($http) {
	var baseUrl = 'http://localhost:8080/tbwebservice/server/mahasiswa/';
	return {
		getAll: function () {
			return $http.get(baseUrl + 'select_mhs.php');
		},
		getIdkelas: function (kelasId) {
			return $http.get(baseUrl + 'get_id_kelas.php?kelas_id=' + kelasId);
		},
		getIdmahasiswa: function (mahasiswaId) {
			return $http.get(baseUrl + 'get_id_mhs.php?mahasiswa_id=' + mahasiswaId);
		},
        addMhs: function (data){
            return $http.post(baseUrl + 'insert_mhs.php',data,{
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8;'
                }
            });
        },
        update: function (data){
            return $http.post(baseUrl+'update.php',data,{
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8;'
                }
            });
        },
        delete: function  (mahasiswa_id){
            return $http.get(baseUrl+'delete_mhs.php?mahasiswa_id='+mahasiswa_id);
        }
	};

})

app.factory('loginService', function ($http, AuthService) {
	var baseUrl = 'http://localhost:8080/tbwebservice/server/login/';
	return {
		getIdlogin: function () {
			return $http.get(baseUrl + 'select_id_login.php?login_username=' + AuthService.username());
		},
	};
});