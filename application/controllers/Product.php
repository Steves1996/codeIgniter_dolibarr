<?php
class Product extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
    }

    function index()
    {
        $data['product'] = $this->product_model->getProduct();
        $this->load->view('product/index', $data);
    }

    function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $this->input->post('name');
            $ref = $this->input->post('ref');
            $price = $this->input->post('price');
            $qte = $this->input->post('qte');

            $data = array(
                'name' => $name,
                'price' => $price,
                'quantity' => $qte,
                'ref' => $ref
            );
            $result = $this->product_model->insertProduct($data);
            if ($result == true) {
                $postParameter = array(
                    'ref' => $ref,
                    'label' => $name,
                    'price' => $price,
                );
                $product_url = "http://localhost/dolitest/api/index.php/products";

                $ch = curl_init($product_url);

                //set opt
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('DOLAPIKEY: Z9sV71tihu0VDOHYuy7Gi9vK9o65jV7K'));
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postParameter);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                $response = curl_exec($ch);
                if (isset(json_decode($response)->{'error'}->{'code'})) {
                    echo json_decode($response)->{'error'}->{'message'};
                } else {
                    echo $response;
                    $this->session->set_flashdata('success', 'creation done !');
                    redirect(base_url('product/add'));
                }
                curl_close($ch);

                //process de connexion a dolibarr et recuperation du token
                /* $loginParameter = array(
                    'login' => 'admin',
                    'password' =>'Allen1205@',
                );
                $login_url ='http://localhost/dolitest/api/index.php/login';


                $ch = curl_init($login_url);

                //set opt
                curl_setopt($ch, CURLOPT_POSTFIELDS, $loginParameter);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

                $response = curl_exec($ch);
                $result = json_decode($response)->{'success'}->{'token'};
                echo $result;
                die();
                
                curl_close($ch);*/
            } else {
                $this->session->set_flashdata('error', 'creation not done !');
                $this->load->view('product/add_product');
            }
        } else {
            $this->load->view('product/add_product');
        }
    }

    function edit($id)
    {
        $data['product'] = $this->product_model->getOneProduct($id);
        $data['id'] = $id;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $this->input->post('name');
            $ref = $this->input->post('ref');
            $price = $this->input->post('price');
            $qte = $this->input->post('qte');

            $data = array(
                'name' => $name,
                'price' => $price,
                'quantity' => $qte,
                'ref' => $ref
            );
            $result = $this->product_model->updateProduct($data, $id);
            if ($result == true) {
                $postParameter = array(
                    'ref' => $ref,
                    'label' => $name,
                    'price' => $price,
                );
                $product_url = "http://localhost/dolitest/api/index.php/products/$id";
                $ch = curl_init($product_url);

                //set opt
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('DOLAPIKEY: Z9sV71tihu0VDOHYuy7Gi9vK9o65jV7K'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postParameter));

                $response = curl_exec($ch);
                if (isset(json_decode($response)->{'error'}->{'code'})) {
                    echo json_decode($response)->{'error'}->{'message'};
                } else {
                    echo $response;
                    $this->session->set_flashdata('success', 'update done !');
                    redirect(base_url('product/edit/' . $id));
                }
                curl_close($ch);
            } else {
                $this->session->set_flashdata('error', 'update not done !');
                $this->load->view('product/edit_product');
            }
        } else {
            $this->load->view('product/edit_product', $data);
        }
    }

    function delete($id)
    {
        if (is_numeric($id)) {
            $result =  $this->product_model->deleteProduct($id);
            if ($result == true) {
                $product_url = "http://localhost/dolitest/api/index.php/products/$id";

                $ch = curl_init($product_url);

                //set opt
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('DOLAPIKEY: Z9sV71tihu0VDOHYuy7Gi9vK9o65jV7K'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

                $response = curl_exec($ch);
                if (isset(json_decode($response)->{'error'}->{'code'})) {
                    echo json_decode($response)->{'error'}->{'message'};
                } else {
                    echo $response;
                    $this->session->set_flashdata('success', 'delete done !');
                    redirect(base_url('product/index'));
                }
                curl_close($ch);
            } else {
                $this->session->set_flashdata('error', 'delete not done !');
                $this->load->view('product/index');
            }
        }
    }
}
