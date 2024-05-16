<?php $this->load->view('includes/header'); ?>

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">Ajout d'un client</h5>
                <form method="post" action="<?=base_url()?>client/index">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom du client</label>
                        <input type="text" name="name" class="form-control" id="name" >
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="isFour" class="form-label">C'est un fournisseur</label>
                        <input type="number" name="isFour" class="form-control" id="isFour">
                    </div>
                    
                    <div class="mb-3">
                        <label for="isClient" class="form-label">C'est un client</label>
                        <input type="number" name="isClient" class="form-control" id="isClient">
                    </div>

                    <div class="mb-3">
                        <label for="codeFour" class="form-label">Code Fournisseur</label>
                        <input type="text" name="codeFour" class="form-control" id="codeFour">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

</div>

<?php $this->load->view('includes/footer'); ?>