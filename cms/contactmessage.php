<?php 
$header = "Contactmessage";
include 'inc/header.php'; ?>
<?php include 'inc/checklogin.php'; ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <?php flashMessage(); ?>
            <div class="page-title">
              <div class="title_left">
                <h3>Message</h3>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Pending Messages</h2>
                    <!-- <ul class="nav navbar-right panel_toolbox">
                      <a href="javascript:;" class="btn btn-primary" onclick="addMessage();">Add Message</a>
                    </ul> -->
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <th>S.N</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Time</th>
                        <th>Message ID</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php 
                          $Contactmessage = new contactmessage();
                          $contactmessages = $Contactmessage->getAllWaitingContactmessage();
                          // debugger($contactmessages);
                          if ($contactmessages) {
                            foreach ($contactmessages as $key => $contactmessage) {
                        ?>
                        <tr>
                          <td><?php echo $key+1; ?></td>
                          <td><?php echo $contactmessage->email; ?></td>
                          <td><?php echo $contactmessage->subject; ?></td>
                          <td><?php echo html_entity_decode($contactmessage->message); ?></td>
                          <td><?php echo date("M d, Y h:i:s a",strtotime($contactmessage->created_date)); ?></td>
                          <td><?php echo $contactmessage->id ; ?></td>
                          <td>
                            <a href="process/contactmessage?id=<?php echo($contactmessage->id) ?>&amp;act=<?php echo substr(md5("Accept-Contactmessage-".$contactmessage->id.$_SESSION['token']), 3,15) ?>" class="btn btn-success">
                              Accept
                            </a>

                            <a href="process/contactmessage?id=<?php echo($contactmessage->id) ?>&amp;act=<?php echo substr(md5("Reject-Contactmessage-".$contactmessage->id.$_SESSION['token']), 3,15) ?>" class="btn btn-danger">
                              Reject
                            </a>
                          </td>
                        </tr>
                        <?php
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
        <!-- /page content -->
  <?php include 'inc/footer.php'; ?>
  <script src="assets/js/datatable.js"></script>