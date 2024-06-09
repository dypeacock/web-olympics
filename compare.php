<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="compare.js"></script>
    <link rel="stylesheet" type="text/css" href="compare.css">
  </head>
  <body>

    <nav class="navbar fixed-top mt-auto py-3 navbar-expand-lg bg-body-tertiary bg-light" data-bs-theme="light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <img src="https://toppng.com/uploads/preview/olympic-rings-logo-png-transparent-background-photoshop-116607304293dbwfybxh8.png" width="50" alt="" class="logo">
            Compare
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="http://codnp.sci-project.lboro.ac.uk/f213619olympics/bmi.html">BMI</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="http://codnp.sci-project.lboro.ac.uk/f213619olympics/athletes.html">Athletes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="http://codnp.sci-project.lboro.ac.uk/f213619olympics/details.html">Details</a>
              </li>
              <li class="nav-item dropdown" id="filter-dropdown">
              </li>
            </ul>
          </div>
        </div>
      </nav>

    

    <div class="modal modal-sheet position-static d-block p-4 py-md-5 mt-5" tabindex="-1" role="dialog" id="compareForm">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-4 shadow">

                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h1 class="fw-bold mb-0 fs-2">Compare</h1>
                </div>
            
                <div class="modal-body p-5 pt-0">
                    <form id="COUNTRY_ISO" onSubmit="checkISO(); return false;" >
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="iso_1" value="GBR">
                            <label for="floatingInput">Country ID</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="iso_2" value="FRA">
                            <label for="floatingInpyr">Country ID</label>
                        </div>
                        <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Compare</button>
                        <small class="text-body-secondary">By clicking Compare, you agree to observe the might of my programming wizardry!</small>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <div id="results" style="display : none;"> 
    

        <div class="modal modal-sheet position-static d-block" role="dialog">
        
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <h5 class="fw-bold mb-0 fs-2">Medals</h5>
                    </div>
                    <div class="modal-body p-1 pt-0 pb-4">
                        <table class='custom-table' id="medals"></table>
                    </div>
                </div>
            </div>
            
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="modal modal-sheet position-static d-block" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content rounded-4 shadow">
                                <div class="modal-header p-5 pb-4 border-bottom-0">
                                    <h5 id="iso_1-header" class="fw-bold mb-0 fs-2"></h5>
                                </div>
                                <div class="modal-body p-5 pt-0" id="cyclists1"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="modal modal-sheet position-static d-block" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content rounded-4 shadow">
                                <div class="modal-header p-5 pb-4 border-bottom-0">
                                    <h5 id="iso_2-header" class="fw-bold mb-0 fs-2"></h5>
                                </div>
                                <div class="modal-body p-5 pt-0" id="cyclists2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>       

        </div>
        
        

        <div class="modal modal-sheet position-static d-block" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <h5 class="fw-bold mb-0 fs-2">Gold Medals</h5>
                    </div>
                    <div class="modal-body p-5 pt-0 pb-4 DivWithScroll">
                        <table id="gold"></table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-sheet position-static d-block" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <h5 class="fw-bold mb-0 fs-2">Number of Cyclists</h5>
                    </div>
                    <div class="modal-body p-5 pt-0 pb-4 DivWithScroll">
                        <table id="number_of_cyclists"></table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-sheet position-static d-block pb-5" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <h5 class="fw-bold mb-0 fs-2">Average Age</h5>
                    </div>
                    <div class="modal-body p-5 pt-0 pb-4 DivWithScroll">
                        <table id="avg_age"></table>
                    </div>
                </div>
            </div>
        </div>
    
    </div>

    <div class="container-fluid">
    <footer class="fixed-bottom mt-auto py-3 bg-light" data-bs-theme="light">
        <div class="col-md-4 d-flex align-items-center">
            
            <img class="px-2" src="https://study-eu.s3.amazonaws.com/uploads/university/loughborough-university-219-logo.png" width="100" alt="" class="logo">
            <span class="px-2 mb-3 mb-md-0 text-muted">&copy; COA123 - Web Programming</span>
        </div>
    </footer>
    </div>

  </body>
</html>