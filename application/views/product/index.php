<?php $this->load->view('includes/header'); ?>

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">Liste des produits</h5> <a href="<?=base_url()?>product/add">Ajouter</a>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ref</th>
                            <th>Nom produit</th>
                            <th>Montant</th>
                            <th>Quantite</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($product as $row) { ?>
                        <tr>
                            <td><?=$i++?></td>
                            <td><?=$row->ref?></td>
                            <td><?=$row->name?></td>
                            <td><?=$row->price?></td>
                            <td><?=$row->quantity?></td>
                            <td>
                                <a href="<?=base_url()?>product/edit/<?=$row->id?>" class="btn brn-sm btn-primary">Edit</a>
                                <a href="<?=base_url()?>product/delete/<?=$row->id?>" class="btn brn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
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