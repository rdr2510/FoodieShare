<?php
    require_once('./Modeles/sessions.php');
    $sessions= new Sessions('./Datas/Sessions.json');
    $user;
    if ($sessions->isActive()){
        $user= $sessions->get();
    }

    require('./Modeles/repas.php');
    $repas= new Repas('./Datas/Repas.json');
    $listRepas= $repas->getAll();

    $filtreRecherche= false;
    $filtrePrix= false;
    $filtreDistance= false;

    if (isset($action)){
        if ($action=='SUPPRIMER'){        
            if (isset($platId)){
                $repas->delete((int)$platId);
                echo "<script type='text/javascript'>window.top.location='./index.php?menu=DELETE_REPAS_SUCCESS';</script>"; 
                exit;
            }
        } else if ($action=='RECHERCHE'){        
            if (isset($recherche) && isset($critere)){
                if (!empty($recherche)){
                    $filtreRecherche= true;
                    $listRepas= $repas->search($listRepas, $recherche, $critere);
                }
            }
            if (isset($prixMin) && isset($prixMax)){
                if ($prixMax>0){
                    $filtrePrix= true;
                    $listRepas= $repas->filtrePrix($listRepas, $prixMin, $prixMax);                           
                }
            }
            if (isset($distanceMin) && isset($distanceMax)){
                if ($distanceMax>0){
                    $filtreDistance= true;
                    $listRepas= $repas->filtreLocalisation($listRepas, $distanceMin, $distanceMax);
                }
            }
        }
    }    

    echo '<div class="bg-primary rounded m-2 p-2 d-flex flex-wrap justify-content-between align-items-center">
            <div class="d-flex align-items-center">            
                <h5 class="fw-bold d-flex align-items-center text-white m-0"><span class="material-symbols-rounded text-white" style="margin-right: 5px">fastfood</span>LISTE DES REPAS</h5>';
                if($filtreRecherche){
                    echo '<div class="text-white d-flex align-items-center"><span class="material-symbols-rounded mx-1 text-black fw-bold">arrow_right_alt</span><span class="mx-1">Recherche par</span>"<span class="text-warning">'.$recherche.'<span>"</div>';
                }
                if($filtrePrix){
                    echo '<div class="text-white d-flex align-items-center"><span class="material-symbols-rounded mx-1 text-black fw-bold">arrow_right_alt</span><span class="mx-1">Prix entre</span>(<span class="text-warning">'.$prixMin.' et '.$prixMax.'</span>) $</div>';
                }
                if($filtreDistance){
                    echo '<div class="text-white d-flex align-items-center"><span class="material-symbols-rounded mx-1 text-black fw-bold">arrow_right_alt</span><span class="mx-1">Rayon entre</span>(<span class="text-warning">'.$distanceMin.' et '.$distanceMax.'</span>) Km</div>';
                }
            echo '</div>';
        echo '<h5 class="text-white m-0 badge bg-warning fs-6" style="padding-right: 5px;"><span class="text-danger fw-bold">'.count($listRepas).'</span> DISPONIBLE(S)</h5>
          </div>
          <div class="container-fluid" style="height: 100%";>
            <div id="container-list-repas" class="d-flex flex-wrap justify-content-center overflow-y-scroll">';
                foreach ($listRepas as $diner){ ?>
                    <div id=plat-<?=$diner->id?>  class="plat card border-2 border-primary m-4 mx-4" style="width: 18rem; height: 13rem">
                        <div class="card-header badge bg-primary fs-5 d-flex align-items-center rounded-top-1 py-0"><span class="material-symbols-rounded text-warning">lunch_dining</span>&nbsp;<span class="text-truncate py-3"><?=$diner->nom?></span></div>
                        <div class="card-body pb-0 d-flex flex-column pt-0">
                            <div style="height: 100%;">
                                <p class="card-text" style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;"><?=$diner->description?></p>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div style="width: 9rem; margin-right: 8px" class="text-start">
                                    <span class="badge bg-info rounded-bottom-0 w-100 border-bottom text-black fw-bold border-black">LOCALISATION</span>
                                    <h5 style="font-size: 16px; padding-top:2px; padding-bottom:2px" class="card-title badge bg-info text-black d-flex align-items-center justify-content-center rounded-top-0">
                                        <span class="text-danger material-symbols-rounded">distance</span><?=$diner->localisation?>Km
                                    </h5>
                                </div>
                                <div style="width: 9rem; margin-left: 8px" class="text-end">
                                    <span class="badge bg-warning rounded-bottom-0 w-100 border-bottom text-black fw-bold border-black">PRIX</span> 
                                    <h5 style="font-size: 16px; padding-top:2px; padding-bottom:2px" class="card-title badge bg-warning text-black d-flex align-items-center justify-content-center rounded-top-0">
                                        <span class="text-danger material-symbols-rounded">paid</span><?=$diner->prix?>$
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between bg-primary w-100" style="padding-top:2px">
                            <?= isset($user)?'<button data-bs-toggle="modal" data-bs-target=#delete-repas-'.$diner->id.' class="btn btn-danger p-0 m-0 px-2 material-symbols-rounded d-flex align-items-center" style="height:100%;">delete_forever</button>':'';?>
                            <a href=<?= './index?menu=DETAIL_REPAS&platId='.$diner->id?> class="btn btn-primary d-flex align-items-center justify-content-end">Detail<span class="material-symbols-rounded">read_more</span></a>
                        </div>
                    </div>
                    
                    <?php if (isset($user)){?>
                        <div class="modal fade" id=<?='delete-repas-'.$diner->id?> data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h1 class="modal-title fs-5 text-white d-flex align-items-center" id="staticBackdropLabel"><span class="material-symbols-rounded" style="margin-right: 5px;">warning</span>SUPPRESSION</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Voulez-vous vraiment supprimer ce plat (<?=$diner->nom?>)?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary d-flex align-items-center" data-bs-dismiss="modal"><span class="material-symbols-rounded" style="margin-right: 5px;">cancel</span>Annuler</button>
                                        <a type="button" class="btn btn-danger d-flex align-items-center" href=<?='./index?menu=LIST_REPAS&action=SUPPRIMER&platId='.$diner->id?>>Supprimer<span class="material-symbols-rounded" style="margin-left: 5px;">delete_forever</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                }
            echo '</div>
        </div>';
    ?>

<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel" style="height: auto;">
    <div class="offcanvas-header bg-primary text-light">
        <h5 class="offcanvas-title text-light d-flex align-items-center" id="offcanvasTopLabel"><span class="material-symbols-rounded">search</span>RECHERCHE & FILTRE</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="offcanvas-body">
        
        <div class="d-flex flex-column flex-lg-row gap-lg-3 border border-primary pt-3 px-4 rounded">
            <div id="input" class="input-group mb-3 rounded">
                <span class="input-group-text material-symbols-rounded text-primary">quick_reference_all</span>
                <input type="text" class="form-control" placeholder="Entrer votre recherche" name="recherche">
            </div>
            <div id="input" class="input-group mb-3 rounded">
                <span class="input-group-text material-symbols-rounded text-primary">filter_alt</span>
                <select class="form-select" aria-label="Default select example" name="critere">
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
                    <input id="filter-input-min" type="number" step="any" class="form-control" placeholder="Prix Minumum" name="prix-min">
                    <input id="filter-input-max" type="number" step="any" class="form-control" placeholder="Prix Maximum" name="prix-max">
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
                    <input id="filter-input-min" type="number" step="any" class="form-control" placeholder="Distance Minumum" name="distance-min">
                    <input id="filter-input-max" type="number" step="any" class="form-control" placeholder="Distance Maximum" name="distance-max">
                </div>    
            </div>    
            <input type="hidden" name="action" value="RECHERCHE">
            <button name="menu" value="LIST_REPAS" type="submit" class="btn btn-primary d-flex flex-lg-column flex-row align-items-center justify-content-center"><span class="material-symbols-rounded" style="margin-right: 5px;">search</span>Rechercher</button>
        </div>    
    </form>
</div>