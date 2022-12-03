<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TextHost</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <?php include('header.php');?>
    <section class="container">
        <div class="heading mt-5 text-center">
            <h2>
                Free Text Host Online Demo
            </h2>
        </div>
        <div class="form">
            <div class="from-group pt-4">
                <label for="#title">Title</label> <small>(max 100)</small>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="form-group pt-4">
                <label for="content">Content</label> <small>(max 5000)</small>
                <div id="editr" style="height:250px; font-size:16px;color:black;">  
                                        
                <p id="content"></p>
                </div>
            </div>
            <div class="submit text-center">
                <input type="button" id="submit" class="btn btn-primary mt-4" value="Submit">
            </div>
        </div>
    </section>
            <?php
                $n=6;
                function getName($n) {
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $randomString = '';
                    
                    for ($i = 0; $i < $n; $i++) {
                        $index = rand(0, strlen($characters) - 1);
                        $randomString .= $characters[$index];
                    }
                    
                    return $randomString;
                }
                    
                $slug = getName($n);

                
            ?>
            <input type="text" id="slug" hidden value="<?php echo $slug;?>">
    <!-- <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script> -->
    <link href="https://cdn.quilljs.com/1.2.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.2.6/quill.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php include('footer.php');?>

    <script>
        var quill = new Quill('#editr', {
        modules: {
            toolbar: true
        },
        theme: 'snow'
        });
    </script>
    <script>
        // function makeid() {
        //     var text = "";
        //     var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        //     for (var i = 0; i < 5; i++)
        //         text += possible.charAt(Math.floor(Math.random() * possible.length));

        //     return text;
        //     }
//         const genRand = (len) => {
//   return Math.random().toString(36).substring(2,len+2);
// }

// console.log(genRand(8));
        $(document).ready(function(){
            $("#submit").click(function(){
                var title = $("#title").val();
                var slug = $("#slug").val();
                var editr = $('.ql-editor').html();
                
                if(title == ""){
                    Swal.fire(
                            'Title Empty.!',
                            'Please Fill Title',
                            'error'
                            )
                }
                else if (editr == '<p><br></p>'){
                    Swal.fire(
                            'Content Empty.!',
                            'Please Fill Content',
                            'error'
                            )
                }
                else{
                    var fd = new FormData();

                    fd.append("title", title);
                    fd.append("editr", editr);
                    fd.append("slug", slug);
                    $.ajax({
                        url: 'ajax/texthost.php',
                        type: 'post',
                        contentType: false,
                        processData:false,
                        data: fd,
                        success: function(response){
                            var data = JSON.parse(response);
                            console.log(data);
                            if(data.status == 'success'){

                                Swal.fire(
                                'Success',
                                'Your Text is Posted',
                                'success'
                                ).then(function(){ window.location = 'get.php?file='+slug;});

                            }
                            else{
                                Swal.fire(
                                'Error',
                                'Somting Error, Contact Admin',
                                'error'
                                )
                            }
                        }
                    });
                }
            });
        });
        
    </script>
</body>
</html>