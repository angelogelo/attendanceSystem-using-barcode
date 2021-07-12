<?php 

    include 'header.php'; 

     
?>


<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Barcode Generation</h6>
                </div>
                <form method="POST" action="barcodeGenerator.php">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <p class="h6">Barcode Start</p>
                                <input type="text" name="barcodeStart" class="form-control" autocomplete="off">
                            </div>

                            <div class="col-md-4">
                                <p class="h6">Barcode End</p>
                                <input type="text" name="barcodeEnd" class="form-control" autocomplete="off">
                            </div>

                            <div class="col-md-4">
                                <p class="h6">...................................</p>
                                <button class="btn btn-primary btn-sm">Generate Barcode</button>
                            </div>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>

</div><!-- /.container-fluid -->


<?php include 'footer.php'; ?>