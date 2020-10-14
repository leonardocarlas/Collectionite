<?php   

    require "header.php";

    
?>

<?php 

    if(isset($_GET['Email'])){ ?>
    <script type="text/javascript">
        Swal.fire(
        'Email Sent Succefully. We will reply you in a few period',
        '',
        'success'
        );
    </script>
<?php } ?>



<div class="content-wrapper" style="min-height: 636.763px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Contact Us</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                    <h5 class="card-title m-0">Contact Form</h5>
                    </div>
                    <form role="form" method="POST" action="php/send_problem.php">
                        <div class="card-body">
                        <div class="form-group" data-children-count="1">
                            <label for="email">Email</label>
                            <input type="email" name="sender-email" class="form-control" id="email" placeholder="Enter your email" data-kwimpalastatus="alive" data-kwimpalaid="1596293785065-3">
                        </div>
                        <div class="form-group" data-children-count="1">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject-problem" class="form-control" id="subject" placeholder="Subject" data-kwimpalastatus="alive" data-kwimpalaid="1596293785065-3">
                        </div>
                            <!-- /.card-body -->
                        <div class="form-group" data-children-count="1">
                        <label>Mail body</label>
                        <textarea class="form-control" name="mail-problem" rows="3" placeholder="Mail body"></textarea>
                         </div>
                        </div>
                        <div class="card-footer">
                        <button type="submit"  name="invia-problema" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
<?php   

    require "footer.php";

    
?>