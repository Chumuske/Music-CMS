<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - PAGE</title>
      <!-- Font Awesome -->
      <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css"
    rel="stylesheet"
    />
</head>
<body class="bg-dark">

    <?php
    
    session_start();

    include('functions/dbcon.php');
    include('functions/crud.php');

    $get_songs_record = mysqli_query($con, "SELECT id, title, artist, created_at FROM songs_tbl WHERE deleted_at IS NULL");

    // To unset the session of the song id when the song back in the edit or delete
    if(basename($_SERVER['REQUEST_URI']) == "index.php" && isset($_SESSION['song-id-interaction'])){
        unset($_SESSION['song-id-interaction']);
    }

    if(isset($_GET['id']) && isset($_GET['a'])){

        // To set a session so the song cannot change the data in the url
        if(!isset($_SESSION['song-id-interaction'])){
            $_SESSION['song-id-interaction'] = $_GET['id'];
        }

        // To get the song data 
        if(isset($_SESSION['song-id-interaction']) && $_SESSION['song-id-interaction'] == $_GET['id']){
            $id = $_SESSION['song-id-interaction'];
            $get_data = mysqli_query($con, "SELECT * FROM songs_tbl WHERE id = '$id'");
            $data = mysqli_fetch_assoc($get_data);
        }
        else{
            header("Location: index.php?id={$_SESSION['song-id-interaction']}&a=edit");
        }  
    }

    ?>


    <!-- Main Content -->
    <?php if(!isset($_GET['id']) || !isset($_GET['a'])){ ?>
        <div class="container mt-5 pt-7">
            <div class="row">
                <div class="col">
                        <?php if(isset($_SESSION['crud-message'])){ ?>
                        <p class="text-white"><?php echo $_SESSION['crud-message']; ?></p>
                    <?php $_SESSION['remove-crud-message'] = 1; } ?>
                </div>
                <div class="col">  
                    <div class="d-flex justify-content-end">
                        <button class="btn bg-white mb-2" data-bs-toggle="modal" data-bs-target="#addModal">Add <i class="fas fa-plus-circle"></i></button>
                    </div>
                </div>
            </div>
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Created At</th>
                    <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_array($get_songs_record)){ ?>
                        <tr>
                            <td>
                                <div class="ms-3">
                                    <p class="fw-bold mb-1"><?php echo $row['title']; ?></p>
                                </div>
                            </td>
                            <td>
                                <p class="fw-normal mb-1"><?php echo $row['artist']; ?></p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1"><?php echo $row['created_at']; ?></p>
                            </td>
                            <td>
                            <div class="dropdown">
                            <button
                                class="btn btn-dark dropdown-toggle"
                                type="button"
                                id="dropdownMenuButton"
                                data-mdb-toggle="dropdown"
                                aria-expanded="false"
                            >
                                Actions
                            </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="index.php?id=<?php echo $row['id']; ?>&a=edit">Edit</a></li>
                                    <li><a class="dropdown-item"href="index.php?id=<?php echo $row['id']; ?>&a=del">Delete</a></li>
                                </ul>
                            </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>

    <!-- Edit Content -->
    <?php if(isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'edit'){ ?>
        <div class="container mt-5 pt-7">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card card-profile bg-white mt-5">
                        <div class="card-body pt-7 px-5">
                            <div class="text-center mb-4">
                                <p class="text-dark display-6">Edit song</p>
                            </div>
                            <form role="form" method="post">
                                <input type="hidden" class="form-control" name="id" value="<?php echo $_GET['id']; ?>" required>
                                <div class="form-row">
                                    <div class="row">
                                        <div class="col">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control" value="<?php echo $data['title']; ?>" required>
                                        </div>
                                        <div class="col">
                                            <label for="artist">Artist</label>
                                            <input type="text" name="artist" id="artist" class="form-control" value="<?php echo $data['artist']; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row mt-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Lyrics</label>
                                        <textarea class="form-control" name="lyrics" id="exampleFormControlTextarea1" rows="5"><?php echo $data['lyrics']?></textarea>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <a href="index.php" class="btn btn-outline-primary mt-2">No</a>
                                    <button type="submit" name="edit-song-btn" class="btn btn-primary mt-2">Yes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Delete Content -->
    <?php if(isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'del'){ ?>
        <div class="container mt-5 pt-7">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card card-profile bg-white mt-5">
                        <div class="card-body pt-7 px-5">
                            <div class="text-center mb-4">
                                <p class="text-dark display-6">Are you sure you want to delete this song?</p>
                            </div>
                            <form role="form" method="post">
                                <input type="hidden" class="form-control" name="id" value="<?php echo $_GET['id']; ?>" required>
                                <div class="text-center">
                                    <a href="index.php" class="btn btn-outline-primary mt-2">No</a>
                                    <button type="submit" name="delete-song-btn" class="btn btn-primary mt-2">Yes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add song</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" role="form">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="row">
                            <div class="col">
                                <input type="text" name="title" class="form-control" placeholder="Title" required>
                            </div>
                            <div class="col">
                                <input type="text" name="artist" class="form-control" placeholder="Artist" required>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Lyrics</label>
                                <textarea class="form-control" name="lyrics" id="exampleFormControlTextarea1" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add-song-btn" class="btn btn-primary">Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    

<!-- MDB -->
<script
type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"
></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


</body>
</html>