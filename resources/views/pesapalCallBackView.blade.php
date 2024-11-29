<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('frontend/css/facebook.css') }}">
    <title>NyumbaFasta - Malipo</title>
    <link rel="icon" type="">
</head>
<body>
<section>
<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            
    <div class="container ">
    <div class="px-5 float-left">
        <img style="width: 100px; height:70px"   class="mt-1" src="{{ asset('frontend/img/logoo.png') }}" alt="">
        </div>

    </div>

    </nav>
    </section>
    

      <!--Information Section   -->
<section class="p-5 ">

<div class="row align-items-center justify-items-between">

<div class="col-md p-5">
                <h1 style="font-size:1.86rem;" class="pt-5" >Your Payment Status is :</h1>
                <div class="row mt-5 align-items-center">
                    <img src="" alt="">
                    <p class="m-3"><span>{{$status}}</p>
                </div>
</div>
</div>

</section>

<!-- information section-->




   

            
           
      
</body>
</html>