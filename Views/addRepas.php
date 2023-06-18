<div class="modal fade" id="add-repas" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 d-flex align-items-center text-light fw-bold" id="staticBackdropLabel"><span class="material-symbols-rounded" style="margin-right: 10px;">restaurant</span>NOUVEAU REPAS</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <div class="w-75">
                    <div id="input" class="input-group mb-3 rounded">
                        <span class="input-group-text material-symbols-rounded text-primary">lunch_dining</span>
                        <input type="text" class="form-control" placeholder="Nom du plat" name="nom">
                    </div>
                    <div class="d-flex gap-lg-4 flex-column flex-lg-row">
                        <div id="input" class="input-group mb-3 rounded border-primary">
                            <span class="input-group-text material-symbols-rounded text-primary">monetization_on</span>
                            <input type="number" class="form-control" step="any" aria-label="Prix unitaire du plat" placeholder="Prix Unitaire" name="prix">
                            <span class="input-group-text fw-bold">$</span>
                        </div>
                        <div id="input" class="input-group mb-3 rounded border-primary">
                            <span class="input-group-text material-symbols-rounded text-primary">distance</span>
                            <input type="number" class="form-control" step="any" aria-label="Prix unitaire du plat" placeholder="Localisation" name="localisation">
                            <span class="input-group-text fw-bold">Km</span>
                        </div>
                    </div>
                    <div id="input" class="input-group mb-3 rounded border-primary">
                        <span class="input-group-text material-symbols-rounded text-primary">post</span>
                        <textarea class="form-control" name="description" rows="3" placeholder="Description"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-secondary">
                <button type="button" class="btn btn-secondary btn-outline-light d-flex align-items-center" data-bs-dismiss="modal"><span class="material-symbols-rounded" style="margin-right: 10px;">close</span>Annuler</button>
                <button type="button" class="btn btn-primary d-flex align-items-center"><span class="material-symbols-rounded" style="margin-right: 10px;">cloud_upload</span>Enregistrer</button>
            </div>
        </div>
    </div>
</div>