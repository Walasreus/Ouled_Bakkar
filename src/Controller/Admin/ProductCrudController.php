<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnIndex()
                              ->hideOnForm(),
            TextField::new('name'),
            TextareaField::new('description'),
            AssociationField::new('category'),
            MoneyField::new('price')->setCurrency('EUR'),
            ImageField::new('image')->setBasePath('/assets/image/products')//le dossier où il cherche nos images
                                    ->setUploadDir('public/assets/image/products')
            //Pour les images de même nom et la regénéartion d'un nouveau nom d'image d'une manière aléartoire avec : randomhash
                                    ->setUploadedFileNamePattern('[randomhash].[extension]'),// la manière de comment on vas encoder nos images,
            DateTimeField::new('created_at')->hideOnForm(),
            DateTimeField::new('updated_at')->hideOnForm(),
        ];
    }
 
}
