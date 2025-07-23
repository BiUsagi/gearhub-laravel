@extends('admin.layouts.app')

@section('title', 'Dashboard - GearHub Admin')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab"
                                aria-controls="overview" aria-selected="true">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#audiences" role="tab"
                                aria-selected="false">Audiences</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#demographics" role="tab"
                                aria-selected="false">Demographics</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#more" role="tab"
                                aria-selected="false">More</a>
                        </li>
                    </ul>
                    <div>
                        <div class="btn-wrapper">
                            <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i>
                                Share</a>
                            <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
                            <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i>
                                Export</a>
                        </div>
                    </div>
                </div>
                <div class="tab-content tab-content-basic">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="statistics-details d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="statistics-title">Total Sales</p>
                                        <h3 class="rate-percentage">$32,530</h3>
                                        <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+12.5%</span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="statistics-title">Total Orders</p>
                                        <h3 class="rate-percentage">7,682</h3>
                                        <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+8.1%</span></p>
                                    </div>
                                    <div>
                                        <p class="statistics-title">Total Customers</p>
                                        <h3 class="rate-percentage">1,248</h3>
                                        <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>-2.8%</span>
                                        </p>
                                    </div>
                                    <div class="d-none d-md-block">
                                        <p class="statistics-title">Avg. Order Value</p>
                                        <h3 class="rate-percentage">$42.35</h3>
                                        <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+5.8%</span></p>
                                    </div>
                                    <div class="d-none d-md-block">
                                        <p class="statistics-title">Products Sold</p>
                                        <h3 class="rate-percentage">12,847</h3>
                                        <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+15.2%</span>
                                        </p>
                                    </div>
                                    <div class="d-none d-md-block">
                                        <p class="statistics-title">Conversion Rate</p>
                                        <h3 class="rate-percentage">3.2%</h3>
                                        <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.8%</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 d-flex flex-column">
                                <div class="row flex-grow">
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card card-rounded">
                                            <div class="card-body">
                                                <div class="d-sm-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h4 class="card-title card-title-dash">Sales Overview</h4>
                                                        <p class="card-subtitle card-subtitle-dash">Lorem ipsum dolor sit
                                                            amet consectetur adipisicing elit</p>
                                                    </div>
                                                    <div>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn btn-light dropdown-toggle toggle-dark btn-lg mb-0 me-0"
                                                                type="button" id="dropdownMenuButton2"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"> This month </button>
                                                            <div class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton2">
                                                                <h6 class="dropdown-header">Settings</h6>
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else
                                                                    here</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="#">Separated link</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                                                    <div class="d-sm-flex align-items-center mt-4 justify-content-between">
                                                        <h2 class="me-2 fw-bold">$36,2531.00</h2>
                                                        <h4 class="me-2">USD</h4>
                                                        <h4 class="text-success">(+1.37%)</h4>
                                                    </div>
                                                    <div class="me-3">
                                                        <div id="marketing-overview-legend"></div>
                                                    </div>
                                                </div>
                                                <div class="chartjs-bar-wrapper mt-3">
                                                    <canvas id="marketingOverview"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <div class="row flex-grow">
                                    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                        <div class="card bg-primary card-rounded">
                                            <div class="card-body pb-0">
                                                <h4 class="card-title card-title-dash text-white mb-4">Status Summary</h4>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <p class="status-summary-ight-white mb-1">Closed Value</p>
                                                        <h2 class="text-info">357</h2>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="status-summary-chart-wrapper pb-4">
                                                            <canvas id="status-summary"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                        <div class="card card-rounded">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">
                                                            <div class="circle-progress-width">
                                                                <div id="totalVisitors"
                                                                    class="progressbar-js-circle pr-2"></div>
                                                            </div>
                                                            <div>
                                                                <p class="text-small mb-2">Total Visitors</p>
                                                                <h4 class="mb-0 fw-bold">26.80%</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="circle-progress-width">
                                                                <div id="visitperday" class="progressbar-js-circle pr-2">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <p class="text-small mb-2">Visits per day</p>
                                                                <h4 class="mb-0 fw-bold">9065</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 d-flex flex-column">
                                <div class="row flex-grow">
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card card-rounded table-darkBGImg">
                                            <div class="card-body">
                                                <div class="col-sm-8">
                                                    <h3 class="text-white upgrade-info mb-0">Enhance your <span
                                                            class="fw-bold">Campaign</span> for better outreach</h3>
                                                    <a href="#" class="btn btn-info upgrade-btn">Upgrade
                                                        Account!</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row flex-grow">
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card card-rounded">
                                            <div class="card-body">
                                                <div class="d-sm-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h4 class="card-title card-title-dash">Recent Orders</h4>
                                                        <p class="card-subtitle card-subtitle-dash">You have 50+ new orders
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <button class="btn btn-primary btn-lg text-white mb-0 me-0"
                                                            type="button"><i class="mdi mdi-account-plus"></i>Add new
                                                            order</button>
                                                    </div>
                                                </div>
                                                <div class="table-responsive  mt-1">
                                                    <table class="table select-table">
                                                        <thead>
                                                            <tr>
                                                                <th>
                                                                    <div class="form-check form-check-flat mt-0">
                                                                        <label class="form-check-label">
                                                                            <input type="checkbox"
                                                                                class="form-check-input"
                                                                                aria-checked="false"><i
                                                                                class="input-helper"></i></label>
                                                                    </div>
                                                                </th>
                                                                <th>Order</th>
                                                                <th>Customer</th>
                                                                <th>Ship To</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-check form-check-flat mt-0">
                                                                        <label class="form-check-label">
                                                                            <input type="checkbox"
                                                                                class="form-check-input"
                                                                                aria-checked="false"><i
                                                                                class="input-helper"></i></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex ">
                                                                        <img src="{{ asset('admin/assets/images/faces/face1.jpg') }}"
                                                                            alt="">
                                                                        <div>
                                                                            <h6>#ORD001</h6>
                                                                            <p>Feb 2, 2022</p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <h6>Cameron Williamson</h6>
                                                                    <p>Head of Development</p>
                                                                </td>
                                                                <td>
                                                                    <h6>Jakarta, Indonesia</h6>
                                                                    <p>312 S Wilmington St</p>
                                                                </td>
                                                                <td>
                                                                    <div class="badge badge-outline-success">Approved</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-check form-check-flat mt-0">
                                                                        <label class="form-check-label">
                                                                            <input type="checkbox"
                                                                                class="form-check-input"
                                                                                aria-checked="false"><i
                                                                                class="input-helper"></i></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <img src="{{ asset('admin/assets/images/faces/face2.jpg') }}"
                                                                            alt="">
                                                                        <div>
                                                                            <h6>#ORD002</h6>
                                                                            <p>Feb 2, 2022</p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <h6>Mercedes Mayert</h6>
                                                                    <p>Head of Development</p>
                                                                </td>
                                                                <td>
                                                                    <h6>Hanoi, Vietnam</h6>
                                                                    <p>312 S Wilmington St</p>
                                                                </td>
                                                                <td>
                                                                    <div class="badge badge-outline-warning">In progress
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-check form-check-flat mt-0">
                                                                        <label class="form-check-label">
                                                                            <input type="checkbox"
                                                                                class="form-check-input"
                                                                                aria-checked="false"><i
                                                                                class="input-helper"></i></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <img src="{{ asset('admin/assets/images/faces/face5.jpg') }}"
                                                                            alt="">
                                                                        <div>
                                                                            <h6>#ORD003</h6>
                                                                            <p>Feb 2, 2022</p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <h6>Robert Bacins</h6>
                                                                    <p>Head of Development</p>
                                                                </td>
                                                                <td>
                                                                    <h6>Karachi, Pakistan</h6>
                                                                    <p>312 S Wilmington St</p>
                                                                </td>
                                                                <td>
                                                                    <div class="badge badge-outline-success">Approved</div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <div class="row flex-grow">
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card card-rounded">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-3">
                                                            <h4 class="card-title card-title-dash">Top Categories</h4>
                                                        </div>
                                                        <div class="mt-3">
                                                            <div
                                                                class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                                <div class="d-flex">
                                                                    <img class="img-sm rounded-10"
                                                                        src="{{ asset('admin/assets/images/faces/face1.jpg') }}"
                                                                        alt="profile">
                                                                    <div class="wrapper ms-3">
                                                                        <p class="ms-1 mb-1 fw-bold">Gaming Gear</p>
                                                                        <small class="text-muted mb-0">48 Products</small>
                                                                    </div>
                                                                </div>
                                                                <div class="text-muted text-small"> 1h ago </div>
                                                            </div>
                                                            <div
                                                                class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                                <div class="d-flex">
                                                                    <img class="img-sm rounded-10"
                                                                        src="{{ asset('admin/assets/images/faces/face2.jpg') }}"
                                                                        alt="profile">
                                                                    <div class="wrapper ms-3">
                                                                        <p class="ms-1 mb-1 fw-bold">Computer Hardware</p>
                                                                        <small class="text-muted mb-0">125 Products</small>
                                                                    </div>
                                                                </div>
                                                                <div class="text-muted text-small"> 1h ago </div>
                                                            </div>
                                                            <div
                                                                class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                                <div class="d-flex">
                                                                    <img class="img-sm rounded-10"
                                                                        src="{{ asset('admin/assets/images/faces/face3.jpg') }}"
                                                                        alt="profile">
                                                                    <div class="wrapper ms-3">
                                                                        <p class="ms-1 mb-1 fw-bold">Audio Equipment</p>
                                                                        <small class="text-muted mb-0">32 Products</small>
                                                                    </div>
                                                                </div>
                                                                <div class="text-muted text-small"> 1h ago </div>
                                                            </div>
                                                            <div
                                                                class="wrapper d-flex align-items-center justify-content-between pt-2">
                                                                <div class="d-flex">
                                                                    <img class="img-sm rounded-10"
                                                                        src="{{ asset('admin/assets/images/faces/face4.jpg') }}"
                                                                        alt="profile">
                                                                    <div class="wrapper ms-3">
                                                                        <p class="ms-1 mb-1 fw-bold">Accessories</p>
                                                                        <small class="text-muted mb-0">87 Products</small>
                                                                    </div>
                                                                </div>
                                                                <div class="text-muted text-small"> 1h ago </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
