<?php

class Application_Model_Photo
{
    /**
     * @var Application_Form_Photo
     */
    protected $_form;
    
    /**
     * Panggil upload form
     * 
     * @return Application_Form_Photo
     */
    public function getForm()
    {
        if (null === $this->_form) {
            $this->_form = new Application_Form_Photo();
        }
        return $this->_form;
    }
    
    /**
     * Fungsi ini cuma merename gambar berdasar title hasil upload gambar original 
     * kemudian untuk proses resizing ada pada @link {$this->_process()}
     * 
     * @param array $data
     * @return array berisi title, original_filename, thumb_filename
     */
    public function upload(array $data)
    {
        $form = $this->getForm();
        if ($form->user_image->isUploaded()) {
            $form->user_image->addFilter('Rename', array(
                        'target' => $form->user_image->getDestination() 
                                    . DIRECTORY_SEPARATOR 
                                    . $this->_normalizeTitle($form->title->getValue()) 
                                    . '.jpg', // hanya jpg yang valid kan?
                        'overwrite' => true,
                    ));
            $form->user_image->receive();
            $process = $this->_process($form->user_image->getFilename(), $form->title->getValue());
            return $process;
        }
    }
    
    /**
     * Fungsi ini memproses thumbnail untuk file yang telah diupload pada fungsi @link {$this->upload()}
     * 
     * @param array $full_path Absolute path dari gambar
     * @param array $title Title Gambar
     * @return array
     */
    protected function _process($full_path, $title)
    {
        $thumbOptions = array(
            'resizeUp'      => false,
            'jpegQuality'   => 85,
            'correctPermissions' => false,
        );
        
        $thumb = PhpThumbFactory::create($full_path, $thumbOptions);
        $thumb->adaptiveResize(250, 250);
        
        $fileinfo = new SplFileInfo($full_path);
        $path = $fileinfo->getPath() . DIRECTORY_SEPARATOR;

        $new_file = '_thumb_' . $fileinfo->getFilename();
        
        $thumb->save($path . $new_file, 'JPG');
        
        $result = array(
            'title' => $title,
            'original_filename' => $fileinfo->getBasename(),
            'thumb_filename' => $new_file,
        );
        
        return $result;
    }
    
    /**
     * Fungsi ini akan menormalisasi title untuk keperluan filename gambar
     * 
     * @param string $title
     * @return string Title yang telah dinormalisasikan
     */
    protected function _normalizeTitle($title)
    {
        if (is_string($title)) {
            $title = iconv('utf-8', 'ascii//translit', $title);
            $title = strtolower($title);
            $title = preg_replace('#[^a-z0-9-_]#', '_', $title);
            $title = preg_replace('#-{2,}#', '_', $title);
            return $title;
        }
    }
}

