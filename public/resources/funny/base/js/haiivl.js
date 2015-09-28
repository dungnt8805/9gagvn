
(function(angular, document) {
    angular.module('AppVL', ['ngAnimate', 'ngCookies', 'LocalStorageModule', 'facebook', 'infinite-scroll', 'ngFileUpload']).config(function(FacebookProvider, $httpProvider, localStorageServiceProvider, $provide) {
        localStorageServiceProvider.setPrefix('haivl');
        FacebookProvider.init({
            appId: '840430735988938',
            cookie: 1,
            xfbml: 1,
            version: 'v2.3'
        });
        $httpProvider.defaults.xsrfCookieName = '_cid';
        $httpProvider.defaults.xsrfHeaderName = 'x-xsrf-token';
        $provide.decorator('$browser', ['$delegate', function($delegate) {
            $delegate.onUrlChange = function() {};
            $delegate.url = function() {
                return ""
            };
            return $delegate;
        }]);
    }).run(function($rootScope, localStorageService, $window, $cookies, Haivl) {
        $rootScope.settings = localStorageService.get('settings') || {
                quickSettings: false
            };
        $rootScope.userInfo = Haivl.getUser();
        $rootScope._csrf = $cookies['_cid'];
        Haivl.initWindow();
    }).service('Haivl', function($rootScope, $http, $cookies, $window, $interval, Facebook, localStorageService, anchorSmoothScroll, Facebook) {
        var timeout = 10000;
        this.reload;
        this.getData = function(url, data) {
            var config = {
                timeout: timeout,
                params: {
                    haiivl: 'JSON_CALLBACK',
                    _csrf: $cookies['_cid']
                }
            };
            angular.extend(config.params, data);
            return $http.jsonp(url, config);
        };
        this.postData = function(url, data) {
            var config = {
                timeout: timeout
            }
            return $http.post(url, data, config);
        };
        this.getUser = function() {
            var userInfo = localStorageService.get('userInfo') || null;
            if (!userInfo || userInfo.user_id != user_id) userInfo = null;
            return userInfo;
        };
        this.fbAction = function(status) {
            if (!status) return;
            var self = this;
            var commentedCallback = function(url, html) {
                self.updateFBAction(url, 'comment.create');
            };
            var commentCallback = function(url, html) {
                self.updateFBAction(url, 'comment.remove');
            };
            var likedCallback = function(url, html) {
                self.updateFBAction(url, 'edge.create');
            };
            var likeCallback = function(url, html) {
                self.updateFBAction(url, 'edge.remove');
            };
            FB.Event.subscribe('edge.create', likedCallback);
            FB.Event.subscribe('edge.remove', likeCallback);
            FB.Event.subscribe('comment.create', commentedCallback);
            FB.Event.subscribe('comment.remove', commentCallback);
        };
        this.updateFBAction = function(url, type) {
            this.postData('/post/fb', {
                url: url,
                types: type
            });
        };
        this.trackADS = function(type, ads_id) {
            this.postData('/track/ads', {
                types: type,
                ads_id: ads_id
            });
        };
        this.scrollToTop = function() {
            anchorSmoothScroll.scrollToTop(0);
        };
        this.getCurrentPost = function() {
            var currentPosition = anchorSmoothScroll.getCurrentPagePosition(window, document);
            var index = 0;
            var entrys = angular.element(document.querySelector('#haivl-list-content')).find('article');
            var total = 0;
            for (var i = 0; i < entrys.length; i++) {
                total += entrys[i].offsetHeight;
                if (total >= currentPosition) {
                    index = i;
                    break;
                }
            }
            return {
                entrys: entrys,
                index: index,
                start: currentPosition
            };
        };
        this.jumpPostPrev = function() {
            var data = this.getCurrentPost();
            if (data.entrys.length == 0) return;
            if (data.index - 1 == 0) {
                anchorSmoothScroll.scrollToP(data.start, 0);
            } else if (data.index - 1 >= 0) {
                anchorSmoothScroll.scrollToP(data.start, anchorSmoothScroll.getElementY(document, data.entrys[data.index - 1]) - 68);
            }
        };
        this.jumpPostNext = function() {
            var data = this.getCurrentPost();
            if (data.entrys.length == 0) return;
            if (data.index + 1 <= data.entrys.length - 1) {
                if (data.index == 0) {
                    anchorSmoothScroll.scrollToP(data.start, anchorSmoothScroll.getElementY(document, data.entrys[1]) - 68 - 68);
                } else {
                    anchorSmoothScroll.scrollToP(data.start, anchorSmoothScroll.getElementY(document, data.entrys[data.index + 1]) - 68);
                }
            } else {
                var lastPost = anchorSmoothScroll.getElementY(document, data.entrys[data.index]);
                var stopY = lastPost + data.entrys[data.index].offsetHeight - 68;
                anchorSmoothScroll.scrollToP(data.start, stopY);
            }
        };
        this.keyEvent = function(keyCode) {
            var listPostElement = document.getElementById('haivl-list-content');
            if (listPostElement) {
                switch (keyCode) {
                    case 37:
                        this.jumpPostPrev();
                        break;
                    case 39:
                        this.jumpPostNext();
                        break;
                    case 75:
                        this.jumpPostPrev();
                        break;
                    case 74:
                        this.jumpPostNext();
                        break;
                };
            } else return;
        };
        this.clearReload = function() {
            if (this.reload) $interval.cancel(this.reload);
        };
        this.reloadPage = function(status) {
            if (status) {
                $cookies.windowBlur = 1;
                if ($window.location.pathname.indexOf('/video') >= 0) return;
                else {
                    this.reload = $interval(function() {
                        $window.location.reload();
                    }, 900000);
                }
            } else {
                $cookies.windowBlur = 0;
                this.clearReload();
            }
        };
        this.initWindow = function() {
            var self = this;
            angular.element($window).bind('blur', function() {
                self.reloadPage(true);
            });
            angular.element($window).bind('focus', function() {
                self.reloadPage(false);
            });
            if ($cookies.windowBlur == '1' || $cookies.windowBlur == 1) self.reloadPage(true);
        }
    }).service('anchorSmoothScroll', function($document, $window) {
        var document = $document[0];
        var window = $window;

        function getCurrentPagePosition(window, document) {
            if (window.pageYOffset) return window.pageYOffset;
            if (document.documentElement && document.documentElement.scrollTop)
                return document.documentElement.scrollTop;
            if (document.body.scrollTop) return document.body.scrollTop;
            return 0;
        }

        function getElementY(document, element) {
            var y = element.offsetTop;
            var node = element;
            while (node.offsetParent && node.offsetParent != document.body) {
                node = node.offsetParent;
                y += node.offsetTop;
            }
            return y;
        }
        this.getCurrentPagePosition = getCurrentPagePosition;
        this.getElementY = getElementY;
        this.scrollDown = function(startY, stopY, speed, distance) {
            var timer = 0;
            var step = Math.round(distance / 25);
            var leapY = startY + step;
            for (var i = startY; i < stopY; i += step) {
                setTimeout("window.scrollTo(0, " + leapY + ")", timer * speed);
                leapY += step;
                if (leapY > stopY) leapY = stopY;
                timer++;
            }
        };
        this.scrollUp = function(startY, stopY, speed, distance) {
            var timer = 0;
            var step = Math.round(distance / 25);
            var leapY = startY - step;
            for (var i = startY; i > stopY; i -= step) {
                setTimeout("window.scrollTo(0, " + leapY + ")", timer * speed);
                leapY -= step;
                if (leapY < stopY) leapY = stopY;
                timer++;
            }
        };
        this.scrollToTop = function(stopY) {
            scrollTo(0, stopY);
        };
        this.scrollTo = function(elementId, speed) {
            var element = document.getElementById(elementId);
            if (element) {
                var startY = getCurrentPagePosition(window, document);
                var stopY = getElementY(document, element);
                var distance = stopY > startY ? stopY - startY : startY - stopY;
                if (distance < 100) {
                    this.scrollToTop(stopY);
                } else {
                    var defaultSpeed = Math.round(distance / 100);
                    speed = speed || (defaultSpeed > 20 ? 20 : defaultSpeed);
                    if (stopY > startY) {
                        this.scrollDown(startY, stopY, speed, distance);
                    } else {
                        this.scrollUp(startY, stopY, speed, distance);
                    }
                }
            }
        };
        this.scrollToP = function(startY, stopY, speed) {
            var distance = stopY > startY ? stopY - startY : startY - stopY;
            if (distance < 100) {
                this.scrollToTop(stopY);
            } else {
                var defaultSpeed = Math.round(distance / 100);
                speed = speed || (defaultSpeed > 20 ? 20 : defaultSpeed);
                if (stopY > startY) {
                    this.scrollDown(startY, stopY, speed, distance);
                } else {
                    this.scrollUp(startY, stopY, speed, distance);
                }
            }
        };
    }).factory('Modal', function($sce, localStorageService) {
        var Modal = function($scope) {
            this.scope = $scope;
            this.modal = {};
            this.modalQueue = [];
            this.readyValue = false;
            this.activeModal = null;
            this.message = $sce.trustAsHtml('');
            this.__init();
        }
        Modal.prototype = {
            __init: function() {
                this.__modalWatch();
            },
            __modalWatch: function() {
                var self = this;
                this.scope.$watch('Modal.activeModal', function(newVal, oldVal) {});
            },
            __modalPopup: function(modal, status) {
                this.isOpen = status;
                this.modal[modal] = status;
                this.modalActive(modal, status);
            },
            modalActive: function(modal, status) {
                if (status) this.activeModal = modal;
            },
            modalReady: function(status) {
                this.readyValue = status;
            },
            modalMessage: function(message) {
                this.message = $sce.trustAsHtml(message);
            },
            __openModalQueue: function() {
                if (this.modalQueue[0] == 'vote') {
                    this.__clearVoteQueue();
                } else if (this.modalQueue[0]) {
                    this.__modalPopup(this.modalQueue[0], true);
                    this.modalQueue = [];
                }
            },
            __clearVoteQueue: function() {
                this.voteQueue.Post.vote(this.voteQueue.post_id, this.voteQueue.vote);
            },
            setVoteQueue: function(Post, post_id, vote) {
                this.voteQueue = {
                    Post: Post,
                    post_id: post_id,
                    vote: vote
                };
            },
            open: function(modal, modalQueue) {
                this.__modalPopup(modal, true);
                if (modalQueue) this.modalQueue.push(modalQueue);
            },
            close: function(modal, openQueue) {
                if (modal == 'notif') localStorageService.cookie.set('hideNotif', 1, 2);
                if (modal) {
                    this.__modalPopup(modal, false);
                    if (openQueue) this.__openModalQueue();
                } else {
                    var self = this;
                    _.forEach(this.modal, function(data, key) {
                        self.__modalPopup(key, false);
                    });
                }
            }
        };
        return Modal;
    }).factory('Post', function($rootScope, $sce, $timeout, $location, $compile, $window, Haivl, Facebook) {
        var listElement = document.getElementsByClassName('haivl-collection');
        var btnLoadMore = document.getElementsByClassName('badge-load-more-post');
        var wrappedElement = angular.element(listElement);
        var btnLoadMoreElement = angular.element(btnLoadMore) || null;
        var Post = function($scope) {
            $scope.postHide = [];
            $scope.post = [];
            this.scope = $scope;
            this.postView = [];
            this.pageLoad = 1;
            this.readyLoad = false;
            this.loadingText = $sce.trustAsHtml('Xem thÃªm cÃ²n nhiá»u láº¯m');
            this.path = $window.location.pathname;
            this.isProfile = false;
            this.showTips = false;
            this.scope.postPin = [];
            this.pageView, this.page, this.user_id, this.voteStatus, this.postUrl;
            this.__init();
        };
        Post.prototype = {
            __init: function() {
                this.error = false;
                this.__initPost();
                this.__loadingTextStatus();
                this.__updateURIPageNext();
                this.readyImage = isBOT || false;
                this.__readyLoad();
            },
            checkMod: function(post_id) {
                var postInfo = this.scope.post['post-' + post_id];
                this.showTips = (postInfo.status == 1);
            },
            initPin: function(post_ids) {
                this.scope.postPin = post_ids;
            },
            initInfo: function(post_id, user_id, point, status, hide_post, nsfw, types) {
                if (this.scope.post['post-' + post_id]) {
                    this.scope.post['post-' + post_id + 'd'] = {
                        hide_post: true
                    };
                    return;
                } else this.postView.push(post_id);
                this.scope.post['post-' + post_id] = {
                    post_id: post_id,
                    created_by: user_id,
                    point: point,
                    hide_post: hide_post,
                    status: status,
                    nsfw: nsfw,
                    types: types,
                    pin: (this.scope.postPin.indexOf(post_id) >= 0)
                };
                this.checkMod(post_id);
            },
            __loadingTextStatus: function(status) {
                var self = this;
                this.scope.$watch('Post.readyLoad', function(newVal, oldVal) {
                    if (newVal) self.loadingText = $sce.trustAsHtml('Äang táº£i thÃªm...');
                    else self.loadingText = $sce.trustAsHtml('Xem thÃªm cÃ²n nhiá»u láº¯m');
                });
                this.scope.$watch('Post.pageLoad', function(newVal) {
                    if (newVal === 3) self.loadingText = $sce.trustAsHtml('Xem thÃªm cÃ²n nhiá»u láº¯m');
                });
            },
            __updateURIPageNext: function() {
                var self = this;
                this.scope.$watch('Post.readyLoad', function(newVal, oldVal) {
                    if (!newVal) {
                        if (self.user_id) {
                            self.URIPageNext = baseUrl + '/' + self.page + '/' + self.user_id + '/' + (self.__getPageNext() + 1);
                        } else {
                            switch (self.page) {
                                case 'photo':
                                case 'link':
                                case 'video':
                                    self.URIPageNext = baseUrl + '/' + self.page + '/page/' + (self.__getPageNext() + 1);
                                    break;
                                default:
                                    self.URIPageNext = baseUrl + '/' + self.page + '/' + (self.__getPageNext() + 1);
                            }
                        }
                    }
                });
            },
            __initPost: function() {
                var tmpPath = this.path.split('/');
                this.pageView = tmpPath[2] || 1;
                this.page = tmpPath[1] || 'hot';
                switch (this.page) {
                    case 'photo':
                    case 'link':
                        this.pageView = tmpPath[3] || 1;
                        break;
                    case 'u':
                        this.isProfile = true;
                        this.user_id = tmpPath[2];
                        this.pageView = tmpPath[3] || 1;
                        break;
                }
            },
            __getPageView: function() {
                return parseInt(this.pageView, 10);
            },
            __getPageLoad: function() {
                return parseInt(this.pageLoad, 10);
            },
            __getPageNext: function() {
                return this.__getPageView() + this.__getPageLoad();
            },
            __getPage: function() {
                return this.page;
            },
            __getAjaxURI: function() {
                if (this.isProfile) return '/user/post';
                else return '/post/' + this.page;
            },
            __getAjaxParams: function() {
                var params = {
                    page: this.__getPageNext()
                };
                if (this.isProfile) params.user_id = this.user_id;
                return params;
            },
            __readyLoad: function() {
                var self = this;
                this.scope.$watch(function() {
                    return Facebook.isReady();
                }, function(newValue, oldValue) {
                    if (newValue) self.readyImage = true;
                    else self.readyImage = false;
                });
            },
            __getPostUrl: function(post_id) {
                var postType = (this.scope.post['post-' + post_id].types == 3) ? 'video' : 'photo';
                return baseUrl + '/' + postType + '/' + post_id;
            },
            loadMore: function(status) {
                var self = this;
                if (this.readyLoad || this.error) return;
                else {
                    this.readyLoad = true;
                    var pageURI = this.__getAjaxURI();
                    var params = this.__getAjaxParams();
                    Haivl.getData(pageURI, params).success(function(data, status) {
                        if (data.s) {
                            var elmData = data.d;
                            self.postView.forEach(function(post_id) {
                                if (elmData.indexOf('article-post-' + post_id) >= 0) {
                                    elmData.replace('post-' + post_id, 'post-' + post_id + 'd');
                                }
                            });
                            var elms = angular.element(elmData);
                            var compiled = $compile(elms);
                            wrappedElement.append(elms);
                            compiled(self.scope);
                            self.pageLoad++;
                            if (self.pageLoad < 3) self.readyLoad = false;
                        } else {
                            self.error = true;
                            self.errorText = data.e || 'Táº¡m thá»i háº¿t ná»™i dung táº£i thÃªm.';
                        }
                    }).error(function(data, status) {
                        self.error = true;
                        self.errorText = 'MÃ¡y chá»§ báº­n, hÃ£y thá»­ láº¡i sau Ã­t phÃºt.';
                    });
                }
            },
            setVote: function(post_id, value) {
                this.scope.post['post-' + post_id].vote = value;
            },
            getVote: function(post_id) {
                return this.scope.post['post-' + post_id].vote;
            },
            setPoint: function(post_id, point) {
                this.scope.post['post-' + post_id].point += point;
            },
            updatePoint: function(post_id, opinion, status) {
                if (status === 1) {
                    if (opinion === 1) this.setPoint(post_id, 1);
                    if (opinion === -1) this.setPoint(post_id, -1);
                } else if (status === 0) {
                    if (opinion === 1) this.setPoint(post_id, 2);
                    if (opinion === -1) this.setPoint(post_id, -2);
                } else {
                    if (opinion === 1) this.setPoint(post_id, -1);
                    if (opinion === -1) this.setPoint(post_id, 1);
                }
            },
            fbShare: function(url) {
                Facebook.ui({
                    method: 'share',
                    href: url,
                    display: 'popup'
                }, function(response) {
                    if (response && !response.error_code) {
                        Haivl.updateFBAction(url, 'edge.create');
                    } else return;
                });
            },
            vote: function(post_id, value, removeVote) {
                var self = this;
                if (this.voteStatus === true) {
                    $window.alert('Báº¡n Ä‘ang Vote vá»›i tá»‘c Ä‘á»™ Ã¡nh sÃ¡ng. HÃ£y thá»­ láº¡i sau Ã­t giÃ¢y.');
                    return;
                }
                if (!$rootScope.userInfo) {
                    this.scope.Modal.setVoteQueue(this.scope.Post, post_id, value);
                    this.scope.Modal.modalMessage('Báº¡n cáº§n Ä‘Äƒng nháº­p Ä‘á»ƒ thá»±c hiá»‡n tÃ­nh nÄƒng nÃ y.');
                    this.scope.Modal.open('login', 'vote');
                } else {
                    this.voteStatus = true;
                    var voteValue = this.getVote(post_id);
                    this.setVote(post_id, value);
                    if (voteValue && voteValue != value) {
                        this.updatePoint(post_id, value, 0);
                    } else if (voteValue === value) {
                        this.setVote(post_id, undefined);
                        this.updatePoint(post_id, value, null);
                    } else {
                        this.updatePoint(post_id, value, 1);
                    }
                    Haivl.postData('/post/vote-v2', {
                        post_id: post_id,
                        opinion: value
                    }).success(function(data, status) {
                        if (data.login) {
                            self.scope.Modal.setVoteQueue(self.scope.Post, post_id, value);
                            self.scope.Modal.modalMessage('Báº¡n cáº§n Ä‘Äƒng nháº­p Ä‘á»ƒ thá»±c hiá»‡n tÃ­nh nÄƒng nÃ y.');
                            self.scope.Modal.open('login', 'vote');
                            self.voteStatus = false;
                            return;
                        }
                        if (!data.s) {
                            $window.alert(data.e);
                        }
                        $timeout(function() {
                            self.voteStatus = false;
                        }, 500);
                        if (data.s) {}
                        return;
                    }).error(function(data, status) {
                        $window.alert('Káº¿t ná»‘i mÃ¡y chá»§ tháº¥t báº¡i, hÃ£y thá»­ láº¡i sau Ã­t phÃºt.');
                    });
                }
            }
        };
        return Post;
    }).factory('User', function($rootScope, $http, $window, Haivl, localStorageService, Facebook) {
        var User = function($scope) {
            this.scope = $scope;
            this.__init();
        };
        User.prototype = {
            __init: function() {
                this.__autoSaveToLocal();
                this.scope.topActive = 1;
                this.scope.viewMoreTop = '/top-user/all';
            },
            __saveToLocal: function(userInfo) {
                localStorageService.set('userInfo', userInfo);
            },
            __removeUserLocal: function() {
                localStorageService.remove('userInfo');
            },
            __setToRoot: function(userInfo) {
                $rootScope.userInfo = userInfo;
            },
            __autoSaveToLocal: function() {
                this.scope.$watch('userInfo', function(newVal, oldVal) {
                    if (oldVal && oldVal.user_id && newVal === null) $window.location.reload();
                });
            },
            getTop: function(types, all) {
                var self = this;
                this.scope.topActive = types || 3;
                Haivl.getData('/user/top', {
                    types: types,
                    all: all
                }).success(function(data) {
                    if (data.s && data.d) {
                        if (data.d.length == 0) self.scope.noTopUser = true;
                        else self.scope.noTopUser = false;
                        if (types === 1) {
                            data.d.forEach(function(user, key) {
                                data.d[key].total_point = user.week_point;
                            });
                            self.scope.topUser = data.d;
                            self.scope.viewMoreTop = '/top-user/week';
                        } else if (types === 2) {
                            data.d.forEach(function(user, key) {
                                data.d[key].total_point = user.month_point;
                            });
                            self.scope.topUser = data.d;
                            self.scope.viewMoreTop = '/top-user/month';
                        } else {
                            self.scope.topUser = data.d;
                            self.scope.viewMoreTop = '/top-user/all';
                        }
                    }
                });
            },
            getUserId: function() {
                return $rootScope.userInfo ? $rootScope.userInfo.user_id : null;
            },
            getUserGroup: function() {
                return $rootScope.userInfo ? $rootScope.userInfo.user_group : null;
            },
            saveUser: function(userInfo) {
                this.__setToRoot(userInfo);
                this.__saveToLocal(userInfo);
            },
            removeLogin: function() {
                this.__setToRoot(null);
                this.__removeUserLocal()
            },
            ping: function(cb) {
                var self = this;
                Haivl.getData('/user/ping', {}).success(function(data, status) {
                    cb(data.s);
                    if (data.s) {
                        $rootScope.userInfo = data.d;
                        self.saveToLocal(data.d);
                    }
                });
            },
            __login: function(data, cb) {
                $http.post('/user/login', data, {
                    timeout: 5000
                }).success(function(data) {
                    cb(data);
                }).error(function() {
                    cb({
                        s: false,
                        e: 'Káº¿t ná»‘i mÃ¡y chá»§ tháº¥t báº¡i. HÃ£y thá»­ láº¡i sau Ã­t phÃºt.'
                    });
                });
            },
            login: function(data, cb, type) {
                if (type == 'normal') {
                    data.type = 'normal';
                    this.__login(data, cb);
                } else {
                    var postLogin = {
                        type: 'fb',
                        fbid: data.authResponse.userID,
                        access_token: data.authResponse.accessToken
                    };
                    this.__login(postLogin, cb);
                }
            },
            logout: function() {
                var self = this;
                $http.post('/user/logout', {}, {
                    timeout: 5000
                }).success(function(data) {
                    self.removeLogin();
                });
            },
            banned: function(user_id) {
                Haivl.postData('/user/banned', {
                    user_id: user_id
                }).success(function(data) {
                    if (data.s) $window.alert('ÄÃ£ ban haivler nÃ y.');
                    else $window.alert(data.e);
                }).error(function() {
                    $window.alert('MÃ¡y chá»§ báº­n. HÃ£y thá»­ láº¡i sau Ã­t phÃºt.');
                })
            },
            saveNewToken: function(fb_id, access_token) {
                $http.post('/user/save-token', {
                    fb_id: fb_id,
                    access_token: access_token
                });
            },
            parsePermission: function(lstPer, permission, isObj) {
                var status = false;
                if (lstPer === null) return false;
                if (isObj) {
                    lstPer.forEach(function(item) {
                        if (item.permission === permission && item.status === 'granted') status = true;
                        if (item.permission === permission && item.status === 'declined') status = -1;
                    });
                } else {
                    if (lstPer.indexOf(permission) >= 0) status = true;
                }
                return status;
            },
            getPermission: function(fb_id, access_token, cb) {
                Facebook.api('/' + fb_id + '/permissions', {
                    access_token: access_token
                }, function(response) {
                    cb(response.data || null);
                });
            },
            resendPermission: function(permission, cb) {
                var self = this;
                Facebook.login(function(res) {
                    if (res.status == 'connected' && res.authResponse) {
                        if (self.parsePermission(res.authResponse.grantedScopes || null, permission, false)) {
                            self.saveNewToken(res.authResponse.userID, res.authResponse.accessToken);
                            cb(true);
                        } else cb(false);
                    } else {
                        cb(false);
                    }
                }, {
                    scope: 'email, public_profile, publish_actions',
                    return_scopes: true
                });
            },
            revokePermission: function(fb_id, permission, access_token, cb) {
                Facebook.api('/' + fb_id + '/permissions/' + permission, 'delete', {
                    access_token: access_token
                }, function(response) {
                    cb(true);
                });
            },
            checkPermission: function(permission, cb, autoRenew) {
                var self = this;
                Haivl.getData('/user/info', {
                    user_id: self.getUserId()
                }).success(function(data, err) {
                    if (data.s && data.d) {
                        var userInfo = data.d;
                        self.getPermission(userInfo.fb_id, userInfo.access_token, function(data) {
                            var status = self.parsePermission(data, permission, true);
                            if (status === false) {
                                if (autoRenew) self.resendPermission(permission, cb);
                                else cb(false);
                            } else if (status === -1) {
                                self.revokePermission(userInfo.fb_id, permission, userInfo.access_token, function() {
                                    if (autoRenew) self.resendPermission(permission, cb);
                                    else cb(false);
                                });
                            } else {
                                cb(true);
                            }
                        });
                    } else cb(false);
                }).error(function() {});
            }
        };
        return User;
    }).factory('Setting', function($rootScope, $window, $http, $cookies, Upload, Haivl, Facebook) {
        var Setting = function(scope) {
            this.scope = scope;
            scope.preLoadingText = null;
        };
        Setting.prototype = {
            activeFB: function() {
                var self = this;
                Facebook.login(function(res) {
                    if (res.status === 'connected') {
                        Haivl.postData('/user/active-fb', {
                            fbid: res.authResponse.userID,
                            access_token: res.authResponse.accessToken
                        }).success(function(data, status) {
                            if (data.s === false) $window.alert(data.e);
                            else self.getInfo();
                        }).error(function(data, status) {
                            $window.alert('Káº¿t ná»‘i tháº¥t báº¡i, hÃ£y thá»­ láº¡i sau Ã­t phÃºt.');
                        });
                    } else return;
                }, {
                    scope: 'email, public_profile, publish_actions'
                });
            },
            getInfo: function() {
                var self = this;
                Haivl.getData('/user/info', {
                    user_id: $rootScope.userInfo ? $rootScope.userInfo.user_id : null
                }).success(function(data) {
                    if (data.s) self.scope.profile = data.d;
                    else $window.alert(data.e);
                }).error(function() {
                    $window.alert('Lá»—i káº¿t ná»‘i.');
                })
            },
            avatar: function(file) {
                var fileAvatar = file[0];
                var self = this;
                if (!fileAvatar || self.scope.preLoadingText) return;
                Upload.upload({
                    url: '/user/avatar',
                    method: 'POST',
                    headers: {
                        'x-xsrf-token': $cookies['_cid']
                    },
                    file: fileAvatar,
                    fileFormDataName: 'image'
                }).progress(function(evt) {
                    self.scope.preLoadingText = parseInt(100.0 * evt.loaded / evt.total) + '%';
                }).success(function(data, status, headers, config) {
                    self.scope.preLoadingText = null;
                    if (data.s) {
                        $rootScope.userInfo.avatar = data.avatar;
                        self.scope.$parent.User.__saveToLocal($rootScope.userInfo);
                    } else $window.alert(data.e);
                }).error(function() {
                    self.scope.preLoadingText = null;
                    $window.alert('Lá»—i káº¿t ná»‘i.');
                });
            },
            saveInfo: function(field) {
                var userInfo = this.scope.profile;
                if (field == 'password') {
                    if (!userInfo.newPassword && !userInfo.rePassword) return;
                    if (userInfo.newPassword != userInfo.rePassword) {
                        return $window.alert('Hai máº­t kháº©u má»›i chÆ°a khá»›p.');
                    }
                }
                $http.post('/user/update2', {
                    field: field,
                    data: userInfo
                }).success(function(data) {
                    if (data.e) $window.alert(data.e);
                    if (data.s) {
                        if (field == 'password') $window.alert('ÄÃ£ cáº­p nháº­t máº­t kháº©u.');
                        else $window.alert('ÄÃ£ lÆ°u nhá»¯ng thay Ä‘á»•i.')
                    };
                }).error(function() {
                    $window.alert('Lá»—i káº¿t ná»‘i.');
                });
            }
        };
        return Setting;
    }).factory('Notif', function($rootScope, $sce, $window, $interval, Haivl) {
        var Notif = function($scope) {
            this.scope = $scope;
            this.pageView = 1;
            this.count = 0;
            this.list = [];
            this.loadingText = $sce.trustAsHtml('Xem thÃªm thÃ´ng bÃ¡o');
            this.lockLoadmore = false;
            this.__init();
        };
        Notif.prototype = {
            __init: function() {
                $interval(this.ping(), 300000);
            },
            get: function() {
                var self = this;
                if (this.lockLoadmore) return;
                this.lockLoadmore = true;
                this.loadingText = $sce.trustAsHtml('Äang táº£i thÃ´ng bÃ¡o...');
                Haivl.postData('/notification/gets', {
                    page: self.pageView,
                    last_item: this.list[this.list.length - 1] ? this.list[this.list.length - 1].created_date : undefined
                }).success(function(data) {
                    this.count = 0;
                    if (data.s) {
                        self.pageView += 1;
                        self.lockLoadmore = false;
                        self.loadingText = $sce.trustAsHtml('Xem thÃªm thÃ´ng bÃ¡o');
                        self.list = self.list.concat(data.d);
                    } else {
                        self.error = true;
                        self.errorText = $sce.trustAsHtml(data.e);
                    }
                }).error(function(data) {
                    $window.alert('Káº¿t ná»‘i mÃ¡y chá»§ tháº¥t báº¡i. HÃ£y thá»­ láº¡i sau Ã­t phÃºt!');
                });
            },
            ping: function() {
                var self = this;
                Haivl.getData('/notification/count', {}).success(function(data) {
                    if (data.d) self.count = parseInt(data.d, 10);
                });
            }
        };
        return Notif;
    }).factory('nowTime', function($timeout) {
        var nowTime = Date.now();
        var updateTime = function() {
            $timeout(function() {
                nowTime = Date.now();
                updateTime();
            }, 1000);
        };
        updateTime();
        return function() {
            return nowTime;
        };
    }).factory('timeAgo', function() {
        var service = {};
        service.settings = {
            refreshMillis: 60000,
            allowFuture: false,
            strings: {
                'vi_VN': {
                    prefixAgo: null,
                    prefixFromNow: null,
                    suffixAgo: 'trÆ°á»›c',
                    suffixFromNow: 'vá»«a xong',
                    seconds: 'vÃ i giÃ¢y',
                    minute: '1 phÃºt',
                    minutes: '%d phÃºt',
                    hour: '1 tiáº¿ng',
                    hours: '%d tiáº¿ng',
                    day: 'má»™t ngÃ y',
                    days: '%d ngÃ y',
                    month: '1 thÃ¡ng',
                    months: '%d thÃ¡ng',
                    year: '1 nÄƒm',
                    years: '%d nÄƒm',
                    numbers: []
                }
            }
        };
        service.inWords = function(distanceMillis) {
            var lang = document.documentElement.lang;
            var $l = service.settings.strings[lang];
            if (typeof $l === 'undefined') {
                $l = service.settings.strings['vi_VN'];
            }
            var prefix = $l.prefixAgo;
            var suffix = $l.suffixAgo;
            if (service.settings.allowFuture) {
                if (distanceMillis < 0) {
                    prefix = $l.prefixFromNow;
                    suffix = $l.suffixFromNow;
                }
            }
            var seconds = Math.abs(distanceMillis) / 1000;
            var minutes = seconds / 60;
            var hours = minutes / 60;
            var days = hours / 24;
            var years = days / 365;

            function substitute(stringOrFunction, number) {
                var string = angular.isFunction(stringOrFunction) ? stringOrFunction(number, distanceMillis) : stringOrFunction;
                var value = ($l.numbers && $l.numbers[number]) || number;
                return string.replace(/%d/i, value);
            }
            var words = seconds < 45 && substitute($l.seconds, Math.round(seconds)) || seconds < 90 && substitute($l.minute, 1) || minutes < 45 && substitute($l.minutes, Math.round(minutes)) || minutes < 90 && substitute($l.hour, 1) || hours < 24 && substitute($l.hours, Math.round(hours)) || hours < 42 && substitute($l.day, 1) || days < 30 && substitute($l.days, Math.round(days)) || days < 45 && substitute($l.month, 1) || days < 365 && substitute($l.months, Math.round(days / 30)) || years < 1.5 && substitute($l.year, 1) || substitute($l.years, Math.round(years));
            var separator = $l.wordSeparator === undefined ? ' ' : $l.wordSeparator;
            return [prefix, words, suffix].join(separator).trim();
        };
        service.parse = function(iso8601) {
            if (angular.isNumber(iso8601)) {
                return parseInt(iso8601, 10);
            }
            var s = (iso8601 || '').trim();
            s = s.replace(/\.\d+/, '');
            s = s.replace(/-/, '/').replace(/-/, '/');
            s = s.replace(/T/, ' ').replace(/Z/, ' UTC');
            s = s.replace(/([\+\-]\d\d)\:?(\d\d)/, ' $1$2');
            return new Date(s);
        };
        return service;
    }).controller('HaivlCtrl', function($rootScope, $scope, $cookies, $timeout, $window, localStorageService, Facebook, User, Modal, Haivl, Notif) {
        $scope.gamePlayer = [];
        $scope.loadmore = 0;
        $scope.hideStick = $cookies['haivl.hideStick'] || false;
        $scope.User = new User($scope);
        $scope.Modal = new Modal($scope);
        $scope.Notif = new Notif($scope);
        $scope.postEdit = null;

        function setCookie(cname, cvalue) {
            var d = new Date();
            d.setTime(d.getTime() + (15 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + "; " + expires + ";path=/";
        }
        if ($cookies['ixengonline']) {
            $scope.gamePlayer['ixengonline'] = $cookies['ixengonline'];
        } else {
            var userOnline = _.random(285, 350);
            $scope.gamePlayer['ixengonline'] = userOnline;
            setCookie('ixengonline', userOnline);
        }
        $scope.haiKeyEvent = function(e) {
            if ($scope.Modal.isOpen) return;
            Haivl.keyEvent(e.keyCode);
        };
        $scope.hideSticky = function(status) {
            $scope.hideStick = status;
            localStorageService.cookie.set('hideStick', 1, 2);
            ga('send', 'event', 'button', 'click', 'hide-stick');
        };
        $scope.$watch(function() {
            return $rootScope.settings;
        }, function(newVal, oldVal) {
            localStorageService.set('settings', newVal);
        });
        $scope.$watch(function() {
            return Facebook.isReady();
        }, function(FBStatus) {
            Haivl.fbAction(FBStatus);
        });
        $timeout(function() {
            if ($window.location.pathname == '/thong-bao') {
                localStorageService.cookie.set('hideNotif', 1, 2);
            }
            if ($window.location.pathname != '/thong-bao' && !$cookies['haivl.hideNotif']) {
                $scope.Modal.open('notif');
            }
        }, 2000);
    }).controller('PostCtrl', function($scope, $window, Post, Haivl) {
        var pinPrompt;
        $scope.Post = new Post($scope);
        $scope.pinPost = function(action, postInfo) {
            if (action == 'unpin') {
                $scope.updatePost2('pin', 0, postInfo);
            } else {
                pinPrompt = $window.prompt('Nháº­p vá»‹ trÃ­ bÃ i muá»‘n PIN (vá»‹ trÃ­ tá»« 1-3)', 1);
                if (pinPrompt != "" && pinPrompt !== null && [1, 2, 3, '1', '2', '3'].indexOf(pinPrompt) >= 0) {
                    $scope.updatePost2('pin', pinPrompt, postInfo);
                };
            }
        }
        $scope.updatePost2 = function(action, status, postInfo) {
            Haivl.postData('/post/update', {
                action: action,
                post: postInfo.post_id,
                status: status
            }).success(function(data, status) {
                if (data.s) {
                    if (data.d.status != undefined) postInfo.status = data.d.status;
                    if (data.d.hide_post != undefined) postInfo.hide_post = data.d.hide_post;
                    if (data.d.nsfw != undefined) postInfo.nsfw = data.d.nsfw;
                    if (data.d.is_delete != undefined) {
                        postInfo.is_delete = data.d.is_delete;
                        $window.alert('ÄÃ£ xÃ³a post.');
                    }
                    if (data.d.edit === true) {
                        $scope.$parent.postEdit = data.postInfo;
                        $scope.$parent.Modal.open('upload');
                    }
                    if (action == 'pin') return $window.alert('ÄÃ£ lÆ°u cáº­p nháº­t. HÃ£y táº£i láº¡i trang Ä‘á»ƒ xem.');
                } else {
                    $window.alert(data.e);
                }
            }).error(function(data, status) {
                $window.alert('MÃ¡y chá»§ báº­n. HÃ£y táº£i láº¡i trang vÃ  thá»­ láº¡i.');
            });
        };
    }).controller('UserQuickCtrl', function($scope, $timeout, $window, Facebook) {
        var parent = $scope.$parent;
        if (parent.Modal.message) {
            $timeout(function() {
                parent.Modal.modalMessage('');
            }, 5000);
        }
        var parseLogin = function(data) {
            if (data.s) {
                parent.User.saveUser(data.d);
                $scope.loginStatus = 3;
                parent.Modal.close('login', true);
            } else {
                $window.alert(data.e);
            }
        };
        $scope.checkLogin = function() {
            parent.User.ping(function(status) {
                if (status) parent.Modal.close('login', true);
            });
        };
        $scope.loginStatus = 1;
        $scope.fbLogin = function() {
            Facebook.login(function(res) {
                if (res.authResponse) {
                    $scope.loginStatus = 2;
                    parent.User.login(res, parseLogin);
                } else {
                    $scope.loginStatus = 1;
                }
            }, {
                scope: 'email, public_profile, publish_actions'
            });
        };
        $scope.loginNormal = function() {
            parent.User.login(this.user, parseLogin, 'normal');
        };
    }).controller('MemeCtrl', function($rootScope, $scope, $window, Haivl) {
        $scope.preloadPost = true;
        $scope.sorted = false;
        var parent = $scope.$parent;
        $scope.makeMeme = function(meme) {
            $rootScope.memeMakeInfo = meme;
            if ($rootScope.userInfo) {
                parent.Modal.open('meme-make');
            } else {
                parent.Modal.open('login', 'meme-make');
            }
        };
        $scope.addMeme = function() {
            parent.Modal.open('meme-info');
        };
        $scope.editMeme = function(meme) {
            $scope.$parent.memeSelect = meme;
            parent.Modal.open('meme-info');
        };
        $scope.deleteMeme = function(meme) {
            var s = $window.confirm('Báº¡n thá»±c sá»± muá»‘n xÃ³a Meme nÃ y?\nBáº¥m [OK] Ä‘á»ƒ tiáº¿p tá»¥c...');
            if (s) {
                Haivl.postData('/meme/delete', meme).success(function(data, status) {
                    if (data.s) {
                        $window.alert(data.d);
                        $window.location.reload();
                    } else $window.alert(data.e);
                });
            }
        };
        $scope.getMeme = function() {
            Haivl.postData('/meme/list', {
                sorted: $scope.sorted
            }).success(function(data, status) {
                $scope.preloadPost = false;
                if (data.s) $scope.listMeme = data.d;
            }).error(function() {
                $scope.preloadPost = false;
            })
        };
    }).controller('makerCtrl', function($scope, $rootScope, $http, Upload, $cookies, $timeout, $location, $window) {
        $scope.inputLineTop = 'DÃ²ng trÃªn';
        $scope.inputLineBot = 'DÃ²ng dÆ°á»›i';
        $scope.meme = $rootScope.memeMakeInfo;
        $scope.message = {};
        $scope.lockUpload = false;
        var validData = function(post) {
            if (!post.title) return 'HÃ£y nháº­p tiÃªu Ä‘á»';
            if (post.title.length <= 5) return 'TiÃªu Ä‘á» cá»§a báº¡n quÃ¡ ngáº¯n, tá»‘i thiá»ƒu 5 kÃ½ tá»±.';
            return true;
        };
        $scope.reloadMeme = function() {
            $window.location.reload();
        };
        $scope.uploadMeme = function(post) {
            var status = validData(post);
            if (status === true) {
                $scope.lockUpload = true;
                post.fileUpload = 2;
                var paramsUpload = {
                    url: '/post/upload',
                    method: 'POST',
                    headers: {
                        'x-xsrf-token': $cookies['_cid']
                    },
                    data: post
                };
                $scope.upload = Upload.upload(paramsUpload);
                $scope.upload.then(function(res) {
                    var data = null;
                    $timeout(function() {
                        data = res.data;
                        if (data.s && data.d) {
                            $window.location = data.d;
                        } else if (!data.s && data.login) {
                            parent.Modal.open('login', 'meme-make');
                        } else {
                            $scope.lockUpload = false;
                            $scope.message = {
                                s: true,
                                m: data.e
                            };
                        }
                    });
                }, function(res) {
                    $scope.lockUpload = false;
                    if (res.status === 403) $scope.message = {
                        s: true,
                        m: 'Báº¡n khÃ´ng cÃ³ quyá»n truy Ä‘á»ƒ thá»±c hiá»‡n thao tÃ¡c nÃ y.'
                    };
                }, function(evt) {});
            } else {
                $scope.message.m = status;
            }
        };
    }).controller('memeInfoCtrl', function($rootScope, $scope, Upload, $location, $cookies, $timeout, $sce) {
        var fileAllow = /image\/(jpg|jpeg|png)$/i;
        var maxSize = 1024 * 1024 * 10;
        var uploadUrl = '/meme/push';
        var validData = function(post, file) {
            var errorPost = {};
            var status = true;
            if (!file && !post.meme_id) errorPost.photo = $sce.trustAsHtml('Báº¡n chÆ°a chá»n file áº£nh.');
            if (file && file.size > maxSize) errorPost.photo = $sce.trustAsHtml('Táº­p tin quÃ¡ lá»›n.');
            if (file && !fileAllow.test(file.type)) errorPost.photo = $sce.trustAsHtml('KhÃ´ng há»— trá»£ file nÃ y.');
            if (!post.name) errorPost.name = $sce.trustAsHtml('Viáº¿t vÃ i tá»« mÃ´ táº£ nÃ o :)');
            Object.keys(errorPost).forEach(function(data) {
                if (data) status = false;
            });
            $scope.errorPost = errorPost;
            return status;
        };
        var uploadPost = function(meme, file) {
            var paramsUpload = {
                url: uploadUrl,
                method: 'POST',
                headers: {
                    'x-xsrf-token': $cookies._cid
                },
                data: {
                    postData: meme
                }
            };
            if (file) {
                paramsUpload.file = file;
                paramsUpload.fileFormDataName = 'image';
            }
            $scope.upload = Upload.upload(paramsUpload);
            $scope.upload.then(function(res) {
                var data = null;
                $timeout(function() {
                    data = res.data;
                    $scope.lockUpload = false;
                    if (data.s && data.d) {
                        $scope.message = {
                            s: false,
                            m: $sce.trustAsHtml('HoÃ n táº¥t...')
                        };
                        $timeout(function() {
                            $scope.message = {};
                        }, 3000)
                    } else if (data.login) {
                        $rootScope.modalReg = true;
                        $rootScope.modalMemeInfo = false;
                    } else $scope.message = {
                        s: true,
                        m: $sce.trustAsHtml(data.e)
                    };
                });
            }, function(res) {
                $scope.lockUpload = false;
                if (res.status === 403) $scope.message = {
                    s: true,
                    m: 'Báº¡n khÃ´ng cÃ³ quyá»n Ä‘á»ƒ thá»±c hiá»‡n thao tÃ¡c nÃ y.'
                };
            }, function(evt) {});
        };
        $scope.meme = $scope.$parent.memeSelect || {};
        $scope.errorPost = {};
        $scope.message = {};
        $scope.lockUpload = false;
        $scope.selectedFiles = [];
        $scope.selectFile = function($files) {
            $scope.selectedFiles = $files;
        };
        $scope.submitMeme = function() {
            if (validData($scope.meme, $scope.selectedFiles[0])) {
                $scope.lockUpload = true;
                uploadPost($scope.meme, $scope.selectedFiles[0]);
            };
        };
    }).controller('UploadCtrl', function($sce, $rootScope, $scope, $cookies, $location, $timeout, $window, Upload) {
        if (!$rootScope.userInfo) {
            $scope.$parent.Modal.modalMessage('Báº¡n cáº§n Ä‘Äƒng nháº­p Ä‘á»ƒ cÃ³ thá»ƒ Ä‘Äƒng Ä‘Æ°á»£c áº£nh.');
            $scope.$parent.Modal.close('upload');
            $scope.$parent.Modal.open('login', 'upload');
            return;
        }
        $scope.errorPost = {};
        $scope.message = {};
        $scope.lockUpload = false;
        $scope.post = {
            fileUpload: 1
        };
        $scope.isEditPost = !!$scope.$parent.postEdit;
        $scope.progressCount = '0%';
        var fileAllow = /image\/(gif|jpe?g|png)$/i;
        var maxSize = 1024 * 1024 * 10;
        var hasCheckPermission = false;
        var parent = $scope.$parent;
        var uploadUrl = '/post/upload';
        var isYoutube = function(url) {
            var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
            var match = url.match(regExp);
            if (match && match[7].length == 11) return match[7];
            else return false;
        };
        var isMeCloud = function(string) {
            var regex = /\[mecloud\](.+?)\[\/mecloud\]/;
            var parse = string.match(regex);
            if (parse && parse[1]) return parse[1];
            else return false;
        };
        var isFacebook = function(url) {
            url = url.replace(/https?:\/\//i, '').split('/');
            if (url[0].indexOf('facebook.com') >= 0) return true;
            else return false;
        };
        var isImage = function(url) {
            return /(https?:\/\/.*\.(?:gif|jpe?g|png))$/i.test(url);
        };
        var validData = function(post, file) {
            var errorPost = {};
            var status = true;
            if (post.fileUpload) {
                if (!$scope.isEditPost && !file) errorPost.photo = 'Báº¡n chÆ°a chá»n file áº£nh.';
                if (file && file.size > maxSize) errorPost.photo = 'Táº­p tin quÃ¡ lá»›n.';
                if (file && !fileAllow.test(file.type)) errorPost.photo = 'KhÃ´ng há»— trá»£ file nÃ y.';
            } else {
                if (!$scope.isEditPost && !post.url) errorPost.photo = 'HÃ£y nháº­p link áº£nh/youtube.';
            }
            if (!post.title) errorPost.title = 'Viáº¿t vÃ i tá»« mÃ´ táº£ nÃ o :)';
            if (post.title && post.title.length > 120) errorPost.title = 'TiÃªu Ä‘á» quÃ¡ dÃ i, hÃ£y thu gá»n nÃ³.';
            Object.keys(errorPost).forEach(function(data) {
                if (data) status = false;
            });
            $scope.errorPost = errorPost;
            return status;
        };
        var uploadPost = function(post, file) {
            var paramsUpload = {
                url: uploadUrl,
                method: 'POST',
                headers: {
                    'x-xsrf-token': $cookies._cid
                },
                data: post
            };
            if (post.fileUpload) {
                paramsUpload.file = file;
                paramsUpload.fileFormDataName = 'image';
            }
            Upload.upload(paramsUpload).progress(function(evt) {
                $scope.progressCount = parseInt(100.0 * evt.loaded / evt.total) + '%';
            }).success(function(data, status, headers, config) {
                $scope.lockUpload = false;
                if (data.s && data.d) {
                    if ($scope.isEditPost) {
                        $window.alert('ÄÃ£ lÆ°u nhá»¯ng thay Ä‘á»•i. Táº£i láº¡i trang Ä‘á»ƒ cáº­p nháº­t ná»™i dung.');
                    } else {
                        $window.location = data.d;
                    }
                } else if (!data.s && data.login) {
                    parent.Modal.modalMessage('Báº¡n cáº§n Ä‘Äƒng nháº­p Ä‘á»ƒ cÃ³ thá»ƒ Ä‘Äƒng Ä‘Æ°á»£c áº£nh.');
                    parent.Modal.close('upload');
                    parent.Modal.open('login', 'upload');
                } else $scope.message = {
                    s: true,
                    m: $sce.trustAsHtml(data.e)
                };
            }).error(function(data, status) {
                $scope.lockUpload = false;
                if (res.status === 403) {
                    $scope.message = {
                        s: true,
                        m: $sce.trustAsHtml('Báº¡n khÃ´ng cÃ³ quyá»n truy Ä‘á»ƒ thá»±c hiá»‡n thao tÃ¡c nÃ y.')
                    };
                } else {
                    $scope.message = {
                        s: true,
                        m: $sce.trustAsHtml('ÄÄƒng bÃ i tháº¥t báº¡i, hÃ£y thá»­ láº¡i sau Ã­t phÃºt.')
                    }
                }
            });
        };
        if ($scope.isEditPost) {
            var postEdit = $scope.$parent.postEdit;
            $scope.post.post_id = postEdit.post_id;
            $scope.post.title = postEdit.title;
            $scope.post.source = postEdit.source;
            $scope.post.nsfw = postEdit.nsfw;
            $scope.post.feed = postEdit.feed;
            if (postEdit.youtube_id || postEdit.fb_url) {
                $scope.post.fileUpload = 0;
                $scope.post.url = postEdit.fb_url ? postEdit.fb_url : 'https://www.youtube.com/watch?v=' + postEdit.youtube_id;
            } else $scope.post.fileUpload = 1;
        } else {
            parent.User.checkPermission('publish_actions', function(status) {
                if (status) hasCheckPermission = true;
                $scope.post.feed = status;
            });
            $scope.post.fileUpload = 1;
        }
        $scope.files = [];
        $scope.fileSelected = function(files, event) {
            $scope.files = files;
        };
        $scope.submitUpload = function() {
            if (validData($scope.post, $scope.files[0])) {
                $scope.lockUpload = true;
                uploadPost($scope.post, $scope.files[0]);
            };
        };
        $scope.$watch('post.feed', function(newValue) {
            if (newValue === undefined || $scope.isEditPost) return;
            if (newValue === true) {
                if (hasCheckPermission) return;
                $scope.post.feed = false;
                $scope.lockUpload = true;
                parent.User.resendPermission('publish_actions', function(status) {
                    $scope.lockUpload = false;
                    if (status) {
                        hasCheckPermission = true;
                        $scope.post.feed = true;
                    } else {
                        hasCheckPermission = false;
                        $scope.post.feed = false;
                    }
                }, true);
            }
        });
    }).controller('SettingCtrl', function($scope, Setting) {
        var parent = $scope.$parent;
        $scope.Setting = new Setting($scope);
    }).controller('NotifCtrl', function($scope, Notif) {
        $scope.Notif = new Notif($scope);
    }).controller('QuangcaoCtrl', function($scope, Upload, $window, $cookies) {
        $scope.progressCount = 'LÆ°u láº¡i';
        $scope.quangcao = {};
        $scope.locked = false;
        $scope.files = [];
        $scope.fileSelected = function(files, event) {
            $scope.files = files;
        };
        $scope.saveInfo = function(quangcao) {
            if ($scope.locked) return;
            $scope.locked = true;
            var paramsUpload = {
                url: '/quangcao/save',
                method: 'POST',
                headers: {
                    'x-xsrf-token': $cookies._cid
                },
                data: quangcao
            };
            if ($scope.files.length > 0) {
                paramsUpload.file = $scope.files;
                paramsUpload.fileFormDataName = 'fileData';
            }
            Upload.upload(paramsUpload).progress(function(evt) {
                $scope.progressCount = parseInt(100.0 * evt.loaded / evt.total) + '%';
            }).success(function(data, status, headers, config) {
                $scope.progressCount = 'LÆ°u láº¡i';
                $scope.locked = false;
                if (data.s) {
                    $window.alert('ÄÃ£ lÆ°u nhá»¯ng thay Ä‘á»•i.');
                } else {
                    $window.alert(data.e);
                }
            }).error(function(data, status) {
                $scope.locked = false;
                $scope.progressCount = 'LÆ°u láº¡i';
                if (status === 403) {
                    $window.alert('Báº¡n khÃ´ng cÃ³ quyá»n thá»±c hiá»‡n thao tÃ¡c nÃ y.');
                } else {
                    $window.alert('Káº¿t ná»‘i mÃ¡y chá»§ tháº¥t báº¡i. HÃ£y thá»­ láº¡i sau Ã­t phÃºt.');
                }
            });
        };
    }).filter('trustHtml', function($sce) {
        return function(str) {
            return $sce.trustAsHtml(str);
        };
    }).filter('timeAgo', function(nowTime, timeAgo) {
        return function(value) {
            var fromTime = timeAgo.parse(value);
            var diff = nowTime() - fromTime;
            return timeAgo.inWords(diff);
        };
    }).filter('avatarSize', function() {
        return function(userInfo, size) {
            if (!userInfo) return;
            size = size || 32;
            var avatar = userInfo.avatar || 'haiivl.png';
            return '//s3.haiivl.com/' + size + '_' + avatar;
        };
    }).filter('parseMemeImage', function() {
        return function(meme) {
            if (meme) return cdn_url + '/meme/' + meme.meme;
        };
    }).filter('haiPermission', function($rootScope) {
        return function(postInfo, action) {
            if (!postInfo) return;
            var pStt = false;
            var returnStatus = null;
            var userInfo = $rootScope.userInfo || {};
            var user_group = userInfo.user_group;
            var user_id = userInfo.user_id;
            var postStatus = postInfo.status;
            var groupMod = function(status) {
                switch (status) {
                    case 1:
                        return user_group === 5;
                        break;
                    case 2:
                        return user_group === 3 || user_group === 5;
                        break;
                    case 3:
                        return user_group === 2 || user_group === 3 || user_group === 5;
                        break;
                    default:
                        return false;
                };
            };
            switch (action) {
                case 'nsfw':
                    var pStt = groupMod(3);
                    if (pStt && postInfo.nsfw) returnStatus = 0;
                    if (pStt && !postInfo.nsfw) returnStatus = 1;
                    break;
                case 'hide':
                    var pStt = groupMod(3);
                    if (pStt && postInfo.hide_post) returnStatus = 0;
                    if (pStt && !postInfo.hide_post) returnStatus = 1;
                    break;
                case 'new':
                    if (groupMod(1)) {
                        pStt = groupMod(1);
                        if (pStt && !postInfo.hide_post && postInfo.status == 1) returnStatus = 1;
                        if (pStt && !postInfo.hide_post && postInfo.status == 2) returnStatus = null;
                        break;
                    }
                    if (groupMod(3)) {
                        pStt = groupMod(3);
                        if (pStt && postInfo.types != 3 && !postInfo.hide_post && postInfo.status == 1) returnStatus = 1;
                        if (pStt && postInfo.types != 3 && !postInfo.hide_post && postInfo.status == 2) returnStatus = null;
                        break;
                    }
                case 'hot':
                    pStt = groupMod(1);
                    if (pStt && postInfo.status == 2) returnStatus = 1;
                    if (pStt && postInfo.status == 3) returnStatus = 0;
                    break;
                case 'edit':
                    pStt = groupMod(3);
                    returnStatus = pStt ? 1 : null;
                    break;
                case 'delete':
                    pStt = groupMod(2);
                    returnStatus = pStt ? 1 : null;
                    break;
                case 'pin':
                    pStt = groupMod(1);
                    if (pStt && postInfo.pin) returnStatus = 0;
                    if (pStt && !postInfo.pin) returnStatus = 1;
                    break;
            };
            return returnStatus;
        };
    }).directive('a', function($window, $location) {
        return {
            restrict: 'E',
            link: function(scope, elem, attrs) {
                if (attrs.ngClick || attrs.href === '' || attrs.href === '#') {
                    elem.on('click', function(e) {
                        e.preventDefault();
                    });
                } else {
                    elem.on('click', function(e) {
                        if (attrs.href == $window.location.pathname) $window.location.reload();
                    });
                }
            }
        };
    }).directive('haivlTrackQc', function(Haivl) {
        return {
            restrict: 'A',
            link: function(scope, elem, attrs) {
                elem.ready(function() {
                    Haivl.trackADS('views', attrs.haivlTrackQc);
                });
                elem.on('click', function(e) {
                    ga('send', 'event', 'Haivl AD', 'click', attrs.haivlTrackQc);
                    Haivl.trackADS('click', attrs.haivlTrackQc);
                });
            }
        }
    }).directive('parseXfbml', function(Facebook) {
        return {
            restrict: 'C',
            link: function(scope, elm, attrs) {
                scope.$watch(function() {
                    return Facebook.isReady();
                }, function(FBStatus) {
                    if (FBStatus) FB.XFBML.parse(elm[0]);
                });
            }
        };
    }).directive('pinBoxQc', function($window) {
        var windowScroll = 0;
        var likeBox = document.getElementById('haii-social-plugin');
        var sidebarBox = document.getElementById('sidebar');
        return {
            restrict: 'C',
            link: function(scope, element, attrs) {
                var thisElement = angular.element(sidebarBox);
                angular.element($window).bind("scroll", function() {
                    likeBoxTop = likeBox.getBoundingClientRect().top;
                    likeBoxHeight = likeBox.offsetHeight;
                    if (likeBoxTop + likeBoxHeight - 40 < 0) {
                        if (!thisElement.hasClass('fixed-box')) thisElement.addClass('fixed-box');
                    } else {
                        if (thisElement.hasClass('fixed-box')) thisElement.removeClass('fixed-box');
                    }
                });
            }
        };
    }).directive("pinPostInfo", function($window) {
        var windowScroll = null,
            elementTop = [],
            contentHeight = [],
            toolBarHeight = [],
            listElm = null,
            thisElement = null,
            postContainer;
        return {
            restrict: 'C',
            link: function(scope, element, attrs) {
                angular.element($window).bind("scroll", function() {
                    windowScroll = this.pageYOffset;
                    listElm = element.find('article');
                    angular.forEach(listElm, function(elm, key) {
                        if (!elm) return;
                        postContainer = elm.querySelector('.post-container');
                        if (!postContainer) return;
                        elementTop[key] = postContainer.getBoundingClientRect().top;
                        contentHeight[key] = postContainer.offsetHeight;
                        toolBarHeight[key] = elm.querySelector('.post-info-container').offsetHeight;
                    });
                    angular.forEach(elementTop, function(elmTop, key) {
                        thisElement = angular.element(listElm[key]);
                        if (elmTop - 50 > 0) {
                            if (thisElement.hasClass('fixed-info')) thisElement.removeClass('fixed-info')
                            if (thisElement.hasClass('bottom')) thisElement.removeClass('bottom');
                        } else if (elmTop - 50 <= 0 && elmTop - 50 + contentHeight[key] - toolBarHeight[key] > 0) {
                            if (!thisElement.hasClass('fixed-info')) thisElement.addClass('fixed-info').removeClass('bottom');
                        } else {
                            if (thisElement.hasClass('fixed-info')) thisElement.removeClass('fixed-info').addClass('bottom');
                        }
                    });
                });
            }
        };
    }).directive("pinToolBar", function($window) {
        return {
            restrict: 'C',
            link: function(scope, element, attrs) {
                var postHead = element[0].querySelector('.post-header'),
                    postHeadTop, postHeadHeight;
                var thisElement = angular.element(element[0]);
                angular.element($window).bind("scroll", function() {
                    if (!postHead) return;
                    postHeadTop = postHead.getBoundingClientRect().top;
                    postHeadHeight = postHead.offsetHeight;
                    if (postHeadTop + postHeadHeight - 47 < 0) {
                        thisElement.addClass('fixed-bar');
                    } else {
                        thisElement.removeClass('fixed-bar');
                    }
                });
            }
        };
    }).directive('badgeScrollToTop', function($window, Haivl) {
        var scrollHeight, scrollStep, cosParameter, scrollMargin;
        var scrollCount = 0;

        function scrollTopPosition(position) {
            scrollCount = scrollCount + 1;
            scrollMargin = cosParameter - cosParameter * Math.cos(scrollCount * scrollStep);
            $window.scrollTo(position, (scrollHeight - scrollMargin));
        }

        function step() {
            setTimeout(function() {
                if ($window.scrollY != 0) {
                    $window.requestAnimationFrame(step);
                    scrollTopPosition(0, scrollStep, scrollCount, scrollMargin);
                }
            }, 15);
        }

        function scrollToTop(scrollDuration) {
            var scrollStep = -window.scrollY / (scrollDuration / 15),
                scrollInterval = setInterval(function() {
                    if (window.scrollY != 0) {
                        window.scrollBy(0, scrollStep);
                    } else clearInterval(scrollInterval);
                }, 15);
        }
        return {
            restrict: 'C',
            link: function(scope, elm, attrs) {
                var thisElement = angular.element(elm[0]);
                angular.element($window).bind("scroll", function() {
                    if (this.pageYOffset > $window.innerHeight) {
                        thisElement.addClass('show');
                    } else {
                        thisElement.removeClass('show');
                    }
                });
                elm.bind('click', function() {
                    scrollToTop(200);
                });
            }
        };
    }).directive('memeMaker', function($timeout, $rootScope, $window, $http, $location) {
        function Meme(memeId, scope) {
            var l = 585,
                width, height, scale, buildUrl = '/meme/builder',
                uploadUrl = '/post/upload',
                canvas, topText, bottomText, isBusy = false,
                outputData, watermark = null,
                watermarkData = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAALAAAAAWCAMAAABXLOafAAAAqFBMVEUAAAD///8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAkJCQ/Pz9UVFRnZ2d3d3eHh4eVlZWjo6OwsLC9vb3JycnV1dXf39/r6+v19fX///9JJMpAAAAAJ3RSTlMAAAQNERQdISQsMDRBRFFUYGRxdIGEkZShpKaxtLbBw8bR1uHm8fYkVV+bAAAEcElEQVR4Ad2Xe0/bwBLFMQWaJrhJSAJpIA+4lLMPrx9e2/P9v9k9u84jcPtHq0pVb0eMvHvmzPintSWTi+RDXPxl8ZHv3wL+fHv5/wT8aQ28XP71wDzVfnH1DdpimiSDyf34WB6y/OO4vB0mfyCOwNeLzffnhzSc6pewXwFoKyyTwRuAA/Eulj/E+OH5IfnyAuxOGqXxT0NcLjaLXwVOX9GHtthGXmXzWvGEJ3AlkEbXAiaWGV+22PbiGIyHLazB4sgLxvhneV8ArH8NOAUy3zWFQiHAcjqCarrOYJUE4LbAfDKZLu838LHM12ILRprybO5RNngGxGMzT5PL8f3j7BlNifs0SdkXGnv24B4l19PlcjoYTCZjytPl3WgM6zXSu6/X6ZxSHDBK52ms05qMZo9cvgPeErQtvTQRGHgFj7es8RgfdavxhhgROLwWKSDFQTUlHiIwY01/iNIASHGI3U1ys46rVXyWb33rlsneskO8a3RywKktWFeIg2/OgAfQ0iqQ1hViyyoDVF4XGms+LlvWuYJzrio1fChbvCzo9Q668HS5AtsAHFuiHygc1VdeYqPBU7ILbk5CVlUOHKhLBV3Ri6bWhc4zdtF5GGBD3QQrWUqynAFP4MRhBVXYQqQRydCI7zqNMaxIJ56kXSMtL9KKWGy4akvdSRdFMOgLmyz4q4AvlhvHRv4pzGC6ro3PsG1o8HR3pYjkUJLbMLZu2IusrweMtmLdHVimJ+A5p1jcrgAucgJUjj4tfA/hfKYb4XyFUqwXqxopsIivhOGJUdkDt8p0YgtveCEw29nBukFgf0QtRtVixYNL7cU5CelhxVhpdBPTNm24k5a+Xkjds1RYfgQeryMwoMQX4r3vPDZQpfctgT1gezZF1HkERu59cwSmIxOr6Y/AqFu0NXwTG7GJI8K6iELY7bPoghCTHNLGoWFczBPLCTiluQSgvSNwb8qstSaeS5PX74BxBC6kK6pzYDpa8XkbgXkykh0agYiubATO3gH7+h1wbRnqHLhnWZyAL/+DVnKEB7IHzqRE4fP4rrpKfgjcKC+Fkw/A3NMfdqqTDkdgh0qc4R26VqtG1Bmw5OfAvjO69rqHPWe5OwEn32A6YbDSA6PirjNYUJDW/y/wd3QcRc/HEy7pryMwZ1RHYB43MUVqOGE4nICtmHPgSFLtYc9ZRmfAn3ZQWZHr/ksHawCTZwq7NCwURUNJWWViWSN9gqbLOLUXqfYOWMdS3GkaD41wALLCgrJzUT9k0UVHTB2uWU7dnmXP8u7TfPOEENv4v8QLsNuB8XSTpHGBIK3A6Mvr/jOwQ9aoXqRKR+986/3Bsd71MrW3h9dQnm3jjYK+T18j3D24Qksk2b0c88hyDsy4/jq/G/X/rcV/vEb8VFIOixHFIaWr26thLH+mTOdwCFMrRJFq77i8nQzo544OGveNg8kg3CKlczDhmnqfCxiNGR3BxZYr2gjCATHfsfz+L44dgNXF78UOWP+5n0izx9nF78bw87/8m+6/8JBDDxdVkzQAAAAASUVORK5CYII=',
                initialTopText, initialBottomText, getId = function(id) {
                    return document.querySelector(id);
                },
                errorMessage = function(message) {
                    document.getElementById('maker-message').innerHTML = message;
                },
                getImage = function(cb) {
                    $http.post(buildUrl, {
                        meme: memeId
                    }).success(function(data, status) {
                        if (data.s) cb(data.d);
                        else $window.alert(data.e);
                    }).error(function(data, status) {
                        $window.alert('Táº£i áº£nh Meme tháº¥t báº¡i. Vui lÃ²ng báº¥m F5 Ä‘á»ƒ thá»­ láº¡i.');
                    })
                },
                getTextObj = function(a, y) {
                    return new fabric.Text('', {
                        originY: a,
                        left: width / 2,
                        top: y,
                        fill: 'white',
                        stroke: 'black',
                        strokeWidth: 1,
                        lineHeight: 1.1,
                        fontFamily: 'Tahoma',
                        fontWeight: 'bold',
                        textAlign: 'center',
                        hasControls: false
                    })
                },
                getFontSize = function(a) {
                    var b = 0;
                    var h = height;
                    if (h < 350) b = -4;
                    else if (h < 500) b = -2;
                    var c = 28;
                    if (a.length <= 50) {
                        c = 34
                    } else if (a.length <= 80) {
                        c = 32
                    }
                    return c + b
                },
                updateText = function(a, b) {
                    a.set('fontSize', getFontSize(b));
                    a.set('left', width / 2);
                    if (a === topText) {
                        a.set('top', 10)
                    } else {
                        a.top = height - 22
                    }
                    a.set('text', '');
                    var c = fabric.util.object.clone(a);
                    var d = b.split(" ");
                    var e = '';
                    var f = "";
                    for (var j = 0; j < d.length; j++) {
                        c.set('text', f + ' ' + d[j]);
                        if (c.width < width) {
                            f += d[j] + ' ';
                            e += d[j] + ' '
                        } else {
                            e = e.substring(0, e.length - 1);
                            e += '\n' + d[j] + ' ';
                            f = d[j] + ' '
                        }
                    }
                    a.set('text', e);
                    canvas.renderAll()
                },
                updateAllText = function() {
                    updateText(topText, document.getElementById('input-line-1').value);
                    updateText(bottomText, document.getElementById('input-line-2').value)
                },
                clearText = function() {
                    if (document.getElementById('input-line-1').value == 'DÃ²ng trÃªn') {
                        updateText(topText, '');
                    }
                    if (document.getElementById('input-line-2').value == 'DÃ²ng dÆ°á»›i') {
                        updateText(bottomText, '');
                    }
                },
                handleEvents = function() {
                    angular.element(getId('#input-line-1')).on('focus', function() {
                        updateAllText();
                    });
                    angular.element(getId('#input-line-2')).on('focus', function() {
                        updateAllText();
                    });
                    angular.element(getId('#input-line-1')).on('keyup', function() {
                        updateAllText();
                    });
                    angular.element(getId('#input-line-2')).on('keyup', function() {
                        updateAllText();
                    });
                    angular.element(getId('#meme-create')).on('click', function() {
                        if (!confirm("Báº¡n Ä‘Ã£ xong tháº­t chÆ°a?\nNáº¿u xÃ¡c nháº­n báº¡n sáº½ khÃ´ng thá»ƒ tiáº¿p tá»¥c sá»­a áº£nh nÃ y.")) return;
                        if (isBusy) return;
                        isBusy = true;
                        clearText();
                        addWatermark(function() {
                            var a = canvas.toDataURL({
                                format: 'jpeg'
                            });
                            isBusy = false;
                            preview(a)
                        })
                    })
                },
                addWatermark = function(a) {
                    canvas.deactivateAll().renderAll();
                    if (watermark == null) {
                        var b = new Image();
                        b.onload = function() {
                            watermark = new fabric.Image(b, {
                                left: width - b.width / 2,
                                top: height - b.height / 2
                            });
                            canvas.add(watermark);
                            a()
                        };
                        b.src = watermarkData
                    } else {
                        a()
                    }
                },
                preview = function(a) {
                    outputData = a.split(',', 2)[1];
                    angular.element(getId('#meme-main-maker')).addClass('hide');
                    angular.element(getId('#meme-main-preview')).removeClass('hide');
                    document.getElementById('maker-output').src = a;
                    document.getElementById('download-btn').href = a.replace(/^data:image\/[^;]/, 'data:application/octet-stream');
                    document.getElementById('meme-title').focus();
                    scope.imageData = outputData;
                    scope.$apply();
                },
                drawCanvas = function(a) {
                    canvas = new fabric.Canvas('canvas', {
                        backgroundImage: a.src,
                        backgroundImageStretch: true,
                        selection: false
                    });
                    canvas.setDimensions({
                        width: width,
                        height: height
                    });
                    angular.element(document.querySelector('#canvas')).addClass('show');
                    topText = getTextObj('top', 20);
                    bottomText = getTextObj('bottom', height - 20);
                    canvas.add(topText);
                    canvas.add(bottomText);
                    updateAllText();
                    handleEvents()
                };
            return {
                initialize: function(textTop, textBot) {
                    initialTopText = textTop;
                    initialBottomText = textBot;
                    getImage(function(a) {
                        var b = new Image();
                        b.onload = function() {
                            width = b.width;
                            height = b.height;
                            scale = 1;
                            if (width > l) {
                                height = Math.round(l * height / width);
                                scale = l / width;
                                width = l
                            }
                            drawCanvas(b)
                        };
                        b.src = a
                    });
                    return this
                },
                changed: function() {
                    return document.getElementById('topText').value !== initialTopText || document.getElementById('bottomText').value !== initialBottomText
                }
            }
        };
        return {
            scope: {
                memeMaker: '=',
                lineTop: '=',
                lineBot: '=',
                imageData: '='
            },
            link: function(scope, element, attrs) {
                scope.$watch('memeMaker', function(value) {
                    var meme = new Meme(value, scope).initialize(scope.lineTop, scope.lineBot);
                });
                $window.onbeforeunload = confirmExit;

                function confirmExit() {
                    if (meme.changed()) return "TÃ¡c pháº©m cá»§a báº¡n chÆ°a Ä‘Æ°á»£c lÆ°u. Báº¡n cÃ³ cháº¯c muá»‘n thoÃ¡t khÃ´ng?";
                    return null;
                }
            }
        }
    });
})(angular, document);