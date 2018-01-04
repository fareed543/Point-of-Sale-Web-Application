var MaterialPos = angular.module('MaterialPos',['ui.router']);
MaterialPos.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider){
	$urlRouterProvider.otherwise("/")
	
	/*$stateProvider
	.state('/', {
		url: "/",
		templateUrl: "app/components/home/homeView.html",
	})
	.state('details', {
		url: "/details/:id",
		templateUrl: "app/components/details/detailsView.html",
	})
	.state('page', {
		url: "/page",
		templateUrl: "app/components/page/pageView.html",
	})*/
}]);