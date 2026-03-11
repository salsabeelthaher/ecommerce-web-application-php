<!DOCTYPE html>
<html lang="en">
<?php
	include('config2.php');
	include('topbar.php');
	include ('navbar.php'); 
?>
<body>

<?php
if(isset($_GET['id'])){
	global $conn;
	$q = "select * from services where id = " . $_GET['id'];
	$results = mysqli_query($conn, $q);
	$row = mysqli_fetch_assoc($results);
	extract($row);
}
?>
    
<div class="container-fluid pt-5">
    <div class="container">
        <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
            <h1 class="display-4 text-uppercase"></h1>
        </div>

        <div class="row gx-5">
            <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100" 
                         src="https://placehold.co/400x300/000000/FFFFFF?text=400x300"
                         style="object-fit: cover;">
                </div>
            </div>

          
            <div class="col-lg-6 pb-5">
                <h2 class="mb-4">
                    <?php echo $name; ?>
                </h2>

                <p class="mb-4">
                    <?php echo substr($description, 0, 300) . "..."; ?>
                </p>

                <h4 class="mb-4">
                    $<?php echo $price; ?>
                </h4>

                <h4 class="mb-4">
                    <a href="addtocart.php?id=<?php echo $_GET['id']; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                        </svg>
                    </a>
                </h4>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<!-- JS -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/magnific-popup-options.js"></script>
<script src="js/scrollspy.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>
