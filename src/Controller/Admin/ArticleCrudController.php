<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            TextareaField::new('content'),
            TextField::new('header'),
            ImageField::new('image')->setBasePath('/assets/image/articles')//le dossier où il cherche nos images
                                    ->setUploadDir('public/assets/image/articles')
                                    //Pour les images de même nom et la regénéartion d'un nouveau nom d'image d'une manière aléartoire avec : randomhash
                                    ->setUploadedFileNamePattern('[randomhash].[extension]'),// la manière de comment on vas encoder nos images
            BooleanField::new('published'),
            AssociationField::new('user'),
            DateTimeField::new('updated_at')->hideOnForm(),
            DateTimeField::new('created_at')->hideOnForm(),

        ];
    }

}
