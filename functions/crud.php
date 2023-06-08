<?php

function get_timestamp(){
    return date("Y-m-d G:i:s");
}

// To implement the message first before it removes or unset it completely.
if(isset($_SESSION['remove-crud-message']) && $_SESSION['remove-crud-message'] == 1){
    unset($_SESSION['crud-message']);
    unset($_SESSION['remove-crud-message']);
}

// Add song function
if(isset($_POST['add-song-btn'])){

    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $lyrics = $_POST['lyrics'];
    $timestamp = get_timestamp();

    $add_song = mysqli_query($con, "INSERT INTO `songs_tbl`(`title`, `artist`, `lyrics`, `created_at`) 
                                    VALUES ('$title', '$artist', '$lyrics', '$timestamp')");

    if($add_song){
        $_SESSION['crud-message'] = "The song has been successfully added.";
    }
    else{
        $_SESSION['crud-message'] = "The song has been failed to be added.";
    }
}

// Edit song function
if(isset($_POST['edit-song-btn'])){

    $id = $_POST['id'];
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $lyrics = $_POST['lyrics'];
    $timestamp = get_timestamp();


    $edit_song = mysqli_query($con, "UPDATE `songs_tbl` SET title='$title',artist='$artist',lyrics='$lyrics',updated_at='$timestamp' WHERE id = '$id'");

    if($edit_song){
        header("Location: index.php");
        $_SESSION['crud-message'] = "The song has been successfully edited.";
    }
    else{
        header("Location: index.php");
        $_SESSION['crud-message'] = "The song has been failed to be edited.";
    }
}

// Delete song function
if(isset($_POST['delete-song-btn'])){

    $id = $_POST['id'];
    $timestamp = get_timestamp();


    $delete_song = mysqli_query($con, "UPDATE `songs_tbl` SET deleted_at='$timestamp' WHERE id = '$id'");

    if($delete_song){
        header("Location: index.php");
        $_SESSION['crud-message'] = "The song has been successfully deleted.";
    }
    else{
        header("Location: index.php");
        $_SESSION['crud-message'] = "The song has been failed to be deleted.";
    }
}

?>