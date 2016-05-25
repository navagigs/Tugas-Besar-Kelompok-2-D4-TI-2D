var app = angular.module('App.controllers', [])

app.controller('AppCtrl', function ($scope, $state, $stateParams, $ionicPopup, $window) {
	$scope.title = "D4-TI 2014";	
})


app.controller('HomeCtrl', function ($scope, $state, kelasService, dosenService, $timeout, $ionicLoading) {
	$scope.title = "Home";
	$scope.showData = function () {
		kelasService.getAll().success(function (data) {
			$scope.kelas = data;

			$timeout(function () {
				$ionicLoading.hide();
				$scope.kelas = data;
			}, 300);

		}).finally(function () {
			$scope.$broadcast('scroll.refreshComplete');
		});
	};
	$scope.showData();

	$scope.reload = function () {
		$state.go('app.home');
	};

	$scope.showData = function () {
			dosenService.getAll().success(function (datads) {
				$scope.dosen = datads;

				$timeout(function () {
					$ionicLoading.hide();
					$scope.dosen = datads;
				}, 300);

			}).finally(function () {
				$scope.$broadcast('scroll.refreshComplete');
			});
		};
		$scope.showData();

		$scope.reload = function () {
			$state.go('app.home');
		};

	$ionicLoading.show({
		content: 'Loading',
		animation: 'fade-in',
		showBackdrop: true,
		maxWidth: 100,
		showDelay: 0
	});
})

app.controller('ListmahasiswaCtrl', function ($scope, $state, mahasiswaService, $timeout, $ionicLoading) {
	$scope.title = "Mahasiswa";
		$scope.showData = function () {
		mahasiswaService.getAll().success(function (data) {
			$scope.mahasiswa = data;	
			$scope.entryLimit = "2";


			$timeout(function () {
				$ionicLoading.hide();
				$scope.mahasiswa = data;
			}, 300);

		 	$scope.delete = function (data){
		        mahasiswaService.delete(data.mahasiswa_id);
					//console.log('Success', resp);
		        $scope.datamahasiswas.splice($scope.datamahasiswas.indexOf(data),1);
					$window.location.reload(true);
					//$ionicHistory.goBack();
		      //  $state.go('app.list_mahasiswa');
					$state.go('app.home');
		    };

			$scope.limit1 = "1";
			$scope.currentPage = 1; //current page
			$scope.entryLimit = "4"; //max no of items to display in a page
			$scope.filteredItems = $scope.mahasiswa.length; //Initially for no filter  
			$scope.totalItems = $scope.mahasiswa.length;
			$scope.search = {};
			$scope.search.searchText = '';

		}).finally(function () {
			$scope.$broadcast('scroll.refreshComplete');
		});
	};
	$scope.showData();

	$scope.reload = function () {
		$state.go('app.list_mahasiswa');
	};
	$ionicLoading.show({
		content: 'Loading',
		animation: 'fade-in',
		showBackdrop: true,
		maxWidth: 100,
		showDelay: 0
	});
})

app.controller('mahasiswaCtrl', function ($scope, $stateParams, $timeout, mahasiswaService, $timeout, $ionicLoading) {
	$scope.showDataId = function () {
		mahasiswaService.getIdkelas($stateParams.kelasId).success(function (data) {
			$scope.mahasiswa = data;
			$scope.limit1 = "1";
			$scope.currentPage = 1; //current page
			$scope.entryLimit = "4"; //max no of items to display in a page
			$scope.filteredItems = $scope.mahasiswa.length; //Initially for no filter  
			$scope.totalItems = $scope.mahasiswa.length;
			$scope.search = {};
			$scope.search.searchText = '';

			$timeout(function () {
				$ionicLoading.hide();
				$scope.mahasiswa = data;
			}, 300);

		});
	};
	$scope.showDataId();

	$scope.setPage = function (pageNo) {
		$scope.currentPage = pageNo;
	};
	$scope.filter = function () {
		$timeout(function () {
			$scope.filteredItems = $scope.filtered.length;
		}, 10);
	};
	$scope.predicate = 'mahasiswa_nama';
	$scope.reverse = true;
	$scope.order = function (predicate) {
		$scope.reverse = ($scope.predicate === predicate) ? !$scope.reverse : false;
		$scope.predicate = predicate;
	};

	$ionicLoading.show({
		content: 'Loading',
		animation: 'fade-in',
		showBackdrop: true,
		maxWidth: 100,
		showDelay: 0
	});
})

app.controller('DetailMahasiswaCtrl', function ($scope, $window, $ionicHistory, $stateParams, $timeout, mahasiswaService, $timeout, $ionicLoading, $ionicPopup,$ionicModal) {
	$scope.title = "Detail Mahasiswa";
	$scope.showDataId = function () {
		mahasiswaService.getIdmahasiswa($stateParams.mahasiswaId).success(function (data) {
			$scope.mahasiswa = data;
			$scope.limit1 = "1";
			$scope.currentPage = 1; //current page
			$scope.entryLimit = "4"; //max no of items to display in a page
			$scope.filteredItems = $scope.mahasiswa.length; //Initially for no filter  
			$scope.totalItems = $scope.mahasiswa.length;
			$scope.search = {};
			$scope.search.searchText = '';

			$timeout(function () {
				$ionicLoading.hide();
				$scope.mahasiswa = data;
			}, 300);

		});
	};
	$scope.showDataId();
 
	$scope.setPage = function (pageNo) {
		$scope.currentPage = pageNo;
	};
	$scope.filter = function () {
		$timeout(function () {
			$scope.filteredItems = $scope.filtered.length;
		}, 10);
	};
	$scope.predicate = 'mahasiswa_nama';
	$scope.reverse = true;
	$scope.order = function (predicate) {
		$scope.reverse = ($scope.predicate === predicate) ? !$scope.reverse : false;
		$scope.predicate = predicate;
	};

   //FORM-EDIT
    $ionicModal.fromTemplateUrl('edit.html', function(modal){
        $scope.taskModal = modal;
	}, {
            scope : $scope,
            animation : 'slide-in-up'	
	});
        
        $scope.showAlert = function(msg) {
            $ionicPopup.alert({
                title: msg.title,
                template: msg.message,
                okText: 'Ok',
                okType: 'button-positive'
            });
          };
	
	$scope.editModal = function(){
            $scope.taskModal.show();
	};
	
	$scope.batal = function(){
            $scope.taskModal.hide();
            $scope.showDataId();
	};
        
    $scope.edit = function(mahasiswa_npm,mahasiswa_nama,mahasiswa_alamat,mahasiswa_email,mahasiswa_tlp,mahasiswa_agama,kelas_id){
            if (!mahasiswa_npm){
                $scope.showAlert({
                    title: "Information",
                    message: "mahasiswa_npm Mohon Diisi"
                });
            }else if (!mahasiswa_nama){
                $scope.showAlert({
                    title: "Information",
                    message: "mahasiswa_nama Mohon Diisi"
                });
            }else if(!mahasiswa_alamat){
                $scope.showAlert({
                    title: "Information",
                    message: "mahasiswa_alamat Mohon Diisi"
                });
            }else if(!mahasiswa_email){
                $scope.showAlert({
                    title: "Information",
                    message: "mahasiswa_email Mohon Diisi"
                });
            }else if(!mahasiswa_tlp){
                $scope.showAlert({
                    title: "Information",
                    message: "mahasiswa_tlp Mohon Diisi"
                });
            }else if(!mahasiswa_agama){
                $scope.showAlert({
                    title: "Information",
                    message: "mahasiswa_agama Mohon Diisi"
                });
            }else if(!kelas_id){
                $scope.showAlert({
                    title: "Information",
                    message: "kelas_id Mohon Diisi"
                });
            }else{
                $scope.mahasiswa_npm = mahasiswa_npm;
                $scope.mahasiswa_nama = mahasiswa_nama;
                $scope.mahasiswa_alamat = mahasiswa_alamat;
                $scope.mahasiswa_email = mahasiswa_email;
                $scope.mahasiswa_tlp = mahasiswa_tlp;
                $scope.mahasiswa_agama = mahasiswa_agama;
                $scope.kelas_id = kelas_id;
                mahasiswaService.update({
                    'mahasiswa_npm': mahasiswa_npm,
                    'mahasiswa_nama': mahasiswa_nama,
                    'mahasiswa_alamat': mahasiswa_alamat,
                    'mahasiswa_email': mahasiswa_email,
                    'mahasiswa_tlp': mahasiswa_tlp,
                    'mahasiswa_agama': mahasiswa_agama,
                    'kelas_id': kelas_id
                }).then(function(resp) {
                  console.log('Success', resp);
                  $scope.showAlert({
                        title: "Information",
                        message: "Data Telah Diupdate"
                    });
                },function(err) {
                  console.error('Error', err);
                }); 
            }
    };
    //END FORM EDIT
    
	$ionicLoading.show({
		content: 'Loading',
		animation: 'fade-in',
		showBackdrop: true,
		maxWidth: 100,
		showDelay: 0
	});
})



.controller('addMahasiswaCtrl', function($scope,$ionicPopup,mahasiswaService){
	$scope.title = "Tambah Mahasiswa";
    $scope.showAlert = function(msg) {
      $ionicPopup.alert({
          title: msg.title,
          template: msg.message,
          okText: 'Ok',
          okType: 'button-positive'
      });
    };
    
    $scope.data={};
    $scope.simpan = function (){
        if (!$scope.data.mahasiswa_npm){
            $scope.showAlert({
                title: "Information",
                message: "NPM mohon diisi"
            });
        }else if (!$scope.data.mahasiswa_nama){
            $scope.showAlert({
                title: "Information",
                message: "Nama mohon diisi"
            });
        }else if (!$scope.data.mahasiswa_alamat){
            $scope.showAlert({
                title: "Information",
                message: "Alamat mohon diisi"
            });
        }else if (!$scope.data.mahasiswa_email){
            $scope.showAlert({
                title: "Information",
                message: "E-mail mohon diisi"
            });
        }else if (!$scope.data.mahasiswa_tlp){
            $scope.showAlert({
                title: "Information",
                message: "No.Telpon mohon diisi"
            });
        }else if (!$scope.data.mahasiswa_agama){
            $scope.showAlert({
                title: "Information",
                message: "Agama mohon diisi"
            });
        }else if (!$scope.data.kelas_id){
            $scope.showAlert({
                title: "Information",
                message: "Kelas mohon diisi"
            });
        }else{
            mahasiswaService.addMhs({
                mahasiswa_npm: $scope.data.mahasiswa_npm,
                mahasiswa_nama: $scope.data.mahasiswa_nama,
                mahasiswa_alamat: $scope.data.mahasiswa_alamat,
                mahasiswa_email: $scope.data.mahasiswa_email,
                mahasiswa_tlp: $scope.data.mahasiswa_tlp,
                mahasiswa_agama: $scope.data.mahasiswa_agama,
                kelas_id: $scope.data.kelas_id
            }).success(function(data){
                $scope.showAlert({
                    title: "Information",
                    message: "Data Telah Tersimpan"
                });
			$window.location.reload(true);
            });
        }
        
    };
       
});


app.controller('ListdosenCtrl', function ($scope, $state, dosenService, $timeout, $ionicLoading) {
	$scope.title = "Dosen";
		$scope.showData = function () {
		dosenService.getAll().success(function (data) {
			$scope.dosen = data;	
			$scope.entryLimit = "2";

			$timeout(function () {
				$ionicLoading.hide();
				$scope.dosen = data;
			}, 300);

			$scope.limit1 = "1";
			$scope.currentPage = 1; //current page
			$scope.entryLimit = "4"; //max no of items to display in a page
			$scope.filteredItems = $scope.dosen.length; //Initially for no filter  
			$scope.totalItems = $scope.dosen.length;
			$scope.search = {};
			$scope.search.searchText = '';

		}).finally(function () {
			$scope.$broadcast('scroll.refreshComplete');
		});
	};
	$scope.showData();

	$scope.reload = function () {
		$state.go('app.list_dosen');
	};

	$ionicLoading.show({
		content: 'Loading',
		animation: 'fade-in',
		showBackdrop: true,
		maxWidth: 100,
		showDelay: 0
	});
})



app.controller('SettingCtrl', function ($scope, $state) {
	$scope.title = "Setting";
		$state.go('app.setting');

	});