<div class="hkder-sidebar-top box" ng-controller="UserCtrl">
    <div class="box-tip">
        <h2 class="sidebar-title">Top danh hai</h2>
        <a calss="more" href="">Xem them</a>
    </div>
    <div class="hkder-top-user" data-ng-init="loadTopSidebar()">
        <div class="top-user" ng-repeat="user in Users">
            <a href="@{{ user.link }}">
                <img ng-src="@{{ user.avatar }}" width="32px" height="32px" class="img-circle"/>

                <div class="info">
                    <span class="like-count">@{{ user.name }}</span>
                    <span class="full-name">
                        <i class="fa fa-thumb-o-up"></i>
                        @{{ user.point }}
                    </span>

                </div>
            </a>
        </div>
    </div>
</div>