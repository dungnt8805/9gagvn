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
App.factory("VoteServices", function ($http) {
    return {
        getDomain: function () {
            return window.location.origin;
        },
        load: function (action, post_id) {
            return $http.post(this.getDomain() + '/vote/' + action, {
                post_id: post_id,
                _token: $('meta[name="_token"]').attr('content')
            });
        }
    }
});

App.controller("NewsfeedCtrl", function ($scope, PostServices, VoteServices, $http) {
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
    };
    $scope.like = function (post_id) {
        if ($scope.busy) return;
        $scope.busy = true;
        VoteServices.load("like", post_id)
            .success(function (res) {
                var likes = parseInt($('#point').html());
                $('.btn-vote .down').removeClass('alter');
                $('.btn-vote .up').addClass('alter');
                $('#point').html(likes + res.data);
                $scope.busy = false;
            });
    };
    $scope.dislike = function (post_id) {
        if ($scope.busy) return;
        $scope.busy = true;
        VoteServices.load("dislike", post_id)
            .success(function (res) {
                var likes = parseInt($('#point').html());
                $('#point').html(likes - res.data);
                $('.btn-vote .down').addClass('alter');
                $('.btn-vote .up').removeClass('alter');
                $scope.busy = false;
            }).failure(function () {
                $scope.busy = false;
            });

    }
});

App.directive('postBackImg', function () {
    return function (scope, element, attrs) {
        var image = attrs.postBackImg;
        element.css({
            'background-image': 'url(' + image + ')',
            'background-size': 'cover'
        });
    }
});

App.directive('actionLike', function () {
    return function (scope, element, attrs) {
        var post_id = attrs.actionLike;
        element.attr('ng-click', "like(" + post_id + ")");
    }
});
