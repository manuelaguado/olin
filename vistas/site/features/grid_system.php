        <section class="page-top">
            <div class="container">
                <div class="col-md-4 col-sm-4">
                    <h1>Grid System</h1>
                </div>
                <div class="col-md-8 col-sm-8">
                    <ul class="pull-right breadcrumb">
                        <li>
                            <a href="javascript:;" data-file="index" data-folder="index" class="load-content">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                Features
                            </a>
                        </li>
                        <li class="active">
                            Grid System
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <p>
                            Clip-One includes Bootstrap's responsive, mobile-first fluid grid system that appropriately scales up to 12 columns as the device or viewport size increases. It includes predefined classes for easy layout options, as well as powerful mixins for generating
                            more semantic layouts.
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th> Extra small devices <small>Phones (&lt;768px)</small></th>
                                        <th> Small devices <small>Tablets (≥768px)</small></th>
                                        <th> Medium devices <small>Desktops (≥992px)</small></th>
                                        <th> Large devices <small>Desktops (≥1200px)</small></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Grid behavior</th>
                                        <td>Horizontal at all times</td>
                                        <td colspan="3">Collapsed to start, horizontal above breakpoints</td>
                                    </tr>
                                    <tr>
                                        <th>Max container width</th>
                                        <td>None (auto)</td>
                                        <td>100%</td>
                                        <td>100%</td>
                                        <td>100%</td>
                                    </tr>
                                    <tr>
                                        <th>Class prefix</th>
                                        <td><code>.col-xs-</code></td>
                                        <td><code>.col-sm-</code></td>
                                        <td><code>.col-md-</code></td>
                                        <td><code>.col-lg-</code></td>
                                    </tr>
                                    <tr>
                                        <th># of columns</th>
                                        <td colspan="4">12</td>
                                    </tr>
                                    <tr>
                                        <th>Max column width</th>
                                        <td class="text-muted">Auto</td>
                                        <td>60px</td>
                                        <td>78px</td>
                                        <td>95px</td>
                                    </tr>
                                    <tr>
                                        <th>Gutter width</th>
                                        <td colspan="4">20px (10px on each side of a column)</td>
                                    </tr>
                                    <tr>
                                        <th>Nestable</th>
                                        <td colspan="4">Yes</td>
                                    </tr>
                                    <tr>
                                        <th>Offsets</th>
                                        <td class="text-muted" colspan="1">N/A</td>
                                        <td colspan="3">Yes</td>
                                    </tr>
                                    <tr>
                                        <th>Column ordering</th>
                                        <td class="text-muted">N/A</td>
                                        <td colspan="3">Yes</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <p>
                            Using a single set of <code>.col-md-*</code> grid classes, you can create a basic grid system that starts out stacked on mobile devices and tablet devices (the extra small to small range) before becoming horizontal on desktop
                            (medium) devices.
                        </p>
                    </div>
                </div>
                <div class="show-grid">
                    <div class="row">
                        <div class="col-md-1">
                            .col-md-1
                        </div>
                        <div class="col-md-1">
                            .col-md-1
                        </div>
                        <div class="col-md-1">
                            .col-md-1
                        </div>
                        <div class="col-md-1">
                            .col-md-1
                        </div>
                        <div class="col-md-1">
                            .col-md-1
                        </div>
                        <div class="col-md-1">
                            .col-md-1
                        </div>
                        <div class="col-md-1">
                            .col-md-1
                        </div>
                        <div class="col-md-1">
                            .col-md-1
                        </div>
                        <div class="col-md-1">
                            .col-md-1
                        </div>
                        <div class="col-md-1">
                            .col-md-1
                        </div>
                        <div class="col-md-1">
                            .col-md-1
                        </div>
                        <div class="col-md-1">
                            .col-md-1
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            .col-md-8
                        </div>
                        <div class="col-md-4">
                            .col-md-4
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            .col-md-4
                        </div>
                        <div class="col-md-4">
                            .col-md-4
                        </div>
                        <div class="col-md-4">
                            .col-md-4
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            .col-md-6
                        </div>
                        <div class="col-md-6">
                            .col-md-6
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <p>
                            Don't want your columns to simply stack in smaller devices? Use the extra small and medium device grid classes by adding <code>.col-xs-*</code><code>.col-md-*</code> to your columns. See the example below for a better idea
                            of how it all works.
                        </p>
                    </div>
                </div>
                <div class="show-grid">
                    <!-- Stack the columns on mobile by making one full-width and the other half-width -->
                    <div class="row">
                        <div class="col-xs-12 col-md-8">
                            .col-xs-12 col-md-8
                        </div>
                        <div class="col-xs-6 col-md-4">
                            .col-xs-6 .col-md-4
                        </div>
                    </div>
                    <!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            .col-xs-6 .col-md-4
                        </div>
                        <div class="col-xs-6 col-md-4">
                            .col-xs-6 .col-md-4
                        </div>
                        <div class="col-xs-6 col-md-4">
                            .col-xs-6 .col-md-4
                        </div>
                    </div>
                    <!-- Columns are always 50% wide, on mobile and desktop -->
                    <div class="row">
                        <div class="col-xs-6">
                            .col-xs-6
                        </div>
                        <div class="col-xs-6">
                            .col-xs-6
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <p>
                            Build on the previous example by creating even more dynamic and powerful layouts with tablet <code>.col-sm-*</code> classes.
                        </p>
                    </div>
                </div>
                <div class="show-grid">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-8">
                            .col-xs-12 .col-sm-6 .col-md-8
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-4">
                            .col-xs-6 .col-sm-6 .col-md-4
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-4 col-md-4">
                            .col-xs-6 .col-sm-4 .col-md-4
                        </div>
                        <div class="col-xs-6 col-sm-4 col-md-4">
                            .col-xs-6 .col-sm-4 .col-md-4
                        </div>
                        <!-- Optional: clear the XS cols if their content doesn't match in height -->
                        <div class="clearfix visible-xs"></div>
                        <div class="col-xs-6 col-sm-4 col-md-4">
                            .col-xs-6 .col-sm-4 .col-md-4
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <p>
                            Move columns to the right using <code>.col-md-offset-*</code> classes. These classes increase the left margin of a column by * columns. For example, <code>.col-md-offset-4</code> moves <code>.col-md-4</code> over four columns.
                        </p>
                    </div>
                </div>
                <div class="show-grid">
                    <div class="row">
                        <div class="col-md-4">
                            .col-md-4
                        </div>
                        <div class="col-md-4 col-md-offset-4">
                            .col-md-4 .col-md-offset-4
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-md-offset-3">
                            .col-md-3 .col-md-offset-3
                        </div>
                        <div class="col-md-3 col-md-offset-3">
                            .col-md-3 .col-md-offset-3
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            .col-md-6 .col-md-offset-3
                        </div>
                    </div>
                </div>
            </div>
        </section>
