<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Twilio\Rest\Client;
class Order extends Common_Front_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('order_model');
        $this->load->library('tracking_more');
        $this->load->model('File_upload_model');
    }

    //function for order list
    function current_order() {
        //$this->check_user_session();
        $data['page_title'] = 'Current orders';
        $user_id = $this->session->userdata() ['app_user_sess']['userID'];

        if (!empty($_GET['qoute']) && $_GET['qoute'] == 'true' && !empty($this->session->userdata() ['is_user_logged_in'])) {
            // echo "string";die();
            // if ($_GET['service_type'] == 4) {
            //     $last_id = $this->insert_concierge_order($_GET);
            //     $concierge_detail = $this->common_model->is_data_exists(CONCIERGE_QUOTES, array('conciergeQuoteID' => $last_id));
            // } else {
            $order_id = $this->insert_order($_GET);
            if (!empty($order_id)) {
                $orderData = $this->common_model->is_data_exists(ORDERS, array('orderID' => $order_id));
            }
            // }
        }
        $this->load->front_render('order', $data);
    } //end of function

    //get_ticket_list
    public function get_current_order_list() {
        $user_id = $this->session->userdata() ['app_user_sess']['userID'];
        $this->load->model('Current_order_model');
        $delType = getAllDeliveryCustom();
        //pr($delType);
        if (!empty($_POST['status']) && !empty($_POST['type'])) {
            $this->Current_order_model->set_data(array('user_id' => $user_id, 'orders.status' => $_POST['status'], 'orders.service_type' => $_POST['type']));
        } elseif (!empty($_POST['type'])) {
            $this->Current_order_model->set_data(array('user_id' => $user_id, 'orders.service_type' => $_POST['type']));
        } elseif (!empty($_POST['status'])) {
            $this->Current_order_model->set_data(array('user_id' => $user_id, 'orders.status' => $_POST['status']));
        } else {
            $this->Current_order_model->set_data(array('user_id' => $user_id));
        }
        $list = $this->Current_order_model->get_list();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $order) {
            if (!empty($order->sea_title)) {
                $item = $order->sea_title;
            } elseif (!empty($order->courier_title)) {
                $item = $order->courier_title;
            } elseif (!empty($order->air_title)) {
                $item = $order->air_title;
            } elseif (!empty($order->air_title)) {
                $item = $order->air_title;
            } else {
                $item = 'NA';
            }
            // // status
            // if ($order->status == 1) {
            //     $status = '<p id="badge" class="badge bg-primary">Placed</p>';
            // }
            // if ($order->status == 2) {
            //     $status = '<p id="badge" class="badge bg-warning">Pending</p>';
            // }
            // if ($order->status == 3) {
            //     $status = '<p id="badge" class="badge bg-primary">Shipped by Customer</p>';
            // }
            // if ($order->status == 4) {
            //     $status = '<p id="badge" class="badge bg-info">Received by Hobort</p>';
            // }
            // if ($order->status == 5) {
            //     $status = '<p id="badge" class="badge bg-secondary">Packed</p> ';
            // }
            // if ($order->status == 6) {
            //     $status = '<p id="badge" class="badge bg-danger">On the way</p> ';
            // }
            // if ($order->status == 7) {
            //     $status = '<p id="badge" class="badge bg-success">Delivered</p> ';
            // }
                // status
                if ($order->status == 1) {
                    $status = '<h5 class="statusBadge"><span class="badge badge-warning">Placed</span></h5>';

                    // $status = '<p id="badge" class="badge bg-primary">Placed</p>';
                }
                if ($order->status == 2) {
                    $status = '<h5 class="statusBadge"><span class="badge badge-info">Approved</span></h5>';
                }
                if ($order->status == 3) {
                    $status = '<h5 class="statusBadge"><span class="badge badge-secondary">Package Received at our warehouse</span></h5>';

                    //$status = '<p id="badge" class="badge bg-primary">Shipped by Customer</p>';
                }
                if ($order->status == 4) {
                    $status = ' <h5 class="statusBadge"><span class="badge badge-dark">Package preparing to ship</span></h5>';
                }
                if ($order->status == 5) {
                    //$status = '<p id="badge" class="badge bg-secondary">Packed</p> ';
                    $status = ' <h5 class="statusBadge"><span class="badge badge-primary">Shipment dropped off at Atlanta Airport</span></h5>';
                }
                if ($order->status == 6) {
                    //$status = '<p id="badge" class="badge bg-danger">On the way</p> ';
                    $status = ' <h5 class="statusBadge"><span class="badge badge-info">Shipment in Transit</span></h5>';
                }
                if ($order->status == 7) {
                    $status = ' <h5 class="statusBadge"><span class="badge badge-success">Shipment Arrived in Accra</span></h5>';
                }

                if ($order->status == 8) {
                    //$status = '<p id="badge" class="badge bg-danger">On the way</p> ';
                    $status = ' <h5 class="statusBadge"><span class="badge badge-info">Customs Clearance Started</span></h5>';
                }
                if ($order->status == 9) {
                    $status = ' <h5 class="statusBadge"><span class="badge badge-success">Shipment Cleared</span></h5>';
                }
            
            if (!empty($order->receipt_file)) {
                $file_name = base_url('order/receipt_download/download_reciept?image_name=') . $order->receipt_file;
            } else {
                $file_name = 'javascript:void(0)';
            }
            $encoded = encoding($order->concierge_quote_id);
            if (!empty($order->orderID)) {
                $encoded = encoding($order->orderID);
            }
            $detail = base_url() . 'order/current_order_detail/' . $encoded . '/' . encoding(1);
            $action = '';
            $no++;
            $row = array();
            $row[] = !empty($order->tracking_id) ? '<a href="' . $detail . '" style="color:#fca900">' . display_placeholder_text('#' . $order->tracking_id) . '</a>' : '<a href="' . $detail . '" >NA</a>';
            $row[] = !empty($order->service_type) ? display_placeholder_text($delType[$order->service_type]) : 'NA';
            // $row[] = !empty($item)?the_excerpt($item):'NA';
            $row[] = !empty($order->price) && $order->price != '0.00' ? display_placeholder_text('$' . $order->price) : 'NA';
            $row[] = !empty($order->created_at) ? date('d M Y', strtotime($order->created_at)) . ', ' . date("h:i:a", strtotime($order->created_at)) : 'NA';
            $row[] = !empty($order->status) ? $status : 'NA';
            // $action = '<span class="detail-icon"><a href="'.$detail.'"><i class="fa fa-eye "></i></a></span>';
            // $action = '<td class="text-right">
            //                 <div class="btn-group slct-btn">
            //                     <button type="button" class="form-control select-btn btn btn-default default-btn dropdown-toggle" data-toggle="dropdown" style="width: 100%;">
            //                         Select <span class="caret caret-2"></span>
            //                     </button>
            //                     <ul class="dropdown-menu  dropdown-menu-right" role="menu">
            //                         <li><a href="' . $file_name . '">Download Reciept</a></li>
            //                         <li><a href="' . $detail . '">Detail</a></li>
            //                     </ul>
            //                 </div>
            //               </td>';
            $action = '<td class="text-right">
                    <div class="recHisAction">
                        <a href="' . $detail . '" class="icView icCircle"><span data-toggle="tooltip" class="material-icons-outline md-visibility" title="Details"></span></a>
                        <a href="' . $file_name . '" class="icEdit icCircle"><span data-toggle="tooltip" class="material-icons-outline md-receipt_long" title="Download Reciept"></span></a>
                    </div>
                                    </td>';
            $row[] = $action;
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->Current_order_model->count_all(), "recordsFiltered" => $this->Current_order_model->count_filtered(), "data" => $data);
        //output to json format
        echo json_encode($output);
    } //end of function

    public function get_concierge_order_list() {
        $user_id = $this->session->userdata() ['app_user_sess']['userID'];
        $this->load->model('Concierge_order_model');
        $delType = getAllDeliveryCustom();
        // pr($_POST['status']);
        if ($_POST['status'] == '-1' || $_POST['status'] == '0') {
            $this->Concierge_order_model->set_data(array('cq.user_id' => $user_id, 'cq.status' => $_POST['status'] + 2));
        } elseif ($_POST['status'] >= '1') {
            $this->Concierge_order_model->set_data(array('cq.user_id' => $user_id, 'orders.status' => $_POST['status']));
        } else {
            $this->Concierge_order_model->set_data(array('cq.user_id' => $user_id));
        }
        $list = $this->Concierge_order_model->get_list();
        // lq();
        // pr($list);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $order) {
            if ($order->cqstatus == 1) {
                $status = '<h5 class="statusBadge"><span class="badge badge-warning">Pending</span></h5>';
            }
            if ($order->cqstatus == 2) {
                //$status = '<p id="badge" class="badge bg-warning">Offer Sent</p>';
                $status = '<h5 class="statusBadge"><span class="badge badge-warning">Offer Sent</span></h5>';

            }
            if ($order->cqstatus == 4) {
                //$status = '<p id="badge" class="badge bg-info">Declined</p>';
                $status = '<h5 class="statusBadge"><span class="badge badge-warning">Declined</span></h5>';

            }
            if (!empty($order->status)) {
                // status
                if ($order->status == 1) {
                    $status = '<h5 class="statusBadge"><span class="badge badge-warning">Placed</span></h5>';

                    // $status = '<p id="badge" class="badge bg-primary">Placed</p>';
                }
                if ($order->status == 2) {
                    $status = '<h5 class="statusBadge"><span class="badge badge-info">Approved</span></h5>';
                }
                if ($order->status == 3) {
                    $status = '<h5 class="statusBadge"><span class="badge badge-secondary">Shipped by Customer</span></h5>';

                    //$status = '<p id="badge" class="badge bg-primary">Shipped by Customer</p>';
                }
                if ($order->status == 4) {
                    $status = ' <h5 class="statusBadge"><span class="badge badge-dark">Received by Hobort</span></h5>';
                }
                if ($order->status == 5) {
                    //$status = '<p id="badge" class="badge bg-secondary">Packed</p> ';
                    $status = ' <h5 class="statusBadge"><span class="badge badge-primary">Packed</span></h5>';
                }
                if ($order->status == 6) {
                    //$status = '<p id="badge" class="badge bg-danger">On the way</p> ';
                    $status = ' <h5 class="statusBadge"><span class="badge badge-info">On the way</span></h5>';
                }
                if ($order->status == 7) {
                    $status = ' <h5 class="statusBadge"><span class="badge badge-success">Deliverd</span></h5>';
                }
            }
            if (!empty($order->receipt_file)) {
                $file_name = base_url('order/receipt_download/download_reciept?image_name=') . $order->receipt_file;
            } else {
                $file_name = 'javascript:void(0)';
            }
            $encoded = encoding($order->conciergeQuoteID);
            if (!empty($order->orderID)) {
                $encoded = encoding($order->orderID);
            }
            $detail = base_url() . 'order/current_order_detail/' . $encoded . '/' . encoding(2);
            $action = '';
            $no++;
            $row = array();
            $row[] = !empty($order->tracking_id) ? '<a href="' . $detail . '" style="color:#fca900">' . display_placeholder_text('#' . $order->tracking_id) . '</a>' : '<a href="' . $detail . '">NA</a>';
            // $row[] = !empty($order->description) ? display_placeholder_text($order->description) : 'NA';
            $row[] = mb_strimwidth(display_placeholder_text($order->description), 0, 50, "..."); 
            // $row[] = !empty($item)?the_excerpt($item):'NA';
            $row[] = !empty($order->offer_price) ? display_placeholder_text('$' . $order->offer_price) : 'NA';
            $row[] = !empty($order->cqcreated_at) ? date('d M Y', strtotime($order->cqcreated_at)) . ', ' . date("h:i:a", strtotime($order->cqcreated_at)) : 'NA';
            $row[] = !empty($status) ? $status : 'NA';
            // $action = '<span class="detail-icon"><a href="'.$detail.'"><i class="fa fa-eye "></i></a></span>';
            // $action = '<td class="text-right">
            //                 <div class="btn-group slct-btn">
            //                     <button type="button" class="form-control select-btn btn btn-default default-btn dropdown-toggle" data-toggle="dropdown" style="width: 100%;">
            //                         Select <span class="caret caret-2"></span>
            //                     </button>
            //                     <ul class="dropdown-menu  dropdown-menu-right" role="menu">
            //                         <li><a href="' . $file_name . '">Download Reciept</a></li>
            //                         <li><a href="' . $detail . '">Detail</a></li>
            //                     </ul>
            //                 </div>
            //               </td>';
             $action = '<td class="text-right">
                    <div class="recHisAction">
                        <a href="' . $detail . '" class="icView icCircle"><span data-toggle="tooltip" class="material-icons-outline md-visibility" title="Details"></span></a>
                        <a href="' . $file_name . '" class="icEdit icCircle"><span data-toggle="tooltip" class="material-icons-outline md-receipt_long" title="Download Reciept"></span></a>
                    </div>
                                    </td>';
            $row[] = $action;
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->Concierge_order_model->count_all(), "recordsFiltered" => $this->Concierge_order_model->count_filtered(), "data" => $data);
        //output to json format
        echo json_encode($output);
    } //end of function

    //function for concierge order list
    function concierge_order() {
        $this->check_user_session();
        $data['page_title'] = 'Current orders';
        $this->load->front_render('concierge_order_list', $data);
    } //end of function

    public function current_order_detail() {

        $this->check_user_session();

        $order_id = $this->uri->segment(3);
        $id = decoding($order_id);

        $where = array('orderID' =>$id);
        $data['page_title'] = "Tracking Detail";
        $data['orderexist'] = $this->common_model->is_data_exists(ORDERS, $where);
        $where_order = array('order_id' => $id);
        $data['ordersipments'] = $this->common_model->getTotalRecords(OS, $where_order);

        if (!empty($data['orderexist'])) {
            $data['userdetail'] = $this->common_model->is_data_exists(USERS,array('userID'=>$data['orderexist']->user_id));
            $data['title'] = "Order Details";

            if ($data['orderexist']->service_type==1) {
                // $where_air = array('order_id' =>$id );
                $data['air'] = $this->common_model->is_data_exists(AIR_FREIGHT_ORDER_INFO, $where_order);

                $where = array('airFreightItemID' =>$data['air']->item_id);
                $data['air_title'] = $this->common_model->is_data_exists(AIR_FREIGHT_ITEMS, $where);

                // $data['air_price'] = $this->common_model->is_data_exists(AIR_FREIGHT_SERVICES,array('airFreightServiceID'=>$data['orderexist']->service_id));
            }
            if ($data['orderexist']->service_type==2) {
                $where_sea = array('seaFreightServiceID' =>$data['orderexist']->service_id );
                $data['sea'] = $this->common_model->is_data_exists(SEA_FREIGHT_SERVICES, $where_sea);
            }

            $this->load->front_render('shipped_orders', $data);
          
        } else {
            $this->load->front_render('shipped_orders', $data);
        }
    }

    // public function current_order_detail() {
    //     // pr($_GET);
    //     $this->check_user_session();
    //     $id = $this->uri->segment(3);
    //     $type = $this->uri->segment(4);
    //     $order_id = decoding($id);
    //     // pr($order_id);
    //     $data['page_title'] = 'Order detail';
    //     $user_id = $this->session->userdata() ['app_user_sess']['userID'];
    //     $orderData = '';
    //     $concierge_detail = '';
    //     if (decoding($type) == 1) {
    //         $orderData = $this->common_model->is_data_exists(ORDERS, array('orderID' => $order_id));
    //     }
    //     if (decoding($type) == 2) {
    //         $concierge_detail = $this->common_model->is_data_exists(CONCIERGE_QUOTES, array('conciergeQuoteID' => $order_id));
    //     }
    //     //for consierge freight
    //     // lq();
    //     if ($orderData->service_type == 1) {
    //         $orderServiceDataAir = $this->common_model->is_data_exists(AIR_FREIGHT_ORDER_INFO, array('order_id' => $orderData->orderID));
    //         // pr($orderServiceDataAir);
    //         $orderServiceData = $this->common_model->is_data_exists(AIR_FREIGHT_ITEMS, array('airFreightItemID' => $orderServiceDataAir->item_id));
    //         $orderServiceDataPrice = $this->common_model->is_data_exists(AIR_FREIGHT_SERVICES, array('airFreightServiceID' => $orderData->service_id));
    //         $data['orderServiceDataPrice'] = $orderServiceDataPrice;
    //         $data['orderServiceDataAir'] = $orderServiceDataAir;
    //         $data['orderServiceData'] = $orderServiceData;
    //         //pr($data);
    //     }
    //     if ($orderData->service_type == 2) {
    //         $orderServiceData = $this->common_model->is_data_exists(SEA_FREIGHT_SERVICES, array('seaFreightServiceID' => $orderData->service_id));
    //     }
    //     if ($orderData->service_type == 3) {
    //         $orderServiceData = $this->common_model->is_data_exists(COURIER_SERVICES, array('courierServiceID' => $orderData->service_id));
    //     }
    //     $data['orderData'] = $orderData;
    //     $data['orderServiceData'] = $orderServiceData;
    //     // pr($data);
    //     //for concierge order view load
    //     $data['concierge_detail'] = $concierge_detail;
    //     if (!empty($concierge_detail)) {
    //         if ($concierge_detail->status == 1) {
    //             // echo "string";die();
    //             $this->load->front_render('concierge_order_pending', $data);
    //         } else {
    //             $this->load->front_render('concierge_order_offer', $data);
    //         }
    //         //pr($orderData);
    //     } else {
    //         if (empty($orderData)) {
    //             $this->load->front_render('empty_order', $data);
    //         }
    //     }
    //     if ($orderData->status == 1 && $orderData->service_type != 5) {
    //         if ($orderData->service_type == 4) {
    //             $data['concierge_detail'] = $this->common_model->is_data_exists(CONCIERGE_QUOTES, array('status' => 3, 'user_id' => $user_id, 'conciergeQuoteID' => $orderData->concierge_quote_id));
    //         }

    //         $this->load->front_render('place_order', $data);
    //     }
    //     if ($orderData->status >= 1 && $orderData->service_type == 5) {
    //         //$data['tracking_number'] = $orderData->shipment_tracking_ids;
    //         $data['tracking_number'] = '1Z12345E0291980793';
    //         // $response123 = $this->tracking_more->getCompanyName($data);
    //         $response = $this->tracking_more->getTrackingInfo($orderData->shipment_tracking_ids, 'upd');
    //         //pr($response);
           
    //         $this->load->front_render('shipment/shipment_details', $data);
    //     }
    //     if ($orderData->status == 2 && $orderData->service_type != 5) {
            
    //         if ($orderData->service_type == 4) {
    //             $data['concierge_detail'] = $this->common_model->is_data_exists(CONCIERGE_QUOTES, array('status' => 3, 'user_id' => $user_id, 'conciergeQuoteID' => $orderData->concierge_quote_id));
    //         }

    //         $this->load->front_render('approved_order', $data);
    //     }
    //     if ($orderData->status >= 3 && $orderData->service_type != 5) {
    //         if ($orderData->service_type == 4) {
    //             $data['concierge_detail'] = $this->common_model->is_data_exists(CONCIERGE_QUOTES, array('status' => 3, 'user_id' => $user_id, 'conciergeQuoteID' => $orderData->concierge_quote_id));
    //         }
            
    //         $this->load->front_render('shipped_order', $data);
    //     }
    // }

    public function create_quote() {
        $this->check_user_session();
        $data['page_title'] = 'Create Qoute';
        $data['air_freight_item'] = $this->order_model->getAllItem(AIR_FREIGHT_ITEMS, array('status' => 1));
        $data['sea_freight_item'] = $this->order_model->getAllItem(SEA_FREIGHT_SERVICES, array('status' => 1));
        $data['courier_freight_item'] = $this->order_model->getAllItem(COURIER_SERVICES, array('status' => 1));
        $data['sea_calculation'] = $this->common_model->is_data_exists(USERS, array('userID' => $_SESSION['app_user_sess']['userID']));
        $data['calculation_sea'] = $this->common_model->is_data_exists(ORDERS, array('user_id' => $_SESSION['app_user_sess']['userID']));
        //pr($data);
        // if ($data['sea_calculation']->promo_applicable == 1) {
        //     $price = calculate_promo_discount($data['calculation_sea']->price);
        // }
        $this->load->front_render('create_quote', $data);
    }

    //function for insert order
    function insert_order($jsonData) {
        //$this->check_ajax_auth();
        // pr($jsonData);
        $jsonData = json_encode($jsonData);
        $jsonData = json_decode($jsonData);
        $item = array();
        if ($jsonData->service_type == 1) {
            $item['length'] = $jsonData->length;
            $item['width'] = $jsonData->width;
            $item['weight'] = $jsonData->weight;
            $item['volumetric_weight'] = $jsonData->area_total;
            $item['item_id'] = $jsonData->item;
            $item['item_value'] = $jsonData->item_value;
            $item['height'] = $jsonData->height;
            $data['service_type'] = $jsonData->service_type;
            // $data['service_id'] = $jsonData->service_id;
            $data['quantity'] = $jsonData->quantity;
            // $data['price'] = $jsonData->totalValue;

            // $area_totald = $item['length'] * $item['height'] * $item['width'];
            // $area_total = $area_totald / 366;
            // $area_total = feet_to_cm($area_total);
            // $final_weight = $area_total;
            // if ($item['weight'] > $area_total) {
            //     $final_weight = $item['weight'];
            // }
            // $priceData = $this->order_model->getPrice($final_weight);
            // if (empty($priceData)) {
            //     return 0;
            // }
            // $airFreightServiceID = $priceData->airFreightServiceID;
            // $price = $priceData->price * (float)$data['quantity'];

            $price = $jsonData->price;

            //check promo_applicable for user
            $promo_applicable_check = $this->common_model->is_data_exists(USERS, array('userID' => $_SESSION['app_user_sess']['userID']));
            if (!empty($_SESSION['app_user_sess'])) {
                if ($promo_applicable_check->promo_applicable == 1) {
                    $price = calculate_promo_discount($price);
                    $promo_update['promo_applicable'] = 0;
                    $this->common_model->updateFields(USERS, $promo_update, array('userID' => $_SESSION['app_user_sess']['userID']));
                }
            }
            $data['price'] = $price;
        }else if ($jsonData->service_type == 2) {
            $data['service_type'] = $jsonData->service_type;
            $data['service_id'] = $jsonData->service_id;
            $data['quantity'] = $jsonData->quantity;
            // $data['price'] = $jsonData->totalValue_sea;
            // pr($jsonData);
            $priceData = $this->common_model->is_data_exists(SEA_FREIGHT_SERVICES, array('seaFreightServiceID' => $jsonData->service_id));
            // pr($priceData);
            $price = '0.00';
            if (!empty($priceData)) {
                $price = $priceData->price;
            } else {
                return 0;
            }
            $tota_price = $price * $data['quantity'];
            //check promo_applicable for user
            $promo_applicable_check = $this->common_model->is_data_exists(USERS, array('userID' => $_SESSION['app_user_sess']['userID']));
            if (!empty($_SESSION['app_user_sess'])) {
                if ($promo_applicable_check->promo_applicable == 1) {
                    $tota_price = calculate_promo_discount($tota_price);
                    $promo_update['promo_applicable'] = 0;
                    $this->common_model->updateFields(USERS, $promo_update, array('userID' => $_SESSION['app_user_sess']['userID']));
                }
            }
            $data['price'] = $tota_price;
        }else if ($jsonData->service_type == 3) {
            $data['service_type'] = $jsonData->service_type;
            $data['service_id'] = $jsonData->service_id;
            $data['quantity'] = $jsonData->quantity;
            // $data['price'] = $jsonData->totalValue_courier;
            $priceData = $this->common_model->is_data_exists(COURIER_SERVICES, array('courierServiceID' => $jsonData->service_id));
            // pr($priceData);
            $price = '0.00';
            if (!empty($priceData)) {
                $price = $priceData->price;
            } else {
                return 0;
            }
            $tota_price = $price * $data['quantity'];
            //check promo_applicable for user
            $promo_applicable_check = $this->common_model->is_data_exists(USERS, array('userID' => $_SESSION['app_user_sess']['userID']));
            if (!empty($_SESSION['app_user_sess'])) {
                if ($promo_applicable_check->promo_applicable == 1) {
                    $tota_price = calculate_promo_discount($tota_price);
                    $promo_update['promo_applicable'] = 0;
                    $this->common_model->updateFields(USERS, $promo_update, array('userID' => $_SESSION['app_user_sess']['userID']));
                }
            }
            $data['price'] = $tota_price;
        }

        $data['user_id'] = $this->session->userdata() ['app_user_sess']['userID'];
        // $data['shipper_name'] = $this->session->userdata()['app_user_sess']['name'];
        $data['updated_at'] = datetime();
        $data['created_at'] = datetime();
        $is_already = $this->common_model->is_data_exists(ORDERS, array('user_id' => $data['user_id'], 'status!=' => 7));

        if(!empty($is_already)){
            return $is_already->orderID;
        }

        if ($data) {
            $orderInsert = $this->common_model->insertData(ORDERS, $data);
            if (!empty($item)) {
                // pr($item);
                $item['order_id'] = $orderInsert;
                $itemInsert = $this->common_model->insertData(AIR_FREIGHT_ORDER_INFO, $item);
                // pr($itemInsert);
                
            }
            // unset($this->session->userdata()['is_user_logged_in']);
            $this->session->unset_userdata('is_user_logged_in');
            return $orderInsert;
        }
    } //end of function

    //function for insert concierge detail
    function insert_concierge_order($jsonData) {
        $this->check_ajax_auth();
        $jsonData = json_encode($jsonData);
        $jsonData = json_decode($jsonData);
        $data['user_id'] = $this->session->userdata() ['app_user_sess']['userID'];
        // pr($data['user_id']);
        // $item['length'] = $jsonData->service_type;
        $data['description'] = $jsonData->description;
        $data['updated_at'] = datetime();
        $data['created_at'] = datetime();
        $concierge_detail = $this->common_model->is_data_exists(CONCIERGE_QUOTES, array('user_id' => $data['user_id'], 'status<=' => 2));
        // pr($concierge_detail);
        $this->session->unset_userdata('is_user_logged_in');
        $last_id = $this->common_model->insertData(CONCIERGE_QUOTES, $data);
        return $last_id;
        return $concierge_detail->conciergeQuoteID;
    } //end of function

    //function for accept and reject function
    function accept_reject_concierge() {
        $this->check_ajax_auth();
        $flag = $this->input->post('flag');
        $id = $this->input->post('id');
        $concierge_detail = $this->common_model->is_data_exists(CONCIERGE_QUOTES, array('conciergeQuoteID' => $id));
        if (empty($concierge_detail)) {
            echo json_encode(array('status' => 0, 'message' => 'Invalid order to accept or reject'));
            die();
        }
        if ($flag == 1) {
            $data_update['status'] = 3;
            $data_update['updated_at'] = datetime();
            $message = 'Offer has been approved.';
        }
        if ($flag == 2) {
            $data_update['status'] = 4;
            $data_update['updated_at'] = datetime();
            $message = 'Offer has been rejected.';
        }
        $updated = $this->common_model->updateFields(CONCIERGE_QUOTES, $data_update, array('conciergeQuoteID' => $id));
        $orderData['user_id'] = $this->session->userdata() ['app_user_sess']['userID'];
        $orderData['service_type'] = 4;
        $orderData['price'] = $concierge_detail->offer_price;
        $orderData['order_cost'] = $concierge_detail->order_cost;
        $orderData['concierge_fee'] = $concierge_detail->concierge_fee;
        $orderData['concierge_quote_id'] = $concierge_detail->conciergeQuoteID;
        $orderData['updated_at'] = datetime();
        $orderData['created_at'] = datetime();
        if ($updated == true && $flag == 1) {
            $insert_order = $this->common_model->insertData(ORDERS, $orderData);
        }
        echo json_encode(array('status' => 1, 'message' => $message, 'url' => base_url('order/concierge_order')));
        die();
    } //end of function

    //function for get company name through traking more api
    function getCompanyName() {
        $traking_id = $this->input->post('tracking_id');
        $data['tracking_number'] = $traking_id;
        $response = $this->tracking_more->getCompanyName($data);
        // pr($response->meta->code);
        if ($response->meta->code != 200) {
            echo json_encode(array('status' => 0, 'message' => $response->meta->message));
            die();
        }
        echo json_encode(array('status' => 1, 'company_name' => $response->data[0]->name, 'company_code' => $response->data[0]->code));
        die();
    } //end of funtion

    //function for add shipper info
    function add_shipper_info() {
        $this->check_ajax_auth();
        $this->form_validation->set_rules('shipper_name', 'Shipper name', 'required');
        $this->form_validation->set_rules('tracking_id', 'Tracking id', 'required');
        $this->form_validation->set_rules('company_name', 'Company name', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');
        $is_tracking = $this->common_model->is_data_exists(ORDERS, array('shipper_tracking_id' => $this->input->post('tracking_id')));
        if (!empty($is_tracking)) {
            echo json_encode(array('status' => 0, 'message' => 'Tracking Id already exist'));
            die();
        }
        //when validation false
        if ($this->form_validation->run($this) == FALSE) {
            echo json_encode(array('status' => 0, 'message' => validation_errors()));
            die();
        }
        $order_id = $this->input->post('order_id');
        $is_exist = $this->common_model->is_data_exists(ORDERS, array('orderID' => $order_id));
        if (empty($is_exist)) {
            echo json_encode(array('status' => 0, 'message' => 'This order is not exist'));
            die();
        }
        $shipper_name = $this->input->post('shipper_name');
        $tracking_id = $this->input->post('tracking_id');
        $company_name = $this->input->post('company_name');
        $content = $this->input->post('content');
        $insertData['shipper_name'] = $shipper_name;
        $insertData['shipper_tracking_id'] = $tracking_id;
        $insertData['shipper_company_name'] = $company_name;
        $insertData['shipper_description'] = $content;
        $insertData['status'] = 3;
        $status_json_text = json_decode($is_exist->status_updated_at);
        $status_json_text->shipped_by_customer_at = datetime();
        $insertData['status_updated_at'] = json_encode($status_json_text);
        $insertData['updated_at'] = datetime();
        $updated = $this->common_model->updateFields(ORDERS, $insertData, array('orderID' => $order_id));
        if ($updated != TRUE) {
            echo json_encode(array('status' => 0, 'message' => 'Problem in updation'));
            die();
        }
        echo json_encode(array('status' => 1, 'message' => 'Shipper info updated successfully'));
        die();
    } //end of function

    //function for upload reciept
    function upload_reciept() {
        $this->check_ajax_auth();
        $id = $_POST['id'];
        $is_data = $this->common_model->is_data_exists(ORDERS, array('orderID' => $id));
        if (empty($is_data)) {
            echo json_encode(array('status' => 0, 'message' => 'Order is not exist'));
            die();
        }
        if (empty($_FILES['file_name'])) {
            echo json_encode(array('status' => 0, 'message' => 'Please select a file to upload'));
            die();
        }
        $ext = pathinfo($_FILES['file_name']['name']);
        $this->load->model('Image_model');
        $this->load->model('File_model');
        $folder = 'receipt';
        // pr($ext['extension']);
        if (in_array($ext['extension'], imageExtension())) {
            // echo "string";die();
            $res['image_name'] = $this->Image_model->upload_image('file_name', $folder); //upload media of
            
        } else {
            // echo "string";die();
            $res['image_name'] = $this->File_upload_model->upload_file_to_s3('file_name', $folder, $file_names = '', 'doc'); //upload media of
            
        }
        // $res['image_name'] = $this->File_model->upload_image('file_name', $folder); //upload media of
        // pr($res['image_name']);
        if (!empty($res['image_name']['error'])) {
            echo json_encode(array('status' => 0, "msg" => $res['image_name']['error']));
            die;
        }
        // pr($ext['extension']);
        $data['receipt_file'] = $res['image_name'];
        $data['receipt_mime_type'] = $_FILES['file_name']['type'];
        $data['receipt_file_extension'] = $ext['extension'];
        $data['updated_at'] = datetime();
        $is_update = $this->common_model->updateFields(ORDERS, $data, array('orderID' => $id));
        if ($is_update != TRUE) {
            echo json_encode(array('status' => 0, 'message' => 'Problem in query'));
            die();
        }
        $for_image_data = $this->common_model->is_data_exists(ORDERS, array('orderID' => $id));
        $header_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'header';
        $content_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'content';
        if (!empty($for_image_data->receipt_file)) {
            if (in_array($for_image_data->receipt_file_extension, imageExtension())) {
                $receipt_file = getenv('S3_USER_RECEIPT_THUMB') . $for_image_data->receipt_file;
            } elseif (in_array($for_image_data->receipt_file_extension, fileExtension())) {
                $receipt_file = $content_images . '/doc.png';
            } else {
                $receipt_file = $content_images . '/pdf.png';
            }
        }
        // $image_path = getenv('S3_USER_RECEIPT_DIR').$res['image_name'];
        echo json_encode(array('status' => 1, 'message' => 'Receipt uploaded!', 'image' => $receipt_file, 'image_name' => $res['image_name']));
        die();
    } //end of funtoion

    //functon for download image
    function download_reciept() {
        $this->check_user_session();
        if (empty($_POST['file_name'])) {
            echo json_encode(array('status' => 0, 'message' => 'Receipt does not exist'));
            die();
        }
        $this->load->model('Image_model');
        $res['image_name'] = $this->Image_model->download_file($_POST['urls'], $_POST['file_name']);
        if (empty($res['image_name'])) {
            echo json_encode(array('status' => 0, 'message' => 'Receipt does not exist'));
            die();
        }
        echo json_encode(array('status' => 1, 'image' => $res['image_name']));
        die();
    } //end of function

    //function for past order list
    function past_order() {
        $this->check_user_session();
        $data['page_title'] = 'Past order';
        $this->load->front_render('past_order', $data);
    } //end of function
    //get_ticket_list
    public function get_past_order_list() {
        $user_id = $this->session->userdata() ['app_user_sess']['userID'];
        $this->load->model('Past_order_model');
        // $status = $this->input->post('ticketStatus');
        // if($status){
        //     $this->Ticket_model->set_data(array('created_by_id'=>$user_id,'tickets.status'=>$status));
        // }else{
        // }
        $delType = getAllDeliveryCustom();
        if (!empty($_POST['type'])) {
            $this->Past_order_model->set_data(array('user_id' => $user_id, 'orders.service_type' => $_POST['type']));
        } else {
            $this->Past_order_model->set_data(array('user_id' => $user_id));
        }
        $list = $this->Past_order_model->get_list();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $order) {
            if (!empty($order->sea_title)) {
                $item = $order->sea_title;
            } elseif (!empty($order->courier_title)) {
                $item = $order->courier_title;
            } elseif (!empty($order->air_title)) {
                $item = $order->air_title;
            } elseif (!empty($order->air_title)) {
                $item = $order->air_title;
            } else {
                $item = 'NA';
            }
            if (!empty($order->receipt_file)) {
                $file_name = base_url('order/receipt_download/download_reciept?image_name=') . $order->receipt_file;
            } else {
                $file_name = 'javascript:void(0)';
            }
            $encoded = encoding($order->orderID);
            $action = '';
            $no++;
            $row = array();
            $row[] = display_placeholder_text('#' . $order->tracking_id);
            $row[] = display_placeholder_text($delType[$order->service_type]);
            $row[] = the_excerpt($item);
            $row[] = display_placeholder_text('$' . $order->price);
            $row[] = date('d M Y', strtotime($order->created_at)) . ', ' . date("h:i:a", strtotime($order->created_at));
            $detail = base_url() . 'order/order_detail/' . $encoded;
            // $action = '<span class="detail-icon"><a href="'.$detail.'"><i class="fa fa-eye "></i></a></span>';
            // $action = '<td class="text-right">
            //                 <div class="btn-group slct-btn">
            //                     <button type="button" class="form-control select-btn btn btn-default default-btn dropdown-toggle" data-toggle="dropdown" style="width: 100%;">
            //                         Select <span class="caret caret-2"></span>
            //                     </button>
            //                     <ul class="dropdown-menu  dropdown-menu-right" role="menu">
            //                         <li><a href="'.$file_name.'">Download Reciept</a></li>
            //                         <li><a href="'.$detail.'">Detail</a></li>
            //                     </ul>
            //                 </div>
            //               </td>';
            $action = '<td class="text-right">
                    <div class="recHisAction">
                        <a href="' . $detail . '" class="icView icCircle"><span data-toggle="tooltip" class="material-icons-outline md-visibility" title="Details"></span></a>
                        <a href="' . $file_name . '" class="icEdit icCircle"><span data-toggle="tooltip" class="material-icons-outline md-receipt_long" title="Download Reciept"></span></a>
                    </div>
                                    </td>';
            $row[] = $action;
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->Past_order_model->count_all(), "recordsFiltered" => $this->Past_order_model->count_filtered(), "data" => $data);
        //output to json format
        echo json_encode($output);
    } //end of function

    //function for orderdetail
    function order_detail() {
        $this->check_user_session();
        $data['page_title'] = 'Past order-detail';
        $id = $this->uri->segment(3);
        $order_id = decoding($id);
        $orderData = $this->common_model->is_data_exists(ORDERS, array('orderID' => $order_id, 'status' => 7));
        $data['orderData'] = $orderData;
        if ($orderData->service_type == 1) {
            $orderServiceDataAir = $this->common_model->is_data_exists(AIR_FREIGHT_ORDER_INFO, array('order_id' => $orderData->orderID));
            // pr($orderServiceDataAir);
            $orderServiceData = $this->common_model->is_data_exists(AIR_FREIGHT_ITEMS, array('airFreightItemID' => $orderServiceDataAir->item_id));
            $orderServiceDataPrice = $this->common_model->is_data_exists(AIR_FREIGHT_SERVICES, array('airFreightServiceID' => $orderData->service_id));
            $data['orderServiceDataPrice'] = $orderServiceDataPrice;
            $data['orderServiceDataAir'] = $orderServiceDataAir;
            $data['orderServiceData'] = $orderServiceData;
            // pr($data);
            
        }
        if ($orderData->service_type == 2) {
            $orderServiceData = $this->common_model->is_data_exists(SEA_FREIGHT_SERVICES, array('seaFreightServiceID' => $orderData->service_id));
        }
        if ($orderData->service_type == 3) {
            $orderServiceData = $this->common_model->is_data_exists(COURIER_SERVICES, array('courierServiceID' => $orderData->service_id));
        }
        $data['orderServiceData'] = $orderServiceData;
        if (!empty($orderData->concierge_quote_id)) {
            $data['concierge_detail'] = $this->common_model->is_data_exists(CONCIERGE_QUOTES, array('conciergeQuoteID' => $orderData->concierge_quote_id));
        }
        // pr($data);
        $this->load->front_render('complete_order_detail', $data);
        // if($orderData->service_type==5){
        //     $this->load->front_render('shipment/shipment_details', $data);
        // }
        // else{
        // $this->load->front_render('complete_order_detail', $data);
        // }
        
    } //end of function
    
} //end of class
