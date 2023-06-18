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

<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel" style="height: auto;">
    <div class="offcanvas-header bg-primary text-light">
        <h5 class="offcanvas-title text-light d-flex align-items-center" id="offcanvasTopLabel"><span class="material-symbols-rounded">search</span>RECHERCHE & FILTRE</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        
        <div class="d-flex flex-column flex-lg-row gap-lg-3 border border-primary pt-3 px-4 rounded">
            <div id="input" class="input-group mb-3 rounded">
                <span class="input-group-text material-symbols-rounded text-primary">quick_reference_all</span>
                <input type="text" class="form-control" placeholder="Entrer votre recherche" name="recherche">
            </div>
            <div id="input" class="input-group mb-3 rounded">
                <span class="input-group-text material-symbols-rounded text-primary">filter_alt</span>
                <select class="form-select" aria-label="Default select example">
                    <option selected value="0">Toute les colonnes</option>
                    <option value="1">Par nom</option>
                </select>
            </div>
        </div>  

        <div class="d-flex flex-column flex-lg-row gap-3 mt-3 w-100">
            <div class="d-flex align-items-center flex-column flex-lg-row gap-lg-3 border border-primary px-4 pt-3 rounded w-100">
                <div id="input" class="rounded d-flex flex-column flex-lg-row align-items-center border mb-3 w-100">
                    <div class="input-group d-flex align-items-center">
                        <div id="filter-label" class="input-group-text w-100">
                            <span class="material-symbols-rounded text-primary">currency_exchange</span>
                            <div class="fw-bold text-primary m-0 mx-2">Filtrage de Prix :</div>
                        </div>
                    </div>    
                    <input id="filter-input-min" type="number" class="form-control" placeholder="Prix Minumum" name="prix-min">
                    <input id="filter-input-max" type="number" class="form-control" placeholder="Prix Maximum" name="prix-max">
                </div>    
            </div>    

            <div class="d-flex align-items-center flex-column flex-lg-row gap-lg-3 border border-primary px-4 pt-3 rounded w-100">
                <div id="input" class="rounded d-flex flex-column flex-lg-row align-items-center border mb-3 w-100">
                    <div class="input-group d-flex align-items-center">
                        <div id="filter-label" class="input-group-text w-100">
                            <span class="material-symbols-rounded text-primary">distance</span>
                            <div class="fw-bold text-primary m-0 mx-2">Rayon de localisation :</div>
                        </div>
                    </div>    
                    <input id="filter-input-min" type="number" class="form-control" placeholder="Distance Minumum" name="distance-min">
                    <input id="filter-input-max" type="number" class="form-control" placeholder="Distance Maximum" name="distance-max">
                </div>    
            </div>    

            <button type="button" class="btn btn-primary d-flex flex-lg-column flex-row align-items-center justify-content-center"><span class="material-symbols-rounded" style="margin-right: 5px;">search</span>Rechercher</button>
        </div>    
    </div>
</div>