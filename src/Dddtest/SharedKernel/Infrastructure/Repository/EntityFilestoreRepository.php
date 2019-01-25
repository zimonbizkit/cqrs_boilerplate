<?php

namespace Dddtest\SharedKernel\Infrastructure\Repository;

use Dddtest\SharedKernel\Domain\Entity\DomainEntityInterface;
use Dddtest\SharedKernel\Domain\Entity\EntityIdInterface;

abstract class EntityFilestoreRepository
{
    abstract protected function getEntityClass();

    public function exists(EntityIdInterface $entityId): bool
    {
        $fileName = $this->getFileName($this->getEntityClass());
        if (strstr(file_get_contents($fileName), $entityId->value())!==false) {
            return true;
        }
        return false;

    }

    public function save(DomainEntityInterface $entity)
    {
        $filename = $this->getFileName($entity);
        if(file_exists($filename)) {
            file_put_contents($filename,serialize($entity),FILE_APPEND);
        }else{
            $h = fopen('./'.$filename,'w');
            fputs($h,serialize($entity));
            fclose($h);
        }
    }

    /**
     * @param DomainEntityInterface $entity
     * @return string
     */
    private function getFileName(DomainEntityInterface $entity): string
    {
        $parts = explode("\\", get_class($entity));
        $filename = "_filestore__" . strtolower($parts[count($parts) - 1]);
        return $filename;
    }

}