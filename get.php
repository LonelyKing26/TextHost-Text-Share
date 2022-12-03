<?php
include('config.php');

$slug = $_GET['file'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TextHost</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include('header.php');?>
    <?php
    // echo $slug;
        $sql = "SELECT * FROM post_data
                WHERE status = 'Active'
                AND post_data.slug LIKE '%$slug%'
        ";
        $res = mysqli_query($conn, $sql);
        $post = mysqli_fetch_assoc($res);
        
    ?>
        <section class="container">
            <div class="heading">
                <h2><?php echo $post['title'];?></h2>
            </div>
            <div class="content mt-5">
                <?php echo $post['slug'];?>
                <?php echo $post['content'];?>
            </div>
        </section>
    <link href="https://cdn.quilljs.com/1.2.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.2.6/quill.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var quill = new Quill('#editr', {
        modules: {
            toolbar: true
        },
        theme: 'snow'
        });
    </script>
    <script>
        
        $(document).ready(function(){
            // $("#submit").click(function(){
            //     var title = $("#title").val();
            //     var slug = $("#slug").val();
            //     var editr = $('.ql-editor').html();
                
            //     if(title == ""){
            //         Swal.fire(
            //                 'Title Empty.!',
            //                 'Please Fill Title',
            //                 'error'
            //                 )
            //     }
            //     else if (editr == '<p><br></p>'){
            //         Swal.fire(
            //                 'Content Empty.!',
            //                 'Please Fill Content',
            //                 'error'
            //                 )
            //     }
            //     else{
            //         var fd = new FormData();

            //         fd.append("title", title);
            //         fd.append("editr", editr);
            //         fd.append("slug", slug);
            //         $.ajax({
            //             url: 'ajax/texthost.php',
            //             type: 'post',
            //             contentType: false,
            //             processData:false,
            //             data: fd,
            //             success: function(response){
            //                 console.log(response);
            //                 if(response == 'success'){
            //                     Swal.fire(
            //                     'Success',
            //                     'Your Text is Posted',
            //                     'success'
            //                     ).then(function(){ window.location.href('get.php?file='+slug);});
            //                 }
            //                 else{
            //                     Swal.fire(
            //                     'Error',
            //                     'Somting Error, Contact Admin',
            //                     'error'
            //                     )
            //                 }
            //             }
            //         });
            //     }
            // });
        });
        
    </script>
</body>
</html>