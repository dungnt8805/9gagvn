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
                var likes = parseInt($('#point-' + post_id).html());
                $('#point-' + post_id).html(likes + res.data);
                $scope.busy = false;
            });
    };
    $scope.dislike = function (post_id) {
        if ($scope.busy) return;
        $scope.busy = true;
        VoteServices.load("dislike", post_id)
            .success(function (res) {
                var likes = parseInt($('#point-' + post_id).html());
                $('#point-' + post_id).html(likes - res.data);
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

(function (angular, document) {
    angular.module("AppVL", ['infinite-scroll', 'ngFileUpload', 'LocalStorageModule', 'ngCookie', 'ngAnimate', 'facebook'])
        .config(function (FacebookProvider, $httpProvider, localStorageServiceProvider, $provide) {
            localStorageServiceProvider.setPrefix('9gagvn');
            FacebookProvider.init({
                appId: fb_app_id,
                cookie: 1,
                xfbml: 1,
                version: 'v2.3'
            });
            $httpProvider.defaults.xsrfCookieName = '_token';
            $httpProvider.defaults.xsrfHeaderName = 'x-xsrf-token';
            $provide.decorator('$browser', ['$delegate', function ($delegate) {
                $delegate.onUrlChange = function () {
                };
                $delegate.url = function () {
                    return "";
                }
                return $delegate;
            }])
        }).run(function ($rootScope, localStorageService, $window, $cookie, GAGVN) {
            $rootScope.settings = localStorageService.get('settings') || {
                    quickSettings: false
                };
            $rootScope.userInfo = GAGVN.getUser();
            $rootScope._csrf = $cookie['_token'];
            GAGVN.initWindow();
        }).service('GAGVN', function ($rootScope, $http, $cookie, $window, $interval, Facebook, localStorageService, anchorSmoothScroll) {
            var timeout = 10000;
            this.reload;
            this.getData = function (url, data) {
                var config = {
                    timeout: timeout,
                    params: {
                        gagvn: 'JSON_CALLBACK',
                        _csrf: $cookie['_token']
                    }
                };
                angular.extend(config.params, data);
                return $http.json(url, config);
            };
            this.postData = function (url, data) {
                var config = {
                    timeout: timeout
                };
                return $http.post(url, data, config);
            };
            this.getUser = function () {
                var userInfo = localStorageService.get('userInfo') || null;
                if (!userInfo || userInfo.user_id != user_id) userInfo = null;
                return userInfo;
            }
        }).service('anchorSmoothScroll', function ($document, $window) {
            var document = $document[0];
            var window = $window;

            function getCurrentPagePosition(window, document) {
                if (window.pageYOffset) return window.pageYOffset;
                if (document.documentElement && document.documentElement.scrollTop)
                    return document.documentElement.scrollTop;
                if (document.body.scrollTop) return document.body.scrollTop;
                return 0;

            }
        })
})
(angular, document);
