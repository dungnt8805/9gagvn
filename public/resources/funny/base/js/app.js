/**
 * Created by dungnt13 on 9/10/2015.
 */
var App,
    Service;


/**
 * Configuration Application
 * @type {module}
 */
App = angular.module('App', [
    'infinite-scroll',
]);

App.factory("PostServices", function ($http) {
    return {
        getDomain: function () {
            return window.location.origin;
        },
        load: function (page) {
            return $http.post(this.getDomain(), {page: page});
        }
    }
});

App.controller("NewsfeedCtrl", function ($scope, PostServices, $http) {
    $scope.Posts = [];
    $scope.busy = false;
    $scope.page = 1;
    $scope.loadPostList = function (type) {
        $scope.type = type;
        if ($scope.busy) return;
        $scope.busy = true;
        PostServices
            .load($scope.page)
            .success(function (res) {
                if (!res.data || res.data.length < 1) {
                    return;
                } else {
                    for (var i in res.data) {
                        $scope.Posts.push(res.data[i]);
                    }
                }
                $scope.busy = false;
                $scope.page++;
            })
    }
});
