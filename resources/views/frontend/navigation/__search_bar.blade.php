{!! Form::open(['url' => url('search'), 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'GET']) !!}
    <div class="form-group" style="">
        <div class="input-group searchbar-group" style="width: 100%">
            <select class="input-group-addon nav-search-text animate" name="scope"
                    style="float: left; width: 20%; padding: 9px; height: 34px;">
                <option value="all"          {{isset($scope) && $scope=='all'           ? 'selected' : ''}}>All</option>
                <option value="articles"     {{isset($scope) && $scope=='articles'      ? 'selected' : ''}}>Articles</option>
                <option value="users" 		 {{isset($scope) && $scope=='users'         ? 'selected' : ''}}>Users</option>
                <option value="publications" {{isset($scope) && $scope=='publications'  ? 'selected' : ''}}>Publications</option>
                <option value="resources" 	 {{isset($scope) && $scope=='resources'     ? 'selected' : ''}}>Resources</option>
                <option value="discussions"  {{isset($scope) && $scope=='discussions'   ? 'selected' : ''}}>Discussions</option>
            </select>

            <i class="fa fa-angle-down" style="position: absolute; left: 15%; top: 10px; color: #aaa; pointer-events: none;"></i>
            <input name="query_term" class="text-left form-control nav-searchbar animate" value="{{ (isset($query_term)) ? $query_term : '' }}" placeholder="Search DEMHUB" style="width: 70%;">
            <button type="submit" class="input-group-addon nav-search-icon-style animate" style="width: 10%; padding: 9.5px; height:34px;">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
{!! Form::close() !!}
