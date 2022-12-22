<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>PHP web</title>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <?php 
        $keys = [];
     $file = file_get_contents('info.txt');
     $keys = explode(',',$file);

    //  $three_lock = $_POST['three_lock'];    
    if(isset($_POST['action']) && $_POST['action'] == 'one'){
        if(isset($_POST['one_lock'])){
            $keys[0]= 1;
        }else{
            $keys[0]= 0;
        }
        if(isset($_POST['two_lock'])){
            $keys[1]= 1;
        }else{
            $keys[1]= 0;
        }

        $resp = implode(',',$keys);
        file_put_contents('info.txt',$resp);
    }

    if(isset($_POST['action']) && $_POST['action'] == 'two'){
        if(isset($_POST['three_lock'])){
            $keys[0]= 1;
            $keys[1]= 1;
        }
        

        $resp = implode(',',$keys);
        file_put_contents('info.txt',$resp);
    }
    
     ?>

<header class="p-3 text-bg-dark">
            <div class="container">
              <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                  <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                  <li><a href="#" class="nav-link px-2 text-white">Smart Lock <br> Yaroslav Sabadash, Veronika Kosiuk</a></li>
                </ul>
                </div>
              </div>
            </div>
        </header>

        <div class="container mt-5">
            <h3 class="mb-5">Buttons</h3>
            <div class="d-flex flex-wrap">
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                  <div class="card-header py-3">
                    <h4 class="my-0 fw-normal">Button 1 / Button 2</h4>
                  </div>  
                  <div class="card-body">
                  <img src="img/lock.png" class="img-thumbnail">

                    <form action="" method="post">
                        <input type="text" name="action" value='one' hidden>
                    <input type="checkbox" name="one_lock" value = 'true' id="key" <? if($keys[0] == 1){echo('checked');}?>>
                    <label class="custom">Close the first lock</label>    
                    <img src="img/lock.png" class="img-thumbnail">

                    <input type="checkbox" name="two_lock" value = 'true' id="key2" <? if($keys[1] == 1){echo('checked');}?>>
                    <label class="custom">Close the second lock</label>
                    <input type="submit" class="w-100 btn btn-lg btn-outline-primary">
                    </form>

                  </div>
                </div>
              </div>


              <div class="col" style="margin-top: 15%"> 
                <div class="card mb-4 rounded-3 shadow-sm">
                  <div class="card-header py-3">
                    <h4 class="my-0 fw-normal">Button 3</h4>
                  </div>
                  <div class="card-body">
                  <img src="img/lock2.png" class="img-thumbnail">

                  <form action="" method="post">
                    <label class="custom">
                        <input type="text" name="action" value='two' hidden>
                        <input type="checkbox" name="three_lock" checked hidden>Close both locks</input>
                    </label>
                    <input type="submit" class="w-100 btn btn-lg btn-outline-primary"></input>
                    </form>

                  </div>
                </div>
              </div>
        </div>
    </div>

    <script>
      function update(){
        $.ajax({
          type: "GET",
          url: "https://veronikakosiuk.azurewebsites.net/keys.php?act=get",
          success: function(data) {
            // data contains the contents of the JSON file
            let arr = data.split(',');
            if(arr[0] == '1'){
                $('#key').prop('checked', true);
            }else{
              $('#key').prop('checked', false);
            }

            if(arr[1] == '1'){
                $('#key2').prop('checked', true);
            }else{
              $('#key2').prop('checked', false);
            }
          }
        });
      }
      setInterval(update,10000);
    </script>
</body>
</html>
