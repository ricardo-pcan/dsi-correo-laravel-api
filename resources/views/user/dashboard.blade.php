@extends('layouts.dashboard')
@section( 'content' )
    <div class="container" ng-controller="DashboardController">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="dashboard-pills">
                <ul class="nav nav-tabs">
                    @foreach( $nav_items as $item )
                        <li><a href={{ $item[ 'url' ] }}> {{ $item[ 'text' ] }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="dashboard-table">
                <table id="request-table" datatable="ng" dt-options="dtOptions" dt-columns="dtColumns" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido P.</th>
                            <th>Apellido M.</th>
                            <th># Empleado</th>
                            <th>Rol</th>
                            <th># Extensión</th>
                            <th>Departamento</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="request in ::requests">
                            <td>@{{ request.first_name }}</td>
                            <td>@{{ request.first_last_name }}</td>
                            <td>@{{ request.second_last_name }}</td>
                            <td>@{{ request.employee_id }}</td>
                            <td>@{{ request.role }}</td>
                            <td>@{{ request.extension_number }}</td>
                            <td>@{{ request.department_id }}</td>
                            <td>@{{ request.status }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
