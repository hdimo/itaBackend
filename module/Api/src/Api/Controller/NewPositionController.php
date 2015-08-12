<?php
/**
 * User: khaled
 * Date: 8/3/15 at 11:05 AM
 */

namespace Api\Controller;


use Application\Entity\Position;
use Zend\File\Transfer\Adapter\Http;
use Zend\Filter\File\Rename;
use Zend\View\Model\JsonModel;

class NewPositionController extends BaseController
{

    public function create($data)
    {

        //echo exec('echo '.serialize($_POST).' > /home/khaled/Desktop/file.txt');
        error_log("You messed up!", 3, BASE_PATH."/../data/log/my-errors.log");

        $file = $this->params()->fromFiles();
        $filename = $this->uploadImage($file);

        $position = new Position();
        $position->setLatitude($data['latitude']);
        $position->setLongitude($data['longitude']);
        $position->setComment($data['comment']);
        $position->setStatus($data['status']);
        $position->setImage($filename);
        $position->setCreatedDate(time());

        $this->getEntityManager()->persist($position);
        $this->em->flush();

        $model = new JsonModel();
        $model->setVariables($data);
        return $model;
    }

    public function uploadImage($file){

        $filename = $file['file']['name'];
        $adapter = new Http();
        $path = BASE_PATH.'/img/position';
        $fileRenameFilter = new Rename(array(
            'target' => $path . '/usr.jpg',
            'randomize' => true,
        ));
        $adapter->addFilters(array($fileRenameFilter));
        if($adapter->receive($filename)){
            $fileFullPath = explode('/', $adapter->getFileName());
            $newFileName = array_pop($fileFullPath);
            return $newFileName;
        }else {
            return 'no-image.png';
        }
    }

}
