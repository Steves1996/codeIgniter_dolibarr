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
                    'fields' => [
                        "name", "list_price"
                    ],
                    'values' => [
                        'name' => $name,
                        'list_price' => $price
                    ]
                );

                //Odoo

                $dataToSave = json_encode($postParameter);

                $product_url = "http://localhost:8069/send_request?model=product.template";

                $ch = curl_init($product_url);

                //header curl
                $headers = [
                    "Content-Type:application/json",
                    "db:miradb",
                    "login:steveskamdem6@gmail.com",
                    "password:Allen1205@",
                    "api_key:1a874b9b-6908-4475-a5a6-a390f43306cc"
                ];
                //set opt
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $dataToSave);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                $response = curl_exec($ch);

                echo($response);
                die();
                
                $this->session->set_flashdata('success', "$response");
                redirect(base_url('product/add'));
                curl_close($ch);

                //Dolibarr
                /*$product_url = "http://localhost/dolitest/api/index.php/products";

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
                curl_close($ch);*/

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
                    'fields' => [
                        "name", "list_price"
                    ],
                    'values' => [
                        'name' => $name,
                        'list_price' => $price
                    ]
                );

                //Odoo
                $dataToSave = json_encode($postParameter);

                $product_url = "http://localhost:8069/send_request?model=product.template&Id=$id";

                $ch = curl_init($product_url);

                //header curl
                $headers = [
                    "Content-Type:application/json",
                    "db:miradb",
                    "login:steveskamdem6@gmail.com",
                    "password:Allen1205@",
                    "api_key:1a874b9b-6908-4475-a5a6-a390f43306cc"
                ];

                //set opt
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $dataToSave);

                $response = curl_exec($ch);

                $this->session->set_flashdata('success', "$response");
                redirect(base_url('product/edit/' . $id));

                curl_close($ch);

                //Dolibarr
                /*
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
                */
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

                $product_url = "http://localhost:8069/send_request?model=product.template&Id=$id";

                $ch = curl_init($product_url);

                
                //header curl
                $headers = [
                   "Content-Type:application/json",
                    "db:miradb",
                    "login:steveskamdem6@gmail.com",
                    "password:Allen1205@",
                    "api_key:1a874b9b-6908-4475-a5a6-a390f43306cc"
                ];

                //set opt
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

                $response = curl_exec($ch);
               
                $this->session->set_flashdata('success', "$response");

                redirect(base_url('product/index'));
                curl_close($ch);

                /*
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
                */
            } else {
                $this->session->set_flashdata('error', 'delete not done !');
                $this->load->view('product/index');
            }
        }
    }
}



