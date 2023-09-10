@extends('dashboard.mahasiswa.layouts.main')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Avatars</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Base</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Avatars</a>
                    </li>
                </ul>
            </div>

            <br>

            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
            <section id="content" class="container">
                <!-- Begin .page-heading -->
                <div class="page-heading">
                    <div class="media clearfix">
                        <div class="media-left pr30">
                            <a href="#">
                                <img class="media-object mw150" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="...">
                            </a>
                        </div>
                        <div class="media-body va-m">
                            <h2 class="media-heading">Michael Halls
                            </h2>
                            <p class="lead">Lorem ipsum dolor sit amet ctetur adicing elit, sed do eiusmod tempor incididunt</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="panel">
                            <div class="panel-heading">
                                <span class="panel-icon">
                                    <i class="fa fa-trophy"></i>
                                </span>
                                <span class="panel-title"> My Skills</span>
                            </div>
                            <div class="panel-body pb5">
                                <span class="label label-warning mr5 mb10 ib lh15">Default</span>
                                <span class="label label-primary mr5 mb10 ib lh15">Primary</span>
                                <span class="label label-info mr5 mb10 ib lh15">Success</span>
                                <span class="label label-success mr5 mb10 ib lh15">Info</span>
                                <span class="label label-alert mr5 mb10 ib lh15">Warning</span>
                                <span class="label label-system mr5 mb10 ib lh15">Danger</span>
                                <span class="label label-info mr5 mb10 ib lh15">Success</span>
                                <span class="label label-success mr5 mb10 ib lh15">Ui Design</span>
                                <span class="label label-primary mr5 mb10 ib lh15">Primary</span>

                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-heading">
                                <span class="panel-icon">
                                    <i class="fa fa-pencil"></i>
                                </span>
                                <span class="panel-title">About Me</span>
                            </div>
                            <div class="panel-body pb5">

                                <h6>Experience</h6>

                                <h4>Facebook Internship</h4>
                                <p class="text-muted"> University of Missouri, Columbia
                                    <br> Student Health Center, June 2010 - 2012
                                </p>

                                <hr class="short br-lighter">

                                <h6>Education</h6>

                                <h4>Bachelor of Science, PhD</h4>
                                <p class="text-muted"> University of Missouri, Columbia
                                    <br> Student Health Center, June 2010 through Aug 2011
                                </p>

                                <hr class="short br-lighter">

                                <h6>Accomplishments</h6>

                                <h4>Successful Business</h4>
                                <p class="text-muted pb10"> University of Missouri, Columbia
                                    <br> Student Health Center, June 2010 through Aug 2011
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">

                        <div class="tab-block">
                            <ul class="nav nav-tabs" style="margin-bottom: 10px;">
                                <li class="active">
                                    <a href="#tab1" data-toggle="tab">Activity</a>
                                </li>
                                <li>
                                    <a href="#tab1" data-toggle="tab">Social</a>
                                </li>
                                <li>
                                    <a href="#tab1" data-toggle="tab">Media</a>
                                </li>
                            </ul>
                            <div class="tab-content p30" style="height: 730px;">
                                <div id="tab1" class="tab-pane active">
                                    hallo
                                </div>
                                <div id="tab2" class="tab-pane"></div>
                                <div id="tab3" class="tab-pane"></div>
                                <div id="tab4" class="tab-pane"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection