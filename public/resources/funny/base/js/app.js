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
        load: function () {
            return $http.post(this.getDomain());
        }
    }
});

App.controller("NewsfeedCtrl", function ($scope, PostServices, $http) {
    $scope.busy = false;

    $scope.loadPostList = function (type) {
        $scope.type = type;
        if ($scope.busy) return;
        $scope.busy = true;
        PostServices
            .load()
            .success(function (res) {
                if (!res.data || res.data.length < 1) {
                    return;
                }
                $scope.Posts = res.data;
                $scope.busy = false;
            })
    }
});
