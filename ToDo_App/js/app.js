var app = angular.module("toDoApp", []);

app.controller("mainController", function ($scope) {
    $scope.list = [{text: 'workout', done: false}, {text: 'study', done: true}];
    $scope.addItem = function () {
        $scope.errortext = "";
        if (!$scope.addMe) {
            return;
        }
        if ($scope.list.indexOf($scope.addMe) == -1) {
            $scope.list.push({text: $scope.addMe, done: false});
        } else {
            $scope.errortext = "The item is already in your ToDo list.";
        }
        $scope.addMe = null;
    }
    $scope.removeItem = function (x) {
        $scope.list.splice(x, 1);
    }
    $scope.toggle = function (x) {
        x.done = !x.done;
    }
});