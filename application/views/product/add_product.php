<?php $this->load->view('includes/header'); ?>

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">Ajout d'un produit</h5>
                <form method="post" action="<?=base_url()?>product/index">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom du produit</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp">
                    </div>
                    
                    <div class="mb-3">
                        <label for="ref" class="form-label">Ref</label>
                        <input type="text" name="ref" class="form-control" id="ref">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Montant</label>
                        <input type="number" name="price" class="form-control" id="price">
                    </div>

                    <div class="mb-3">
                        <label for="qte" class="form-label">Quantite</label>
                        <input type="number" name="qte" class="form-control" id="qte">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

</div>

<?php $this->load->view('includes/footer'); ?>