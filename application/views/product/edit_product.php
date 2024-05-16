<?php $this->load->view('includes/header'); ?>

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">Modifier un produit</h5>
                <form method="post" action="<?= base_url() ?>product/edit/<?=$id?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom du produit</label>
                        <input type="text" name="name" class="form-control" value="<?=$product->name?>" id="name" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="ref" class="form-label">Ref</label>
                        <input type="text" name="ref" value="<?=$product->ref?>" class="form-control" id="ref">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Montant</label>
                        <input type="number" name="price" value="<?=$product->price?>"class="form-control" id="price">
                    </div>

                    <div class="mb-3">
                        <label for="qte" class="form-label">Quantite</label>
                        <input type="number" name="qte" value="<?=$product->quantity?>" class="form-control" id="qte">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
                <?php
                if ($this->session->flashdata('success')) {
                ?>
                    <div class="alert alert-success" role="alert">
                        produit modifier
                    </div>
                <?php }
                ?>
                <?php
                if ($this->session->flashdata('error')) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        echec modification
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </div>

</div>

<?php $this->load->view('includes/footer'); ?>