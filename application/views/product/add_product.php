<?php $this->load->view('includes/header'); ?>

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">Ajout d'un produit</h5>
                <form method="post" action="<?= base_url() ?>product/add">
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
                <?php
                if ($this->session->flashdata('success')) {
                ?>
                    <div class="alert alert-success" role="alert">
                        produit ajouter
                    </div>
                <?php }
                ?>
                <?php
                if ($this->session->flashdata('error')) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        echec ajout
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </div>

</div>

<?php $this->load->view('includes/footer'); ?>