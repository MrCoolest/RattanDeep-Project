<?php include 'C:\xampp\htdocs\rd_proj\base_\links.php' ?>

<?php include './base_/main.php' ?>


<!-- importing Json of Carousel -->

<?php 


// Read JSON file
$json = file_get_contents('./Json/carousel.json');
$json2 = file_get_contents('./Json/context.json');

//Decode JSON
$json_data = json_decode($json,true);
$context = json_decode($json2,true);

// print_r($context['context']['Name'])

/*
//Print data
// print_r($json_data['carousel'][1]['heading']);
// print_r(count($json_data['carousel']));



// for ($i=0; $i<count($json_data['carousel']); $i++){
  // print_r()
  // // print_r($json_data['carousel'][$i]['heading']);
  // $heading = $json_data['carousel'][$i]['heading'];
  // echo $heading;
// }

*/



?>



        <header class="mt-5">

          <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
            
            <?php

              for ($i=0; $i<count($json_data['carousel']); $i++){
                $slide = $i+1; 
                
                if ($i==0){
                  echo "<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='".$i."'class='active' aria-current='true' aria-label='Slide ".$slide."'></button>";
                }else{
                  echo "<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='".$i."'class='' aria-current='true' aria-label='Slide ".$slide."'></button>";
                }
              }


            ?>
              
              
            </div>
            <div class="carousel-inner">
          <?php

            for($i=0; $i<count($json_data['carousel']); $i++){
              $heading = $json_data['carousel'][$i]['heading'];
              $para = $json_data['carousel'][$i]['Paragraph'];
              $url = $json_data['carousel'][$i]['img_url'];

              if($i==0){
                echo "<div class='carousel-item active' style='background-image: url(".$url.")'>
                <div class='carousel-caption'>
                  <h5>".$heading."</h5>
                  <p>".$para."</p>
                </div>
              </div>";
              }
              else{
              echo "<div class='carousel-item' style='background-image: url(".$url.")'>
              <div class='carousel-caption'>
                <h5>".$heading."</h5>
                <p>".$para."</p>
              </div>
            </div>";
              }
            }

          
          ?>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </header>

       


        <!-- ABout Page -->
         <section class="jumbotron text-center p-5">
        <div class="container px-5">
          <h1 class="jumbotron-heading">Album example</h1>
          <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
          <p>
          <?php
          //     if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
          //     {
          // echo '<div class=" mx-auto">
          //       <div class="form-outline">
          //         <input type="search" id="search_input" class="input-search" />
          //         <button type="button" id="search_btn" class="btn btn-primary">Search</button>
          //       </div>
          //     </div>';
          //     }
            ?>  
            <!-- <a href="#" class="btn btn-primary my-2">Main call to action</a>
            <a href="#" class="btn btn-secondary my-2">Secondary action</a> -->
          </p>
         
        </div>
      </section>



      <div class="album py-5 bg-light">
          <div class="container">
  
            <div class="row">

            <?php 

            for($i=1; $i<=6; $i++){
              echo "   <div class='col-md-4'>
              <div class='card mb-4 box-shadow'>
                <img class='card-img-top' src='./images/img.jpg' alt='Card image cap'>
                <div class='card-body'>
                  <p class='card-text'>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class='d-flex justify-content-between align-items-center'>
                    <div class='btn-group'>
                      <button type='button' class='btn btn-sm btn-outline-secondary'>View</button>
                      <button type='button' class='btn btn-sm btn-outline-secondary'>Edit</button>
                    </div>
                    <small class='text-muted'>9 mins</small>
                  </div>
                </div>
              </div>
            </div>";
            }

            ?>

            </div>
          </div>
        </div> 

      <div class="album py-5 bg-light">
          <div class="container">
            <h3 class="text-center pb-3" id="top_books_title"></h3>
            <div class="row" id="top_books">

            

            </div>
          </div>
        </div> 

        


        <?php include './base_/footer.php' ?>
