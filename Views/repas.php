<?php
    require('./Modeles/repas.php');
    $repas= new Repas('./Datas/Repas.json');

    echo '<div class="container-fluid py-2 d-flex flex-wrap justify-content-center">';

    $listRepas= $repas->getAll();
    foreach ($listRepas as $diner){
        echo '  
            <div class="card text-bg-primary mb-3 mx-2" style="width: 18rem; height: 13rem">
                <div class="card-header badge bg-secondary fs-5 d-flex align-items-center"><span class="material-symbols-rounded text-warning">lunch_dining</span>&nbsp;'.$diner->nom.'</div>
                    <div class="card-body pb-0 d-flex flex-column">
                        <p class="card-text" style="height: 100%">'.$diner->description.'</p>
                        <div class="d-flex justify-content-center">
                            <div style="width: 9rem; margin-right: 8px" class="text-start">
                                <span class="badge bg-info rounded-bottom-0 w-100 border-bottom text-black fw-bold border-black">LOCALISATION</span>
                                <h5 style="font-size: 16px; padding-top:2px; padding-bottom:2px" class="card-title badge bg-info text-black d-flex align-items-center justify-content-center rounded-top-0">
                                    <span class="text-danger material-symbols-rounded">distance</span>'.$diner->localisation.'Km
                                </h5>
                            </div>
                            <div style="width: 9rem; margin-left: 8px" class="text-end">
                                <span class="badge bg-warning rounded-bottom-0 w-100 border-bottom text-black fw-bold border-black">PRIX</span> 
                                <h5 style="font-size: 16px; padding-top:2px; padding-bottom:2px" class="card-title badge bg-warning text-black d-flex align-items-center justify-content-center rounded-top-0">
                                    <span class="text-danger material-symbols-rounded">paid</span>'.$diner->prix.'$
                                </h5>
                            </div>
                        </div>
                    </div>
                <a href="#" class="btn btn-secondary d-flex align-items-center justify-content-end">Detail<span class="material-symbols-rounded">read_more</span></a>
            </div> ';
    }

    echo '</div>';
?>

<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasTopLabel">Offcanvas top</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        
    </div>
</div>