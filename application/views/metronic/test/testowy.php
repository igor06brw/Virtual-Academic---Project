<style>
    .popover{
        max-width: 100%;
    }
    .portlet > .portlet-title > .actions {
        float: left !important;
    }
    .actions{
        margin-left: 13px;
    }
    .portlet.light > .portlet-title > .actions {
        padding: 1px 0 14px 0;


    }
</style>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            <?= $pageTitle ?> <small><?= (isset($smallTitle)) ? $smallTitle : '' ?></small>
        </h3>
        <div class="page-bar">
            <?= (isset($breadcrumbs)) ? $breadcrumbs : '' ?>

        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PORTLET-->

                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bar-chart font-green"></i>
                            <span class="caption-subject font-green bold uppercase"></span>
                            <span class="caption-helper"></span>
                        </div>



                    </div>
                    <div class="portlet-body">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                            Launch demo modal
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button id="pobierzDane" type="button" class="btn btn-primary">Pobierz dane</button>
                        <table id="table1" class="table">
                            <thead>
                            <tr>
                                <td>ID</td>
                                <th>Name</th>
                                <th>Age</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>



                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->


