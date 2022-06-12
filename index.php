<?php $tab_num = 0; ?>
<?php include "../Masters/layouts/header.php";?>
<link href="../Masters/scripts/index/datatables-cards.css" rel="stylesheet" type="text/css" />
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
                  </ul>
                  <!-- END PAGE BREADCRUMBS -->
                  <!-- BEGIN PAGE CONTENT INNER -->
                  <div class="page-content-inner">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="portlet light portlet-fit ">
                              <div class="portlet-title">
                                 <div class="caption">
                                    <i class=" icon-layers font-green"></i>
                                    <span class="caption-subject font-green bold uppercase">Toys</span>
                                 </div>
                              </div>
                              <div class="portlet-body">
                                 <div class="mt-element-card mt-element-overlay">
                                    <table id="example" class="table table-sm table-hover cards" cellspacing="0" width="100%">
                                       <thead>
                                          <tr>
                                             <th></th>
                                             <th></th>
                                             <th></th>
                                             <th></th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php
                                             $toysData = get_toys();
                                             while ($toy = mysqli_fetch_assoc($toysData))
                                             {
                                                if($toy['t_ID'] > 0){
                                                   echo "<tr role='row' style='height: auto;'>";
                                                      echo "<td>";
                                                         echo "<a data-toggle='modal' data-vclassid='" . $toy['t_ID'] . "' href='#viewmodal' class='view btn btn-circle btn-sm green'> View details <span aria-hidden='true' class='icon-eye'></span>
                                                                </a><br />";
                                                         echo "<img src='" . checkIfNoImage($toy['t_photo']) . "' class='avatar'>";
                                                      echo "</td>";
                                                      echo "<td>" . $toy['t_description'] . "</td>";
                                                      echo "<td>Owner: " . $toy['u_username'] . "</td>";
                                                   echo "</tr>";
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
<?php  include("../Masters/layouts/footer1.php"); ?>
<script src="../Masters/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="../Masters/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="../Masters/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

<script src="../Masters/scripts/index/datatables-index.js" type="text/javascript"></script>

<script src="../Masters/scripts/toys/view-toys.js" type="text/javascript"></script>
<?php include("../Masters/layouts/footer2.php"); ?>
