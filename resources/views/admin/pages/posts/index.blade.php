@extends('admin.layout.master')
@section('content')

<div class="card">
    <h5 class="card-header">Posts</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-striped">
        <thead>
            <tr>
                <th>Project</th>
                <th>Client</th>
                <th>Users</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <i class="icon-base bx bxl-angular icon-md text-danger me-4"></i> <span>Angular Project</span>
                </td>
                <td>Albert Cook</td>
                <td>
                    <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                    <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        title="Lilian Fuller">
                        <img src="../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        title="Sophia Wilkerson">
                        <img src="../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        title="Christina Parker">
                        <img src="../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    </ul>
                </td>
                <td><span class="badge bg-label-primary me-1">Active</span></td>
                <td>
                    <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="icon-base bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="icon-base bx bx-edit-alt me-1"></i> Edit</a
                        >
                        <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="icon-base bx bx-trash me-1"></i> Delete</a
                        >
                    </div>
                    </div>
                </td>
            </tr>
             <tr>
                <td>
                    <i class="icon-base bx bxl-angular icon-md text-danger me-4"></i> <span>Angular Project</span>
                </td>
                <td>Albert Cook</td>
                <td>
                    <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                    <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        title="Lilian Fuller">
                        <img src="../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        title="Sophia Wilkerson">
                        <img src="../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        title="Christina Parker">
                        <img src="../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    </ul>
                </td>
                <td><span class="badge bg-label-primary me-1">Active</span></td>
                <td>
                    <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="icon-base bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="icon-base bx bx-edit-alt me-1"></i> Edit</a
                        >
                        <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="icon-base bx bx-trash me-1"></i> Delete</a
                        >
                    </div>
                    </div>
                </td>
            </tr>
             <tr>
                <td>
                    <i class="icon-base bx bxl-angular icon-md text-danger me-4"></i> <span>Angular Project</span>
                </td>
                <td>Albert Cook</td>
                <td>
                    <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                    <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        title="Lilian Fuller">
                        <img src="../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        title="Sophia Wilkerson">
                        <img src="../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        title="Christina Parker">
                        <img src="../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    </ul>
                </td>
                <td><span class="badge bg-label-primary me-1">Active</span></td>
                <td>
                    <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="icon-base bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="icon-base bx bx-edit-alt me-1"></i> Edit</a
                        >
                        <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="icon-base bx bx-trash me-1"></i> Delete</a
                        >
                    </div>
                    </div>
                </td>
            </tr>
             <tr>
                <td>
                    <i class="icon-base bx bxl-angular icon-md text-danger me-4"></i> <span>Angular Project</span>
                </td>
                <td>Albert Cook</td>
                <td>
                    <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                    <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        title="Lilian Fuller">
                        <img src="../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        title="Sophia Wilkerson">
                        <img src="../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        title="Christina Parker">
                        <img src="../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    </ul>
                </td>
                <td><span class="badge bg-label-primary me-1">Active</span></td>
                <td>
                    <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="icon-base bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="icon-base bx bx-edit-alt me-1"></i> Edit</a
                        >
                        <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="icon-base bx bx-trash me-1"></i> Delete</a
                        >
                    </div>
                    </div>
                </td>
            </tr>
             <tr>
                <td>
                    <i class="icon-base bx bxl-angular icon-md text-danger me-4"></i> <span>Angular Project</span>
                </td>
                <td>Albert Cook</td>
                <td>
                    <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                    <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        title="Lilian Fuller">
                        <img src="../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        title="Sophia Wilkerson">
                        <img src="../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        title="Christina Parker">
                        <img src="../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    </ul>
                </td>
                <td><span class="badge bg-label-primary me-1">Active</span></td>
                <td>
                    <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="icon-base bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="icon-base bx bx-edit-alt me-1"></i> Edit</a
                        >
                        <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="icon-base bx bx-trash me-1"></i> Delete</a
                        >
                    </div>
                    </div>
                </td>
            </tr>
             <tr>
                <td>
                    <i class="icon-base bx bxl-angular icon-md text-danger me-4"></i> <span>Angular Project</span>
                </td>
                <td>Albert Cook</td>
                <td>
                    <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                    <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        title="Lilian Fuller">
                        <img src="../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        title="Sophia Wilkerson">
                        <img src="../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        title="Christina Parker">
                        <img src="../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    </ul>
                </td>
                <td><span class="badge bg-label-primary me-1">Active</span></td>
                <td>
                    <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="icon-base bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="icon-base bx bx-edit-alt me-1"></i> Edit</a
                        >
                        <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="icon-base bx bx-trash me-1"></i> Delete</a
                        >
                    </div>
                    </div>
                </td>
            </tr>
             <tr>
                <td>
                    <i class="icon-base bx bxl-angular icon-md text-danger me-4"></i> <span>Angular Project</span>
                </td>
                <td>Albert Cook</td>
                <td>
                    <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                    <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        title="Lilian Fuller">
                        <img src="../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        title="Sophia Wilkerson">
                        <img src="../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    <li
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        class="avatar avatar-xs pull-up"
                        title="Christina Parker">
                        <img src="../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    </ul>
                </td>
                <td><span class="badge bg-label-primary me-1">Active</span></td>
                <td>
                    <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="icon-base bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="icon-base bx bx-edit-alt me-1"></i> Edit</a
                        >
                        <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="icon-base bx bx-trash me-1"></i> Delete</a
                        >
                    </div>
                    </div>
                </td>
            </tr>
        </tbody>
        <tfoot class="table-border-bottom-0">
            <tr>
            <th class="rounded-start-bottom">Project</th>
            <th>Client</th>
            <th>Users</th>
            <th>Status</th>
            <th class="rounded-end-bottom">Actions</th>
            </tr>
        </tfoot>
        </table>
    </div>
    </div>
@endsection