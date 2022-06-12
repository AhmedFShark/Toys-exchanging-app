<?php $tab_num = 1; ?>
<?php include "../Masters/layouts/header.php";?>
<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <!-- BEGIN PAGE BREADCRUMBS -->
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <a href="./">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Toys</span>
                            </li>
                        </ul>
                        <!-- END PAGE BREADCRUMBS -->
                        <!-- BEGIN PAGE CONTENT INNER -->

                        <div class="page-content-inner">
                            <div class="mt-content-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet light ">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-basket-loaded font-red-mint"></i>
                                                    <span class="caption-subject font-red-mint sbold uppercase">All Toys</span>
                                                </div>
                                                <div class="actions">
                                                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                                                        <label class="btn btn-transparent green btn-outline btn-circle btn-sm active">
                                                            <input type="radio" name="options" class="toggle" id="available">Available
                                                        </label>
                                                    </div>
                                                    <div class="btn-group">
                                                        <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                                                            <i class="fa fa-share"></i>
                                                            <span class="hidden-xs"> Table Tools </span>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right" id="sample_1_tools">
                                                            <li>
                                                                <a href="javascript:;" data-action="0" class="tool-action">
                                                                <i class="icon-printer"></i> Print</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;" data-action="1" class="tool-action">
                                                                <i class="icon-doc"></i> Save As PDF</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;" data-action="2" class="tool-action">
                                                                <i class="icon-paper-clip"></i> Save As Excel</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="table-toolbar">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="btn-group">
                                                                <button data-toggle="modal" href="#addmodal" class="btn btn-circle red-mint"> <i class="fa fa-plus"></i> Add Toy
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <table class="table table-striped table-bordered table-hover dataTable dtr-inline collapsed" id="sample_1" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th> Photo </th>
                                                            <th> Description </th>
                                                            <th> Owner </th>
                                                            <th> Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php
    $toysData = get_toys();
    while ($ty = mysqli_fetch_assoc($toysData))
    {
        if($ty['t_ID'] > 0){
            echo "<tr>";
            echo "  <td><img src='" . checkIfNoImage($ty['t_photo']) . "' class='avatar' width='120px'></td>";
            echo "  <td>" . $ty['t_description'] . "</td>";
            echo "  <td>" . $ty['u_username'] . "</td>";
            echo '  <td width="5%">';

            if(logged_in()){
                echo '<div class="btn-group">
                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-left" role="menu">
                                <li>
                                    <a data-toggle="modal" data-vclassid="' . $ty['t_ID'] . '" href="#viewmodal" class="view">
                                        <i class="icon-eye"></i> View
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="modal" data-classid="' . $ty['t_ID'] . '" href="#updatemodal" class="edit">
                                        <i class="icon-pencil"></i> Edit
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="modal" data-dclassid="' . $ty['t_ID'] . '" href="#deletemodal" class="delete">
                                        <i class="icon-close"></i> Delete
                                    </a>
                                </li>
                            </ul>
                        </div>';
            } else {
                echo '<a data-toggle="modal" data-vclassid="' . $ty['t_ID'] . '" href="#viewmodal" class="view btn btn-xs green"> View <i class="icon-eye"></i></a>';
            }
            echo "  </td>";
            echo "  </tr>";
        }
    }
?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END PAGE CONTENT INNER -->
                    </div>
                </div>
                <!-- END PAGE CONTENT BODY -->
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
    </div>
</div>
<div id="addmodal" class="modal fade bs-modal-lg" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Toy</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:650px" data-always-visible="1" data-rail-visible1="1">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="#" class="form-horizontal" id="form_add">
                                <div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button> Please fix the errors
                                    </div>
                                    <div class="alert alert-success display-hide">
                                        <button class="close" data-close="alert"></button> Data saved successfully
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Serial Number</label>
                                            <div class="col-md-6">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" maxlength="4" id="asn" name="asn" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Model</label>
                                            <div class="col-md-6">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" id="amodel" name="amodel" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Display Size</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" id="adsize" name="adsize" />
                                                    </div>
                                                    <span class="input-group-addon">
                                                        <i class="fa">"</i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Display Resolution</label>
                                            <div class="col-md-6">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" id="adres" name="adres" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Display Type</label>
                                            <div class="col-md-6">
                                                <div class="input-icon right">
                                                    <select class="form-control" id="adtype" name="adtype">
                                                        <option value="HD">HD</option>
                                                        <option value="Full HD">Full HD</option>
                                                        <option value="Quad HD">Quad HD</option>
                                                        <option value="Ultra HD">Ultra HD</option>
                                                        <option value="4K">4K</option>
                                                        <option value="8K">8K</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">RAM</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" maxlength="3" id="aram" name="aram" />
                                                    </div>
                                                    <span class="input-group-addon">
                                                        <i class="fa">GB</i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">CPU</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa"><b>i</b></i>
                                                    </span>
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" maxlength="2" id="acpu" name="acpu" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Generation</label>
                                            <div class="col-md-6">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" maxlength="2" id="agen" name="agen" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">GPU Type</label>
                                            <div class="col-md-6">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" id="agput" name="agput" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">GPU Size</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" maxlength="3" id="agpus" name="agpus" />
                                                    </div>
                                                    <span class="input-group-addon">
                                                        <i class="fa">GB</i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6"></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Hard Drive 1</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" maxlength="3" id="ahd1" name="ahd1" />
                                                    </div>
                                                    <div class="input-group-btn">
                                                        <select class="btn grey-mint btn-outline" id="ahd1s" name="ahd1s" >
                                                            <option value="GB SSD">GB SSD</option>
                                                            <option value="GB HDD">GB HDD</option>
                                                            <option value="TB SSD">TB SSD</option>
                                                            <option value="TB HDD">TB HDD</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Hard Drive 2</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" maxlength="3" id="ahd2" name="ahd2" />
                                                    </div>
                                                    <div class="input-group-btn">
                                                        <select class="btn grey-mint btn-outline" id="ahd2s" name="ahd2s" >
                                                            <option value="GB SSD">GB SSD</option>
                                                            <option value="GB HDD">GB HDD</option>
                                                            <option value="TB SSD">TB SSD</option>
                                                            <option value="TB HDD">TB HDD</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" id="aod" name="aod"> Optical Drive
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" id="ahdmi" name="ahdmi"> HDMI
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" id="avga" name="avga"> VGA
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" id="acreader" name="acreader"> Card Reader
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" id="aelan" name="aelan"> Ethernet LAN
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" id="ajack" name="ajack"> Audio Jack
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" id="afprint" name="afprint"> Fingerprint
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" id="acam" name="acam"> Camera
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" id="alitkey" name="alitkey"> Lit Keyboard
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3"></div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">In Stock</label>
                                            <div class="col-md-6">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" maxlength="4" id="aistock" name="aistock" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Wholesale Price</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" id="awprice" name="awprice" />
                                                    </div>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Singular Price</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" id="asprice" name="asprice" />
                                                    </div>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Final Singular Price</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" id="afsprice" name="afsprice" />
                                                    </div>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <label class="control-label">Discription</label>
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <textarea class="form-control" rows="2" id="ades" name="ades" style="resize: none;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-5"></div>
                                        <div class="col-md-7">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="../Masters/images/noimage.png" alt="" id="avphoto" name="avphoto" /> </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                <div>
                                                    <span class="btn default btn-file">
                                                        <span class="fileinput-new"> Select image </span>
                                                        <span class="fileinput-exists"> Change </span>
                                                        <input type="file" name="aphoto" id="aphoto" accept="image/jpeg, image/jpg" />
                                                    </span>
                                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-5 col-md-12">
                                                <button type="submit" class="btn green" >Save</button>
                                                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="updatemodal" class="modal fade bs-modal-lg" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Edit Toy</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:600px" data-always-visible="1" data-rail-visible1="1">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="#" class="form-horizontal" id="form_update">
                                <div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button> Please fix the errors
                                    </div>
                                    <div class="alert alert-success display-hide">
                                        <button class="close" data-close="alert"></button> Data saved successfully
                                    </div>

                                    <input type="hidden" id="updateToyID" name="updateToyID" />

                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Serial Number</label>
                                            <div class="col-md-6">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" maxlength="4" id="esn" name="esn" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Model</label>
                                            <div class="col-md-6">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" id="emodel" name="emodel" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Display Size</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" id="edsize" name="edsize" />
                                                    </div>
                                                    <span class="input-group-addon">
                                                        <i class="fa">"</i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Display Resolution</label>
                                            <div class="col-md-6">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" id="edres" name="edres" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Display Type</label>
                                            <div class="col-md-6">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="edtype" name="edtype">
                                                        <option value="HD">HD</option>
                                                        <option value="Full HD">Full HD</option>
                                                        <option value="Quad HD">Quad HD</option>
                                                        <option value="Ultra HD">Ultra HD</option>
                                                        <option value="4K">4K</option>
                                                        <option value="8K">8K</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">RAM</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" maxlength="3" id="eram" name="eram" />
                                                    </div>
                                                    <span class="input-group-addon">
                                                        <i class="fa">GB</i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">CPU</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa"><b>i</b></i>
                                                    </span>
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" maxlength="2" id="ecpu" name="ecpu" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Generation</label>
                                            <div class="col-md-6">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" maxlength="2" id="egen" name="egen" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">GPU Type</label>
                                            <div class="col-md-6">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" id="egput" name="egput" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">GPU Size</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" maxlength="3" id="egpus" name="egpus" />
                                                    </div>
                                                    <span class="input-group-addon">
                                                        <i class="fa">GB</i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6"></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Hard Drive 1</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" maxlength="3" id="ehd1" name="ehd1" />
                                                    </div>
                                                    <div class="input-group-btn">
                                                        <select class="btn grey-mint btn-outline" id="ehd1s" name="ehd1s" >
                                                            <option value="GB SSD">GB SSD</option>
                                                            <option value="GB HDD">GB HDD</option>
                                                            <option value="TB SSD">TB SSD</option>
                                                            <option value="TB HDD">TB HDD</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Hard Drive 2</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" maxlength="3" id="ehd2" name="ehd2" />
                                                    </div>
                                                    <div class="input-group-btn">
                                                        <select class="btn grey-mint btn-outline" id="ehd2s" name="ehd2s" >
                                                            <option value="GB SSD">GB SSD</option>
                                                            <option value="GB HDD">GB HDD</option>
                                                            <option value="TB SSD">TB SSD</option>
                                                            <option value="TB HDD">TB HDD</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" id="eod" name="eod"> Optical Drive
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" id="ehdmi" name="ehdmi"> HDMI
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" id="evga" name="evga"> VGA
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" id="ecreader" name="ecreader"> Card Reader
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" id="eelan" name="eelan"> Ethernet LAN
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" id="ejack" name="ejack"> Audio Jack
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" id="efprint" name="efprint"> Fingerprint
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" id="ecam" name="ecam"> Camera
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" id="elitkey" name="elitkey"> Lit Keyboard
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3"></div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">In Stock</label>
                                            <div class="col-md-6">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" maxlength="4" id="eistock" name="eistock" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Wholesale Price</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" id="ewprice" name="ewprice" />
                                                    </div>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Singular Price</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" id="esprice" name="esprice" />
                                                    </div>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label col-md-6">Final Singular Price</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" id="efsprice" name="efsprice" />
                                                    </div>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <label class="control-label">Discription</label>
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <textarea class="form-control" rows="2" id="edes" name="edes" style="resize: none;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-5"></div>
                                        <div class="col-md-7">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="../Masters/images/noimage.png" alt="" id="evphoto" name="evphoto" /> </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                <div>
                                                    <span class="btn default btn-file">
                                                        <span class="fileinput-new"> Select image </span>
                                                        <span class="fileinput-exists"> Change </span>
                                                        <input type="file" name="ephoto" id="ephoto" accept="image/jpeg, image/jpg" />
                                                    </span>
                                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-5 col-md-12">
                                                <button type="submit" class="btn green" >Update</button>
                                                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="viewmodal" class="modal fade bs-modal-lg" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">View Toy</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:600px" data-always-visible="1" data-rail-visible1="1">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" role="form" >
                                <div class="form-group">
                                    <label class="control-label col-md-5">Photo</label>
                                    <div class="col-md-4">
                                        <img src="" id="vphoto" name="vphoto" alt="avatar" height="150" width="200" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label col-md-6">Description</label>
                                        <div class="col-md-6">
                                            <b><p class="form-control-static" id="vdes" name="vdes"> </p></b>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label col-md-6">Owner</label>
                                        <div class="col-md-6">
                                            <b><p class="form-control-static" id="vowner" name="vowner"> </p></b>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="deletemodal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Delete Toy</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:100%" data-always-visible="1" data-rail-visible1="1">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="#" class="form-horizontal" id="form_delete">
                                <div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> Please fix the errors </div>
                                    <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Data deleted successfully </div>
                                    <input type="hidden" id="deleteToyID" name="deleteToyID" />
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label col-md-8">Do you want to delete the toy?</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-10">
                                            <button type="submit" class="btn green" >Yes</button>
                                            <button type="button" data-dismiss="modal" class="btn dark btn-outline">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("../Masters/layouts/footer1.php"); ?>
<script src="../Masters/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="../Masters/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="../Masters/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

<script src="../Masters/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="../Masters/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>

<script src="../Masters/scripts/toys/datatables-toys.js" type="text/javascript"></script>
<script src="../Masters/scripts/toys/crud-toys.js" type="text/javascript"></script>
<script src="../Masters/scripts/toys/view-toys.js" type="text/javascript"></script>
<?php include("../Masters/layouts/footer2.php"); ?>
