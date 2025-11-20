<?php
 
$page_title = "Image Gallery";
$introduction = "Welcome to our gallery of images, uploaded by users just like you. To add more images to the gallery, click the link below to be taken to the home page.";
$active = "gallery";
include 'includes/header.php';

$query = "SELECT * FROM gallery_prep ORDER BY uploaded_on DESC;";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) : ?>

<section class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">

<?php
    while ($row = mysqli_fetch_array($result)) {
        // We'll use the primary key to generate buttons that launch a specific modal window, all of which requires a unique ID attribute.
        $id = $row['image_id'];
        $title = $row['title'];
        $description = $row['description'];
        $filename = $row['filename'];
        $uploaded_on = $row['uploaded_on'];

        ?>

        <div class="col">
            <div class="card p-0 shadow-sm">
                <img src="images/thumbs/<?= $filename; ?>" alt="<?= $description; ?>" class="card-img-top">
                <div class="card-body">
                    <h2 class="fs-5"><?= $title; ?></h2>
                    <p class="card-text">Added on <?= $uploaded_on; ?></p>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modal-<?= $id; ?>" class="btn btn-primary">View</button>
                </div>
            </div>
        </div>

        <!-- Modal -->
         <div class="modal fade" id="modal-<?= $id; ?>" tabindex="1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title display-6"><?= $title; ?></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close Window"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img src="images/full/<?= $filename; ?>" alt="<?= $description; ?>" class="img-fluid">
                        </div>
                        <p class="mt-4"><?= $description; ?></p>
                        <p>Added on <?= $uploaded_on; ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
         </div>

        <?php
    } // end of while loop
?>

</section>

<?php else : ?>

<!-- If there are no records found, we'll give the use an error message. -->
 <section class="row justify-content-center">
    <div class="col-md-6">
        <h2>Oops!</h2>
        <p>We weren't able to find any images in our gallery – but this is where you come in. Return to the <a href="index.php">upload page</a> to submit your own images.</p>
    </div>
 </section>

<?php endif; ?>

<?php include 'includes/footer.php'; ?>