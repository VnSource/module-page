@push('head')
<script type="text/ng-template" id="page.html">
    <div ng-controller="PageCtrl">
        <div class="container-fluid">
            <div vns-table="tableParams"></div>
        </div>
        <div class="content-btn">
            <button ng-disabled="isLoading" class="btn btn-default btn-sm" ng-click="tableParams.reload()"><i class="fa fa-refresh fa-fw"></i> {{ __('Reload') }}</button>
            <button class="btn btn-success btn-sm" ng-click="new()"><i class="fa fa-file-o fa-fw"></i> {{ __('New page') }}</button>
        </div>
    </div>
</script>
<script type="text/ng-template" id="page/edit.html">
    <div class="modal-header">
        <h4 class="modal-title">{{__('Edit')}}: @{{name}}</h4>
    </div>
    <div class="modal-body">
        <table class="table table-striped table-bordered" style="margin-bottom: 0">
            <colgroup>
                <col width="25%">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <td >{{ __('Name') }}</td>
                <td>
                    <input class="form-control" type="text" ng-model="page.name">
                </td>
            </tr>
            <tr>
                <td >{{ __('Slug') }}</td>
                <td>
                    <input class="form-control" type="text" ng-model="page.slug">
                </td>
            </tr>
            <tr>
                <td >{{ __('Title') }}</td>
                <td>
                    <input class="form-control" type="text" ng-model="page.title">
                </td>
            </tr>
            <tr>
                <td >{{ __('Description') }}</td>
                <td>
                    <textarea class="form-control" ng-model="page.excerpt"></textarea>
                </td>
            </tr>
            <tr>
                <td >{{ __('Image') }}</td>
                <td>
                    <vns-media-input ng-model="page.image" media-config="{single:true}"/>
                </td>
            </tr>
            <tr>
                <td >{{ __('Status') }}</td>
                <td>
                    <div class="btn-group">
                        <label class="btn btn-default" ng-model="page.status" uib-btn-radio="true">{{__('Enabled')}}</label>
                        <label class="btn btn-default" ng-model="page.status" uib-btn-radio="false">{{__('Disabled')}}</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td >{{ __('Comment') }}</td>
                <td>
                    <div class="btn-group">
                        <label class="btn btn-default" ng-model="page.comment" uib-btn-radio="true">{{__('Enabled')}}</label>
                        <label class="btn btn-default" ng-model="page.comment" uib-btn-radio="false">{{__('Disabled')}}</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td >{{ __('Content') }}</td>
                <td>
                    <textarea ui-tinymce="$root.tinymceOptions" ng-model="page.content"></textarea>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" ng-click="save()" >{{ __('Save') }}</button>
        <button type="button" class="btn btn-primary" ng-click="close()" >{{ __('Close') }}</button>
    </div>
</script>
<script type="text/ng-template" id="page/new.html">
    <div class="modal-header">
        <h4 class="modal-title">{{__('New page')}}</h4>
    </div>
    <div class="modal-body">
        <table class="table table-striped table-bordered" style="margin-bottom: 0">
            <colgroup>
                <col width="25%">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <td >{{ __('Name') }}</td>
                <td>
                    <input class="form-control" type="text" ng-model="page.name">
                </td>
            </tr>
            <tr>
                <td >{{ __('Slug') }}</td>
                <td>
                    <input class="form-control" type="text" input-slug="page.name" ng-model="page.slug">
                </td>
            </tr>
            <tr>
                <td >{{ __('Title') }}</td>
                <td>
                    <input class="form-control" type="text" input-copy="page.name" ng-model="page.title">
                </td>
            </tr>
            <tr>
                <td >{{ __('Description') }}</td>
                <td>
                    <textarea class="form-control" ng-model="page.excerpt"></textarea>
                </td>
            </tr>
            <tr>
                <td >{{ __('Image') }}</td>
                <td>
                    <vns-media-input ng-model="page.image" media-config="{single:true}"/>
                </td>
            </tr>
            <tr>
                <td >{{ __('Status') }}</td>
                <td>
                    <div class="btn-group">
                        <label class="btn btn-default" ng-model="page.status" uib-btn-radio="true">{{__('Enabled')}}</label>
                        <label class="btn btn-default" ng-model="page.status" uib-btn-radio="false">{{__('Disabled')}}</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td >{{ __('Comment') }}</td>
                <td>
                    <div class="btn-group">
                        <label class="btn btn-default" ng-model="page.comment" uib-btn-radio="true">{{__('Enabled')}}</label>
                        <label class="btn btn-default" ng-model="page.comment" uib-btn-radio="false">{{__('Disabled')}}</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td >{{ __('Content') }}</td>
                <td>
                    <textarea ui-tinymce="$root.tinymceOptions" ng-model="page.content"></textarea>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" ng-click="save()" >{{ __('Save') }}</button>
        <button type="button" class="btn btn-primary" ng-click="close()" >{{ __('Close') }}</button>
    </div>
</script>
<script type="text/javascript">
  VnSapp.controller('PageCtrl', function ($rootScope, $scope, $uibModal, $filter, vnsTableParams, $resource, Dialog, Notification) {
      $rootScope.siteTitle = '{{__('Page')}}';

      var Page = $resource(API_URL + '/page/:id', {id: '@id'}, {
          update: {
              method: 'PUT'
          }
      });

      var tableParams = $scope.tableParams = new vnsTableParams({
          columns: {
              id: {
                  label: '{{__('Id')}}',
                  type: 'fixed',
                  filter: 'number',
                  sortable: true
              },
              image: {
                  label: '{{__('Image')}}',
                  type: 'image',
                  format: function (value) {
                      return $filter('parseImage')(value);
                  }
              },
              name: {
                  label: '{{__('Name')}}',
                  filter: 'text',
                  sortable: true
              },
              author: {
                  label: '{{__('Author')}}',
                  filter: 'text'
              },
              created_at: {
                  label: '{{__('Created at')}}',
                  type: 'datetime'
              },
              status: {
                  label: '{{__('Status')}}',
                  type: 'status',
                  filter: 'status',
                  action: function (row) {
                      $scope.toggleStatus(row);
                  }
              }
          },
          actions: [
              {
                  label: '{{__('View')}}',
                  icon: 'fa fa-eye fa-fw',
                  callback: function (row) {
                      $rootScope.viewPost(row);
                  }
              },
              {
                  label: '{{__('Edit')}}',
                  icon: 'fa fa-pencil fa-fw',
                  callback: function (row) {
                      $scope.edit(row);
                  }
              },
              {
                  label: '{{__('Copy url')}}',
                  icon: 'fa fa-link fa-fw',
                  callback: function (row) {
                      $rootScope.postUrl(row)
                  }
              },
              'divider',
              {
                  label: '{{__('Delete')}}',
                  icon: 'fa fa-trash-o fa-fw',
                  callback: function (row) {
                      $scope.delete(row);
                  }
              }
          ],
          getData: function (params) {
              return Page.query(params.url(), function (data, headers) {
                  params.setTotal(headers('total'));
                  return data;
              });
          }
      });

      $scope.new = function () {
          $uibModal.open({
              animation: true,
              templateUrl: 'page/new.html',
              controller: function ($scope, $uibModalInstance) {
                  $scope.page = {
                      name: '',
                      slug: '',
                      title: '',
                      excerpt: '',
                      image: null,
                      comment: false,
                      status: true,
                      content: ''
                  };
                  $scope.save = function () {
                      var $page = new Page($scope.page);
                      $page.$save(function (res) {
                          tableParams.reload();
                          $uibModalInstance.dismiss('close');
                          Notification.success('{{__('Saved successfully')}}');
                      }, function (xhr) {
                          if (xhr.status == 422) {
                              var validatorError = [];
                              for (key in xhr.data) {
                                  validatorError.push(key + ': ' + (typeof xhr.data[key] =='string'?xhr.data[key]:xhr.data[key][0]));
                              }
                              Notification.error(validatorError.join('<br>'));
                          }
                      });
                  };
                  $scope.close = function () {
                      $uibModalInstance.dismiss('close');
                  };
              },
              backdrop: 'static',
              windowClass: 'modal-full'
          });
      };
      $scope.edit = function (row) {
          Page.get({id: row.id}, function (data) {
              $uibModal.open({
                  animation: true,
                  templateUrl: 'page/edit.html',
                  controller: function ($scope, $uibModalInstance) {
                      $scope.page = data;
                      $scope.name = angular.copy(data.name);
                      $scope.save = function () {
                          var $page = angular.copy($scope.page);
                          $page.$update(function (res) {
                              row.name = angular.copy($scope.page.name);
                              row.slug = angular.copy($scope.page.slug);
                              $uibModalInstance.dismiss('close');
                              Notification.success('{{__('Saved successfully')}}');
                          }, function (xhr) {
                              if (xhr.status == 422) {
                                  var validatorError = [];
                                  for (key in xhr.data) {
                                      validatorError.push(key + ': ' + (typeof xhr.data[key] =='string'?xhr.data[key]:xhr.data[key][0]));
                                  }
                                  Notification.error(validatorError.join('<br>'));
                              }
                          });
                      };
                      $scope.close = function () {
                          $uibModalInstance.dismiss('close');
                      };
                  },
                  backdrop: 'static',
                  windowClass: 'modal-full'
              });
          });

      };
      $scope.delete = function (row) {
          Dialog.confirm(__('Are you sure you want to delete <b>:name</b>?', {name: row.name}))
              .result.then(function () {
              row.$delete(function (res) {
                  if (res == false) {
                      Notification.error('{{__('Delete failed')}}');
                  } else {
                      tableParams.reload();
                      Notification.success('{{__('Delete successfully')}}');
                  }
              });
          });
      };

      $scope.toggleStatus = function (row) {
          var $page = angular.copy(row);
          $page.status = !row.status;
          $page.toggleStatus = true;
          $page.$update(function (res) {
              row.status = !row.status;
              Notification.success('{{__('Saved successfully')}}');
          }, function (xhr) {
              if (xhr.status == 422) {
                  var validatorError = [];
                  for (key in xhr.data) {
                      validatorError.push(key + ': ' + (typeof xhr.data[key] =='string'?xhr.data[key]:xhr.data[key][0]));
                  }
                  Notification.error(validatorError.join('<br>'));
              }
          });
      };
  });
</script>
@endpush
@navbarcpanel([
    'icon' => 'fa fa-file-text-o fa-fw',
    'label' => 'Page',
    'permission' => 'page',
    'name' => 'root.page',
    'url' => 'page',
    'template' => 'page.html'
])
