<?php

class Application_Form_Photo extends Zend_Form
{
    public function init()
    {
        $this->setOptions(array(
            'method' => Zend_Form::METHOD_POST,
            'elements' => array(
                'title' => array('text', array(
                    'label'       => 'Judul gambar',
                    'description' => 'Untuk alt dan title tag',
                    'required'    => true,
                )),
                'user_image' => array('file', array(
                    'label'       => 'Pilih Gambar',
                    'description' => 'Minimum: 300x300, Maximum: 1600x1600/1MB',
                    'required'    => true,
                    'destination' => PUBLIC_ABSOLUTE_PATH . IMAGE_PATH,
                    'validators' => array(
                        array('count', false, 1),
                        array('size', false, 1024000),
                        array('extension', false, 'jpg'),
                        array('mimeType', false, array('image/jpeg')),
                        array('ImageSize', false, array(
                            'minwidth' => 300,
                            'minheight' => 300,
                            'maxwidth' => 1600,
                            'maxheight' => 1600,
                        ))
                    ),
                )),
                'upload_button' => array('submit', array(
                    'label' => 'Proses',
                )),
            )
        ));
    }
}

