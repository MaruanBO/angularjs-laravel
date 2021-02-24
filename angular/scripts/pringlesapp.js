var app = angular.module("PringlesApp", []);

// Controllers
app.controller("UsersCtrl", function($scope, UsersFactory) {
  $scope.users = [];
  $scope.name = "";
  $scope.email = "";

  var load = function() {
    UsersFactory.getUsers()
      .success(function(data) {
        $scope.users = data;
        console.log("Users loaded: ");
        console.log(data);
      })
      .error(function(err) {
        console.error(err);
      });
  };

  $scope.addUser = function() {
    var data = {
      'email': $scope.email,
      'name': $scope.name
    };
    UsersFactory.addUser(data)
      .success(function(data) {
        console.log("User added: ");
        console.log(data);
        load();
      })
      .error(function(err) {
        console.error(err);
        load();
      });
  };

  $scope.deleteUser = function(user) {
    UsersFactory.deleteUser(user.id)
      .success(function(data) {
        console.log("User deleted: ");
        console.log(data);
        load();
      })
      .error(function(err) {
        console.error(err);
        load();
      });
  };

  $scope.editUser = function(user) {
    UsersFactory.editUser(user)
      .success(function(data) {
        console.log("User edited: ");
        console.log(data);
        load();
      })
      .error(function(err) {
        console.error(err);
        load();
      });
  };

  load();
});

app.controller("PringlesCtrl", function($scope, PringlesFactory) {
  $scope.can = [];
  $scope.nombre_lata = "";
  $scope.color_principal = "";
  $scope.nacionalidad = "";
  $scope.who_user = "";
  
  var load = function() {
    PringlesFactory.getCans()
      .success(function(data) {
        $scope.can = data;
        console.log("Cans loaded: ");
        console.log(data);
      })
      .error(function(err) {
        console.error(err);
      });
  };

  $scope.addCan = function() {
    
    var data = {
      'nombre_lata': $scope.nombre_lata,
      'color_principal': $scope.color_principal,
      'nacionalidad': $scope.nacionalidad,
      'who_user': $scope.who_user
    };
    
    PringlesFactory.addCan(data)
      .success(function(data) {
        console.log("Can added: ");
        console.log(data);
        load();
      })
      .error(function(err) {
        console.error(err);
        load();
      });
  };

  $scope.deleteCan= function(can) {
    if (!confirm('Are you sure?')) return;
    PringlesFactory.deleteCan(can.id)
      .success(function(data) {
        console.log("Can deleted: ");
        console.log(data);
        load();
      })
      .error(function(err) {
        console.error(err);
        load();
      });
  };

  $scope.editCan = function(can) {
    if (!confirm('Are you sure?')) return;
    PringlesFactory.editCan(can)
      .success(function(data) {
        console.log("Can edited: ");
        console.log(data);
        load();
      })
      .error(function(err) {
        console.error(err);
        load();
      });
  };

  load();
});

// Factories
app.factory("UsersFactory", function($http) {
  var factory = {};
  var baseURL = "http://localhost:8080";
  
  factory.getUsers = function() {
    return $http.get(baseURL + '/api/user');
  };

  factory.addUser = function(data) {
    return $http.post(baseURL + '/api/user', data);
  };

  factory.deleteUser = function(data) {
    return $http.delete(baseURL + '/api/user/' + data);
  };

  factory.editUser = function(data) {
    return $http.put(baseURL + '/api/user/' + data.id, data);
  };

  return factory;
});

app.factory("PringlesFactory", function($http) {
  var factory = {};
  var baseURL = "http://localhost:8080";
  
  factory.getCans = function() {
    return $http.get(baseURL + '/api/can');
  };

  factory.addCan = function(data) {
    return $http.post(baseURL + '/api/can', data);
  };

  factory.deleteCan = function(data) {
    return $http.delete(baseURL + '/api/can/' + data);
  };

  factory.editCan = function(data) {
    return $http.put(baseURL + '/api/can/' + data.id, data);
  };

  return factory;
});
