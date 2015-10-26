/**
 * Created by dungnt on 10/23/15.
 */

var App,
    Service;

App = angular.module('App', ['infinite-scroll']);

App.factory("PostServices", function ($http) {
    return {
        getDomain: function () {
            return window.location.origin;
        },
        load: function (url) {

        }
    }
})

App.factory('UserServices', function ($http) {
    return {
        getDomain: function () {
            return window.location.origin;
        },
        topUserSideBar: function () {
            return $http.post(this.getDomain() + '/users/top_sidebar');
        }
    }
})


App.controller('UserCtrl', function ($scope, UserServices, $http) {
    $scope.Users = [];
    $scope.busy = false;
    $scope.page = 1;
    $scope.loadTopSidebar = function () {
        if ($scope.busy) return;
        $scope.busy = true;
        UserServices.topUserSideBar()
            .success(function (res) {
                $scope.busy = false;
                if (!res.data || res.data.length < 1) {
                    return;
                } else {
                    for (var i in res.data) {
                        $scope.Users.push(res.data[i]);
                        console.log($scope.Users);
                    }
                }
            });
    }
})