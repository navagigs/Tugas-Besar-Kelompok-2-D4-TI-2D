var app = angular.module('App.services', [])

app.factory('kelasService', function ($http) {
    var baseUrl = 'http://localhost:8080/backend_ws/index.php/restfull/';
    return {
        getAll: function () {
            return $http.get(baseUrl + 'get_all_kelas');
        },
    };

})

app.factory('dosenService', function ($http) {
    var baseUrl = 'http://server.nava.web.id/dosen/';
    return {
        getAll: function () {
            return $http.get(baseUrl + 'get_all_dosen');
        },
    };

})

app.factory('mahasiswaService', function ($http) {
    var baseUrl = 'http://localhost:8080/backend_ws/index.php/restfull/';
    return {
        getAll: function () {
            return $http.get(baseUrl + 'get_all_mhs');
        },
        getIdkelas: function (kelasId) {
            return $http.get(baseUrl + 'get_id_kelas?kelas_id=' + kelasId);
        },
        getIdmahasiswa: function (mahasiswaId) {
            return $http.get(baseUrl + 'get_mhs?mahasiswa_id=' + mahasiswaId);
        },
        addMhs: function (data){
            return $http.post(baseUrl + 'add_mhs',data,{
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8;'
                }
            });
        },
        update: function (data){
            return $http.post(baseUrl+' edit_mhs',data,{
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8;'
                }
            });
        },
        delete: function  (mahasiswa_id){
            return $http.get(baseUrl+'hapus_mhs/?mahasiswa_id='+mahasiswa_id);
        }
    };

});