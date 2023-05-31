<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    // public function configureFields(string $pageName): iterable
    // {
    //     return [
    //         IdField::new('id'),
    //         TextField::new('title'),
    //         TextEditorField::new('description'),
    //     ];
    // }  

    
    public function configureFields(string $pageName): iterable
    {
        return [
            // yield Field::new('nombre_producto'),
            'nombre_producto',
            'costo_unitario',
            'existencia',
            'unidad_medida',
            AssociationField::new('user'),
            Field::new('creation_date'),

            // yield Field::new('title'),
            // yield Field::new('description'),
        ];
    }
    
}
