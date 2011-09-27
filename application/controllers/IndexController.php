<?php

class IndexController extends Zend_Controller_Action
{
    /**
     * Tampilkan form upload dan proses form jika request = $_POST
     */
    public function indexAction()
    {
        $upload_model = new Application_Model_Photo();
        $form = $upload_model->getForm();
        $this->view->upload_form = $form;
        
        $request = $this->getRequest();
        
        if ($request->isPost() && $form->isValid($request->getPost())) {
            try {
                $upload = $upload_model->upload($request->getPost());
            } catch (Exception $e) {
                $upload = false;
            }
            
            /**
             * Jika upload sukses, simpan daftar filename (original, thumbnail), 
             * dan title ke database (PDO_SQLITE)
             */
            if ($upload !== false) {
                $dbModel = new Application_Model_DbTable_Photos();
                $insert = $dbModel->insert($upload);
                if ($insert) {
                    $this->_redirect('/index/list');
                }
            }
        }
    }
    
    /**
     * Controller ini untuk menampilkan thumbnail foto yang sudah diproses pada indexAction(). 
     * Data thumbnail yang diambil
     */
    public function listAction()
    {
        $table = new Application_Model_DbTable_Photos();
        $this->view->photos = $table->fetchAll();
    }
    
    
}

